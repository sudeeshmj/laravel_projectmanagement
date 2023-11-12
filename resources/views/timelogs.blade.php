@extends('layouts.app')
@section('content')
<style>
    label.error {
        color: red;
        font-size: 13px;
       
    }
    .error-message {
        color: red;
    }
    .error-container {
    min-height: 20px; 
}
.error {
    min-height: 20px; 
}
</style>
   <div>
    <div  class="d-flex justify-content-between align-items-center mb-3">
      
             <h6>Time Entry</h6>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Add New Entry</button>
        
       
    </div>
    <table class="table  table-hover table-bordered">
        <thead class="thead-light">
          <tr>
            <th scope="col">SNo</th>
            <th scope="col">Project Name</th>
            <th scope="col">Task Name</th>
            <th scope="col">Hours</th>
            <th scope="col">Date</th>
            <th scope="col" width="30%">Description</th>
          </tr>
        </thead>
        <tbody class="logbody">
            @if ($timelogs->isEmpty())
                 <tr><td colspan="6" class="text-center">No Records found</td></tr>
            @else
                
            @foreach ($timelogs as $timelog)
            <tr>
                <td>{{ $timelogs->firstItem() + $loop->index}}</td>
                <td>{{$timelog->project->name}}</td>
                <td>{{$timelog->task->name}}</td>
                <td>{{$timelog->hours}}</td>
                <td>{{$timelog->taskdate}}</td>
                <td>{{$timelog->description}}</td>
               
              </tr>
            @endforeach
            @endif
        </tbody>
      </table>
      <div class="pagination" style="float:right; ">
        {{$timelogs->links()}}
      </div>
      
<!-- Modal -->
<div class="modal" id="addModal" tabindex="-1" token="{{csrf_token()}}" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Time Entry</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="logform">
                @csrf
                <div class="mb-2">
                  <label for="recipient-name" class="col-form-label">Project Name</label>
                    <select class="form-select"  name="project_id" id="project_id">
                        <option value="">Select an option</option>
                        @foreach ($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option> 
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                  <label for="message-text" class="col-form-label">Task Name</label>
                  <select class="form-select" name="task_id" id="task_id">
                    <option value="">Select an option</option>
                </select>
                </div>

                <div class="row g-3 mb-2">
                        <div class="col">
                            <label for="message-text" class="col-form-label">Date</label>
                            <input type="text" class="form-control datepicker" name="taskdate" id="taskdate">
                           
                        </div>
                        <div class="col">
                            <label for="message-text" class="col-form-label">Hours</label>
                            <select class="form-select"  name="hours" id="hours">
                                <option value="">Select an option</option>
                                @for ($i = 1; $i < 24; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select> 
                             </div>
                         </div>


              
                  <div class="mb-2">
                    <label for="message-text" class="col-form-label">Description</label>
                    <textarea class="form-control"  name="description" maxlength="140" id="description"></textarea>
                  </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm savelogs">Save changes</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
   
   $(document).ready(function() {
  
    $(".datepicker").datepicker();

    //submit btn
    $('.savelogs').click(function(){
       
        $('#logform').validate({ 
            rules: {
                project_id: {
                    required: true,  
                },
                task_id: {
                    required: true,
                },
                hours: {
                    required: true,
                },
                taskdate: {
                    required: true,
                },
                description: {
                    required: true,
                    maxlength:150,
                },
            },
            // messages: {
            //     project_name: {
            //         required: "Please Select project."
            //     },
            //     task_name: {
            //         required: "Please Select task."
            //     },
            //     task_name: {
            //         required: "Please Select hours."
            //     },
            //     taskdate: {
            //         required: "Please Select task date."
            //     },
            //     description: {
            //         required: "Please Enter description."
            //     },
            // },
        }).form();  // Trigger the form validation

        if ($('#logform').valid()) {
        const datas={
            project_id:$('#project_id').val(),
            task_id:$('#task_id').val(),
            hours:$('#hours').val(),
            taskdate:$('#taskdate').val(),
            description:$('#description').val(),
        };
      
        $.ajax({
            type:'POST',
            url :"{{route('save.data')}}",
            headers: {
                 'X-CSRF-TOKEN': $('#addModal').attr('token')
                    },
            data:datas,
            success:function(response){
                if (response.success) {
                   
                    $('#addModal').modal('hide');
                    $('#addModal').find('form')[0].reset();
                    location.reload();
                    $.notify(response.message, "success");
                } else {
                    $.notify(response.message, "success");
                }
            },
            error:function(xhr, status, error){
                $.notify("Data insertio failed", "success");
            }
        });
    }
    });
  
// project onchange

$('#project_id').change(function() {
    var project_id =  $(this).val() ;
    if(project_id != ''){
        $.ajax({
                type:'POST',
                url :"{{route('fetch.task')}}",
                headers: {
                    'X-CSRF-TOKEN': $('#addModal').attr('token')
                        },
                data:{
                    'project_id':project_id
                },
                success:function(response){
                    var optn = "<option value=''>Select an option</option>";
                
                    for(let i=0; i< response.data.length;i++){
                        const element= response.data[i];
                        optn +=`<option value ='`+element.id+`'>`+element.name+` </option>`;
                    }
                    $("#task_id").html(optn);
                },
            
            });
    }

  
});

$('#addModal').on('hidden.bs.modal', function () {
    // Clear input fields
    $(this).find('input, select, textarea').val('');
    $('#logform').validate().resetForm();
});      







});
    </script>

   </div>

@endsection