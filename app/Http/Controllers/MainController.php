<?php

namespace App\Http\Controllers;
use App\Models\Ozzal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class MainController extends Controller
{
    public function index(){
        $from = now()->subWeek()->format('Y/m/d H:i:s'); // 예: 2025/05/21 00:00:00
        $to   = now()->format('Y/m/d H:i:s');  
        $hot = Ozzal::where("multi","ozzal")
                    ->where("site_reg_date", ">=", $from)
                    //->whereDate("site_reg_date", "<", $nowdate)
                    //->whereBetween('site_reg_date', [$fromdate, $nowdate])
                    ->orderBy("site_cnt","desc")
                    ->paginate(5);
        return view("index",['boards' => $hot]);
    }

}
