<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\User;
use Pmptadl\Project;

class AjaxController extends Controller
{
    function getAllUser(){
    	$users = User::all();
    	
    	$data = array();
    	foreach($users as $user){
    		$val = array(
    			"name" => $user->name,
    			"img" => "dump",
    			"org" => $user->organization
    		);
    		array_push($data, $val);
    	}
    	header('Content-Type: application/json');
    	return (json_encode($data));
    }

    function getAllProject(){
        $projects = Project::all();

        return response()->json($projects);
    }
}
