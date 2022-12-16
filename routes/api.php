<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Genre\GenreController;
use App\Http\Controllers\User\UserController;


Route::group(['middleware' => 'auth:sanctum'], function () {

    // Books 
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'edit']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

    // Genres
    Route::get('/genres', [GenreController::class, 'index']);
    Route::get('/genres/{id}', [GenreController::class, 'show']);
    Route::post('/genres', [GenreController::class, 'store']);
    Route::put('/genres/{id}', [GenreController::class, 'edit']);
    Route::delete('/genres/{id}', [GenreController::class, 'destroy']);

    // Authors
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{id}', [AuthorController::class, 'show']);
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{id}', [AuthorController::class, 'edit']);
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);

    
    Route::group(['middleware' => 'isAdmin'], function () {

        //Users
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'edit']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        
    });

    // Auth = Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Auth = Login/Register
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
