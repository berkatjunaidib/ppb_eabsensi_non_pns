<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Data jabatan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url();?>apps/home">Home</a></li>
					<li class="breadcrumb-item active">Data jabatan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<?php $this->load->view('apps/v_jabatan/tab'); ?>
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
							<td>Nama jabatan</td>
							<td>
								<input type="text" name="nama_jabatan" class="form-control" id="nama_jabatan">
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<a href="javascript:func_refresh()" class="btn btn-sm btn-primary">reset</a>
								<a href="javascript:func_view()" class="btn btn-sm btn-primary">tampilkan</a>
							</td>
						</tr>
					</table>
				</form>
				<form id="index1" name="form1">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th class="span1 text-center">no</th>
									<th class="span1 text-center" width="140">edit</th>
									<th class="span1" style="cursor: pointer;" onclick="func_sidx('id_jabatan')" id="id_jabatan">id_jabatan<span id="id_jabatan_sort" class="sort"></span></th>
									<th class="span1" style="cursor: pointer;" onclick="func_sidx('nama_jabatan')" id="nama_jabatan">nama_jabatan<span id="nama_jabatan_sort" class="sort"></span></th>
									<th class="span1 text-center">
										<input type="checkbox" name="btncheck" value="checkall" onclick="func_checkall()">
									</th>
								</tr>
							</thead>
							<tbody id="view_data">
							</tbody>
						</table>
					</div>
					<div class="row">
						<?php $this->load->view('apps/v_jabatan/tombol'); ?>
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
	var main = "<?php echo base_url(); ?>apps/c_jabatan/views?mod=v";
	var row = "<?php echo base_url(); ?>apps/c_jabatan/views";
	func_view();
	function func_refresh(){
		document.form2.nama_jabatan.value="";
		document.form2.page.value="";
		document.form2.sidx.value="";
		document.form2.sord.value="";
		document.form2.limit.value="";
		document.form1.limit.value="<?php echo config_item('displayperpage') ?>";
		$("#page").val(1);
		func_view();
	}
	function delete_confirm(){
		if(confirm("Apakah anda yakin?")){
			var method = "<?php echo base_url(); ?>apps/c_jabatan/";
			var form_op = "delete";
			var string = $("#index1").serialize();
			eksekusi_post_notif(method+form_op,string,function(){
				eksekusi_get(method);
			});
		}
	}
	$('#nama_jabatan').autocomplete({
				source: function(request, response) {
					$.getJSON("<?php echo base_url().'apps/c_jabatan/jabatan_auto';?>",{term: request.term},response);
				},
				minLength:1,	
				select: function(event,ui){
					$("#id_jabatan").val(ui.item.id_jabatan);
				}
			});
		</script>
