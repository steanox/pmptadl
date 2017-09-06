<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				
				<li class="<?php if($title == 'dashboard')echo 'active';?>">
					<a href="/dashboard">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					</a>
				</li>
				<li class="<?php if($title == 'project')echo 'active';?>">
					<a href="/project">
					<i class="icon-docs"></i>
					<span class="title">Project</span>
					</a>
				</li>
				<li class="<?php if($title == 'report')echo 'active';?>">
					<a href="javascript:;">
					<i class="icon-graph"></i>
					<span class="title">Report</span>
					</a>
				</li>
				<li class="<?php if($title == 'library')echo 'active';?>">
					<a href="/library">
					<i class="icon-folder"></i>
					<span class="title">Library</span>
					</a>
				</li>
				<li class="<?php if($title == 'contacts')echo 'active';?>">
					<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">Contacts</span>
					</a>
				</li>
				<li class="<?php if($title == 'help')echo 'active';?>">
					<a href="javascript:;">
					<i class="icon-direction"></i>
					<span class="title">Help</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
