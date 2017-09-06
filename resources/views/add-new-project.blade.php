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
								<span class="caption-subject bold uppercase">Project Information</span>
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
						<form  role="form" method="POST" action="{{ route('saveProject') }}">
						{{ csrf_field() }}
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" class="form-control" name="projectName" value="{{old('projectName')}}">
								<label for="form_control_1">Project Title</label>
								
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<textarea class="form-control" rows="5" name="projectDesc">{{old('projectDesc')}}</textarea>
								<label for="form_control_1">Project Description</label>
							</div>

							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control  select2me" name="categoryID" data-placeholder="Select...">
									<option value=""></option>
									@foreach ($categories as $category)
										<option value="{{$category->id}}">{{$category->name }}</option>
									@endforeach
								</select>
								<label for="form_control_1" style="top:-4px !important">Category</label>
							</div>

							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" class="form-control" name="projectSiteArea" value="{{old('projectSiteArea')}}">
								<select class="form-control" style="position: absolute;
								    width: 25%;
								    top: 20px;
								    right: 0px;">
									<option>ha</option>
									<option>acres</option>
									<option>m2</option>
								</select>
								<label for="form_control_1">Site Area</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label" >
								<input type="text" class="form-control" name="projectGFA" value="{{old('projectGFA')}}">
								<select class="form-control" style="position: absolute;
								    width: 25%;
								    top: 20px;
								    right: 0px;">
									<option>ft2</option>
									<option>m2</option>
								</select>
								<label for="form_control_1">GFA</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control  select2me" name="clientName" data-placeholder="Select Client">
									<option value=""></option>
									@foreach ($architectList as $architect)
										<option value="{{$architect->id }}">{{$architect->firstName.' '.$architect->lastName }}</option>
									@endforeach
								</select>
								<label for="form_control_1" style="top:-4px !important">Client</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control  select2me" name="architectName" data-placeholder="Select">
									<option value=""></option>
									
										<option value="PT Arsitek Indah">PT Arsitek Indah</option>
										<option value="PT Rancangan Karya">PT Rancangan Karya</option>
									
								</select>
								<label for="form_control_1" style="top:-4px !important">Architect</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<!--<input type="text" class="form-control" name="projectStructure" value="{{old('projectStructure')}}">-->
								<select class="form-control  select2me" name="structureName" data-placeholder="Select Structure">
									<option value=""></option>
									@foreach ($architectList as $architect)
										<option value="{{$architect->id }}" {{ (old("structureName") == $architect->id ? "selected":"") }}>{{$architect->firstName.' '.$architect->lastName }}</option>
									@endforeach
								</select>
								<label for="form_control_1" style="top:-4px !important">Structure</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control  select2me"  name="mepName" data-placeholder="Select Client">
									<option value=""></option>
									@foreach ($architectList as $architect)
										<option value="{{$architect->id }}" {{ (old("mepName") == $architect->id ? "selected":"") }}>{{$architect->firstName.' '.$architect->lastName }}</option>
									@endforeach
								</select>
								<label for="form_control_1" style="top:-4px !important">MEP</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control  select2me" name="qsName"  data-placeholder="Select Client">
									<option value=""></option>
									@foreach ($architectList as $architect)
										<option value="{{$architect->id }}" {{ (old("qsName") == $architect->id ? "selected":"") }}>{{$architect->firstName.' '.$architect->lastName }}</option>
									@endforeach
								</select>
								<label for="form_control_1" style="top:-4px !important">QS</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control  select2me" name="contractorName"  data-placeholder="Select Client">
									<option value=""></option>
									@foreach ($architectList as $architect)
										<option value="{{$architect->id }}" {{ (old("contractorName") == $architect->id ? "selected":"") }}>{{$architect->firstName.' '.$architect->lastName }}</option>
									@endforeach
								</select>
								<label for="form_control_1" style="top:-4px !important">Main Contractor</label>
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