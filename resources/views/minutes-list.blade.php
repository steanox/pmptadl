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
						<a href="{{Request::url()}}/add-new-minutes" class="btn red">+ New Minutes</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th>
									
								</th>
								<th>
									 Minutes Name
								</th>
								<th>
									Document
								</th>
								
								<th>
									 Noted by
								</th>
								<th>
									 Progress
								</th>
								<th>
									 Distribution
								</th>
								<th>
									 Remarks
								</th>
								<th>
									 action
								</th>
							</tr>
							</thead>
							<tbody>
							<!-- <tr class="odd gradeX">
								<td>
									1
								</td>
								<td>
									 Meeting Pancar kreasi
								</td>
								<td>
									<a href="#" onclick="alert('download this file')">
									MOM-270817.docs</a>
								</td>
								<td>
									 Sabrina L.
								</td>
								<td >
									<small style="position:relative;bottom:4px">
									40% Complete
									</small> 
									<div class="progress progress-striped active">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
									</div>
									</div>
									
								</td>
								<td>
									<a onclick="alert('Go to agung profile')">
									Agung </a>,
									<a onclick="alert('Go to desmons profile')">
									Desmon </a>
								</td>
								<td >
									<a onclick="alert('Go to jaka profile')">
									Jaka </a>
								</td>
								<td>
									<a href="{{Request::url('')}}/meeting-pancar-kreasi"><button type="button" class="btn red">Detail</button></a>
								</td>
								
							</tr> -->

							@foreach($minutes as $minute)
								<tr class="odd gradeX">
									<td>
										{{ $loop->iteration }}
									</td>
									<td>
										 {{ $minute->name }}
									</td>
									<td>
										<a href="{{ $minute->documentPath }}" target="_blank">
										{{ str_limit($minute->document, $limit = 10, $end = '...') }}</a>
									</td>
									<td>
										 {{ $minute->notedby }}
									</td>
									<td>
										@php
											$total = $minute->todos->count();
											if($total == 0)
												$percent = 0;
											else
											{
												$countDone = $minute->todos->where('status', 'Done')->count();
												$percent = ($countDone/$total) * 100;
											}
										@endphp
										
										<small style="position:relative;bottom:4px">
										{{ $percent }}% Complete
										</small> 
										<div class="progress progress-striped active">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent  }}%">
										</div>
										</div>
										
									</td>
									<td>
										@foreach($minute->users as $user)
										<a onclick="alert('Go to {{ $user->name }} profile')">
										{{ $user->name }} </a>
											@if (!$loop->last)
											,
											@endif
										@endforeach
										<!-- <a onclick="alert('Go to agung profile')">
										Agung </a>,
										<a onclick="alert('Go to desmons profile')">
										Desmon </a> -->
									</td>
									<td >
										<a onclick="alert('Go to {{ $minute->remark->name }} profile')">
										{{ $minute->remark->name }} </a>

									</td>
									<td>
										<a href="{{Request::url('').'/'.$minute->id}}"><button type="button" class="btn red">Detail</button></a>
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