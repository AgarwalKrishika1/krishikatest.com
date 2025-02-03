<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Product table</h1>
    <div>
        @if (session()-> has('success'))
        <div><b>
            {{session('success')}}
        </b></div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{route('products.create')}}">Create Product </a>
        </div>
    </div>
    <table border="2"> 
        <thead>
            Products
        </thead>
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>quantity</th>
            <th>price</th>
            <th>description</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->price}}</td>
            <td>{{$product->description}}</td>
            <td>
                <a href="{{route('products.edit', 
                ['product' => $product])}}">Edit </a>
            </td>
            <td>
                <form method="post" action="{{route('products.destroy',['product' => $product])}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>