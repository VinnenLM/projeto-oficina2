<?php

use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
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
Route::get('/series/adicionar', [SeriesController::class, 'criarSeries'])->middleware(['auth']);
Route::post('/series/adicionar', [SeriesController::class, 'salvarSeries'])->middleware(['auth']);
Route::delete('/series/{id}', [SeriesController::class, 'excluirSeries'])->middleware(['auth']);

Route::get('/series/{serie_id}/temporadas', [TemporadasController::class, 'listarTemporadas']);

Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'listarEpisodios']);
Route::post('/temporadas/{temporada}/episodios/assistidos', [EpisodiosController::class, 'assistidos'])->middleware(['auth']);

Route::any('/buscar', [\App\Services\BuscadorDeSerie::class, 'buscarSerie']);

require __DIR__.'/auth.php';
