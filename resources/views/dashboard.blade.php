@extends('layout.app')



@section('content')

    <div class="page-content-wrapper">

		<div class="page-content">



			{{-- Title --}}

				<h3 class="page-title">

				{{title_case($title[0])}} <small>reports & statistics</small>

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
					

					<div class="input-group" style="width:300px;float:right;">

							<input type="text" class="form-control" placeholder="Search..." name="query">

							<span class="input-group-btn">

							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>

							</span>

					</div>

					</div>

			{{-- END TITLE --}}

			

			{{-- DASHBOARD Stats --}}

			<div class="row">

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat blue-madison">

						<div class="visual">

							<i class="fa fa-comments"></i>

						</div>

						<div class="details">

							<div class="number">

								 7

							</div>

							<div class="desc">

								My projects

							</div>

						</div>

						<a class="more" href="javascript:;">

						View more <i class="m-icon-swapright m-icon-white"></i>

						</a>

					</div>

				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat red-intense">

						<div class="visual">

							<i class="fa fa-bar-chart-o"></i>

						</div>

						<div class="details">

							<div class="number">

								 56

							</div>

							<div class="desc">

								 Active Users

							</div>

						</div>

						<a class="more" href="javascript:;">

						View more <i class="m-icon-swapright m-icon-white"></i>

						</a>

					</div>

				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

					<div class="dashboard-stat green-haze">

						<div class="visual">

							<i class="fa fa-shopping-cart"></i>

						</div>

						<div class="details">

							<div class="number">

								 109

							</div>

							<div class="desc">

								 Documents

							</div>

						</div>

						<a class="more" href="javascript:;">

						View more <i class="m-icon-swapright m-icon-white"></i>

						</a>

					</div>

				</div>

			</div>

			{{-- END DASHBOARD STATS --}}

		</div>

	</div>

@endsection