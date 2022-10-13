<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/', function (Request $request) {
/*  dump(request('url'));
    dump(request()->get('url'));
    dump(request()->input('url'));
    dd(Request::get('url')); façades (marche pas ici :())
    dd( $request->url); 
*/

// valider l'url

//Vérifier si l'url a déja été raccourci
$url = App\Models\Url::where('url', request('url'))->first();
if ($url) {
    return view('result')->with('shortened', $url->shortened);
}

//Créer une short url

// Félicaitations


});
