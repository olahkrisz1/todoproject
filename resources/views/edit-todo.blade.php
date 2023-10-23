<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Edit Todo</h1>
    <form action="/edit-todo/{{$todo->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$todo->title}}">
        <textarea name="description">{{$todo->description}}</textarea>
        <button>Save changes</button>
    </form>
</body>

</html>