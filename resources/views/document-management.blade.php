@extends('layout.app')

@section('content')
								<style >
									.dropdown-file{
										z-index: 99;
										display: none;
											position: absolute;
										
											list-style-type: none;
											background-color: white;
											padding: 0px 0px;
											border-style: solid;
											border-color: grey;
											border-width: 0.1px;
									}
									.dropdown-file li{
										padding:10px;
								
									}

									.dropdown-file li:hover{
										background-color: lightgrey;
									}

								</style>

    <div class="page-content-wrapper" >
		<div class="page-content"	>

			<h3 class="page-title">
			{{title_case($title[1])}} <small></small>
			</h3>
			<dyouiv class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{url("/")}}">Home</a>
					</li>
					@foreach ($title as $title)
					<li>
						<i class="fa fa-angle-right"></i>
						<a href="">{{title_case($title)}}</a>
					</li>
					@endforeach
				</ul>
			<div class="page-toolbar">
					<!-- 	<a href="{{Request::url()}}/add-new-workflow" class="btn red">+ Upload Document</a> -->
					<a href="{{Request::url()}}/upload-document" class="btn red">+ Upload New Doc</a>

				</div> 
			</dyouiv>
			<div class="row ">
				<div class="col-md-3">
					<select class="form-control" id="disciplineList">
						@foreach($disciplineList as $discipline)
						<option value="{{$discipline["id"]}}" <?php if($discipline["id"] == $disciplineID) echo "selected";?> >{{ucfirst($discipline["disciplineName"])}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<a href="{{Request::url()}}/upload-document" class="btn red"><i class="fa fa-download"></i> Download All Files</a>
				</div>
			</div>

				&nbsp
			@if (count($errors) > 0 || session('message'))
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

				<div class="col-md-12 col-xs-12">
					<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th>
									Status
								</th>
								<th>
									File
								</th>
								<th>
									 First Upload
								</th>
								<th>
									Last Upload
								</th>
								
								<th>
									Revision
								</th>
								<th>
									 Comments
								</th>
								<th>
									 Remarks
								</th>
								<th>
									Action
								</th>
							</tr>
							</thead>
							<tbody>
							@foreach($documents as $key=>$document)

								<tr class="odd gradeX">
									<td style="background-color: {{$document["statusColor"]}}">
										<h4>{{$document["status"]}} <i class="fa {{$document["statusIcon"]}}"></i></h4>
									</td>

									<td>
										<a href="{{route('downloadSingleFile',['project_name'=> $projectName,'fileName'=>$document["file"][0]->fileName])}}">{{$document["file"][0]->fileName}}</a>
										<a href="#" class="drop-file" data-value="{{$key}}">
											<i class="fa fa-angle-double-down"></i>
										</a>
										<ul id="dropdown-file{{$key}}" class="dropdown-file" >
											@for ($i = 1; $i < count($document["file"]);$i ++)
												<li><a href="{{route('downloadSingleFile',['project_name'=> $projectName,'fileName'=>$document["file"][$i]->fileName])}}">Revision {{$i}}- {{$document["file"][$i]->fileName}}</a></li>
											@endfor

										<ul>
									</td>
									<td>
										<h6>
											Date: {{$document["firstUpload"]}}
										</h6>
										<h6>
											<b>{{$document["firstUploadBy"]->name }}</b>
										</h6>

									</td>
									<td>
										<h6>
											Date: {{$document["lastUpload"]}}
										</h6>
										<h6>
											<b>{{$document["lastUploadBy"]->name}}</b>

										</h6>
									</td>
									<td>
										<a onclick="alert('Go to sabrina profile')">
											Sabrina </a>

									</td>

									<td>

										{{$document["file"][0]->comment}}
									</td>
									<td>
										<a onclick="alert('Go to sabrina profile')">
											Sabrina </a>
									</td>
									<td>
										<a href="#"><button type="button" class="btn blue" title="Download latest File"> <i class="fa fa-download"></i></button></a>
										@if ($document["status"] != "Approved")
										<a href="{{route("approveDocument",['project_name'=>$projectName,'discipline_id'=>$disciplineID,"documentID" => $document["documentID"],"documentFile_id" => $document["file"][0]->id])}}"><button type="button" class="btn green" title="Approve Project"> <i class="fa fa-check"></i></button></a>
										<a href="{{ route("reviewDocument",['project_name'=>$projectName,'discipline_id' => $disciplineID,"document_id"=> $document["documentID"],"documentFile_id" => $document["file"][0]->id] )}}"><button type="button" class="btn yellow" title="Review Document"> <i class="fa fa-comment"></i></button></a>
										@endif
									</td>


								</tr>
							@endforeach

							</tbody>
							</table>
						</div>
					</div>
				
				</div>			
			</div>
		</div>
	</div>
@endsection

@section('addjs')
<script>
TableManaged.init();
$('.drop-file').click(function(){
    var key = $(this).data("value");
	$('#dropdown-file' + key).toggle(100);
	$(this).children().toggleClass('fa-angle-double-down');
	$(this).children().toggleClass('fa-angle-double-right');
});

$('#disciplineList').on("change",function(i){
	var disciplineID = $('#disciplineList').find(":selected").val();
	var root = "{{Request::root()}}";
	var projectID = "{{Request::segment(2)}}"

    window.open(root + "/project/" + projectID + "/document-management/" + disciplineID,"_self");

});

</script>
@endsection