<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VideosController;

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

	Route::get('/dashboard',  							[DashboardController::class, 'index']);

	// - - - - - - - - - - - - - - - - - - - - - 
	Route::prefix('users')->group(function () {
		//Route::get('/edit',  							[UsersController::class, 'edit']);
		//Route::post('/update',  						[UsersController::class, 'update']);
	});

	// - - - - - - - - - - - - - - - - - - - - - -
	Route::prefix('videos')->group(function () {
		Route::get('/read/{id}',  						[VideosController::class, 'read']);
	});

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	//  SESSÃO - PROFESSORES (TAMBÉM SÃO ALUNOS)
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	Route::middleware('sessionauthteach')->group(function () {

		// - - - - - - - - - - - - - - - - - - - - - 
		Route::prefix('users')->group(function () {
			Route::get('/list',  							[UsersController::class, 'list']);
		});

		// - - - - - - - - - - - - - - - - - - - - - 
		Route::prefix('videos')->group(function () {
			Route::get('/',  								[VideosController::class, 'index']);
			Route::get('/create',  							[VideosController::class, 'create']);
			Route::get('/edit/{id}',  						[VideosController::class, 'edit']);
			Route::post('/update/{id}',  					[VideosController::class, 'update']);
			Route::post('/store',  							[VideosController::class, 'store']);
			Route::get('/delete/{id}',  					[VideosController::class, 'delete']);
		});

	});

});
