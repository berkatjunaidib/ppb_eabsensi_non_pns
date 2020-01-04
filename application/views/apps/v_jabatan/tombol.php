<div class="col-md-3">
	<?php 
	if($access_add){
		?><a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/c_jabatan/add')" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a><?php
	}
	?>
</div>
<div class="col-md-6">
	<?php $this->load->view('apps/pager'); ?>
</div>
<div class="col-md-3 text-right">
	<?php 
	if($access_delete){
		?><a href="javascript:delete_confirm()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a><?php
	}
	?>
</div>