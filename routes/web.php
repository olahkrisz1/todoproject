<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $todos = [];
    if (auth()->check()) {
        $todos = auth()->user()->usersTodos()->latest()->get();
    }

    // $todos = Todo::where('user_id', auth()->id())->get();
    return view('home', ['todos' => $todos]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/create-todo', [TodoController::class, 'createTodo']);
Route::get('/edit-todo/{todo}', [TodoController::class, 'showEditPage']);
Route::put('/edit-todo/{todo}', [TodoController::class, 'updateTodo']);
