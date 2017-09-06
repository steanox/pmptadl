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
						<a href="{{url('/')}}">Home</a>
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
								<span class="caption-subject bold uppercase">Library Information</span>
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
						<form  role="form" method="POST" action="{{ route('saveLibrary', Request::segment(2)) }}" enctype="multipart/form-data" >
						{{ csrf_field() }}

							<div class="form-group form-md-line-input ">
								<input class="form-control" id="fileupload" type="file" name="fileupload"  >
								<div id="progress">
								    <div class="bar" style="width: 0%;"></div>
								</div>
							</div>

							<div class="form-group form-md-line-input ">
								<label for="form_control_1">Associated Projects</label>
								<input type="hidden" id="assign-user-id">
								<textarea id="associated-projects" name="associatedProjects" style="width:100%" rows="3"></textarea>
								<span class="help-block" style="opacity:1">You can input multiple username by type it then press enter / click</span>
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
<script src="https://cdn.rawgit.com/LeaVerou/awesomplete/gh-pages/awesomplete.min.js"></script>
<script>
	var data = [];
	window.addEventListener("awesomplete-selectcomplete",function(data){
			console.log(data)
		});
	var ajax = new XMLHttpRequest();
	ajax.open("GET", window.location.origin+"/ajax/getAllProject", true);
	ajax.onload = function() {
		var list = JSON.parse(ajax.responseText).map(function(i) { 
			// var obj = {
			// 	label: i.name,
			// 	value: i.id
			// };
			return i.projectName; 
		});

		new Awesomplete(document.querySelector("#associated-projects"),{ 
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
</script>
@endsection