@extends('layouts.app')
@section('content')
   <div>
 
    <div>
      <h6 class="text-muted">Manage Tasks</h6>
    </div>
      <table class="table   table-hover table-bordered">
        <thead class="thead-light">
          <tr>
            <th scope="col">SNo</th>
            <th scope="col">Project Name</th>
            <th scope="col">Task Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
            @if ($tasks->isEmpty())
                 <tr><td colspan="4" class="text-center">No Records found</td></tr>
            @else
                
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $tasks->firstItem() + $loop->index}}</td>
                <td>{{$task->project->name}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->status}}</td>
               
              </tr>
            @endforeach
            @endif
        </tbody>
      </table>
      <div class="pagination" style="float:right; ">
        {{$tasks->links()}}
      </div>
      
   </div>
@endsection