@extends('layout.app')



@section('content')

	<style>
		.title__menu{
			font-size: 100% !important
		}
	</style>

 	<div class="page-content-wrapper">

		<div class="page-content">



			{{-- Title --}}

				<h3 class="page-title">

				{{title_case($title[0])}} <small></small>

				</h3>

				<div class="page-bar">

					<ul class="page-breadcrumb">

						<li>

							<i class="fa fa-home"></i>

							<a href="index.html">Home</a>

						</li>

						@foreach ($title as $title)

						<li>

							<i class="fa fa-angle-right"></i>

							<a href="#">{{title_case($title)}}</a>

						</li>

						@endforeach

					</ul>

				</div>

			{{-- END TITLE --}}

		



			{{-- Project Detail menu --}}

			<div class="row col-md-12 ">

					<ul class="menu-container">

						<a href="{{Request::url()}}/discipline-list"><li class="project-menu">

							<p><i class="fa fa-recycle" aria-hidden="true"></i></p>

							<p><small class="title__menu">Manage<br>Workflow</small></p>

						</li></a>

						<a href="{{Request::url()}}/document-management/{{$disciplineID}}"><li class="project-menu">

							<p><i class="fa fa-file-text-o" aria-hidden="true"></i></p>

							<p><small class="title__menu">Document<br>Management</small></p>

						</li></a>

						<a href="{{Request::url()}}/minutes-list"><li class="project-menu">

							<p><i class="fa fa-comment-o" aria-hidden="true"></i></p>

							<p><small class="title__menu">Minutes<br>Of Meeting</small></p>

						</li></a>

						<a href="{{Request::url()}}/file-transfer"><li class="project-menu">

							<p><i class="fa fa-exchange" aria-hidden="true"></i></p>

							<p><small class="title__menu">File<br>Transfer</small></p>

						</li></a>
						@if (Auth::user()->userType == "super")
						<a href="{{Request::url()}}/assign-user"><li class="project-menu">

							<p><i class="fa fa-user" aria-hidden="true"></i></p>

							<p><small class="title__menu">Assign<br>User</small></p>

						</li></a>
						@endif
						<a href="{{Request::url()}}/view-library"><li class="project-menu">

							<p><i class="fa fa-book" aria-hidden="true"></i></p>

							<p><small class="title__menu">View<br>Library</small></p>

						</li></a>

						<a href="{{Request::url()}}/view-reports"><li class="project-menu">

							<p><i class="fa fa-area-chart" aria-hidden="true"></i></p>

							<p><small class="title__menu">View<br>Reports</small></p>

						</li></a>



					</ul>

				</div>



				{{-- Project detail --}}

				<div class="row">

					<div class="col-md-9 col-xs-12" >

						<h2>{{title_case($title)}}</h2>

						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h4>

					</div>

					<div class="col-md-3 col-xs-12" id="project-detail">

						<h2>Project Info</h2>

						<h5>Architect: Joko widodo</h5>

						<h5>Structure: -</h5>

						<h5>Site Area: -</h5>

						<h5>GFA: -</h5>

						<h5>Teams:

							<ul id="team-list">

								<li>Joko Anwar</li>

								<li>Andy Zein</li>

							</ul>



						</h5>

					</div>

					

				</div>

		</div>

	</div>

@endsection	