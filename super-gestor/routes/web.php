<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\TesteController;
use App\Http\Middleware\LogAcessoMiddleware;
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

// Route::middleware(LogAcessoMiddleware::class)
//     ->get('/', [PrincipalController::class, 'principal'])
//     ->name('site.index');
Route::get('/', [PrincipalController::class, 'principal'])->name('site.index')->middleware('log.acesso');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');
Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');

Route::post('/contato', [ContatoController::class, 'salvar'])->name('salvar');

Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.form');
Route::get('/cadastro', [LoginController::class, 'cadastro'])->name('cadastro');
Route::post('/cadastro/{erro?}', [LoginController::class, 'autenticacao_cadastro'])->name('cadastro.form');

Route::middleware('autenticacao:padrao,visitante,p3,p4')->prefix('/app/')->group(function() {
    Route::get('home', [HomeController::class, 'index'])->name('app.home');
    Route::get('cliente', [ClienteController::class, 'index'])->name('app.cliente');

    Route::controller(FornecedorController::class)->group(function (){
        Route::get('fornecedor', 'index')->name('app.fornecedor');
        Route::get('fornecedor/adicionar', 'adicionar')->name('app.fornecedor.adicionar');
        Route::post('fornecedor/adicionar', 'adicionar')->name('app.fornecedor.adiciona');
        Route::post('fornecedor/lista', 'consulta')->name('app.fornecedor.lista');
    });

    Route::get('produto', [ProdutoController::class, 'index'])->name('app.produto');
    Route::get('sair', [LoginController::class, 'sair'])->name('app.sair');
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('site.teste');

Route::fallback(function() {
    echo 'A rota acessada n??o existe. <a href="'.route('site.index').'">clique aqui</a> para ir para p??gina inicial';
});
