<?php

namespace App\Models;

use App\Models\Todo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
    $perPage = 4;
    $currentPage = request('page', 1);
    $pagedData = new LengthAwarePaginator(
        $todos->forPage($currentPage, $perPage),
        $todos->count(),
        $perPage,
        $currentPage
    );

    return view('home', [
        'todos' => $pagedData,
    ]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/create-todo', [TodoController::class, 'createTodo']);
Route::get('/edit-todo/{todo}', [TodoController::class, 'showEditPage']);
Route::put('/edit-todo/{todo}', [TodoController::class, 'updateTodo']);
Route::delete('/delete-todo/{todo}', [TodoController::class, 'deleteTodo']);
