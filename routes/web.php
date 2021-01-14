<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
// ACESSO PÚBLICO
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 

Route::get('/',  		[PagesController::class, 'index']);

Route::prefix('users')->group(function () {

	Route::get('/login',  							[UsersController::class, 'login']);
	Route::post('/login',  							[UsersController::class, 'login_post']);
	Route::get('/create',  							[UsersController::class, 'create']);
	Route::post('/store',  							[UsersController::class, 'store']);
	Route::get('/logout',							[UsersController::class, 'logout']);
	Route::post('/password', 						[UsersController::class, 'password_post']);
	Route::get('/password/{token}', 				[UsersController::class, 'password']);
	Route::post('/password/{token}', 				[UsersController::class, 'password_recovery_post']);

});

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
//  SESSÃO - ALUNO
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
Route::middleware('sessionauth')->group(function () {


	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	//  SESSÃO - PROFESSORES (TAMBÉM SÃO ALUNOS)
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	Route::middleware('sessionauthteach')->group(function () {



	});

});
