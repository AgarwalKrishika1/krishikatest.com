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
        Edit product list
    </h1>
    
{{-- check error --}}
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error )
    <li>{{$error}}</li>
    @endforeach
</ul>
@endif
    <form method="post" action="{{route('products.update', ['product'=> $product])}}">
        @csrf
        @method('put')
        <div>
            <label>Name</label>
            <input type= "text" name="name" placeholder="name" value="{{$product->name}}" />
        </div>
        <div>
            <label>quantity</label>
            <input type= "text" name="quantity" placeholder="quantity" value="{{$product->quantity}}"/>
        </div>
        <div>
            <label>Price</label>
            <input type= "text" name="price" placeholder="price" value="{{$product->price}}" />
        </div>
        <div>
            <label>Description</label>
            <input type= "text" name="description" placeholder="description" value="{{$product->description}}"/>
        </div>
        <div>
            <input type="submit" value="Update"/>
        </div>
    </form> 
</body>
</html>