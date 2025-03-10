<a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Create Slider</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Discount</th>
                <th>Category</th>
                <th>Link</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
                <tr>
                    <td>{{ $slider->discount }}</td>
                    <td>{{ $slider->category }}</td>
                    <td>{{ $slider->link }}</td>
                    <td>
                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.sliders.delete', $slider) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>