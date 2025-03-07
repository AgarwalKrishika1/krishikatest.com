<h1>Edit Sale Slider</h1>

    <form action="{{ route('admin.sliders.update', $saleSlider) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" class="form-control" id="discount" name="discount" value="{{ $saleSlider->discount }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $saleSlider->category }}" required>
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="url" class="form-control" id="link" name="link" value="{{ $saleSlider->link }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Slider</button>
    </form>