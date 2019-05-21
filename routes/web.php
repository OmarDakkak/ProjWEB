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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prof',"admincontroller@fonction_prof");
Route::post('/prof',"admincontroller@fonction_prof");
Route::get('/liste',"EtudiantController@viewetudiant");
//Route::get('/resp',"admincontroller@fonction_resp");
//Route::get('/chef',"admincontroller@fonction_chef");
