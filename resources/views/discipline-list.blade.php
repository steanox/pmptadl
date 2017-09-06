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
				<div class="page-toolbar">
						<a href="{{Request::url()}}/add-new-discipline" class="btn red">+ New Discpline</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>


								<th>
									 Discpline Name
								</th>
								<th>
									Initiator
								</th>
								
								<th>
									 Total User
								</th>
								<th>
									Configure
								</th>
							</tr>
							</thead>
							<tbody>

							@foreach($disciplines as $discipline)
								<tr class="odd gradeX">

									<td>{{$discipline->disciplineName}}</td>
									<td>
										<?php
											if ($discipline->initiatorName == null){
												echo "Not been assigned";
											}else{
												echo $discipline->initiatorName;
											}
										?>
									</td>
									<td>
										<?php
											$user = json_decode($discipline->userList);

											echo count($user);
										 ?>
									</td>
									<td>
										<button class="btn green">
											<i class="fa fa-gear"></i>
										</button>
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
@endsection

@section('addjs')
<script>
TableManaged.init();
</script>
@endsection