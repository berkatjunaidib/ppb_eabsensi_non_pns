<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Daftar Pengguna</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Daftar Pengguna</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/a_v_user/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<?php 
				$userID="";
				$userName="";
				$realName="";
				$userSkpd="";
				$userGroup="";
				$userDescription="";
				if($form_op=="update"){
					foreach ($sql1->result() as $row1) {
						$userID=$row1->userID;
						$userName=$row1->userName;
						$realName=$row1->realName;
						$userSkpd=$row1->userSkpd;
						$userGroup=$row1->userGroup;
						$userStatus=$row1->userStatus;
						$userDescription=$row1->userDescription;
					}
				}
				?>
				<form id="form3" name="form3" method="POST" action="#">
					<input type="hidden" name="userID" value="<?php echo $userID; ?>" readonly>
					<table class="table table-condensed">
						<tr>
							<td>userName</td>
							<td colspan="2"><input type="text" name="userName" value="<?php echo $userName; ?>" class="form-control" <?php if($form_op=="update"){ echo "readonly='1'"; }?> required="1"></td>
						</tr>
						<tr>
							<td>realName</td>
							<td colspan="2"><input type="text" name="realName" value="<?php echo $realName; ?>" class="form-control" required="1"></td>
						</tr>
						<tr>
							<td>userOPD</td>
							<td colspan="2">
								<select name="userSkpd"  class="form-control" required="1">
									<option value=""></option>
									<?php
									$sql1 =  $this->m_skpds->views(tahun_anggaran());
									foreach ($sql1->result() as $key1 => $value1) {
										?><option <?php echo cek_select_option($value1->id_sikd_satker,$userSkpd); ?> value="<?php echo $value1->id_sikd_satker; ?>"><?php echo $value1->id_sikd_satker." - ".$value1->nama; ?></option><?php
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>userGroup</td>
							<td colspan="2">
								<select name="userGroup"  class="form-control" required="1">
									<option value=""></option>
									<?php
									$arrayGroup =  $this->m_parameter->getParameter('user.group');
									$i=0;
									foreach ($arrayGroup as $rowGroup) {
										$i++;
										if($i==1){
											if($_SESSION['arrayLogin']['userGroup']==1){
												?><option <?php echo cek_select_option($rowGroup['id'],$userGroup); ?> value="<?php echo $rowGroup['id']; ?>"><?php echo $rowGroup['id']." - ".$rowGroup['description']; ?></option><?php
											}
										}else{
											?><option <?php echo cek_select_option($rowGroup['id'],$userGroup); ?> value="<?php echo $rowGroup['id']; ?>"><?php echo $rowGroup['id']." - ".$rowGroup['description']; ?></option><?php
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>userDescription</td>
							<td colspan="2"><input type="text" name="userDescription" value="<?php echo $userDescription; ?>"  class="form-control" required="1"></td>
						</tr>
						<tr>
							<td>userStatus</td>
							<td colspan="2">
								<select name="userStatus"  class="form-control" required="1">
									<option value=""></option>
									<?php
									$arrayStatus =  $this->m_parameter->getParameter('user.status');
									foreach ($arrayStatus as $rowStatus) {
										?><option <?php echo cek_select_option($rowStatus['id'],$userStatus); ?> value="<?php echo $rowStatus['id']; ?>"><?php echo $rowStatus['id']." - ".$rowStatus['description']; ?></option><?php
									}
									?>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary btn-block">
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$("#form3").submit(function(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/a_c_user/";
			var form_op = "<?php echo $form_op; ?>";
			var string = $("#form3").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
		return false;
	});
</script>