<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function()
{
    return redirect('/');
});

Route::get('home', 'HomeController@index');
Route::get("admin", function(){
    return redirect('admin/dashboard');
});


Route::group(["prefix"=>"admin"],function(){
    Route::controllers([
        'user' => 'Backend\UserController',
        'artikel' => 'Backend\ArtikelController',
        'user' => 'Backend\UserrController',
        'dokter' => 'Backend\DokterController',
        'acara' => 'Backend\AcaraController',
        'konsul' => 'Backend\KonsultasiController',
        'galeri' => 'Backend\GaleriController',
        'dashboard' => 'Backend\AdminController',

    ]);
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'tes' => 'PenggunaController',
    'dokter' => 'Frontend\DokterController',
    'user' => 'Backend\UserController',
    'konsultasi' => 'Frontend\KonsultasiController',
    'editprofil' => 'EditProfilController',
    'artikel' => 'DetailArtikelCon',
    'upload' => 'UploadController',
    '/' => 'MentorBundaController',
]);

//Route::post('upload/upload', 'UploadController@upload');
/*Route::group(["prefix"=>"admindash","middleware"=>"user"], function()
{
    Route::controllers([
        "tes" => 'Backend\AdminController',
    ]);
}); */

Route::get('user', 'UserrController@index');
Route::get('user/data', 'UserrController@getData');