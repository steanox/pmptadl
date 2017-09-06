<?php

namespace Pmptadl\Http\Controllers;

use Illuminate\Http\Request;
use Pmptadl\discipline;
use Pmptadl\User;
use Pmptadl\disciplineDocument;
use Pmptadl\disciplineDocumentFile;
use Carbon\Carbon;

class DocumentManagement extends Controller
{
    public function index($project_name,$disciplineID){




        $disciplineList = discipline::where("projectID",$project_name)->get();

        $data = array(
            "title" => ["project",$project_name,"document management"],
            "projectName" => $project_name,
            "disciplineList" => $this->getAllDiscipline($disciplineList),
            "disciplineID" => $disciplineID,
            "css" => array(
                "js/datatables/plugins/bootstrap/dataTables.bootstrap.css"
            ),
            "js" => array(
                "js/datatables/media/js/jquery.dataTables.min.js",
                "js/datatables/plugins/bootstrap/dataTables.bootstrap.js",
                "js/table-managed.js"
            )
        );

        //get the document of the selected discipline
        $documents = disciplineDocument::where("disciplineID",$disciplineID)->get();
        $data["documents"] = [];

        foreach ($documents as $key=>$document){
            $documentFile = disciplineDocumentFile::where("disciplineDocumentId",$document->id)->orderBy("created_at","desc")->get();

            $firstUpload =  new Carbon($document->created_at) ;
            $lastUpload = new Carbon($document->lastUpload);

            $value = array(
                "documentID" => $document->id,
                "status" => $document->status,
                "statusColor" => ($document->status == "Approved")? "#73ff73" : "orange",
                "statusIcon" => $this->getIcon($document->status),
                "file" => $documentFile,
                "firstUpload" => $firstUpload->format('l\\, jS \\of F Y h:i:s A'),
                "lastUpload" => $lastUpload->format('l\\, jS \\of F Y h:i:s A'),
                "firstUploadBy" => User::where("id",$document->firstUploadBy)->first(),
                "lastUploadBy" => User::where("id",$documentFile[0]->uploadBy)->first()
            );

            array_push($data["documents"],$value);


        }



        return view("document-management",$data);

    }

    public function downloadFile($projectName,$filename){

        $fileCode = disciplineDocumentFile::where('fileName',urldecode($filename))->first();

        try{
            return response()->download('/home/pmptadln/adl/storage/app/public/'.$fileCode->fileURL);
        }catch(Exception $e ){
            echo '<script> alert("'.$e.'")</script>';
        }

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

    private function getIcon($status){
        switch ($status){
            case "Assigned":
                return "fa-cog fa-spin fa-3x fa-fw";
            case "NoComment":
                return "fa-comment-o";
            case "Reviewed with comment":
                return "fa-comment";
            case "Approved":
                return "fa-check";

        }


    }
}
