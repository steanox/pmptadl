<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login',"Auth\LoginController@showLoginForm")->name('login');
Route::post('/password/reset ',"Auth\ResetPasswordController@reset");

Route::get('/password/reset ',"Auth\ForgotPasswordController@showLinkRequestForm")->name('password.request');
Route::post('/login',"Auth\LoginController@login");

Route::get('/test',function(){
	return view('/test');
});

Route::get('/',function(){
		return redirect("/login");
});
Route::group(['middleware' => 'auth'],function(){

	Route::get('/dashboard', function () {
		$data = array(
			"title" => ["dashboard"]
		);
	    return view('dashboard',$data);
	});
	Route::post('/logout',"Auth\LoginController@logout")->name('logout');

	Route::get('/project',"projectController@index")->name("projects");

	Route::get('/project/add-new-user',"projectController@createUser");
	Route::post('/project/add-new-user',"Auth\RegisterController@register")->name('addUser');

    Route::get('/project/{project_name}/edit-project',function($project_name){
        $data = array(
            "title" => ["project",$project_name,"edit project"],
            "css" => array(
                "js/select2/select2.css"
            ),
            "js" => array(
                "js/select2/select2.js",
                "js/components-dropdowns.js"
            )
        );
        return view('add-new-project',$data);
    });

	Route::get('/project/add-new-project',"projectController@createProject");
	Route::post('/project/store-new-user',"projectController@store")->name("saveProject");

	Route::post('/project/sendEmailFile/{project_name}',"fileTransfer@sendFileEmail");
	Route::get('/project/{project_name}/file-transfer',"fileTransfer@index");
	//Route::get('/project/download-transfer-file/{file_name}',"fileTransfer@downloadTransferFile");
	Route::get('/download-transfer-file/{filename}',"fileTransfer@downloadTransferFile");
	Route::get('/send_mail',"fileTransfer@send_mail");

	Route::get('/download-file/{id}',"projectLibraryController@downloadFile");
	Route::get('/get-library-file',"generalLibraryController@getLibraryFile")->name('getLibraryFile');

	Route::get('/project/{project_name}/view-library',"projectLibraryController@index")->name('projectLibrary');
	Route::get('/project/{project_name}/view-library/add-new-library',"projectLibraryController@create");
	Route::post('/project/{project_name}/view-library/store-new-minute',"projectLibraryController@store")->name("saveLibrary");


	Route::get('/project/{project_name}', 'projectController@detail');



	Route::get('/project/{project_name}/document-management',function($project_name){


	});

	Route::get('/project/{project_name}/assign-user',function($project_name){
		$data = array(
			"title" => ["project",$project_name,"assign user"],
			"css" => array(
				"js/jquery-textext-master/src/css/textext.core.css",
				"js/jquery-textext-master/src/css/textext.plugin.autocomplete.css",
				"js/jquery-textext-master/src/css/textext.plugin.tags.css"

			),
			"js" => array(
				"js/jquery-textext-master/src/js/textext.core.js",
				"js/jquery-textext-master/src/js/textext.plugin.tags.js",
				"js/jquery-textext-master/src/js/textext.plugin.autocomplete.js",
				"js/assign-user.js"
			)
		);

		return view('assign-user',$data);

	});

    Route::get('/project/{project_name}/discipline-list', 'disciplineController@index')->name("disciplineList");

	Route::get('project/{project_name}/discipline-list/add-new-discipline','disciplineController@create')->name("createDiscipline");

    Route::post('project/{project_name}/discipline-list/add-new-discipline','disciplineController@storeUser')->name('storeUserDiscipline');

    Route::get('project/{project_name}/discipline-list/{disciplineID}','disciplineController@edit')->name('editDiscipline');


	Route::get('/project/{project_name}/minutes-list', 'MinuteController@index')->name("minutes");

	Route::get('/project/{project_name}/minutes-list/add-new-minutes',"MinuteController@createMinute");
	Route::post('/project/{project_name}/minutes-list/store-new-minute',"MinuteController@store")->name("saveMinute");

	Route::get('/project/{project_name}/minutes-list/{minute_id}', 'TodoController@index')->name("todos");
	Route::get('/project/{project_name}/minutes-list/{minute_id}/add-new-todo', 'TodoController@create')->name("createTodo");




	Route::post('store-new-todo', 'TodoController@store')->name("saveTodo");
	Route::put('todo/{todoID}/done', 'TodoController@update')->name("updateTodo");





	Route::get('/project/{project_name}/document-management/{disciplineID}','DocumentManagement@index')->name("documentList");



	Route::get('/project/{project_name}/document-management/{disciplineID}/upload-document','disciplineDocumentController@uploadDocument')->name('uploadDocument');
    Route::post('/project/{project_name}/document-management/store-new-document','disciplineDocumentController@storeDocument')->name('storeNewDocument');
    Route::get('/project/{project_name}/document-management/{discipline_id}/review/{document_id}/{documentFile_id}','disciplineDocumentController@reviewDocument')->name('reviewDocument');
    Route::post('/project/{project_name}/document-management/{discipline_id}/review/{disciplineDocumentID}','disciplineDocumentController@handleDocumentUpdateFile')->name('updateDocument');
    Route::get('/project/{project_name}/document-management/{discipline_id}/approve/{disciplineDocumentID}/{documentFile_id}','disciplineDocumentController@approveDocument')->name('approveDocument');
    Route::get('/project/{project_name}/document-management/downloadSingleFile/{filename}','DocumentManagement@downloadFile')->name('downloadSingleFile');


	Route::get('/ajax/getAllUser',"AjaxController@getAllUser");
	Route::get('/ajax/getAllProject',"AjaxController@getAllProject");

	//Route::post('/project/document-management/create-stage',"ProjectWorkflowController@initStage")->name('initStage');

	//Route::post('/project/document-management/create-workflow',"ProjectWorkflowController@createWorkflow")->name('createWorkflow');

	//Route::get('/project/{project_name}/document-management/assign-stage',"ProjectWorkflowController@showCreateStage")->name('assignStage');

//	Route::get('/project/{project_name}/document-management/{workflow_name}',function($project_name,$workflow_name){
//		$data = array(
//			"title" => ["project",$project_name,"document management",$workflow_name],
//			"css" => array(
//				"css/todo.css"
//			),
//			"js" => array(
//
//			)
//		);
//		return view("workflow-detail",$data);
//	});


	Route::get('/library','generalLibraryController@index');
});





//Auth::routes();


