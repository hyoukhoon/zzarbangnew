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
        if($boards->memo_cnt){//메모
            //DB::enableQueryLog();
                $memos = DB::table('memo as m')
                ->join('member as b', 'm.userid', '=', 'b.email')
                ->leftJoin('member_levels as ml', 'ml.userid', '=', 'm.userid')
                ->leftJoin(DB::raw('(
                    select mg.memoid, sum(mg.good) as gn, sum(mg.bad) as bn
                    from memo_grade mg
                    group by mg.memoid
                ) as z'), 'z.memoid', '=', 'm.memoid')
                ->select(
                    'm.*',
                    'b.photo',
                    'ml.mylevel',
                    'z.gn',
                    'z.bn'
                )
                ->where('m.status', 1)
                ->where('m.bid', $bid)
                ->orderByRaw('IFNULL(m.pid, m.memoid) ASC, m.memoid ASC')
                ->get();
            //print_r(DB::getQueryLog());
        }
        //print_r($memos);
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

    public function memodelete(Request $request)
    {
        $data = Memo::findOrFail($request->memoid);
        if(Auth::user()->email==$data->userid){
            $rs = Memo::where('memoid', $request->memoid)->update(array('status' => 0));
            if($rs){
                CBoard::find($request->num)->decrement('memo_cnt');
                $fs=FileTables::where('pid', $data->memoid)->get();
                if($fs){
                    foreach($fs as $f){
                        if(FileTables::where('id', $f->id)->where('userid', Auth::user()->email)->update(array('status' => 0))){
                            //unlink(public_path('images')."/".$f->filename);
                            Storage::delete('images/'.$f->filename);
                        }
                    }
                }
            }
            return response()->json(array('msg'=> "succ", 'num'=>$rs), 200);
        }else{
            return response()->json(array('msg'=> "fail", 'val'=>"본인이 작성한 글만 삭제할 수 있습니다."), 200);
        }
    }

    public function memowrite(Request $request)
    {
        $form_data = array(
            'memo' => $request->memo,
            'bid' => $request->bid,
            'pid' => $request->pid??null,
            'userid' => Auth::user()->email,
            'name' => Auth::user()->nickName
        );

        if(auth()->check()){
            $rs=Memo::create($form_data);
            if($rs){
                CBoard::find($request->bid)->increment('memo_cnt');//부모글의 댓글 갯수 업데이트
                CBoard::where('num', $request->bid)->update([//부모글의 댓글 날짜 업데이트
                    'memo_date' => date('Y-m-d H:i:s')
                ]);
                if($request->memo_file){
                    FileTables::where('filename', $request->memo_file)->where('userid', Auth::user()->email)->where('code','memoattach')->update(array('pid' => $rs->memoid));
                }

                $ms = Member::where('email', Auth::user()->email)->first();
                if($ms->photo){
                    $memo_photo= "<img src=\"/board/upImages/thumb/".$ms->photo."\" class=\"memo-profile\">";
                }else{
                    $memo_photo= "<span class=\"material-symbols-outlined\" style=\"font-size:40px;\">record_voice_over</span>";
                }

                if($request->memo_file){
                    $memo_image="<img src='/board/upImages/data/".$request->memo_file."' class='memo-image'>";
                }else{
                    $memo_image="";
                }

                $html="<div class=\"d-flex\" id=\"memolist_".$rs->memoid."\">
                    <div class=\"p-2\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-arrow-return-right\" viewBox=\"0 0 16 16\">
                    <path fill-rule=\"evenodd\" d=\"M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z\"/>
                    </svg>
                    </div>
                    <div class=\"flex-fill\" style=\"width:100%\">
                        <div class=\"card mt-2\">
                            <div class=\"card-header\">
                                <table>
                                    <tbody><tr class=\"align-middle\">
                                        <td rowspan=\"2\" class=\"pr-2\">
                                            ".$memo_photo."
                                        </td>
                                        <td class=\"ml\">".$ms->name."</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <font size=\"2\">".date("Y-m-d H:i:s")."</font> 
                                            <span style=\"cursor:pointer\" onclick=\"#\"></span>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </div>
                            <div class=\"card-body\">
                                ".$memo_image."
                                <p class=\"card-text\">".stripslashes(nl2br($request->memo))."</p>
                                <span class=\"badge bg-secondary\" style=\"cursor:pointer;padding:10px;\"><a onclick=\"memo_delete('".$rs->memoid."','".$request->bid."')\">삭제</a></span>
                            </div>
                        </div>
                    </div>
                </div>";

                $html="<div class=\"card mt-2\" id=\"memolist_".$rs->memoid."\">
						<div class=\"card-header p-2\">
							<table>
								<tbody><tr class=\"align-middle\">
									<td rowspan=\"2\" class=\"pr-2\">
										".$memo_photo."
									</td>
									<td class=\"ml\">".$ms->name."</td>
								</tr>
								<tr>
									<td>
										<font size=\"2\">".date("Y-m-d H:i:s")."</font> 
											<span style=\"cursor:pointer\" onclick=\"#\"></span>
									</td>
								</tr>
							</tbody></table>
						</div>
						<div class=\"card-body\">
							".$memo_image."
							<p class=\"card-text\">".stripslashes(nl2br($request->memo))."</p>
							<span class=\"badge bg-secondary\" style=\"cursor:pointer;padding:10px;\"><a onclick=\"memo_delete('".$rs->memoid."','".$request->bid."')\">삭제</a></span>
						</div>
					</div>";

            }

            return $html;
        }else{
            return "login";
        }
    }
}
