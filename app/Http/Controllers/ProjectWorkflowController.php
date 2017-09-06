<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\projectWorkflow;

class ProjectWorkflowController extends Controller
{
    public function index($project_name)
    {
	$data = array(
			"title" => ["project",$project_name,"document management","add new workflow"],
			"css" => array(
				"js/select2/select2.css",
				"js/jquery-textext-master/src/css/textext.core.css",
				"js/jquery-textext-master/src/css/textext.plugin.autocomplete.css",
				"js/jquery-textext-master/src/css/textext.plugin.tags.css"
			),
			"js" => array(
				"js/jquery-validation/js/jquery.validate.min.js",
				"js/jquery-validation/js/additional-methods.min.js",
				"js/select2/select2.js",
				"js/bootstrap-wizard/jquery.bootstrap.wizard.min.js",
				"js/form-wizard.js",
				"js/jquery-textext-master/src/js/textext.core.js",
				"js/jquery-textext-master/src/js/textext.plugin.tags.js",
				"js/jquery-textext-master/src/js/textext.plugin.autocomplete.js",
				"js/assign-user-to-workflow.js"
			),
			"projectName" => $project_name
		);

	return view("manage-workflow",$data);

    }
    public function initStage(Request $request){
    	$project_name = $request->projectName;
    	$data = array(
			"title" => ["project",$project_name,"document management","add new workflow"],
			"css" => array(
				"js/select2/select2.css",
				"js/jquery-textext-master/src/css/textext.core.css",
				"js/jquery-textext-master/src/css/textext.plugin.autocomplete.css",
				"js/jquery-textext-master/src/css/textext.plugin.tags.css"
			),
			"js" => array(
				"js/jquery-validation/js/jquery.validate.min.js",
				"js/jquery-validation/js/additional-methods.min.js",
				"js/select2/select2.js",
				"js/bootstrap-wizard/jquery.bootstrap.wizard.min.js",
				"js/form-wizard.js",
				"js/jquery-textext-master/src/js/textext.core.js",
				"js/jquery-textext-master/src/js/textext.plugin.tags.js",
				"js/jquery-textext-master/src/js/textext.plugin.autocomplete.js"
			),
			"workflowName" => $request->workflowName,
    		"numberOfStage" => $request->numberOfStage,
    		"projectName" => $project_name
		);

	return view("create-stage",$data);

    }

    public function showCreateStage(){
    	$data = array(
			"title" => ["project",$project_name,"document management","add new workflow"],
			"css" => array(
				"js/select2/select2.css",
				"js/jquery-textext-master/src/css/textext.core.css",
				"js/jquery-textext-master/src/css/textext.plugin.autocomplete.css",
				"js/jquery-textext-master/src/css/textext.plugin.tags.css"
			),
			"js" => array(
				"js/jquery-validation/js/jquery.validate.min.js",
				"js/jquery-validation/js/additional-methods.min.js",
				"js/select2/select2.js",
				"js/bootstrap-wizard/jquery.bootstrap.wizard.min.js",
				"js/form-wizard.js",
				"js/jquery-textext-master/src/js/textext.core.js",
				"js/jquery-textext-master/src/js/textext.plugin.tags.js",
				"js/jquery-textext-master/src/js/textext.plugin.autocomplete.js",
				"js/assign-user-to-workflow.js"
			)
		);

	return view("create-stage",$data);

    }

    public function uploadDocument($project_name){
    	$data = array(
			"title" => ["project",$project_name,"document management","upload document"],
			"css" => array(
				"js/jquery-textext-master/src/css/textext.core.css",
				"js/jquery-textext-master/src/css/textext.plugin.tags.css"
				
			),
			"js" => array(
				"js/jquery-textext-master/src/js/textext.core.js",
				"js/jquery-textext-master/src/js/textext.plugin.tags.js",
				"js/jquery-file-upload/js/vendor/jquery.ui.widget.js",
				"js/jquery-file-upload/js/jquery.iframe-transport.js",
				"js/jquery-file-upload/js/jquery.fileupload.js",
				"js/assign-user.js"
			)
		);

		return view("upload-document",$data);
    }



    public function createWorkflow(Request $request){
    	$val =  json_decode($request->data);
    	//$data = json_decode($request->data);
    	print_r($val);
    }


}
