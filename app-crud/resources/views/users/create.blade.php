<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>
        Create users list
    </h1>
{{-- check error --}}
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error )
    <li>{{$error}}</li>
    @endforeach
</ul>
@endif
    <form method="post" action="{{route('users.store')}}">
        @csrf
        @method('post')
        <div>
            <label>Name</label>
            <input type= "text" name="name" placeholder="name" />
        </div>
        <div>
            <label>email</label>
            <input type= "text" name="email" placeholder="email" />
        </div>
        <div>
            <label>password</label>
            <input type= "text" name="password" placeholder="password" />
        </div>
        <div>
            <label>role</label>
            <input type= "text" name="role" placeholder="role" />
        </div>
        <div>
            <input type="submit" value="Save"/>
        </div>
    </form> 
</body>
</html>