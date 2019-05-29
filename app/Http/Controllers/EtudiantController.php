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

    public function ViewEtudiant(){

            $etudiant=Etudiant::all();
            $arr=Array('etudiant'=>$etudiant);
            $name = 'liste';
            return view('prof_page',$arr,compact('name'));
    }



    public function addabs($id,$nmbr){

        $sum=$nmbr+1;
        $absence=Absence::find($id);
        $absence->nmbrabsence=$sum;
        $absence->save();
        return back();

    }

    public function addnote($id, Request $request){
        $note=Note::find($id);
        $note->note=$request->input('ns');
        $note->save();
        return back();
    }



    public function addaff($id,Request $request){

        $module=Module::find($id);
        $module->idp=$request->input('aa');
        $module->save();
        return back();
    }


    public function addaffresp($id){

        $prof=Prof::all();
        foreach ($prof as $p) {$p->role='prof'; $p->save();}
        $profresp=Prof::find($id);
        $profresp->role='resp';
        $profresp->save();
        return back();

    }

    public function Viewabs(){
        $etudiantabs=Etudiant::all();
        $arr1=Array('etudiant'=>$etudiantabs);
        $absence=Absence::all();
        $arr2=Array('absence'=>$absence);
        return view('prof_page',$arr1,$arr2);
    }


    public function viewprof(){
        $module=Module::all();
        $arr1=Array('module'=>$module);
        $prof=Prof::all();
        $arr2=Array('prof'=>$prof);
//        return view('prof_page',$arr1,$arr2);
        $p = 'liste';
        return view('prof_page',$arr1,$arr2,compact('p'));
    }

    public function viewprofresp(){
        $prof=Prof::all();
        $arr1=Array('prof'=>$prof);
        $variable = 'liste';
        return view('prof_page',$arr1,compact('variable'));
    }


    public function viewnote(){
        $note=Note::all();
        $ar1=Array('note'=>$note);
        $etudiant=Etudiant::all();
        $ar2=Array('etudiant'=>$etudiant);
        return view('prof_page',$ar1,$ar2);
    }



    public function viewmdresp(Request $request){

        $moduleresp=Moduleresp::all();
        $arr=Array('moduleresp'=>$moduleresp);
        return view('prof_page',$arr);
    }

    public function viewmd(Request $request){

        $module=Module::all();
        $arr=Array('module'=>$module);
        $na = 'liste';
        return view('prof_page',$arr,compact('na'));
    }


//    public function ViewProf(){
//        $professeur=Prof::all();
//        $ar1=Array('professeur'=>$professeur);
//        return view('prof_page',$ar1);
//    }


    public function deletet($id){
        $etudiant_supprimer=Etudiant::find($id);
        $etudiant_supprimer->delete();
//        $etudiant=Etudiant::all();
//        $arr=Array('etudiant'=>$etudiant);
//
////        return back();
        return redirect()->to('/liste');
    }

    public function editdesc($id){
        $des=Descriptif::find($id);
        $Module=$des->module;
        $VH=$des->VH;
        $Coordonnateur=$des->coordonnateur;
        $Specialite=$des->specialite;
        $Grade=$des->grade;
        return view('des',compact('Coordonnateur','Specialite','VH','Grade','id'),compact('Module'));
    }
    public function adddesc($id, Request $request){
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
//        return view('/prof_page',$arr,compact('namee'));
     return redirect()->to('http://127.0.0.1:8000/des');

    }
    public function viewdes(){
    echo "helooo";
        $descriptif=Descriptif::all();
        $arr=Array('descriptif'=>$descriptif);
        $namee = 'liste';
        return view('prof_page',$arr,compact('namee'));
    }
    public function ajax1(Request $request){
        if($request->ajax()){

            $arrayresult = explode(",",$request['data']);

            $count_lines = (count($arrayresult)-1)/11;

            $dataToSave = array();

            $indexCounter=0;

            for($index=0; $index<$count_lines; $index++){
                $currentArray = array();
                for($secIndex=0; $secIndex<11; $secIndex++){
                    $currentArray[$secIndex] = $arrayresult[$indexCounter];
                    $indexCounter++;
                }
                array_push( $dataToSave, $currentArray);
            }

            foreach($dataToSave as $line){

                $note=Note::find($id);
                $note->note=$request->input('ns');
                $note->save();

            }



            //return var_dump($request['data']);
//            return "Data saved";
        }

        return "HTTP";
    }
}
