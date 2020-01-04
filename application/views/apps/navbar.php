<nav class="main-header navbar navbar-expand bg-info navbar-light border-bottom">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<span class="nav-link" style="color: #fff;">
			<?php echo config_item('app_name2'); ?>
			(<?php echo config_item('app_name1'); ?>)
			-<?php echo config_item('app_client2'); ?>
			</span>
		</li>
	</ul>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a  href="<?php echo base_url();?>apps/logout" class="nav-link">
				<i class="fa fa-sign-out-alt"></i> Logout
			</a>
		</li>
	</ul>
</nav>
