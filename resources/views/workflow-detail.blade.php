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
				
			<div class="row grid-header">
				<ul class="grid-list">
					<li class="col-md-1 col-xs-1">Stage</li>
					<li class="col-md-1 col-xs-1">Status</li>
					<li class="col-md-2 col-xs-2">Discipline</li>
					<li class="col-md-2 col-xs-2">Date Issued</li>
					<li class="col-md-3 col-xs-3">Last Update</li>
					<li class="col-md-3 col-xs-3"></li>
				</ul>
			</div>
			<div class="row grid-content">
				<div class="accordion " id="accordion1">
					<a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion1" href="#collapse_1">
						<ul class="grid-list">
							<li class="col-md-1 col-xs-1">
							<b>1</b>
							</li>
							<li class="col-md-1 col-xs-1">
							<span class="label label-sm label-success ">
							Done
							</span>
							</li>
							<li class="col-md-2 col-xs-2">
								Workflow 1
							</li>
							<li class="col-md-2 col-xs-2">
								12-5-17 3:22
							</li>
							<li class="col-md-3 col-xs-3">12-7-17 13:22 By <a href="#">Hanna Kusnadi</a></li>
							<li class="col-md-3 col-xs-3" style="position:relative;bottom:5px;">
						
								<a class="btn-icon-only blue tooltips" data-container="body" data-placement="right" data-original-title="Download" onclick="alert('download file')"><i class="icon-cloud-download"></i></a>
								<a class="btn-icon-only red tooltips" data-container="body" data-placement="right" data-original-title="Upload" onclick="alert('Upload file')"><i class="icon-cloud-upload"></i></a>
								<a class="btn-icon-only green tooltips" data-container="body" data-placement="right" data-original-title="Approve" onclick="alert('approved file')"><i class="fa  fa-check"></i></a>
								
							</li>
						</ul>
					</a>
				</div>
				<div id="collapse_1" class="panel-collapse collapse">
					<div class="col-md-4 col-xs-12">
						<div class="row">
							<h5>Ref Number:123-123-123</h5>
							other detail
						</div>
					</div>
					<div class="col-md-4 col-xs-12">
						<h3>Insert Comment</h3>
						<textarea class="form-control todo-taskbody-taskdesc" rows="8" placeholder="Comment Description..."></textarea>
						<a class="btn blue">Submit</a>
					</div>
					<div class="col-md-4 col-xs-12">
						<h3>Comment</h3>
						<div class="comment-section">
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Agung<span class="pull-right" style="font-size:9px">21 Sep 2014 13:20</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Sandra<span class="pull-right" style="font-size:9px">18 Sep 2014 3:25</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Dewi<span class="pull-right" style="font-size:9px">9 Sep 2014 13:20</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Dewi<span class="pull-right" style="font-size:9px">9 Sep 2014 13:20</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
						</div>			
					</div>
				</div>
			</div>

			<div class="row grid-content" style="margin-bottom:20px">
				<div class="accordion " id="accordion1">
					<a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion2" href="#collapse_2">
						<ul class="grid-list">
							<li class="col-md-1 col-xs-1">
							2
							</li>
							<li class="col-md-1 col-xs-1">
							<span class="label label-sm label-success ">
							Done
							</span>
							</li>
							<li class="col-md-2 col-xs-2">
								Workflow 1
							</li>
							<li class="col-md-2 col-xs-2">
								12-5-17 3:22
							</li>
							<li class="col-md-3 col-xs-3">12-7-17 13:22 By <a href="#">Surya Alpha</a></li>
							<li class="col-md-3 col-xs-3" style="position:relative;bottom:5px;">
						
								<a class="btn-icon-only blue tooltips" data-container="body" data-placement="right" data-original-title="Download" onclick="alert('download file')"><i class="icon-cloud-download"></i></a>
								<a class="btn-icon-only red tooltips" data-container="body" data-placement="right" data-original-title="Upload" onclick="alert('Upload file')"><i class="icon-cloud-upload"></i></a>
								<a class="btn-icon-only green tooltips" data-container="body" data-placement="right" data-original-title="Approve" onclick="alert('approved file')"><i class="fa  fa-check"></i></a>
								
							</li>
						</ul>
					</a>
				</div>
				<div id="collapse_2" class="panel-collapse collapse">
					<div class="col-md-4 col-xs-12">
						<h5>Ref Number:123-123-123</h5>
						<p></p>
					</div>
					<div class="col-md-4 col-xs-12">
						<h3>Insert Comment</h3>
						<textarea class="form-control todo-taskbody-taskdesc" rows="8" placeholder="Comment Description..."></textarea>
						<a class="btn blue">Submit</a>
					</div>
					<div class="col-md-4 col-xs-12">
						<h3>Comment</h3>
						<div class="comment-section">
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Agung<span class="pull-right" style="font-size:9px">21 Sep 2014 13:20</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Sandra<span class="pull-right" style="font-size:9px">18 Sep 2014 3:25</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Dewi<span class="pull-right" style="font-size:9px">9 Sep 2014 13:20</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
							<div class="todo-tasklist-item todo-tasklist-item-border-green">
								<img class="todo-userpic pull-left" src="https://dummyimage.com/100x20/000/fff" width="27px" height="27px">
								<div class="todo-tasklist-item-title">
									 <p>Dewi<span class="pull-right" style="font-size:9px">9 Sep 2014 13:20</span></p>
								</div>
								<div class="todo-tasklist-item-text">
									 Lorem dolor sit amet ipsum dolor sit consectetuer dolore.
								</div>
							</div>
						</div>			
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('addjs')

@endsections