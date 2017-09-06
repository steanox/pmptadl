<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\discipline;
use Pmptadl\User;
use Illuminate\Support\Facades\Auth;
use Pmptadl\disciplineDocument;
use Pmptadl\disciplineDocumentFile;


class disciplineDocumentController extends Controller
{
    public function uploadDocument($project_name,$disciplineID){

        $disciplineList = discipline::where("projectID",$project_name)->get();
        $userList = $this->getDecodedUsers($disciplineList);




        $data = array(
            "projectName" => $project_name,
            "disciplineID" =>$disciplineID,
            "title" => ["project",$project_name,"document management","upload document"],
            "disciplineList" => $this->getAllDiscipline($disciplineList),
            "userList" => $userList,
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


    public function storeDocument(Request $request,$projectName){
        $this->validate($request, [
            'discipline' => 'required',
            'comment'=>'required',
            'documentFile' => 'required',
            'users'=> 'required'
        ]);




        $disciplineDocument = new disciplineDocument();
        $disciplineDocument->status = "Assigned";
        $disciplineDocument->disciplineID =  $request->discipline;
        $disciplineDocument->firstUploadBy = Auth::user()->id;
        $disciplineDocument->lastUploadBy = Auth::user()->id;
        $disciplineDocument->approvalBy = "";

        if($disciplineDocument->save()){

            if ($this->handleDocumentFile($request,$disciplineDocument)){
                return redirect()->route('documentList', ["project_name" => $request->segment(2),"disciplineID"=>$disciplineDocument->disciplineID]);
            }

        }else{
            print_r("failed");
        }

    }

    private function handleDocumentFile(Request $request,$disciplineDocument){



        $documentFile = new disciplineDocumentFile();
        $documentFile->fileName = urlencode($request->file('documentFile')->getClientOriginalName());
        $documentFile->fileURL = $request->file('documentFile')->store('disciplineDocument','p1');
        $documentFile->comment = $request->comment;
        $documentFile->uploadBy = Auth::user()->id;
        $documentFile->reviewBy = json_encode($request->users);
        $documentFile->disciplineDocumentId = $disciplineDocument->id;

        if($documentFile->save()){
            return true;
        }else{
            print_r("failed save file");
        }


    }

    public function reviewDocument($projectName,$disciplineID,$documentID,$documentFileID){
        $documentFile = disciplineDocumentFile::where("id",$documentFileID)->first();
        $document = disciplineDocument::where("id",$documentID)->first();

        //CHECK DOCUMENT STATUS
        if($document->status == "Approved"){

            return redirect()->back()->withErrors(['message'=>'This document no longer can be reviewed']);
        }


        //check if user are eligible to review
        $reviewerList = json_decode($documentFile->reviewBy);
        $username = Auth::user()->name;

        if(!in_array($username,$reviewerList )){

            return redirect()->back()->withErrors(['message'=>'You are not permitted to review this document']);
        }

        $discipline =  discipline::where('id',$disciplineID)->get();


        $userList = $this->getDecodedUsers($discipline);

        $data = array(
            "projectName" =>  $projectName,
            "disciplineID" => $disciplineID,
            "disciplineDocumentID" => $documentID,
            "title" => array(
                "project",
                $projectName,
                "document-management",
                $discipline[0]->disciplineName,
                "review"
                ),
            "userList" => $userList,
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

        return view('review-document',$data);

    }



    public function handleDocumentUpdateFile(Request $request,$projectName,$disciplineID,$disciplineDocumentID){


        $this->validate($request, [
            'documentFile' => 'required',
            'users'=> 'required'
        ]);

        $disciplineDocument = disciplineDocument::find($disciplineDocumentID);
        $disciplineDocument->lastUploadBy = Auth::user()->id;
        $disciplineDocument->status = ($request->comment)? "Reviewed with comment" : "Reviewed with no comment";

        if($disciplineDocument->save()){

            if ($this->handleDocumentFile($request,$disciplineDocument)){
                return redirect()->route('documentList', ["project_name" => $request->segment(2),"disciplineID"=>$disciplineDocument->disciplineID]);
            }

        }else{
            print_r("failed");
        }

    }


    /**
     * @param $disciplineList
     * @return array
     */
    private function getDecodedUsers($disciplineList){

        $userList = [];
        $key = [];


        foreach ($disciplineList as $discipline){
            $userListDecoded = json_decode($discipline->userList);

            foreach ($userListDecoded as $user){
                if (!in_array($user[0],$userList)){
                    array_push($userList,array(
                        "role" => ($user[1] == 1)? "Review" : "Approve",
                        "name" => $user[0]
                    ));
                }
                array_push($key,$user[0]);
            }
        }
        return $userList;
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

    public function approveDocument($projectName,$disciplineID,$disciplineDocumentID,$disciplineDocumentFileID){
        //check if user has the role to approve
        $discipline = discipline::where('id',$disciplineID)->first();
        $disciplineUserList = json_decode($discipline->userList);
        $disciplineDocumentFile = disciplineDocumentFile::where("id",$disciplineDocumentFileID)->first();
        $disciplineDocumentFileUserList = json_decode($disciplineDocumentFile->reviewBy);

        $userName = Auth::user()->name;

        if(!in_array($userName,$disciplineDocumentFileUserList)){

            return redirect()->back()->withErrors(['message'=>'You are not permitted to approve this document']);

        }else if(!$this->isEligibleToApprove($userName,$disciplineUserList)){

            return redirect()->back()->withErrors(['message'=>'You are not eligible to approve this document']);

        }else{
            $disciplineDocument = disciplineDocument::where("id",$disciplineDocumentID)->first();
            $disciplineDocument->status = "Approved";
            $disciplineDocument->approvalBy = $userName;

            if($disciplineDocument->save()){
                echo '<script>Success approve documents</script>';
                return redirect()->back();
            }

        }
    }




    private function isEligibleToApprove($username,$userList){
        foreach($userList as $user){
            if($user[0] == $username){
                if($user[1] == 2){
                    return true;
                }
            }

        }
        return false;
    }


}
