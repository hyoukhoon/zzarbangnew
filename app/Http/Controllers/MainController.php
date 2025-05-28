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
        $hot = Ozzal::where("multi","ozzal")
                    ->where("site_reg_date>'".$fromdate."'")
                    ->orderBy("site_cnt","desc")
                    ->paginate(5);
        return view("index",['boards' => $hot]);
    }

}
