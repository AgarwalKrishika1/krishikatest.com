@include('admin.css')
@include('admin.header')
<section id="products">
<h2> Orders </h2>
<table class="table">
<thead>
<tr>
   <th>User ID</th>
   <th>Total Price</th>
   <th>  </th>
   <th>Actions</th>
</tr>
</thead>
<tbody>
    @php
    use App\Models\order;
    $orders = order::all();
    @endphp
@foreach($orders as $order)
   <tr>
       <td>{{ $order->user_id }}</td>
      
       <td>{{ $order->total_price }}</td>
       <td></td>
       <td>
           <a href="{{ route('admin.edit', $order->id) }}" class="btn btn-warning">Edit</a>
           <form action="{{ route('admin.delete', $order->id) }}" method="POST" style="display:inline;">
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