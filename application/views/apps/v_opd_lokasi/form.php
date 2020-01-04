<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data ODP Lokasi</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Data ODP Lokasi</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php

$id_opd_lokasi= "";
$nama_lokasi= "";
$koordinat= "";
if($form=="edit"){
	foreach ($sql1->result() as $row1) {
		$id_opd_lokasi = $row1->id_opd_lokasi;
		$nama_lokasi = $row1->nama_lokasi;
		$koordinat = $row1->koordinat;
	}
}
?>
<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_opd_lokasi/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="opd_lokasi_form" name="form3" method="POST" action="#" enctype="MULTIPART/FORM-DATA">
					<input type="hidden" name="op" value="<?php echo $op; ?>">
					<table class="table table-condensed">
						<tr>
							<td>id_opd_lokasi</td>
							<td><input type="text" name="id_opd_lokasi" class='form-control' value="<?php echo $id_opd_lokasi; ?>" readonly="1"></td>
						</tr>
						<tr>
							<td>nama_lokasi</td>
							<td><input type="text" name="nama_lokasi" class='form-control' value="<?php echo $nama_lokasi; ?>"></td>
						</tr>
						<tr>
							<td>koordinat</td>
							<td>
								<div class="input-group mb-3">
									<textarea rows="5" class="form-control" name="koordinat" id="koordinat"><?php echo $koordinat; ?></textarea>
									<div class="input-group-button">
										<a href="javascript:get_koordinat('<?php echo $koordinat; ?>');" class="btn btn-info">Ambil koordinat</a>
									</div>
								</div>
							</td>
						</tr>
					</table>
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
		window.open("<?php echo base_url();?>apps/c_opd_lokasi/koordinat/?koordinat="+koordinat,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=1250,height=600,left=10,top=10");
	}

	function refreshFromPopup(koordinat){
		$("#koordinat").val(koordinat);	
	}
	$("#opd_lokasi_form").submit(function(){
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