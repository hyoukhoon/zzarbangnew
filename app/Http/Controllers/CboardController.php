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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CboardController extends Controller
{
    public function index(){
        
        $boards = Ozzal::where("multi","ozzal")
                    ->orderBy("site_reg_date","desc")
                    ->paginate(50);
        return view("boards.index",['boards' => $boards]);
    }

    public function show($bid){
        
        $boards = Cboard::findOrFail($bid);
        $boards->content = htmlspecialchars_decode($boards->content);
        return view("boards.show",['boards' => $boards]);
    }
}
