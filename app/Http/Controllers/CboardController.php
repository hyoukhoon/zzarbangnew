<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Cboard;
use App\Models\Memo;
use App\Models\Qna;
use App\Models\Police;
use App\Models\Chukppa;
use App\Models\Ozzal;
use App\Models\Filetables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CboardController extends Controller
{
    public function index(){
        $multi = "ozzal";
        $boards = Ozzal::where("multi",$multi)
                    ->orderBy("site_reg_date","desc")
                    ->paginate(50);
        return view("boards.index",['boards' => $boards, 'multi' => $multi]);
    }

    public function show($bid, $page = null){
        Cboard::find($bid)->increment('cnt');
        //$boards = Cboard::findOrFail($bid);
        
        //DB::enableQueryLog();
        $boards = DB::table('cboard as c1')
                    ->select('c1.*','m.photo','ml.mylevel','cg.good as mygood','cg.bad as mybad'
                        ,DB::raw("(select num from cboard c2 where c2.num < c1.num order by num desc limit 1) as prev")
                        ,DB::raw("(select num from cboard c2 where c2.num > c1.num order by num asc limit 1) as next")
                    )
                    ->join("member as m","m.email", "=", "c1.email")
                    ->join("member_levels as ml","ml.userid", "=", "m.email")
                    ->leftJoin("cboard_grade as cg",function($join) {
                        $join->on("cg.bid", "=", "c1.num")
                        ->where('cg.userid', '=', Auth::user()->email);
                    })
                    ->where('c1.num',$bid)->first();
        //print_r(DB::getQueryLog());
        $boards->content = htmlspecialchars_decode($boards->content);
        if($boards->photo){
            $boards->userphoto="/board/upImages/thumb/".$boards->photo;
        }else{
            $boards->userphoto="/img/person-square.svg";
        }

        if($boards->mygood){
            $boards->btu="/img/hand-thumbs-up-fill.svg";
        }else{
            $boards->btu="/img/hand-thumbs-up.svg";
        }

        if($boards->mybad){
            $boards->btd="/img/hand-thumbs-down-fill.svg";
        }else{
            $boards->btd="/img/hand-thumbs-down.svg";
        }

        $memos = array();
        //if($boards->memo_cnt){//메모
            DB::enableQueryLog();
                $memos = Memo::query()
                ->select('xc_memo.*', 'xc_member.photo', 'xc_member_levels.mylevel', 'z.gn', 'z.bn')
                ->join('xc_member', 'xc_memo.userid', '=', 'xc_member.email')
                ->leftJoin('xc_member_levels', 'xc_member_levels.userid', '=', 'xc_memo.userid')
                ->leftJoinSub(function ($query) {
                    $query->select('memoid', DB::raw('sum(good) as gn'), DB::raw('sum(bad) as bn'))
                        ->from('xc_memo_grade')
                        ->groupBy('memoid');
                }, 'z', 'z.memoid', '=', 'xc_memo.memoid')
                ->where('xc_memo.status', 1)
                ->where('xc_memo.bid', $bid)
                ->orderByRaw('ifnull(xc_memo.pid, xc_memo.memoid) asc, xc_memo.memoid asc')
                ->get();
            print_r(DB::getQueryLog());
        //}
        return view("boards.show",['boards' => $boards, 'memos' => $memos]);
    }

    public function summernote($multi, $bid = null)
    {
        if($bid){
            $boards = Cboard::findOrFail($bid);
        }else{
            $boards = array();
        }
        return view('boards.summernote', ['multi' => $multi, 'boards' => $boards]);
    }

    public function write($multi,$bid=null)
    {
        if(auth()->check()){
            $boards = array();
            $attaches = array();
            $bid = $bid??0;
            if($bid){
                $boards = Cboard::findOrFail($bid);
                $attaches = Filetables::where('pid',$bid)->where('status',1)->where('code','boardattach')->get();
                return view('boards.write', ['multi' => $multi, 'bid' => $bid, 'boards' => $boards, 'attaches' => $attaches]);
            }else{
                return view('boards.write', ['multi' => $multi, 'bid' => $bid, 'boards' => $boards, 'attaches' => $attaches]);
            }
        }else{
            return redirect()->back()->withErrors('로그인 하십시오.');
        }
    }

    public function create(Request $request)
    {
        $form_data = array(
            'subject' => $request->subject,
            'content' => $request->content,
            'uid' => Auth::user()->email,
            'name' => Auth::user()->nickName,
            'email' => Auth::user()->email,
            'multi' => $request->multi??'ozzal',
            'isdisp' => 1
        );

        if(auth()->check()){
            $rs = Cboard::create($form_data);
            if($rs){//디비에 입력하면 엘라스틱에도
                $multi = $request->multi??'ozzal';
                $thumbnail="img";
                $url = "/boards/show/".$rs->num."/1";
                $dates = date("Y/m/d H:i:s");
                $esuid = "ozzal_free_".$rs->num;
                $es = Ozzal::create([
                    'username' => Auth::user()->nickName,
                    'multi' => $multi,
                    'thumbnail' => $thumbnail,
                    'subject' => $request->subject,
                    'url' => $url,
                    'site_num' => $rs->num,
                    'userid' => Auth::user()->email,
                    'site_reg_date' => $dates,
                    'site_cnt' => 1,
                    'uid' => $esuid
                ]);
            }

            Filetables::where('bid', $request->pid)->where('userid', Auth::user()->email)->update(array('bid' => $rs->num));

            return response()->json(array('msg'=> "succ", 'bid'=>$rs->num), 200);
        }
    }

    public function saveimage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if(auth()->check()){
            $image = $request->file('file');
            $new_name = rand().'_'.time().'.'.$image->getClientOriginalExtension();
            //$image->move(public_path('images'), $new_name);
            $result = Storage::putFileAs('images', $request->file('file'), $new_name);
            $imgurl = Storage::url("images/".$new_name);
            $pid = $request->modimemoid?$request->modimemoid:$request->pid;
            $fid = rand();
            $form_data = array(
                'pid' => $pid,
                'userid' => Auth::user()->email,
                'code' => $request->code,
                'filename' => $new_name
            );
            $rs=FileTables::create($form_data);
            return response()->json(array('msg'=> "등록했습니다.", 'result'=>'succ', 'fn'=>$new_name, 'fid'=>$fid, 'imgurl' => $imgurl), 200);
        }else{
            return response()->json(array('msg'=> "로그인 하십시오", 'result'=>'fail'), 200);
        }
    }
}
