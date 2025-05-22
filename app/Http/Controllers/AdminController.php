<?php

namespace App\Http\Controllers;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Cboard;
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
            $todayboardscnt = Cboard::where('isdisp',1)->whereRaw('left(reg_date,10)='.$tdate)->count();
            $todaymemocnt = 10;
            $todaymembercnt = 10;
            $totalmembercnt = 10;
            $qnacnt = 10;
            $boardreportscnt = 10;
            $memoreportscnt = 10;

            return view('adminarea.index', ['todayboardscnt' => $todayboardscnt,'todaymemocnt' => $todaymemocnt,'todaymembercnt' => $todaymembercnt,'totalmembercnt' => $totalmembercnt,'qnacnt' => $qnacnt,'boardreportscnt' => $boardreportscnt,'memoreportscnt' => $memoreportscnt]);
        }
    }

    public function classroom(){
        if(Auth::user()->isAuth<10){
            return view('adminarea.login');
        }else{
            $cls = Classrooms::orderBy('id','desc')->paginate(20);;
            $cates = DB::table('categories')->get();
            return view('adminarea.classroom', ['cls' => $cls,'cates' => $cates]);
        }
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
