@extends('layout.app')

@section('content')
<link rel="stylesheet" href="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.css">
<style>
	.awesomplete{
		display: block !important;
	}
    .text-label div {
        background-position : 0 0;
        background-repeat   : no-repeat;
        padding-left        : 21px;
        line-height         : 16px;
    }

    .text-label div p {
        margin      : 0;
        font-size   : 10px;
        color       : silver;
        line-height : 10px;
    }
</style>
    <div class="page-content-wrapper">
		<div class="page-content">

			<h3 class="page-title">
			{{title_case($title[1])}} <small></small>
			</h3>
			<div class="page-bar">
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
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Workflow Creation Wizard - <span class="step-title">
								Step 1 of 6 </span>
							</div>
							<div class="tools hidden-xs">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<div  class="form-horizontal" >
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li class="active">
												
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Stage Setup for {{$workflowName}} </span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success" style="width:50%">
											</div>
										</div>
										<div class="tab-content">
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												You have some form errors. Please check below.
											</div>
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>
										
											<div class="tab-pane active" id="tab2">
												<h3 class="block">Provide your profile details</h3>
												
												<div class="form-group">
													<label class="control-label col-md-3">Select Stage <span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<select class="form-control" id="stage-select">
															@for ($i = 0 ; $i < $numberOfStage ; $i++)
															<option value="{{$i+1}}">{{$i+1}}</option>
															@endfor
														</select>
														<span class="help-block">
														Depend on what you've submit on step 1</span>
														<input type="hidden" id="current-stage"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Creator<span class="required">
													* </span>
													</label>
													<div class="col-md-6">
														<input type="text" id="assign-creator" class="form-control creator" placeholder="Provide the creator of this stage"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Recipient<span class="required">
													* </span>
													</label>
													<div class="col-md-6">
														<textarea  id="recipient-user" class="recipient" style="width: 100%" rows=5/></textarea>
													</div>
													<div class="col-md-4">
													<span class="help-block" style="opacity:1"></span>
													</div>	
													
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions" style="background-color:#3598dc ">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<a href="" class="btn default button-previous">
												<i class="m-icon-swapleft"></i> Back </a>
												<button id="submit_form" class="btn green ">
												Submit <i class="m-icon-swapright m-icon-white"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
		
		</div>
	</div>
@endsection

@section('addjs')
<script src="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.min.js"></script>
<script>
	var data = [];
	window.addEventListener("awesomplete-selectcomplete",function(data){
			console.log(data)
		});
	var ajax = new XMLHttpRequest();
	ajax.open("GET", window.location.origin+"/ajax/getAllUser", true);
	ajax.onload = function() {
		var list = JSON.parse(ajax.responseText).map(function(i) { return i.name; });

		new Awesomplete(document.querySelector("#recipient-user"),{ 
			list: list,
			filter: function(text, input) {
				return Awesomplete.FILTER_CONTAINS(text, input.match(/[^,]*$/)[0]);
			},

			item: function(text, input) {
				return Awesomplete.ITEM(text, input.match(/[^,]*$/)[0]);
			},

			replace: function(text) {
				var before = this.input.value.match(/^.+,\s*|/)[0];
				this.input.value = before + text + ", ";
			}
		});

		
	};
ajax.send();



	$(document).ready(function(){
		let stageNumber = $('#stage-select').val();
		$("#assign-creator").attr("name","creator-" + stageNumber);
		$("#assign-user").attr("name","recipient-" + stageNumber);

		$("#current-stage").val(stageNumber);
		
	});	

	$('#submit_form').on('click',function(){
		let creator = $('.creator').val();
		let recipient = $('.recipient').val();
		let current_stage = $("#current-stage").val() - 1;
		var stage_value = {creator:creator,recipient:recipient,stage: current_stage + 1};
		
		data[current_stage] = stage_value;
		
		$.ajax({
			type: "POST",
			dataType: "text",
			data: {
				"_token" : "{{ csrf_token() }}",
				"data" : '{"json" : ' + JSON.stringify(data) + '}'
			},
			url: '{{route("createWorkflow")}}',
			success: function(data){
				
				console.log(data);
			}

		});
	});

	$('#stage-select').on("change",function(){
		let creator = $('.creator').val();
		
		
		let recipient = $('.recipient').val();
		let current_stage = $("#current-stage").val() - 1;
		var stage_value = {creator:creator,recipient:recipient,stage: current_stage + 1};
		
		data[current_stage] = stage_value;
		
		if (data[this.value-1] == undefined){
			console.log("undefined");
			$('.creator').val("");
			$('.recipient').val("");
		}else{

			$('.creator').val(data[this.value-1].creator);
			$('.recipient').val(data[this.value-1].recipient);
		}
		console.log	
		$("#current-stage").val(this.value);
	});
</script>
@endsection

