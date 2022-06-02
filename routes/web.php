<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CasillaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\EleccionController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\Auth\LoginController;


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
//TESTING Custom ROUTES 
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
Route::get("/casilla/pdf",[CasillaController::class,'generatepdf']);
Route::get("/eleccion/pdf",[EleccionController::class,'generatepdf']);
Route::get("/voto/pdf",[VotoController::class,'generatepdf']);
#-----graficas------
Route::get('preview', 'App\Http\Controllers\PDFController@preview');
Route::get('download', 'App\Http\Controllers\PDFController@download')->name('download');

Route::resource('casilla',CasillaController::class);
Route::resource('candidato',CandidatoController::class);
Route::resource('eleccion',EleccionController::class);
Route::resource('voto',VotoController::class);

#--- Socialite facebook
Route::get('/login', [LoginController::class,'index'])->name('login');
//Route::get("Login",[LoginController::class,'Login']);
Route::get('/login/facebook/', [LoginController::class,"redirectToFacebookProvider"]);
Route::get('/login/facebook/callback', [LoginController::class,"handleProviderFacebookCallback"]);
#---logout-----
Route::get('/logout', [LoginController::class,'logout']);
Route::middleware(['auth'])->group(function(){
    Route::resource('voto',VotoController::class);
});


Route::get('menu',function(){
    return view('menu');
});