<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Etudiant;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prof',"admincontroller@fonction_prof");
Route::post('/prof',"admincontroller@fonction_prof");
Route::get('liste',"Etudiantcontroller@viewetudiant");
Route::get('mdresp',"Etudiantcontroller@viewmdresp");
Route::get('md',"Etudiantcontroller@viewmd");
Route::get('nt',"Etudiantcontroller@viewnote");
Route::get('des',"Etudiantcontroller@viewdes");
Route::get('editdes/{id}',"Etudiantcontroller@editdesc");
Route::get('affecterresp',"Etudiantcontroller@viewprofresp");
Route::get('affecter',"Etudiantcontroller@viewprof");
Route::get('add/{id}/{nmbr}',"Etudiantcontroller@addabs");
Route::post('addn/{id}',"Etudiantcontroller@addnote");
Route::post('envoyerdesc/{id}',"Etudiantcontroller@adddesc");
Route::post('addaffectation/{id}',"Etudiantcontroller@addaff");
Route::get('addaffectationresp/{id}',"Etudiantcontroller@addaffresp");
Route::get('/abs',"Etudiantcontroller@viewabs");
Route::get('/deleteetudiant/{id}',"Etudiantcontroller@deletet");
Route::post('/sendData',"Etudiantcontroller@ajax1");