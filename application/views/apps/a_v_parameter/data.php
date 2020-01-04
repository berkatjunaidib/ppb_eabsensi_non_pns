<?php
	$no=0;
	$tot=0;
	foreach ($sql1->result() as $obj1){	
		//if($offset==""){$offset=0;}
		//$offset++;
		$tot++;
		$no++;
	   ?>
			<tr>
				<td class="text-center">
					<a href="#pilih" onclick="pilih('<?php echo $obj1->groups;?>','<?php echo $obj1->name ?>','tambah')" class="btn btn-sm btn-info">pilih</a>
				</td>
				<td class="text-center"><?php echo $no; ?></td>
				<td><?php echo $obj1->groups;?></td>
				<td><?php echo $obj1->name;?></td>
			</tr>
		<?php
	}
?>
<input type="hidden" name="cbtotal" value="<?php echo $tot;?>">