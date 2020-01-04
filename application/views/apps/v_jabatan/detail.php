<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data Master Bidang</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Data Master Bidang</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php

$id_jabatan = "";
$nama_jabatan = "";

if($form=="edit"){
	foreach ($sql1->result() as $row1) {
		$id_jabatan = $row1->id_jabatan;
		$nama_jabatan = $row1->nama_jabatan;
	}
}
?>
<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_jabatan/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="jabatan_form" name="form3" method="POST" action="#">
					<input type="hidden" name="op" value="<?php echo $op; ?>">
					<table class="table table-condensed table-striped table-line">
						<tr>
							<td>ID Bidang</td>
							<td><?php echo $id_jabatan;?></td>
						</tr>
						<tr>
							<td>Nama Bidang</td>
							<td><?php echo $nama_jabatan;?></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</section>