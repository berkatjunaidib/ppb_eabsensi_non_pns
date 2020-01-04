<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo config_item('app_client1'); ?> | <?php echo config_item('app_client2'); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<link rel="shortcut icon" type="image/x-icon" href="//www.pakpakbharatkab.go.id/favicon.ico" />
	<link href="<?php echo base_url();?>assets/apps/login/semantic.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/apps/login/login.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url();?>assets/apps/login/jquery-2.1.4.min.js" lang="javascript"></script>
	<script src="<?php echo base_url();?>assets/apps/login/semantic.min.js" lang="javascript"></script>
	<script src="<?php echo base_url();?>assets/apps/login/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="<?php echo base_url();?>assets/apps/login/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="<?php echo base_url();?>assets/apps/login/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/apps/login/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/apps/login/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/apps/plugins/pace/pace.min.css">
</head>
<style type="text/css">
.box_shadow {
	width: 100px;
	height: 100px;
	margin: 100px;
	box-shadow:
	-52px -52px 0px 0px #f65314,
	52px -52px 0px 0px #7cbb00,
	-52px 52px 0px 0px #00a1f1,
	52px 52px 0px 0px #ffbb00;
}
</style>
</head>
<body>

		<div class="ui page grid">
		<div class="sixteen wide mobile two wide tablet two wide computer column"></div>
		<div class="sixteen wide mobile twelve wide tablet twelve wide computer column">
			<div class="ui segment">
				<div class="ui stackable two column grid">
					<div class="green center aligned column">
						<h2 class="ui blue inverted center aligned icon header">
							<img src="//www.pakpakbharatkab.go.id/imej/pakpaklogo.png" class="ui image">
							<div class="content">
								e-monev
								<div class="sub header" style="color: #fff;">
									(Elektornik Monitoring & evaluasi pembangunan)<br>
									<strong>Kab. Pakpak Bharat</strong><br>
									<strong>(V.2.1.0)</strong>
								</div>
							</div>
						</h2>
					</div>
					<div class="column">
						<a class="ui red right ribbon label">
							<h3>Login User</h3>
						</a>
						<div class="ui basic segment">
							<form action="#" method="post" id="form1" class="ui form">
								<div class="field">
									<label>email/Username</label>
									<div class="ui icon input">
										<input type="email" name="userName" placeholder="email" autocomplete="off" required="required" value="">
										
									</div>
								</div>
								<div class="field">
									<label>Password</label>
									<div class="ui icon input">
										<input type="password" name="userPassword" placeholder="Password" autocomplete="off" required="required" value="">
										
									</div>
								</div>
								<div class="inline field">
									<div class="ui checkbox">
										<input type="checkbox" name="remember_me">
										<label>Ingatkan saya</label>
									</div>
								</div>
								<div class="ui one column grid">
									<div class="right aligned column">
										<button type="submit" class="ui green small icon labeled button">Login</button>
									</div>
                                <!--
								<div class="column">
									<small><a href="http://sso.disdikkota.bandung.go.id/forgot"><i class="question icon"></i>Forgot Password</a></small>
								</div>
							-->
						</div>
						<div class="ui one column grid">
							<div id="info_login"></div>
						</div>
					<div id="reset_password"></div>
						
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="ui secondary right aligned segment">
		<!--<div align="left">
			<a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tentang">Tentang</a> <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#panduan">Panduan</a> <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#faq">FAQ</a> <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#kontak">Kontak</a>
		</div>-->
		<strong>© 2018 - Diskominfo</strong><br><small>Dinas Komunikasi dan Informatika Kab. Pakpak Bharat</small>
	</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="tentang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tentang Aplikasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				e-Tikela adalah aplikasi untuk mengetahui tingkat kepuasan layanan dari setiap OPD terhadap pengunjung.
			</div>
			<div class="modal-footer">
				---
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="panduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Panduan Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Untuk memulai aplikasi:<br>
				1. Pilih OPD<br>
				2. Masukkan Password<br>
				3. Klik <a>Login</a>
			</div>
			<div class="modal-footer">
				---
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="kontak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kontak</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<i class="fa fa-phone"> </i> (0627) 743047<br>
				<i class="fa fa-envelope"> </i> diskominfo@pakpakbharatkab.go.id<br>
				<i class="fa fa-globe"></i> <a href="http://diskominfo.pakpakbharatkab.go.id/" target="_blank">diskominfo.pakpakbharatkab.go.id</a><br>
				<i class="fa fa-twitter"></i> <a href="https://twitter.com/diskominfo_pb" target="_blank"> twitter/diskominfo_pb</a><br>
				<i class="fa fa-facebook"></i><a href="https://www.facebook.com/diskominfo.pakpakbharat/" target="_blank"> facebook.com/diskominfo.pakpakbharat/</a>
			</div>
			<div class="modal-footer">
				---
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="faq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">FAQ (Frequently Asked Questions)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<!--       =============   Membuat Collapse ========== -->
				<div id="accordion">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0">
								<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Bagaimana jika saya tidak bisa login?
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-body">
								Silahkan menghubungi user pada kontak yang disediakan
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h5 class="mb-0">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Satker/OPD tidak ada
								</button>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="card-body">
								Silahkan menghubungi user pada kontak yang disediakan untuk menambahkan OPD/Satker
							</div>
						</div>
					</div>
					<!--       =============  Akhir Membuat Collapse ========== -->
				</div>
				<div class="modal-footer">
					---
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Reset Password</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form id="form_reset">
						<input type="email" name="email" id="email" class="form-control input-sm" required="required" placeholder="Email">
						<div class="t4_cek_em"></div>
						<input type="submit" class="btn btn-primary btn-sm btn-block" value="Reset">
						<p class="page_info2 text-center text-success"><?php echo @$error; ?></p>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/apps/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/apps/plugins/ckeditor/ckeditor.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	 --><!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url(); ?>assets/apps/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Morris.js charts -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	 --><script src="<?php echo base_url(); ?>assets/apps/plugins/morris/morris.min.js"></script>
	<!-- jquery-ui -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/apps/plugins/jquery-ui/1103/jquery-ui.css"/>
	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>assets/apps/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/apps/dist/js/adminlte.js"></script>

	<script src="<?php echo base_url(); ?>assets/apps/dist/js/demo.js"></script>

	<script src="<?php echo base_url(); ?>assets/apps/plugins/jquery.price_format/jquery.price_format.2.0.js"></script>
	<script src="<?php echo base_url(); ?>assets/apps/plugins/back-to-top/back-to-top.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/apps/plugins/pace/css/flash.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/plugins/pace/js/pace.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/apps/plugins/notify/notify.min.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/apps/plugins/notify/notify.min.js"></script>

	<script type="text/javascript">
		var klik = 0;
		$("#form1").submit(function(){
			$("#reset_password").html("");
			if($("#userName").val()==""){
				$("#userName").focus();
			}
			else if($("#userPassword").val()==""){
				$("#userPassword").focus();
			}else{
				$(".page_info").addClass("text-info");
				$(".page_info").html("Loading...");
				$(".page_info").removeClass("text-success");
				$(".page_info").removeClass("text-warning");
				$(".page_info").removeClass("text-danger");
				var url_login = $("#url_login").val();
				var method = "<?php echo base_url();?>apps/login/proses";
				var string = $("#form1").serialize();
				$.ajax({
					url: method,
					type: "POST",
					data: string,
					success: function(e){
						var json = $.parseJSON(e);
						$(".page_info").addClass(json.type);
						$(".page_info").html(json.msg);
						if(json.status==1){
							window.location="<?php echo base_url()?>apps/home";
						}else{
							klik+=1;
							if(klik>0){
								$("#reset_password").html("<div class='alert alert-warning'>Anda ingin <a href='#' data-toggle='modal' data-target='#myModal'>Reset Password</a>?</div>");
							}
						}
					},
					error: function (jqXHR, exception) {
						var msg = getErrorMessage(jqXHR, exception);
						$(".page_info").addClass("text-info");
						$(".page_info").html(msg);
					}
				});
			}
			return false;
		});
		$("#form_reset").submit(function(){
			$(".page_info2").addClass("text-info");
			$(".page_info2").html('Loading...');
			$(".page_info2").removeClass("text-success");
			$(".page_info2").removeClass("text-danger");
			if($("#email").val()==""){
				$("#email").focus();
			}else{
				var method = "<?php echo base_url();?>apps/login/reset_password";
				var string = $("#form_reset").serialize();
				$.ajax({
					url: method,
					type: "POST",
					data: string,
					success: function(e){
						var json = $.parseJSON(e);
						$(".page_info2").addClass(json.type);
						$(".page_info2").html(json.msg);
					},
					error: function (jqXHR, exception) {
						var msg = getErrorMessage(jqXHR, exception);
						$(".page_info2").addClass("text-info");
						$(".page_info2").html(msg);
					}
				});
			}
			return false;
		});
		function getErrorMessage(jqXHR, exception) {
			var msg = '';
			if (jqXHR.status === 0) {
				msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
				msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
				msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
				msg = 'Time out error.';
			} else if (exception === 'abort') {
				msg = 'Ajax request aborted.';
			} else {
				msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			return msg;
		}
	</script>
</body>
</html>
