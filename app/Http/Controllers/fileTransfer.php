<?php

namespace Pmptadl\Http\Controllers;

use Pmptadl\Project;
use Pmptadl\Library;
use Mail;
use Pmptadl\Mail\projectTransferFile;
use Carbon\Carbon;
use Illuminate\Http\Request;


class fileTransfer extends Controller
{
    //
	public function index($project_name){

		$data = array(
			"title" => ["project",$project_name,"assign user"],
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
		return view('file-transfer',$data);
	}


    public function sendFileEmail(Request $request,$project_name){
    	$this->validate($request, [
            'email' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'days' => 'required|Integer|min:1'
        ]);

    	
        $lib = new Library();
        $lib->status = "downloadable";
        //get upload file name and assign it to the model
        $fileName = urlencode($request->file('image')->getClientOriginalName());
        $lib->fileName = $fileName;
        //store the file and assign the filename code to the model
        $lib->fileCode = $request->file('image')->store('generalLibrary','p1');
        //get project id base on the url
        $lib->projectID = Project::where('projectName',$project_name)->first()->project_id;

        $lib->validUntil = Carbon::now()->addDays($request->days);
        $mailList = explode(',',$request->email);
        $lib->sentTo = json_encode($mailList);



        if($lib->save()){
        	 $downloadUrl = "http://pmptadl.net/download-transfer-file/".$fileName;
        	 foreach($mailList as $mail){
        	 	Mail::to($mail)->send(new projectTransferFile($downloadUrl));
        	 }
        }else{
        	print_r("fail");
        }
	}

	public function downloadTransferFile($filename){

		$fileCode = Library::where('fileName',urldecode($filename))->first();
		$validUntil = new Carbon($fileCode->validUntil);
		$dateNow = Carbon::now();
		
		if($dateNow->gt($validUntil)){
			 echo '<script> alert("Sorry the file you requested has been expired")</script>';
		}else{
			try{
				return response()->download('/home/pmptadln/adl/storage/app/public/'.$fileCode->fileCode);
			}catch(Exception $e ){
				echo '<script> alert("'.$e.'")</script>';
			}
		}	

	}
}
