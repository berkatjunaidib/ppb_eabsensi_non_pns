<?php 
$type = $arrMsg['type'];
$color = $arrMsg['color'];
$caption = $arrMsg['caption'];
$title = $arrMsg['title'];
$message = $arrMsg['message'];
$info = $arrMsg['info'];
$url = $arrMsg['url'];
$url_print = $arrMsg['url_print'];
?>
<br>
<br>
<br>
<div class="row justify-content-md-center">
	<div class="col-4">
		<div class="card text-center <?php echo $color; ?>">
			<div class="card-header">
				<h3 class="card-title">I N F O R M A S I !!!</h3>
			</div>
			<div class="card-body">
				<h5><?php echo $caption; ?></h5>
				<p><?php echo $message; ?></p>
				<p><?php echo $info; ?> !!!</p>
				<?php
				if(!empty($url_print)){
					?><a href="<?php echo base_url(); ?>apps/c_lap_surat/downlod_surat_pdf/<?php echo $url_print; ?>" target="_blank" class="btn btn-warning"><i class="fa fa-download"></i> Download Surat</a><?php
				}
				?>
				<a class="btn btn-info" href="javascript:eksekusi_get('<?php echo base_url(); ?><?php echo $url; ?>')"><i class="fa fa-angle-double-right"></i> Lanjut</a>
			</div>
			<div class="card-footer <?php echo $color; ?>">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function cetakSlip(url_print){
		var url_print = "<?php echo base_url(); ?>apps/c_lap_surat/downlod_surat_pdf/?"+url_print;
		window.opener=self;
		window.open(url_print,"","resizable=no,toolbar=no,menubar=no,scrollBars=yes,directories=no,location=no,status=no,width=1024,height=512,left=50,top=50");
	}
</script>