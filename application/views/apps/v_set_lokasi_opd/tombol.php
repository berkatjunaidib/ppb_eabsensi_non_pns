<div class="col-md-2">
	Lokasi
</div>
<div class="col-md-8">
	<select name="id_opd_lokasi" class="form-control form-control-sm">
		<?php
		foreach ($sql_lokasi->result() as $key => $value) {
			?>
			<option value="<?php echo $value->id_opd_lokasi;?>"><?php echo $value->id_opd_lokasi;?>-<?php echo $value->nama_lokasi;?></option>
			<?php
		}
		?>
	</select>
	
</div>
<div class="col-md-2 text-right">
	<?php 
	if($access_add){
		?><a href="javascript:proses_confirm()" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i> Simpan</a><?php
	}
	?>
</div>