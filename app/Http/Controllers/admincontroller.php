<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admincontroller extends Controller
{
    public function fonction_prof(Request $request){
        if($request->isMethod('post')){
            if($request->input('login')=="omar@haha.com" && $request->input('pass')=="ensah")
                return view('prof_page');
            if($request->input('login')=="abdelfettah@.haha.com" && $request->input('pass')=="ensah")
                return view('resp_page');
            if($request->input('login')=="hajjioui@.haha.com" && $request->input('pass')=="ensah")
                return view('chef_page');
            else
                return view('error');
        }
        return view('welcome');
    }
//    public function fonction_resp(){
//        return view('resp_page');
//    }
//    public function fonction_chef(){
//        return view('chef_page');
//    }
}

