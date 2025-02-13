@extends('layout')

@section('main-content')
<div>
  <div class="float-start">
    <h4 class="pb-3"> My Tasks </h4>
  </div>
  <div class="float-end">
    <a href="{{route('task.create')}}" class="btn btn-info">
      <i class="fa fa-plus-circle"></i>Create task
    </a>
  </div>
  <div class="clearfix"></div>
</div>

@foreach ($tasks as $task)
<div class="card mt-3">
  <h5 class="card-header">
    @if ($task->status === "ToDo")
        {{$task->title}}
    @else
      <del> {{$task->title}}</del>
    @endif

    <span class="badge rounded-pill bg-warning text-dark">
      {{$task->created_at->diffForHumans()}}
    </span>
  </h5>

  <div class="card-body">
    <div class="card-text">
      <div class="float-start">
        @if ($task->status === "ToDo")
          {{$task->description}}
        @else
            <del> {{$task->description}}</del>
        @endif
      <br>
     @if ($task->status === "ToDo")
     <span class="badge rounded-pill bg-info text-dark">
      ToDo
    </span>
    @else
    <span class="badge rounded-pill bg-success text-white">
      Done
    </span>
     @endif
      <small>Last Updated - {{$task->updated_at->diffForHumans()}}</small>
      </div>


      <div class="float-end">
        <a href="{{route('task.edit', $task->id)}}" class="btn btn-success">
            <i class="fa fa-pencil"> </i>
        </a>

        <form action="{{route('task.destroy',$task->id)}}" style="display: inline" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash "> </i>
          </button>

        </form>
        
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@endforeach
<br><br>
@if (count($tasks) === 0)
  <div class="alert alert-danger p-2">
    No Tasks Found!! Create Task!
    <br>
    <a href="{{route('task.create')}}" class="btn btn-info">
      <i class="fa fa-plus-circle"></i>Create task
    </a>
  </div>
@endif

@endsection