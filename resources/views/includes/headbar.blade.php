<!-- BEGIN HEADER -->

<div class="page-header navbar navbar-fixed-top">

	<!-- BEGIN HEADER INNER -->

	<div class="page-header-inner">

		<!-- BEGIN LOGO -->

		<div class="page-logo">

			<a href="index.html">

			<img src="https://dummyimage.com/100x20/000/fff" alt="logo" class="logo-default"/>

			</a>

			<div class="menu-toggler sidebar-toggler hide">

				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->

			</div>

		</div>



		<!-- END LOGO -->



		

		<!-- BEGIN RESPONSIVE MENU TOGGLER -->

		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">

		</a>

		<!-- END RESPONSIVE MENU TOGGLER -->

		<!-- BEGIN TOP NAVIGATION MENU -->

		<div class="top-menu">

			

			<ul class="nav navbar-nav pull-right">

				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

				<li class="dropdown dropdown-user">

					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

					<img alt="" class="img-circle" src="{{asset('img/avatar3_small.jpg')}}"/>

					<span class="username username-hide-on-mobile">

					{{Auth::user()->name}}</span>

					<i class="fa fa-angle-down"></i>

					</a>

					<ul class="dropdown-menu dropdown-menu-default">

						<li>

							<a href="extra_profile.html">

							<i class="icon-user"></i> My Profile </a>

						</li>

						<li>

							<a href="inbox.html">

							<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">

							3 </span>

							</a>

						</li>

						<li class="divider">

						</li>

						<li>

							   <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

							<i class="icon-key"></i> Log Out </a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
						</li>

					</ul>

				</li>

				<!-- END USER LOGIN DROPDOWN -->

				<!-- BEGIN QUICK SIDEBAR TOGGLER -->

				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

				<li class="dropdown dropdown-quick-sidebar-toggler">

					<a href="javascript:;" class="dropdown-toggle">

					<i class="icon-logout"></i>

					</a>

				</li>

				<!-- END QUICK SIDEBAR TOGGLER -->

			</ul>

		</div>

		<!-- END TOP NAVIGATION MENU -->

	

	</div>

	<!-- END HEADER INNER -->

</div>

<!-- END HEADER -->