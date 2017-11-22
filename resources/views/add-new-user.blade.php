@extends('layout.app')

@section('content')
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
			<form role="form" method="POST" action="{{ route('addUser') }}">
			{{ csrf_field() }}
				<div class="col-md-6 col-xs-12">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption font-green">
								<i class="icon-pin font-green"></i>
								<span class="caption-subject bold uppercase">Personal Information</span>
							</div>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" class="form-control" name="name" value="{{old('name')}}">
							<label for="form_control_1">Username</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="password" class="form-control" name="password">
							<label for="form_control_1">Password</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" class="form-control" name="firstName" value="{{old('firstName')}}">
							<label for="form_control_1">First name</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" class="form-control" name="lastName" value="{{old('lastName')}}">
							<label for="form_control_1">Last name</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" class="form-control" name="email" value="{{old('email')}}" >
							<label for="form_control_1">Email</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" class="form-control" name="address" value="{{old('address')}}">
							<label for="form_control_1">Address</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" class="form-control" name="phone" value="{{old('phone')}}">
							<label for="form_control_1">Phone</label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control" name="userType" >
								<option value="architect">Architect</option>
								<option value="designer">Designer</option>
							</select>
							<label for="form_control_1">Phone</label>
						</div>
						<div class="form-actions noborder">
							<button type="submit" class="btn blue">Submit</button>
						</div>
					</div>
				</div>
					<div class="col-md-6 col-xs-12">
						<div class="portlet light bordered">
							<div class="portlet-title">
								<div class="caption font-red">
									<i class="icon-pin font-green"></i>
									<span class="caption-subject bold uppercase">Organization</span>
								</div>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select name="organization" id="" class="form-control">
									@foreach($organizations as $organization)
										<option value="{{$organization->id}}"
										<?php  if (old('organization')){
											    if (old('organization') == $organization->id) echo 'selected';
												}
										?>
										>{{$organization->name}}</option>
									@endforeach
								</select>
								<label for="form_control_1">Organization</label>


							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" class="form-control" name="mainTitle" value="{{old('mainTitle')}}">
								<label for="form_control_1">Title</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" class="form-control" name="officeAddress" value="{{old('officeAddress')}}">
								<label for="form_control_1">Office address</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" class="form-control" name="officePhone" value="{{old('officePhone')}}">
								<label for="form_control_1">Office Phone</label>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection