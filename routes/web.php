<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('tarefa/exportacao/{extensao}', [TarefaController::class, 'exportacao'])->name('tarefa.exportacao');
Route::get('tarefa/exportarpdf'          , [TarefaController::class, 'exportarPDF'])->name('tarefa.exportarPdf');

Route::resource('tarefa', TarefaController::class)->middleware('verified');

Route::get('/mensagem-teste',function(Request $request){
    return new MensagemTesteMail();
    /* Mail::to(Auth::user())->send(new MensagemTesteMail());
    return 'email enviado com sucesso'; */
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
