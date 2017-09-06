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
						<a href="{{Request::url()}}/add-new-todo" class="btn red">+ New Todo list</a>
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
										 Date
									</th>
									<th>
										Status
									</th>
									
									<th>
										 Due Date
									</th>
									<th>
										 Title
									</th>
									<th>
										 action
									</th>
								</tr>
							</thead>
							<tbody>

							@foreach($todos as $todo)
								<tr class="odd gradeX">
									<td>
										{{ $loop->iteration }}
									</td>
									<td>
										 {{ $todo->date }}
									</td>
									<td>
									@php
										$dueDate = new Carbon\Carbon($todo->dueDate)
									@endphp
									@if($dueDate->isPast() && $todo->status != 'Done')
										Outdated
									@else
									{{ $todo->status }}
									@endif
									</td>
									<td>
										 {{ $todo->dueDate }}
									</td>
									<td>
										{{ $todo->title }}
									</td>

									<td>
										<form action="{{ route('updateTodo', $todo->id) }}" method="POST">
											{{ csrf_field() }}
											{{ method_field('PUT') }}
											<button type="submit" class="btn red">Done</button>
										</form>
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