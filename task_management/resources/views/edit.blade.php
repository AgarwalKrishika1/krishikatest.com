@extends('layout')

@section('main-content')
<div>
  <div class="float-start">
    <h4 class="pb-3"> Edit Task </h4>
  </div>
  <div class="float-end">
    <a href="{{route('index')}}" class="btn btn-info">
      <i class="fa fa-arrow-left"> </i>All task
    </a>
  </div>
  <div class="clearfix"></div>
</div>


<div class="card card-body bg-light p-4">
  <form action="{{route('task.update', $task->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title">Title </label>
      <input type="text" class="form-control" id="title" name="title" value="{{$task->title}}">
    </div>

    <div class="form-group">
      <label for="description">Description </label>
      <textarea type="text" class="form-control" id="description" name="description" rows="5">{{$task->description}}</textarea>
    </div>

    <div class="form-group">
      <label for="status">Status </label>
      <select name="status" id="status" class="form-control">
        @foreach ($statues as $status)
          <option value="{{ $status['value'] }}" 
          {{$task->status === $status['value'] ? 'selected' : ''}}>
            {{$status['label']}}</option>
        @endforeach
        </select>
    </div>
    <a href="{{route('index')}}" class="btn btn-secondary mr-2">
      <i class="fa fa-arrow-left"> </i>Cancel</button>
    </a>
    <button type="submit" class="btn btn-primary">
      <i class="fa fa-check"> </i>Save</button>
  </form>
</div>



@endsection