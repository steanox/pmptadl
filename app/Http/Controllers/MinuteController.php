<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\User;
use Pmptadl\Minute;
use Pmptadl\Project;
use Pmptadl\MinuteUser;

class MinuteController extends Controller
{

    public function index($project_name){
        $project = Project::where('projectName', $project_name)->first();
        $minutes = Minute::where('projectID', $project->project_id)->get();

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
            'minutes' => $minutes
        );
        return view("minutes-list",$data);
    }


    public function createMinute(){

        $data = array(
            "title" => ["minute","add new minute"],
            "css" => array(
                "js/select2/select2.css",
                
            ),
            "js" => array(
                "js/select2/select2.js",
                "js/components-dropdowns.js"
            )
        );

        $data['architectList'] = User::where('userType','architect')->orderBy('firstName','asc')->get();
        // $data['categories'] = Category::orderBy('name','asc')->get();
        
        return view('add-new-minute',$data);
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
            'minuteName' => 'required',
            'fileupload' => 'required',
            'notedBy' => 'required',
            'distribution' => 'required'
        ]);
        
        $project = Project::where('projectName', $request->segment(2))->first();

        $newMinute = new Minute();
        $newMinute->name = $request->minuteName;

        //get upload file name and assign it to the model
        $fileName = urlencode($request->file('fileupload')->getClientOriginalName());
        $newMinute->document = $fileName;
        //store the file
        $newMinute->documentPath = storage_path('app/public/').$request->file('fileupload')->store('ProjectLibrary','p1');
        

        
        $newMinute->remarkID         = $request->remarkID;
        $newMinute->notedby         = $request->notedBy;
        $newMinute->projectID = $project->project_id;

        $distribution = explode(',', $request->distribution);



        // $newMinute->structure   = $request->minuteStructure;
        // $newMinute->architectByID = $request->architectByID;
        // $newMinute->categoryID = $request->categoryID;
        // $newMinute->createdBy   = '{"id":'.Auth::user()->id.',"name":"'.Auth::user()->name.'"}';

        if($newMinute->save()){
            foreach ($distribution as $key => $value) {
                if(trim($value))
                {
                    $user = User::where('name', 'like', '%'.$value.'%')->first();
                    if(isset($user))
                    {
                        $minuteuser = new MinuteUser;
                        $minuteuser->userID = $user->id;
                        $minuteuser->minuteID = $newMinute->id;
                        $minuteuser->save();
                   }
                }
            }

            $request->session()->flash('status','successfully create new minute');
            return redirect()->route('minutes', $project->projectName);
        }
        else{
            print("die");
        }
    }
}
