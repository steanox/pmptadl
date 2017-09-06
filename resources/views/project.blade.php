@extends('layout.app')



@section('content')

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

					<div class="preview-type">
					<ul>
						<li>
							
								<i class="fa fa-list-ul">
								</i>
							
						</li>
						<li>
							
								<i class="fa fa-th">
								</i>
							
						</li>
					</ul>
					</div>

					<div class="page-toolbar">

						<a href="{{Request::url()}}/add-new-project" class="btn red">+ New Project</a>

						<a href="{{Request::url()}}/add-new-user" class="btn blue">+ New User</a>

					</div>

				</div>

			{{-- END TITLE --}}



			{{-- Content --}}

			<div class="portlet">

						

						<div class="portlet-body">

							<div class="row">

								{{-- Filter --}}

								<div class="col-md-3 col-sm-3 col-xs-12">

									<h3>Filter</h3>

									<div id="tree_1" class="tree-demo">

										<ul>

											<li>

												Category

												<ul>

													<li data-jstree='{ "selected" : true,"icon" : "fa fa-home icon-state-success " }'>

														<a href="javascript:;">

														Residential </a>

													</li>

													<li data-jstree='{ "icon" : "fa fa-briefcase icon-state-success " }'>

														 Office

													</li>

												</ul>

											</li>

										</ul>

									</div>

								</div>

								{{-- tables --}}

								<div class="col-md-9 col-sm-9 col-xs-12">

									<div class="tab-content">

										<table class="table table-hover">

											<thead>

												<tr>

													<th>Project Name</th>

													<th>Category</th>

													<th>Last Modified</th>

													<th>Author</th>

												</tr>

											</thead>

											<tbody>
												@foreach ($projects as $project)
												<tr>

													<td><a href="project/{{$project->projectName}}">{{$project->projectName}}</a></td>

													<td>{{$project->category->name}}</td>

													<td>{{$project->updated_at}}</td>

													<td>
													@php 
														$author = json_decode($project->createdBy);
														print_r($author->name);
													@endphp
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

	</div>

	

@endsection



@section('addjs')

<script>

UITree.init();

</script>

@endsection





