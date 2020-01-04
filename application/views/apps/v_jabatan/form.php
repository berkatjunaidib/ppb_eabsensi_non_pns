<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data ODP jabatan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Data ODP jabatan</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<?php

$id_jabatan= "";
$nama_jabatan= "";
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
				<form id="jabatan_form" name="form3" method="POST" action="#" enctype="MULTIPART/FORM-DATA">
					<input type="hidden" name="op" value="<?php echo $op; ?>">
					<table class="table table-condensed">
						<tr>
							<td>id_jabatan</td>
							<td><input type="text" name="id_jabatan" class='form-control' value="<?php echo $id_jabatan; ?>" readonly="1"></td>
						</tr>
						<tr>
							<td>nama_jabatan</td>
							<td><input type="text" name="nama_jabatan" class='form-control' value="<?php echo $nama_jabatan; ?>"></td>
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
		window.open("<?php echo base_url();?>apps/c_jabatan/koordinat/?koordinat="+koordinat,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=1250,height=600,left=10,top=10");
	}

	function refreshFromPopup(koordinat){
		$("#koordinat").val(koordinat);	
	}
	$("#jabatan_form").submit(function(){
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