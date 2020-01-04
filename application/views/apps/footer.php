<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
	<strong>Copyright &copy; 2018-<?php echo date("Y");?> <a href="" target="_blank"><?php echo config_item('app_client2'); ?></a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 1.0.0
	</div>
</footer>


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/apps/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/apps/plugins/ckeditor/ckeditor.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/apps/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/apps/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 --><script src="<?php echo base_url(); ?>assets/apps/plugins/morris/morris.min.js"></script>
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

<?php  $this->load->view('apps/funtionjs'); ?>

<script type="text/javascript">
	$(document).ready(function($){
			/*$('#cssmenu > ul > li > a').click(function() {
				$('#cssmenu > ul > li').removeClass('menu-open');
				$('#cssmenu > ul > li > ul').css('display','none');
				var ID = $(this).attr("id");
				$('#MENU2-'+ID).fadeIn("slow");//'display','block');
				$('#MENU1-'+ID).addClass('menu-open');
				console.log(ID);
			});*/

			$('#cssmenu > ul > li > ul > li > a').click(function() {
				$('#cssmenu > ul > li > ul > li > a').removeClass('active');
				$(this).addClass('active');
			});
		});
	</script>
	<script>
		/*function notifyMe(judul,isi,controller) {
			if (Notification.permission !== "granted")
				Notification.requestPermission();
			else{
				var notification = new Notification(judul, {
					icon: 'https://www.pakpakbharatkab.go.id/imej/pakpaklogo.png',
					body: isi,
				});

				notification.onclick = function () {
					eksekusi_controller(controller);
				};
			}
		}*/
	</script>
</body>
</html>
