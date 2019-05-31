<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prof;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{
    public function fonction_prof(Request $request){
        if($request->isMethod('post')){
            if($request->input('login')=="dadi@dmi.ensah.ma" && $request->input('pass')=="ensah")
            {
                $identite=1;
                $profresp=Prof::find($identite);
                $role=$profresp->role;
                return view('prof_page',compact('identite','role')) ;
            }
            if($request->input('login')=="allaoui@dmi.ensah.ma" && $request->input('pass')=="ensah")
            {
                $identite=2;
                $profresp=Prof::find($identite);
                $role=$profresp->role;
                return view('prof_page',compact('identite','role')) ;
            }
            if($request->input('login')=="boujraf@dmi.ensah.ma" && $request->input('pass')=="ensah")
            {
                $identite=3;
                $profresp=Prof::find($identite);
                $role=$profresp->role;
                return view('prof_page',compact('identite','role')) ;
            }
            if($request->input('login')=="haddouch@dmi.ensah.ma" && $request->input('pass')=="ensah")
            {
                $identite=4;
                $profresp=Prof::find($identite);
                $role=$profresp->role;
                return view('prof_page',compact('identite','role')) ;
            }
            if($request->input('login')=="chef@dmi.ensah.ma" && $request->input('pass')=="ensah")
            {
                $identite=5;
                $profresp=Prof::find($identite);
                $role=$profresp->role;
                return view('prof_page',compact('identite','role')) ;
            }            else
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

