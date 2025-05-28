<?php

namespace App\Http\Controllers;
use App\Models\Ozzal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use pdphilip\elasticsearch\ES;

class MainController extends Controller
{
    public function index(){

        $fromdate = now()->subDays(10)->format('Y/m/d'); // 예: 2025/05/21 00:00:00
        $nowdate   = now()->format('Y/m/d');  
        $hot = Ozzal::where("multi","ozzal")
                    ->where("site_reg_date", ">", $fromdate)
                    //->whereDate("site_reg_date", "<", $nowdate)
                    //->whereBetween('site_reg_date', [$fromdate, $nowdate])
                    ->orderBy("site_cnt","desc")
                    ->paginate(5);
        //dd($fromdate, $nowdate);
        //dd($hot->toArray());
        return view("index",['boards' => $hot]);
    }

}
