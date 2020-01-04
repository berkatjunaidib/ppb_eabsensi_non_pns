<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="small-box" style="background-color: #999;color: #fff">
					<div class="inner">
						<h3><?php echo ($jumlah_lokasi[0]->jlh_lokasi)?> </h3>
						<p>LOKASI ABSEN </p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?php echo ($jumlah_opd)?> </h3>
						<p>OPD</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
