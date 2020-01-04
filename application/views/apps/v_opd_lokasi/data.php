<?php
$tot=0;
foreach ($sql1->result() as $obj1){	
	if($offset==""){$offset=0;}
	$offset++;
	$tot++;
	?>
	<tr>
		<td class="text-center"><?php echo $offset; ?></td>
		<td class="text-center" width="150">
			<?php 
			if($access_view){
				?><a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/c_opd_lokasi/detail?id_opd_lokasi=<?php echo $obj1->id_opd_lokasi;?>')" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> lihat</a> <?php
			}
			if($access_edit){
				?><a href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/c_opd_lokasi/edit?id_opd_lokasi=<?php echo $obj1->id_opd_lokasi;?>')" class="btn btn-warning btn-sm"><span class="fa fa-edit"></span> ubah</a><?php
			}
			?>
		</td>
		<td><?php echo $obj1->id_opd_lokasi; ?></td>
		<td><?php echo $obj1->nama_lokasi; ?></td>
		<td>
			<p class="text-center">
				<input type="checkbox" id="pilih" name="pilih[]" value="<?php echo $obj1->id_opd_lokasi;?>">
			</p>
		</td>
	</tr>
	<?php
}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">