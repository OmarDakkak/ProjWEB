<?php

namespace App\Http\Controllers;

use App\Descriptif;
use App\Etudiant;
use App\Moduleresp;
use App\Prof;
use App\Module;
use App\Note;
use App\Absence;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class Etudiantcontroller extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function ViewEtudiant($identite,$role){

            $etudiant=Etudiant::all();
            $arr=Array('etudiant'=>$etudiant);
            $name = 'liste';
            return view('/prof_page',$arr,compact('name','identite','role'));
      // return redirect()->to("http://127.0.0.1:8000/liste",compact('name','id'));
    }



    public function addnote($id, Request $request,$identite,$role){
        $note=Note::find($id);
        $note->note=$request->input('ns');
        $note->save();
        return back()->withInput(compact('identite','role'));
    }



    public function addaff($id,Request $request,$identite,$role){

        $module=Module::find($id);
        $module->idp=$request->input('aa');
        $module->save();
        return back()->withInput(compact('identite','role'));
    }


    public function addaffresp($id,$identite,$role){

        $prof=Prof::all();
        foreach ($prof as $p) { if($p->role=='resp') {$p->role='prof'; $p->save();}}
        $profresp=Prof::find($id);
        $profresp->role='resp';
        $profresp->save();
        $professeur=Prof::all();
        return back()->withInput(compact('identite','role','professeur'));

    }
    public function addabs($id,$nmbr,$identite,$role){

        $sum=$nmbr+1;
        $absence=Absence::find($id);
        $absence->nmbrabsence=$sum;
        $absence->save();
        //return back(compact('identite'));
        //return view('prof_page',compact('identite'));
        //return redirect()->to('http://127.0.0.1:8000/abs/identite',compact('identite'));
        return back()->withInput(compact('identite','role'));
    }
    public function viewabs($identite,$role){
        $etudiantabs=Etudiant::all();
        $arr1=Array('etudiantabs'=>$etudiantabs);
        $absence=Absence::all();
        $arr2=Array('absence'=>$absence);
       // return redirect()->to('/prof_page',compact('identite'),$arr1,$arr2);
        return view('/prof_page',compact('identite','absence','etudiantabs','role'));
    }


    public function viewprof($identite,$role){
        $module=Module::all();
        $arr1=Array('module'=>$module);
        $prof=Prof::all();
        $arr2=Array('prof'=>$prof);
//        return view('prof_page',$arr1,$arr2);
        $p = 'liste';
        return view('prof_page',compact('p','identite','module','prof','role'));
    }

    public function viewprofresp($identite,$role){
        $prof=Prof::all();
        $arr1=Array('prof'=>$prof);
        $variable = 'liste';
        return view('prof_page',$arr1,compact('variable','identite','role'));
    }


    public function viewnote($identite,$role){
        $note=Note::all();
        $ar1=Array('note'=>$note);
        $etudiant=Etudiant::all();
        $ar2=Array('etudiant'=>$etudiant);
        return view('prof_page',compact('identite','note','etudiant','role'));
    }



    public function viewmdresp($identite,$role){

        $moduleresp=Moduleresp::all();
        $arr=Array('moduleresp'=>$moduleresp);
        return view('prof_page',$arr,compact('identite','role'));
    }

    public function viewmd($identite,$role){

        $module=Module::all();
        $arr=Array('module'=>$module);
        $na = 'liste';
        return view('prof_page',$arr,compact('na','identite','role'));
    }


//    public function ViewProf(){
//        $professeur=Prof::all();
//        $ar1=Array('professeur'=>$professeur);
//        return view('prof_page',$ar1);
//    }


    public function deletet($id,$identite,$role){
        $etudiant_supprimer=Etudiant::find($id);
        $etudiant_supprimer->delete();
//        $etudiant=Etudiant::all();
//        $arr=Array('etudiant'=>$etudiant);
//
////        return back();
        //return redirect()->to('/liste',compact('identite'));
        return back()->withInput(compact('identite','role'));
    }

    public function editdesc($id,$identite,$role){
        $des=Descriptif::find($id);
        $Module=$des->module;
        $VH=$des->VH;
        $Coordonnateur=$des->coordonnateur;
        $Specialite=$des->specialite;
        $Grade=$des->grade;
        return view('des',compact('Coordonnateur','Specialite','VH','Grade','id','identite','role'),compact('Module'));
    }
    public function adddesc($id, Request $request,$identite,$role){
        $desc=Descriptif::find($id);
        $desc->module=$request->input('m');
        $desc->VH=$request->input('v');
        $desc->coordonnateur=$request->input('c');
        $desc->specialite=$request->input('s');
        $desc->grade=$request->input('g');
        $desc->save();
        $descriptif=Descriptif::all();
        $arr=Array('descriptif'=>$descriptif);
        $namee = 'liste';
        return view('prof_page',$arr,compact('namee','identite','role'));
       // return view('prof_page',compact('namee','identite','desc'));
       // return redirect()->to("http://127.0.0.1:8000/des",compact('identite'));
    }
    public function viewdes($identite,$role){

        $descriptif=Descriptif::all();
        $arr=Array('descriptif'=>$descriptif);
        $namee = 'liste';
        return view('prof_page',$arr,compact('namee','identite','role'));
    }
}
