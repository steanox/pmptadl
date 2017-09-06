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
				<div class="col-md-6 col-xs-12">

					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption font-green">
								<i class="icon-pin font-green"></i>
								<span class="caption-subject bold uppercase">File Transfer</span>
							</div>
						</div>
						<form action="/project/sendEmailFile/{{Request::segment(2)}}" enctype="multipart/form-data" method="post">
							{{ csrf_field() }}
						<div class="form-group form-md-line-input ">
							<input class="form-control" id="fileupload" type="file" name="image"  >
							<div id="progress">
							    <div class="bar" style="width: 0%;"></div>
							</div>
						</div>
						<div class="form-group form-md-line-input ">
							<span class="caption-subject bold uppercase">Expired Duration (on Days)</span>
							<input type="number" class="form-control" placeholder="Input a number of days" name="days"/>
						</div>
						<div class="form-group form-md-line-input ">
							<span class="caption-subject bold uppercase">Input Email</span>
							<textarea  style="width:100%" rows="3" name="email"></textarea>
							<span class="help-block" style="opacity:1">You can input multiple username by type it then press enter / click or by adding " , " to separate email</span>
							
						</div>
						&nbsp
						<div class="form-actions noborder">
							<button type="submit" class="btn blue">Submit</button>
						</div>
						</form>
					</div>
		
				</div>			
			</div>
		</div>
	</div>
@endsection

@section('addjs')

@endsection