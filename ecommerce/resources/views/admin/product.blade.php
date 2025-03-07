<section id="products">
<h2> Products </h2>
<table class="table">
<thead>
<tr>
   <th>Name</th>
   <th>Price</th>
   <th>  </th>
   <th>Actions</th>
</tr>
</thead>
<tbody>
    @php
    use App\Models\Products;
    $products = Products::all();
    @endphp
@foreach($products as $product)
   <tr>
       <td>{{ $product->name }}</td>
       <td>{{ $product->price }}</td>
       <td></td>
       <td>
           <a href="{{ route('admin.edit', $product->id) }}" class="btn btn-warning">Edit</a>
           <form action="{{ route('admin.delete', $product->id) }}" method="POST" style="display:inline;">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger">Delete</button>
           </form>
       </td>
   </tr>
@endforeach
</tbody>
</table>
</section>