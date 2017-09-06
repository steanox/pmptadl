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



					<div class="page-toolbar">
					@if(Request::segment(2))
						<a href="{{Request::url()}}/add-new-library" class="btn blue">+ Upload Files</a>
					@else
					<a disabled="true" href="#" class="btn blue">+ Upload Files</a>
					@endif

					</div>

				</div>

			{{-- END TITLE --}}



			{{-- Content --}}
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

			<div class="portlet">

				<div class="portlet-body">

					<div class="row">

								{{-- Filter --}}

						<div class="col-md-3 col-sm-3 col-xs-12">

							<h3>Filter</h3>

									<div id="tree_1" class="tree-demo">

										<ul>

											<li>

												<a href="{{Request::url()}}">All Files</a>

											</li>

											<li data-jstree='{ "icon" : "fa fa-file-image-o icon-state-success " }'>

												<a href="{{Request::url()}}?q=image">Image</a>

											</li>

											<li data-jstree='{ "icon" : "fa fa-file icon-state-success " }'>
												<a href="{{Request::url()}}?q=document">Document</a>
											</li>

										</ul>

									</div>

									<div class="library-filter">

										<select class="form-control" id="form_control_!">

											<option>Category 1</option>

										</select>

									</div>

									<div class="library-filter">

										<select class="form-control" id="form_control_!">

											<option>Category 2</option>

										</select>

									</div>

									<div class="library-filter">

										<select class="form-control" id="form_control_!">

											<option>Category 3</option>

										</select>

									</div>

									<div class="library-filter">

										<select class="form-control" id="form_control_!">

											<option>Category 4</option>

										</select>

									</div>


						</div>



						<div class="col-md-9 col-sm-9 col-xs-12">


							<table class="table">
							    <thead>
							      <tr>
							        <th>File Name</th>
							        <th>Modified</th>
							        <th>Associated Projects</th>
							      </tr>
							    </thead>
							    <tbody>
							      

							      @if(isset($fileLists))
										@foreach($fileLists as $fileList)
										<tr>
											<td>
												<img src="https://dummyimage.com/30x30/000/fff" alt="logo"/>
												<a href="{{ url('/download-file/' . $fileList->id) }}">{{ $fileList->fileName }}</a>
											

											</td>

											<td>{{ $fileList->created_at }}</li>

											<td>@foreach($fileList->projects as $project)
												{{ $project->projectName }}
												@if (!$loop->last)
												,
												@endif
											@endforeach
											</td>
										</tr>
										@endforeach
									@else 
									<tr>
										<td class="text-center" colspan="3">
										Data Not Available
										</td>
									</tr>
									@endif
							    </tbody>
						  	</table>


							<div class="progress" style="margin-top: 20px">
								<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
							
							</div>

							@if(isset($fileLists))
								{{ $fileLists->links() }}
							@endif

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
TableManaged.init();

</script>
@endsection