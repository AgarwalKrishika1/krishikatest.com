@include('adminlte::page')
<div>
  <div class="float-start">
    <h4 class="pb-3"> Create Task </h4>
  </div>
  <div class="float-end">
    <a href="{{route('index')}}" class="btn btn-info">
      <i class="fa fa-arrow-left"> </i>All task
    </a>
  </div>
  <div class="clearfix"></div>
</div>


<div class="card card-body bg-light p-4">
  <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($_POST)
    <div class="form-group">
      <label for="name">Title </label>
      <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
      <label for="price">price </label>
      <input type="text" class="form-control" id="price" name="price">
    </div>

    <div class="form-group">
      <label for="description">Description </label>
      <textarea type="text" class="form-control" id="description" name="description" rows="5"></textarea>
    </div>

    <div class="form-group">
      <label for="image">Image </label>
      <input type="file" class="form-control" id="image" name="image">
    </div>    

    <button type="submit" class="btn btn-primary">
      <i class="fa fa-check"> </i>
      Submit</button>
  </form>
</div>


