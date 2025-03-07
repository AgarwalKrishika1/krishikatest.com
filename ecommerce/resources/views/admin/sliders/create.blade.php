<h1>Create Sale Slider</h1>

<form action="{{ route('admin.sliders.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="text" class="form-control" id="discount" name="discount" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" required>
    </div>
    <div class="form-group">
        <label for="link">Link</label>
        <input type="url" class="form-control" id="link" name="link" required>
    </div>

    <button type="submit" class="btn btn-success mt-3">Save Slider</button>
</form>