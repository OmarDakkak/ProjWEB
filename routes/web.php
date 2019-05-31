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
Route::get('liste/{identite}/{role}',"Etudiantcontroller@viewetudiant");
Route::get('/mdresp/{identite}/{role}',"Etudiantcontroller@viewmdresp");
Route::get('md/{identite}/{role}',"Etudiantcontroller@viewmd");
Route::get('nt/{identite}/{role}',"Etudiantcontroller@viewnote");
Route::get('des/{identite}/{role}',"Etudiantcontroller@viewdes");
Route::get('/editdes/{id}/{identite}/{role}',"Etudiantcontroller@editdesc");
Route::get('affecterresp/{identite}/{role}',"Etudiantcontroller@viewprofresp");
Route::get('affecter/{identite}/{role}',"Etudiantcontroller@viewprof");
Route::get('add/{id}/{nmbr}/{identite}/{role}',"Etudiantcontroller@addabs");
Route::post('/addn/{id}/{identite}/{role}',"Etudiantcontroller@addnote");
//Route::post('/add/{id}/{identite}/{role}',"Etudiantcontroller@addnote");
Route::post('envoyerdesc/{id}/{identite}/{role}',"Etudiantcontroller@adddesc");
Route::post('addaffectation/{id}/{identite}/{role}',"Etudiantcontroller@addaff");
Route::get('addaffectationresp/{id}/{identite}/{role}',"Etudiantcontroller@addaffresp");
Route::get('abs/{identite}/{role}',"Etudiantcontroller@viewabs");
Route::get('deleteetudiant/{id}/{identite}/{role}',"Etudiantcontroller@deletet");
Route::post('/logout', function () {
    return view('welcome');
});
Auth::routes();

