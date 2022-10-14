<?php

use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Url;
use Illuminate\Support\Facades\Validator;

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

$data=['url' => request('url')];
//Validator::make($data, $rules);

Validator::make($data,
                ['url' => 'required|url'],
                /* Si on n 'utilise pas de fichier de traduction                           
                 [
                    'url.required' => 'Vous devez fournir une Url.',
                    'url.url' => 'L\'adresse rentrée est invalide',
                ] */)->validate();

/* if ($validation->fails()) {
    dd('ce n est pas une url');
}
else {
    dd('SUCCESS');
} */

//Vérifier si l'url a déja été raccourci
// url = url enregistrée en bdd
// request('url') => l'url postée
    $url = App\Models\Url::where('url', '=', request('url'))->first();
    if ($url) {
        return view('result')->with('shortened', $url->shortened);
    }


/*********************** */

Helpers::createShortened();

//Créer une short url
//! URL create: save() + Retourne le model ...
    $newUrl= URL::create([
        'url' => request('url'),
        'shortened' =>  Url::getUniqueShortUrl(),
    ]);

    if($newUrl) {
        return view('result')->withShortened($newUrl->shortened);
    }

    
    return view('error_create_url');
// Félicaitations


});

Route::get('/{shortened}', function ($shortened){
    $url = Url::whereShortened($shortened)->first();
    
    if (! $url) {
        return redirect('/');
    }

    return redirect($url->url);

});