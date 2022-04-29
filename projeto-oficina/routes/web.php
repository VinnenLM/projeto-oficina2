<?php

use App\Http\Controllers\RegistroController;
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
    return redirect('/registrar');
});

Route::get('/registrar', [RegistroController::class, 'registrar']);
Route::post('/registrar', [RegistroController::class, 'criarRegistro']);

require __DIR__.'/auth.php';
