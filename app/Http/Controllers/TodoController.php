<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\User;
use Pmptadl\Minute;
use Pmptadl\Project;
use Pmptadl\Todo;

class TodoController extends Controller
{

    public function index($project_name, $minute_id){
        $project = Project::where('projectName', $project_name)->first();
        $todos = Todo::where('minuteID', $minute_id)->get();

        $data = array(
            "title" => ["project",$project_name,"minutes list"],
            "css" => array(
                "js/datatables/plugins/bootstrap/dataTables.bootstrap.css"
            ),
            "js" => array(
                "js/datatables/media/js/jquery.dataTables.min.js",
                "js/datatables/plugins/bootstrap/dataTables.bootstrap.js",
                "js/table-managed.js"
            ),
            'todos' => $todos
        );
        return view("todo-list",$data);
    }

    public function create(){

        $data = array(
            "title" => ["project","add new project"],
            "css" => array(
                "js/select2/select2.css",
                
            ),
            "js" => array(
                "js/select2/select2.js",
                "js/components-dropdowns.js"
            )
        );

        // $data['architectList'] = User::where('userType','architect')->orderBy('firstName','asc')->get();
        // $data['categories'] = Category::orderBy('name','asc')->get();
        
        return view('add-new-todo',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required',
            'date' => 'required',
            'dueDate' => 'required',
            'projectName' => 'required',
            'minuteID' => 'required'
        ]);
        
        $project = Project::where('projectName', $request->projectName)->first();

        $newTodo = new Todo();
        $newTodo->title = $request->title;
        $newTodo->minuteID = $request->minuteID;
        $newTodo->date    = $request->date;
        $newTodo->dueDate         = $request->dueDate;
        $newTodo->status         = 'On Progress';
        // $newTodo->structure   = $request->minuteStructure;
        // $newTodo->architectByID = $request->architectByID;
        // $newTodo->categoryID = $request->categoryID;
        // $newTodo->createdBy   = '{"id":'.Auth::user()->id.',"name":"'.Auth::user()->name.'"}';

        if($newTodo->save()){
            $request->session()->flash('status','successfully create new todo');
            return redirect()->route('todos', [$project->projectName, $newTodo->minuteID] );
        }
        else{
            print("die");
        }
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($todoID)
    {
        
        $todo = Todo::find($todoID);
        $todo->status         = 'Done';

        if($todo->save()){
            // $request->session()->flash('status','successfully update  todo');
            return redirect()->back();
        }
        else{
            print("die");
        }
    }
}
