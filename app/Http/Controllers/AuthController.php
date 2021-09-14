<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function postLogin(Request $request){

        if (Auth::attempt($request->only('email','password'))) {
            return redirect()->route('index');
        }
        return redirect()->back();
    }
}
