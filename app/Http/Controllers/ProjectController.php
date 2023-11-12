<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Timelog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index(){
        return view('layouts.app');
    }

    public function projectList(){
          $projects = Project::orderby('id','asc')->paginate(5);
        return view('projectlist',compact('projects'));
    }

    public function taskList(){
        $tasks = Task::orderby('project_id','asc')->paginate(5);
        return view('tasklist',compact('tasks'));
    }

    public function timeLogs(){
        $projects = Project::where('status',1)->orderby('name','asc')->get();
        $tasks = Task::where('status',1)->get();
        $timelogs = Timelog::orderby('project_id','asc')->paginate(6);
        return view('timelogs',compact('timelogs','projects','tasks'));
    }

public function fetchTask(){
    $tasklist = Task::where('project_id',request('project_id'))
                        ->where('status',1)
                        ->orderby('name','asc')
                        ->get();
    return ['status'=>'200','data'=> $tasklist];
}



    public function saveData(Request $request){

        try {
            
            $validatedData = $request->validate([
                'project_id' => 'required',
                'task_id' => 'required',
                'hours' => 'required',
                'taskdate' => 'required',
                'description' => 'required',
            ]);

            $new_entry = new Timelog;
            $new_entry->project_id = $request->input('project_id');
            $new_entry->task_id = $request->input('task_id');
            $new_entry->hours = $request->input('hours');
            $new_entry->taskdate =  $request->input('taskdate');
            $new_entry->description = $request->input('description');
            $new_entry->save(); 
           
            return response()->json(['success' => true, 'message' => 'Data inserted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error inserting data', 'error' => $e->getMessage()]);
        }
    }

public function report(){
 return view ('report');
}
public function fetchData(){
    $reportData = Timelog::select('project_id', 'task_id', DB::raw('SUM(hours) as total_hours'))
    ->with('project','task')
    ->groupBy('project_id', 'task_id')
    ->get();
 
    return response()->json(['data' => $reportData]);
}

public function searchData(Request $request){
    $query = $request->input('searchdata');

    Log::info('Search query:', ['query' => $query]);
    $prjctnm = Project::where('name', 'like', '%' . $query . '%')->get();
    Log::info('Response of the first API call:', ['prjctnm' => $prjctnm]);
    if ($prjctnm->isEmpty()) {
      
        return response()->json(['success' => false,'message' => 'No results found']);
    } else {
        $projectIds = $prjctnm->pluck('id')->toArray();
        $reportData = Timelog::select('project_id', 'task_id', DB::raw('SUM(hours) as total_hours'))
        ->with('project','task')
       -> whereIn('project_id',$projectIds )
        ->groupBy('project_id', 'task_id')
        ->get();
        Log::info('Response of the second API call:', ['reportData' => $reportData]);
        return response()->json(['success' => true,'data' => $reportData]);      
    }

   
}

}
