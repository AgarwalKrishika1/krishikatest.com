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
        Create product list
    </h1>
{{-- check error --}}
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error )
    <li>{{$error}}</li>
    @endforeach
</ul>
@endif
    <form method="post" action="{{route('products.store')}}">
        @csrf
        @method('post')
        <div>
            <label>Name</label>
            <input type= "text" name="name" placeholder="name" />
        </div>
        <div>
            <label>quantity</label>
            <input type= "text" name="quantity" placeholder="quantity" />
        </div>
        <div>
            <label>Price</label>
            <input type= "text" name="price" placeholder="price" />
        </div>
        <div>
            <label>Description</label>
            <input type= "text" name="description" placeholder="description" />
        </div>
        <div>
            <input type="submit" value="Save"/>
        </div>
    </form> 
</body>
</html>