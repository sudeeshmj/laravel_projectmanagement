@extends('layouts.app')
@section('content')
<style>

</style>
   <div>
    
    <div>
      <h6 class="text-muted">Manage Projects</h6>
    </div>
      
      <table class="table  table-hover table-bordered">
        <thead >
          <tr>
            <th scope="col">SNo</th>
            <th scope="col">Project Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
            @if ($projects->isEmpty())
                 <tr><td colspan="3" class="text-center">No Records found</td></tr>
            @else
                
            @foreach ($projects as $project)
            <tr>
                <td>{{ $projects->firstItem() + $loop->index}}</td>
               
                <td>{{$project->name}}</td>
                <td>{{$project->status}}</td>
               
              </tr>
            @endforeach
            @endif
        </tbody>
      </table>
      <div class="pagination" style="float:right; ">
        {{$projects->links()}}
      </div>
      
   </div>
@endsection