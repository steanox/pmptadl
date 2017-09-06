@extends('layout.app')

@section('content')
<style>
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
		<small>{{title_case($title[1])}}</small>
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
			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> Workflow Creation Wizard  - <span class="step-title">
								Step 1 of 2 </span>
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
							<!--<form action="{{route('initStage')}}" class="form-horizontal" id="submit_form" method="POST">-->
							<form action="/project/{{$projectName}}" class="form-horizontal" id="submit_form">
							{{ csrf_field() }}
							<input type="hidden" name="projectName" value="{{$projectName}}"/>
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li>
												<a href="#tab1"  class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-gears"></i> Design Discipline</span>
												</a>
											</li>
 										<li>
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Construction </span>
												</a>
											</li> 
											<li>
												<a href="#tab3" data-toggle="tab" class="step">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Another </span>
												</a>
											</li> 
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>
										<div class="tab-content">
											
											<div class="tab-pane active" id="tab1">
												<h3 class="block">Provide your workflow details</h3>
												<div style="margin-left: 50px">
													<div class="row">
														<label>Initiator Name <span class="required">
															* </span>
														</label>
													</div>
													<div class="form-group ">
														<div class="row">
															<div class="col-md-6">
																<input type="text" name="workflowName" class="form-control" name="username"/>
															</div>
															
														</div>

													</div>
													
												</div>

												<div style="margin-left: 50px">
													<div class="row">
														<label>User<span class="required">
															* </span>
														</label>
													</div>
													<div class="form-group " id="user-list">
														<div class="row new-user-form">
															<div class="col-md-2">
																<input type="text" name="user[]" class="form-control">
															</div>
															<div class="col-md-2 offset-md-6">
															
																<select class="form-control" name="numberOfStage">
																	<option>- Role - </option>
																	<option>Review</option>
																	<option>Approve</option>
																</select>
															</div>
														</div>

													</div>
													<a href="#" class="btn btn-xs green" id="add-new-form">+ Add new User</a>
												</div>
											</div>
											
										</div>
									</div>
									<div class="form-actions">
									<button class="btn blue" >Submit</button>
									</div>
								
							</form>
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
<script>

$("#add-new-form").click(function(){

	var userForm = '<div class="row new-user-form"><div class="col-md-2"><input type="text" name="user[]" class="form-control"></div><div class="col-md-2 offset-md-6"><select class="form-control" name="numberOfStage"><option>- Role - </option><option>Review</option><option>Approve</option></select></div></div>';

	$("#user-list").append(userForm);
})
</script>
@endsection

