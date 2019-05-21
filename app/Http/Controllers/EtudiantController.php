<?php

namespace App\Http\Controllers;

use App\Etudiant;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class EtudiantController extends Controller
{
        public function viewetudiant(){
            $etudiant=Etudiant::all();
            $arr=Array('etudiant'=>$etudiant);
        return view('prof_page',$arr);
    }
}
