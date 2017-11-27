<?php

namespace Pmptadl\Http\Controllers;

use Pmptadl\Project;
use Pmptadl\Organizations;
use Pmptadl\User;
use Pmptadl\discipline;
use Pmptadl\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class projectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = array(
            "title" => ["project"],
            "css" => array(
                "js/jstree/dist/themes/default/style.min.css"
            ),
            "js" => array(
                "js/jstree/dist/jstree.min.js",
                "js/ui-tree.js"
            )
        );
       
        $data['projects'] = Project::with('category')->get();
        return view('project',$data);
    }

    public function createProject(){

        $data = array(
            "title" => ["project","add new project"],
            "css" => array(
                "js/select2/select2.css",
                
            ),
            "js" => array(
                "js/select2/select2.js",
                "js/components-dropdowns.js"
            ),
            'organizations' => Organizations::all()
        );

        $data['architectList'] = User::where('userType','architect')->orderBy('firstName','asc')->get();
        $data['categories'] = Category::orderBy('name','asc')->get();
        
        return view('add-new-project',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {

        $data = array(
            "title" => ["project","add new user"],
            'organizations' => Organizations::all()
        );

        return view('add-new-user',$data);
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
            'projectName' => 'required',
            'projectDesc' => 'required',
            'projectSiteArea' => 'required',
            'projectGFA' => 'required',
            'clientName' => 'required',
            'architectName' => 'required',
            'structureName' => 'required',
            'mepName' => 'required',
            'qsName' => 'required',
            'contractorName' => 'required',
        ]);
           
        $newProject = new Project();
        $newProject->projectName
            = $request->projectName;
        $newProject->description        = $request->projectDesc;
        $newProject->siteArea           = $request->projectSiteArea;
        $newProject->GFA                = $request->projectGFA;
        $newProject->categoryID         = $request->categoryID;
        $newProject->clientName         = $request->clientName;
        $newProject->architectName      = $request->architectName;
        $newProject->structureName      = $request->structureName;
        $newProject->mepName            = $request->mepName;
        $newProject->qsName             = $request->qsName;
        $newProject->contractorName     = $request->contractorName;
        
        $newProject->createdBy   = '{"id":'.Auth::user()->id.',"name":"'.Auth::user()->name.'"}';

        if($newProject->save()){
            $request->session()->flash('status','successfully create new project');
            return redirect()->route('projects');
        }
        else{
            print("Failed");
        }
    }


    public function detail($project_name){
        $disciplineList = discipline::where("projectID",$project_name)->first();
        $data = array(
            "title" => ["project",$project_name]
        );
        if (!empty($disciplineList)){

            $data["disciplineID"] = $disciplineList->id;
        }
        return view('project-menu',$data);

    }




    /**
     * Display the specified resource.
     *
     * @param  \Pmptadl\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Pmptadl\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Pmptadl\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Pmptadl\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }


    private function getAllDiscipline($disciplineList){
        $disciplines = [];

        foreach ($disciplineList as $discipline){

            array_push($disciplines,array(
                "id" => $discipline->id,
                "disciplineName" => $discipline->disciplineName
            ));


        }

        return $disciplines;

    }

}
