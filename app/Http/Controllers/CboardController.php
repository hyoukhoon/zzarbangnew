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

    public function show($bid,$page){
        
        $boards = Cboard::findOrFail($bid);
        $boards->content = htmlspecialchars_decode($boards->content);
        return view("boards.show",['boards' => $boards]);
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
            $rs=Cboard::create($form_data);
            if($request->pid){
                //Filetables::where('pid', $request->pid)->where('userid', Auth::user()->email)->update(array('pid' => $rs->bid));
            }
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
            Storage::putFileAs('images', $request->file('file'), $new_name);
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
