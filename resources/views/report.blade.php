@extends('layouts.app')
@section('content')

<div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="col-md-3">
             <h6 class="text-muted">Report</h6>
        </div>
        <div class="col-md-3  mb-3">  
        <input type="text" name="searchdata" id="searchdata" placeholder="Seacrh by Project"  class="form-control"></div>
    </div>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">SNo</th>
            <th scope="col"> Name</th>
            <th scope="col">Total hours</th>
          </tr>
        </thead>
        <tbody class="reporttr">
        </tbody>
      </table>

      <script>
   
        $(document).ready(function() {
          
           fetchData();

        function fetchData(){
            $.ajax({
            type:'GET',
            url :"{{route('fetch.data')}}",
            dataType: 'json',
            success:function(response){
                var htmldata='';
                if (response.data.length == 0) {
                    htmldata="<tr ><td colspan=3 align=center >No record found</td></tr>"    
                }else{

                   
                    var projectTotals = {};

                    $.each(response.data, function (index, entry) {
                        var projectId = entry.project_id;

                        if (!projectTotals.hasOwnProperty(projectId)) {
                            projectTotals[projectId] = 0;
                        }

                        projectTotals[projectId] += parseInt(entry.total_hours);
                    });

                    console.log(projectTotals);


                    var prevProjectId=''; var sl=1;
                    for(let i=0; i< response.data.length;i++){
                        const element= response.data[i];
                       
                        if(element.project_id !== prevProjectId){
                           
                            htmldata +="<tr  class='green-bg'><td>"+sl+"</td><td><b>"+element.project.name+"</b></td><td>"+projectTotals[element.project_id]+"</td> </tr>";
                        sl++;
                        }
                        prevProjectId = element.project_id;

                        htmldata +="<tr><td></td><td>"+element.task.name+"</td><td>"+element.total_hours+"</td> </tr>";

                    }
                }
                $('.reporttr').html(htmldata);
            },
            error:function(xhr, status, error){
                console.error('AJAX Error:', status, error);
            }
             });
        }

        //search
        $('#searchdata').keyup(function(e) {
               
                var searchkey = e.target.value.trim();
            
       if(searchkey != ''){

             $.ajax({
            type:'GET',
            url :"{{route('search.data')}}",
            data: { searchdata : searchkey },
            dataType: 'json',
            success:function(response){
                var htmldata='';
                if (response.success) {
                    
                    if (response.data.length == 0) {
                    htmldata="<tr ><td colspan=3 align=center >No record found</td></tr>"    
                   
                }else{

                   
                    var projectTotals = {};

                    $.each(response.data, function (index, entry) {
                        var projectId = entry.project_id;

                        if (!projectTotals.hasOwnProperty(projectId)) {
                            projectTotals[projectId] = 0;
                        }

                        projectTotals[projectId] += parseInt(entry.total_hours);
                    });

                    console.log(projectTotals);


                    var prevProjectId=''; var sl=1;
                    for(let i=0; i< response.data.length;i++){
                        const element= response.data[i];
                       
                        if(element.project_id !== prevProjectId){
                           
                            htmldata +="<tr  class='green-bg'><td>"+sl+"</td><td>"+element.project.name+"</td><td>"+projectTotals[element.project_id]+"</td> </tr>";
                        sl++;
                        }
                        prevProjectId = element.project_id;

                        htmldata +="<tr><td></td><td>"+element.task.name+"</td><td>"+element.total_hours+"</td> </tr>";

                    }
                }   
                }else{
                    htmldata="<tr ><td colspan=3 align=center >No record found</td></tr>"    
                }

               
                $('.reporttr').html(htmldata);
            },
            error:function(xhr, status, error){
                console.error('AJAX Error:', status, error);
            }
             });
             }else{
                fetchData();
             }
          
                
                });

        });
        </script>

</div>
@endsection