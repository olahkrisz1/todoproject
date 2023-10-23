<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function createTodo(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['user_id'] = auth()->id();
        Todo::create($incomingFields);
        return redirect('/');
    }

    public function showEditPage(Todo $todo)
    {
        if (auth()->user()->id !== $todo['user_id']) {
            return redirect('/');
        }
        return view('edit-todo', ['todo' => $todo]);
    }

    public function updateTodo(Todo $todo, Request $request)
    {
        if (auth()->user()->id !== $todo['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $todo->update($incomingFields);
        return redirect('/');
    }
}
