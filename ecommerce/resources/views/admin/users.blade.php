<section id="users">
<h2> Users </h2>
<table class="table">
<thead>
<tr>
   <th>Name</th>
   <th>E-mail</th>
   <th>  </th>
   <th>Actions</th>
</tr>
</thead>
<tbody>
    @php
    use App\Models\User;
    $users = User::all();
    @endphp
@foreach($users as $user)
   <tr>
       <td>{{ $user->name }}</td>
       <td>{{ $user->email }}</td>
       <td></td>
       <td>
           <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
           <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display:inline;">
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