@include('admin.css')
@include('admin.header')
 <section class="slider">
   <h2> slider </h2>
   <table class="table">
   <thead>
   <tr>
      <th>discount</th>
      <th>category</th>
      <th> link </th>
      <th>Actions</th>
   </tr>
   </thead>
   <tbody>
       @php
       use App\Models\SaleSlider;
       $sliders = SaleSlider::all();
       @endphp
   @foreach($sliders as $slider)
      <tr>
          <td>{{ $slider->discount }}</td>
          <td>{{ $slider->category }}</td>
          <td>{{ $slider->link }}</td>
          <td></td>
          <td>
              <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('admin.sliders.delete', $slider->id) }}" method="POST" style="display:inline;">
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