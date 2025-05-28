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
        $fromdate=date("Y/m/d H:i:s", strtotime('-7 days'));
        $nowdate=date("Y/m/d H:i:s");
        $hot = Ozzal::where("multi","ozzal")
                    //->whereDate("site_reg_date", ">", $fromdate)
                    //->whereDate("site_reg_date", "<", $nowdate)
                    ->whereBetween('site_reg_date', [$fromdate, $nowdate])
                    ->orderBy("site_cnt","desc")
                    ->paginate(5);
        return view("index",['boards' => $hot]);
    }

}
