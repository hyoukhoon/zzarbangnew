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
use App\Models\Ozzal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->isAuth<10){
            return view('adminarea.login');
        }else{
            $tdate = date("Y-m-d");
            $todayboardscnt = Cboard::where("isdisp",1)->whereRaw("left(reg_date,10)='".$tdate."'")->count();
            $todaymemocnt = Memo::where("status",1)->whereRaw("left(regdate,10)='".$tdate."'")->count();
            $todaymembercnt = Member::where("isAuth",0)->whereRaw("left(regDate,10)='".$tdate."'")->count();
            $totalmembercnt = Member::where("isAuth",0)->count();
            $qnacnt = Qna::where("status",1)->whereRaw("left(regdate,10)='".$tdate."'")->count();
            $boardreportscnt = Police::where("status",1)->whereRaw("boardid>0")->count();
            $memoreportscnt = Police::where("status",1)->whereRaw("memoid>0")->count();
            $boards = Cboard::where("isdisp",1)->latest('reg_date')->paginate(20);

            return view('adminarea.index', ['boards' =>$boards, 'todayboardscnt' => $todayboardscnt,'todaymemocnt' => $todaymemocnt,'todaymembercnt' => $todaymembercnt,'totalmembercnt' => $totalmembercnt,'qnacnt' => $qnacnt,'boardreportscnt' => $boardreportscnt,'memoreportscnt' => $memoreportscnt]);
        }
    }

    public function elatest(){
        $rs = Ozzal::where("multi","ozzal")->first();
        echo "<pre>";
        print_r($rs);
        print_r($rs->subject);
        echo "</pre>";
    }

    public function logout(){
        auth() -> logout();
        return redirect() -> route('boards.index');
    }

    public function cateup(Request $request)
    {
        $codes = DB::table('categories')->orderBy('code','desc')->first();
        $code = $codes->code + 1;
        $form_data = array(
            'name' => $request->catename,
            'code' => $code
        );

        if(auth()->check()){
            $rs=Category::create($form_data);
            return response()->json(array('result'=> true, 'msg'=>'생성했습니다.'), 200);
        }
    }
}
