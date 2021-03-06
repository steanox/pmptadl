<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\Organizations;
use PhpParser\Node\Expr\Array_;
use Pmptadl\discipline;
use Pmptadl\User;

class disciplineController extends Controller
{
    public function index($project_name){



        $data = array(
   		    "disciplines" => discipline::where('projectID',$project_name)->get(),
            "title" => array(
                "project",
                $project_name,
                "discipline list"),
            "css" => array(
                "js/datatables/plugins/bootstrap/dataTables.bootstrap.css"
            ),
            "js" => array(
                "js/datatables/media/js/jquery.dataTables.min.js",
                "js/datatables/plugins/bootstrap/dataTables.bootstrap.js",
                "js/table-managed.js"
            )
        );
        return view("discipline-list",$data);


    }

    public function create($project_name){


        $data = array(
            "project" =>  $project_name,
            "title" => array(
                "project",
                $project_name,
                "discipline list",
                "Create New Discipline"),
            "userlist" => User::orderBy('name',"asc")->get(),
            "css" => array(
                "js/select2/select2.css",
                "js/jquery-textext-master/src/css/textext.core.css",
                "js/jquery-textext-master/src/css/textext.plugin.autocomplete.css",
                "js/jquery-textext-master/src/css/textext.plugin.tags.css"
            ),
            "js" => array(
                "js/components-dropdowns.js",
                "js/jquery-validation/js/jquery.validate.min.js",
				"js/jquery-validation/js/additional-methods.min.js",
				"js/select2/select2.js",
				"js/bootstrap-wizard/jquery.bootstrap.wizard.min.js",
				"js/form-wizard.js",
				"js/jquery-textext-master/src/js/textext.core.js",
				"js/jquery-textext-master/src/js/textext.plugin.tags.js",
				"js/jquery-textext-master/src/js/textext.plugin.autocomplete.js"
            ),
            'organizations' => Organizations::all()
        );

      return view('create-discipline',$data);

    }

    public function edit($project_name,$disciplineID){

        $data = array(
            "project" =>  $project_name,
            "discipline" => Discipline::where("id",$disciplineID)->first(),
            "title" => array(
                "project",
                $project_name,
                "discipline list",
                $disciplineID),
            "userlist" => User::orderBy('name',"asc")->get(),
            "css" => array(
                "js/select2/select2.css",
                "js/jquery-textext-master/src/css/textext.core.css",
                "js/jquery-textext-master/src/css/textext.plugin.autocomplete.css",
                "js/jquery-textext-master/src/css/textext.plugin.tags.css"
            ),
            "js" => array(
                "js/components-dropdowns.js",
                "js/jquery-validation/js/jquery.validate.min.js",
                "js/jquery-validation/js/additional-methods.min.js",
                "js/select2/select2.js",
                "js/bootstrap-wizard/jquery.bootstrap.wizard.min.js",
                "js/form-wizard.js",
                "js/jquery-textext-master/src/js/textext.core.js",
                "js/jquery-textext-master/src/js/textext.plugin.tags.js",
                "js/jquery-textext-master/src/js/textext.plugin.autocomplete.js"
            )
        );

        $data["discipline"]["userList"] = json_decode($data["discipline"]["userList"]);

        return view('edit-discipline',$data);




    }

    public function storeUser(Request $request,$projectName){


        $this->validate($request, [
            'disciplineName' => 'required',
            'initiatorName' => 'required'
        ]);




        $newDicipline = new Discipline();
        $userList = [];

        foreach($request->user as $key=>$value){
            array_push($userList,array(
                $value,
                ($request->userRole[$key] == 1) ? "review" : "approve"
            ));
        }




        $newDicipline->disciplineName = $request->disciplineName;
        $newDicipline->projectID = $projectName;
        $newDicipline->initiatorName = User::where('id',$request->initiatorName)->get()[0]->name;
        $newDicipline->userList = json_encode($userList);



        if($newDicipline->save()){
            return redirect()->route('disciplineList', $request->segment(2));
        }


    }
}
