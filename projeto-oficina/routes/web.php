<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SeriesController;
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
    if(\Illuminate\Support\Facades\Auth::check()){
        return redirect('/series');
    }else{
        return redirect('/entrar');
    }
});

Route::get('/entrar', [LoginController::class, 'entrar']);
Route::post('/entrar', [LoginController::class, 'logar']);

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});

Route::get('/registrar', [RegistroController::class, 'registrar']);
Route::post('/registrar', [RegistroController::class, 'criarRegistro']);

Route::get('/series', [SeriesController::class, 'listarSeries'])->middleware(['auth']);

require __DIR__.'/auth.php';
