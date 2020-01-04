<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data ODP pegawai</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Data ODP pegawai</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php

$id_pegawai= "";
$nama_pegawai= "";
$id_opd_lokasi= "";
$id_jabatan= "";
if($form=="edit"){
	foreach ($sql1->result() as $row1) {
		$id_pegawai = $row1->id_pegawai;
		$nama_pegawai = $row1->nama_pegawai;
		$id_opd_lokasi = $row1->id_opd_lokasi;
		$id_jabatan = $row1->id_jabatan;
	}
}
?>
<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_pegawai/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="pegawai_form" name="form3" method="POST" action="#" enctype="MULTIPART/FORM-DATA">
					<input type="hidden" name="op" value="<?php echo $op; ?>">
					<div class="row">
						<div class="col-sm-2">id_pegawai</div>
						<div class="col-sm-10">
							<input type="text" name="id_pegawai" class='form-control' value="<?php echo $id_pegawai; ?>" readonly="1">
						</div>
						<div class="col-sm-2">nama_pegawai</div>
						<div class="col-sm-10">
							<input type="text" name="nama_pegawai" class='form-control' value="<?php echo $nama_pegawai; ?>">
						</div>
						<div class="col-sm-2">id_opd_lokasi</div>
						<div class="col-sm-10">
							<select name="id_opd_lokasi"  class="form-control" required="1">
								<?php
								$data_set['id_opd_lokasi'] ="";
								$data_set['nama_lokasi'] ="";
								$sql1 =  $this->m_opd_lokasi->views("","","","",$data_set);
								foreach ($sql1->result() as $key1 => $value1) {
									?><option <?php echo cek_select_option($value1->id_opd_lokasi,$id_opd_lokasi); ?> value="<?php echo $value1->id_opd_lokasi; ?>"><?php echo $value1->id_opd_lokasi." - ".$value1->nama_lokasi; ?></option><?php
								}
								?>
							</select>
						</div>
						<div class="col-sm-2">id_jabatan</div>
						<div class="col-sm-10">
							<select name="id_jabatan"  class="form-control" required="1">
								<?php
								$data_set['id_jabatan'] ="";
								$data_set['nama_jabatan'] ="";
								$sql1 =  $this->m_jabatan->views("","","","",$data_set);
								foreach ($sql1->result() as $key1 => $value1) {
									?><option <?php echo cek_select_option($value1->id_jabatan,$id_jabatan); ?> value="<?php echo $value1->id_jabatan; ?>"><?php echo $value1->id_jabatan." - ".$value1->nama_jabatan; ?></option><?php
								}
								?>
							</select>
						</div>
					</div>
					<br>
					<button class="btn btn-primary" id="save">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	function get_koordinat(koordinat){
		window.opener=self;
		window.open("<?php echo base_url();?>apps/c_pegawai/koordinat/?koordinat="+koordinat,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=1250,height=600,left=10,top=10");
	}

	function refreshFromPopup(koordinat){
		$("#koordinat").val(koordinat);	
	}
	$("#pegawai_form").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?><?php echo $url_link; ?>/";
			var form_op = "crud/<?php echo $form; ?>";

			$.ajax({
				url: method+form_op,
				type: "POST",
				contentType: false,
				processData:false,
				data:  new FormData(this),
				beforeSend: function(){
					eksekusi_loading();
				},
				success: function(e){
					var json = $.parseJSON(e);
					notify(json.tipe,json.msg);
					eksekusi_get(method);
				},
				error: function(){

				}           
			});
		}
		return false;
	})
</script>