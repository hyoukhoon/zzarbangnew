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
        $rs = Ozzal::where("multi","ozzal")
                    ->where("site_cnt>0")
                    ->orderBy("site_cnt","desc")
                    ->paginate(5);
        return view("index",['boards' => $boards]);
    }

}
