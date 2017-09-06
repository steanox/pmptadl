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
								<span class="caption-subject bold uppercase">Todo Information</span>
							</div>
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
						<form  role="form" method="POST" action="{{ route('saveTodo') }}">
						{{ csrf_field() }}
							<input type="hidden" name="projectName" value="{{ Request::segment(2) }}">
							<input type="hidden" name="minuteID" value="{{ Request::segment(4) }}">
							<div class="form-group form-md-line-input form-md-floating-label">
								<textarea class="form-control" rows="5" name="title" value="{{old('title')}}"></textarea>
								<label for="form_control_1">Title</label>
							</div>

							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="date" class="form-control" name="date" value="{{old('date')}}">
								<label for="form_control_1">Date</label>
							</div>

							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="date" class="form-control" name="dueDate" value="{{old('dueDate')}}">
								<label for="form_control_1">Due Date</label>
							</div>

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
<script>
ComponentsDropdowns.init();
</script>
@endsection