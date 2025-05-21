<?php

namespace App\Http\Controllers;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class MemberController extends Controller
{
    public function adminloginok(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'passwd' => 'required',
        ]);
        
        $email = $request->email;
        $passwd = $request->passwd;
        $passwd = hash('sha512',$passwd);
        $remember = $request->remember;
        $loginInfo = array(
            'email' => $email,
            'passwd' => $passwd
        );

        $ismember = Members::where($loginInfo)->first();
        if($ismember){
            Auth::login($ismember, $remember);
            return redirect() -> route('adminarea.index');
        }else{
            return redirect('/adminarea/login');
        }
    }

    public function logout(){
        auth() -> logout();
        return redirect('/');
    }
}
