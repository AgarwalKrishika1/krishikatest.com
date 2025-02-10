@extends('layout')

@section('main-content')
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
  <form action="{{route('task.store')}}" method="POST">
    @csrf

    <div class="form-group">
      <label for="title">Title </label>
      <input type="text" class="form-control" id="title" name="title">
    </div>

    <div class="form-group">
      <label for="description">Description </label>
      <textarea type="text" class="form-control" id="description" name="description" rows="5"></textarea>
    </div>

    <div class="form-group">
      <label for="status">Status </label>
      <select name="status" id="status" class="form-control">
        @foreach ($statues as $status)
          <option value="{{$status['value']}}">{{$status['label']}}</option>
        @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
      <i class="fa fa-check"> </i>
      Submit</button>
  </form>
</div>



@endsection