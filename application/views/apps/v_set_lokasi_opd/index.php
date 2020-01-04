<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data set_lokasi_opd</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Data set_lokasi_opd</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_set_lokasi_opd/tab'); ?>
		<div class="card card-info card-outline">
			<div class="card-body">
				<form id="index2" class="form-search" name="form2" onsubmit="func_view();return false;">
					<input type="hidden" name="page">
					<input type="hidden" name="sidx">
					<input type="hidden" name="sord">
					<input type="hidden" name="limit">
					<table class="table tablecondensed">
						<tr>
							<th width="150">Item</th>
							<th>Value</th>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>
								<input type="text" name="tanggal" class="form-control tanggal" id="tanggal" value="<?php echo date("d-m-Y");?>" readonly="1">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<a href="javascript:func_refresh()" class="btn btn-sm btn-primary">reset</a>
								<a href="javascript:func_tampil()" class="btn btn-sm btn-primary">tampilkan</a>
							</td>
						</tr>
					</table>
				</form>
				<form id="index1" name="form1">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th class="span1 text-center">
										<input type="checkbox" name="btncheck" value="checkall" onclick="func_checkall()">
									</th>
									<th class="span1 text-center">no</th>
									<th class="span1" style="cursor: pointer;" onclick="func_sidx('ID_OPD')" id="ID_OPD">ID_OPD<span id="ID_OPD_sort" class="sort"></span></th>
									<th class="span1" style="cursor: pointer;" onclick="func_sidx('OPD')" id="OPD">OPD<span id="OPD_sort" class="sort"></span></th>
								</tr>
							</thead>
							<tbody id="view_data">
							</tbody>
						</table>
					</div>
					<div class="row">
						<?php $this->load->view('apps/v_set_lokasi_opd/tombol'); ?>
					</div>

				</form>
				<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Modal Label" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
							</div>
							<div class="modal-footer">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	var main = "<?php echo base_url(); ?>apps/c_set_lokasi_opd/views?mod=v";
	var row = "<?php echo base_url(); ?>apps/c_set_lokasi_opd/views";
	//func_view();

	function func_tampil(){
		Pace.restart();
		//alert('s');
		$("#view_data").html(loading_tabel);
		$("#total_row").val("load...");
		var string = $("#index2").serialize();
		$.ajax({
			type	: 'POST',
			url		: main,
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_data").html(data);
			}
		});
	}
	function func_refresh(){
		eksekusi_get('<?php echo base_url(); ?>apps/c_set_lokasi_opd');
	}
	function proses_confirm(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/c_set_lokasi_opd/";
			var form_op = "proses";
			var string = $("#index1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
	}
	$('#OPD').autocomplete({
		source: function(request, response) {
			$.getJSON("<?php echo base_url().'apps/c_set_lokasi_opd/set_lokasi_opd_auto';?>",{term: request.term},response);
		},
		minLength:1,	
		select: function(event,ui){
			$("#ID_OPD").val(ui.item.ID_OPD);
		}
	});

	function func_checkall() {
		var cbtotal = document.form1.cbtotal.value;
		if (cbtotal>0){
			if (cbtotal==1){
				if(document.form1.btncheck.checked == true){
					document.form1.pilih.checked = true;
				}
				else{
					document.form1.pilih.checked = false;
				}
			}
			else{
				for(var i=0;i<document.form1.pilih.length;i++){
					if(document.form1.btncheck.checked == true){
						document.form1.pilih[i].checked = true;
					}
					else{
						document.form1.pilih[i].checked = false;
					}
				}
			}
		}
	}


</script>
