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
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="portlet light bordered">
						<div class="portlet-title">
							<div class="caption font-green">
								<i class="icon-pin font-green"></i>
								<span class="caption-subject bold uppercase">Input username</span>
							</div>
						</div>
						<div class="form-group form-md-line-input ">
							
							<textarea  id="assign-user" style="widht:100%" rows="3" ></textarea>
							<span class="help-block" style="opacity:1">You can input multiple username by type it then press enter / click</span>
							
						</div>
						
						<div class="form-actions noborder">
							<button type="button" class="btn blue">Submit</button>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
@endsection

@section('addjs')

@endsection