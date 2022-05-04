<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('tarefa/exportar/{tipo_exportacao}', [TarefaController::class, 'exportacao'])->name('tarefa.exportar');
Route::get('tarefa/exportacao', [TarefaController::class, 'exportarPdfComNovoPacote'])->name('tarefa.exportacao');

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');
*/

// Route::middleware('auth')->resource('tarefa', 'App\Http\Controllers\TarefaController');
Route::resource('tarefa', 'App\Http\Controllers\TarefaController')
    ->middleware('verified');

Route::get('/mensagem-teste', function() {
    return new MensagemEmail();
    Mail::to('pablodomingos1700@gmail.com')->send(new MensagemEmail());
    return 'E-mail enviado com sucesso';
});
