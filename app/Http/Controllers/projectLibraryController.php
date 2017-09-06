<?php

namespace Pmptadl\Http\Controllers;

use Pmptadl\projectLibrary;
use Illuminate\Http\Request;
use Pmptadl\FileList;
use Pmptadl\Project;
use Pmptadl\ProjectFileList;

class projectLibraryController extends Controller
{

    public function downloadFile($id){

        $filelist = FileList::find($id);
    
        try{
            return response()->download($filelist->filePath);
        }catch(Exception $e ){
            echo '<script> alert("'.$e.'")</script>';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $project_name)
    {
        $q = $request->input('q');
        $data = array(
            "title" => [$project_name,"library"],
            "css" => array(
                "js/jstree/dist/themes/default/style.min.css",
                "js/jquery.form.min.js"
            ),
            "js" => array(
                "js/jstree/dist/jstree.min.js",
                "js/ui-tree.js"
            ),
            "fileLists" => FileList::where('fileType', 'like', '%'.$q.'%')->simplePaginate(10)
        );
        return view('library',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            "title" => ["Library","add new library"],
            // "css" => array(
            //     "js/select2/select2.css",
                
            // ),
            // "js" => array(
            //     "js/select2/select2.js",
            //     "js/components-dropdowns.js"
            // )
        );

        // $data['architectList'] = User::where('userType','architect')->orderBy('firstName','asc')->get();
        // $data['categories'] = Category::orderBy('name','asc')->get();
        
        return view('add-new-library',$data);
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
            'fileupload' => 'required',
            'associatedProjects' => 'required'
        ]);
        
        $newFileList = new FileList();
        

        //get upload file name and assign it to the model
        $fileName = urlencode($request->file('fileupload')->getClientOriginalName());
        $newFileList->fileName = $fileName;
        $newFileList->fileType = $request->file('fileupload')->getClientMimeType();
        // $newFileList->projectID = $project->project_id;


        $fileNameEncode = $request->file('fileupload')->store('ProjectLibraryLists','p1');
        //store the file
        $newFileList->filePath = storage_path('app/public/').$fileNameEncode;
        $newFileList->fileCode = $fileNameEncode;
        $associatedProjects = explode(',', $request->associatedProjects);
        
        // $newFileList->structure   = $request->minuteStructure;
        // $newFileList->architectByID = $request->architectByID;
        // $newFileList->categoryID = $request->categoryID;
        // $newFileList->createdBy   = '{"id":'.Auth::user()->id.',"name":"'.Auth::user()->name.'"}';

        if($newFileList->save()){

            foreach ($associatedProjects as $key => $value) {
                if(trim($value))
                {
                    $project = Project::where('projectName', 'like', '%'.$value.'%')->first();
                    if(isset($project))
                    {
                        $projectfilelist = new ProjectFileList;
                        $projectfilelist->filelistID = $newFileList->id;
                        $projectfilelist->projectID = $project->project_id;
                        $projectfilelist->save();
                   }
                }
            }

            $request->session()->flash('status','successfully create new minute');
            return redirect()->route('projectLibrary', $request->segment(2));
        }
        else{
            print("die");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Pmptadl\projectLibrary  $projectLibrary
     * @return \Illuminate\Http\Response
     */
    public function show(projectLibrary $projectLibrary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Pmptadl\projectLibrary  $projectLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(projectLibrary $projectLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Pmptadl\projectLibrary  $projectLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, projectLibrary $projectLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Pmptadl\projectLibrary  $projectLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(projectLibrary $projectLibrary)
    {
        //
    }
}
