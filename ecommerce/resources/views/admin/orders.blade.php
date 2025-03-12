@include('admin.css')
@include('admin.header')
<section id="products">
<h2> Orders </h2>
<table class="table">
<thead>
<tr>
   <th>User Name</th>
   <th>Total Price</th>
   <th>  </th>
   <th>Actions</th>
</tr>
</thead>
<tbody>
    @php
    use App\Models\order;
    $orders = order::with('user')->get();
    @endphp
@foreach($orders as $order)
   <tr>
       <td>{{ $order->user->name }}</td>
      
       <td>{{ $order->total_price }}</td>
       <td></td>
       <td>

           <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" style="display:inline;">
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