<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Edit Profil</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Edit Profil</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/c_edit_profil')">Edit Profil</a></li>
		</ul>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form name="form2" id="form2" action="#" method="POST">
					<div class="table-responsive">
						<table class="table table-line">
							<thead>
								<tr>
									<th colspan="2">Ubah password</th>
								</tr>
							</thead>
							<tr>
								<td class="span3">Username</td>
								<td><?php echo $this->session->userdata('arrayLogin')['nip'] ?></td>
							</tr>
							<tr>
								<td>Nama Lengkap</td>
								<td><?php echo $this->session->userdata('arrayLogin')['nama_pegawai'] ?></td>
							</tr>
							<tr>
								<td>Password Lama</td>
								<td><input type="password" name="pass_lama" class="form-control" id="pass_lama"></td>
							</tr>
							<tr>
								<td>Password Baru</td>
								<td><input type="password" name="pass_baru" class="form-control" id="pass_baru"></td>
							</tr>
							<tr>
								<td>Ulang Password Baru</td>
								<td><input type="password" name="ulang_pass_baru" class="form-control" id="ulang_pass_baru"></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button type="submit" class="btn btn-info btn-block">Ubah password</button> 
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script language="JavaScript">
	$("#form1").submit(function(){
		if(confirm('Apakah Anda Yakin Mengubah Profil Desa ??')){
			var method = "<?php echo base_url();?>apps/c_edit_profil/";
			var form_op = "update_desa";
			var string = $("#form1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});

	$("#form2").submit(function(){
		var pass_lama = $("#pass_lama").val();
		var pass_baru = $("#pass_baru").val();
		var ulang_pass_baru = $("#ulang_pass_baru").val();

		if(pass_lama==""){
			$("#pass_lama").focus();
			return false;
		}
		if(pass_baru==""){
			$("#pass_baru").focus();
			return false;
		}
		if(ulang_pass_baru==""){
			$("#ulang_pass_baru").focus();
			return false;
		}
		if(confirm('Apakah Anda Yakin Mengubah Password ??')){
			var method = "<?php echo base_url();?>apps/c_edit_profil/";
			var form_op = "update";
			var string = $("#form2").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});
</script>