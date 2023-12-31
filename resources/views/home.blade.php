<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    @auth
    <p>You are logged in, {{ auth()->user()->email }}!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>

    <div style='background:grey; border: 3px solid black;'>
        <h2>Create a new ToDo</h2>
        <form action="/create-todo" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title">
            <textarea name="description" placeholder="description"></textarea>
            <button>Save ToDo</button>
        </form>
    </div>

    <div style='background:grey; border: 3px solid black; margin-top: 20px;'>
        <h2>All Todos</h2>
        @foreach($todos as $todo)
        <div style="background:aqua; padding: 10px; margin:10px;">
            <h3>{{$todo['title']}}</h3>
            {{$todo['description']}}
            <p><a href="/edit-todo/{{$todo->id}}">Edit</a></p>
            <form action="/delete-todo/{{$todo->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    @else
    <div style='border: 3px solid black;'>
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="email" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <input name="password_confirmation" type="password" placeholder="Confirm password">
            <button>Register</button>
        </form>
    </div>
    <br>
    <div style='border: 3px solid black;'>
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginemail" type="email" placeholder="email">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Log in</button>
        </form>
    </div>

    @endauth



</body>

</html>