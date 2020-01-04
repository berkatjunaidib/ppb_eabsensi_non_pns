<h6><b><?php echo $name; ?></b></h6>
<div class="table-responsive">
	<table class="table table-condensed">
		<thead>
			<tr>
				<th class="text-center" style="width: 170px;">pilih</th>
				<th class="text-center span1">no</th>
				<th>groups</th>
				<th>nama</th>
				<th>id</th>
				<th>description</th>
				<th>notes</th>
				<?php 
				if($name=="web.img"){
					?><th>file</th><?php
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=0;
			foreach ($sql1->result() as $obj1){	
				$no++;
				$groups = $obj1->groups;
				$name = $obj1->name;
				?>
				<tr>
					<td class="text-center">
						<input type="hidden" id="form2_id<?php echo $no; ?>" value="<?php echo $obj1->id; ?>">
						<input type="hidden" id="form2_description<?php echo $no; ?>" value="<?php echo buangbr($obj1->description); ?>">
						<input type="hidden" id="form2_notes<?php echo $no; ?>" value="<?php echo buangbr($obj1->notes); ?>">
						<a href="#pilih" onclick="pilih2('<?php echo $no; ?>','<?php echo $obj1->groups;?>','<?php echo $obj1->name ?>','ubah')" class="btn btn-sm btn-warning">ubah</a>
						<a href="#pilih" onclick="pilih2('<?php echo $no; ?>','<?php echo $obj1->groups;?>','<?php echo $obj1->name ?>','hapus')" class="btn btn-sm btn-danger">hapus</a>
					</td>
					<td class="text-center"><?php echo $no; ?></td>
					<td><?php echo $obj1->groups;?></td>
					<td><?php echo $obj1->name;?></td>
					<td><?php echo $obj1->id;?></td>
					<td><?php echo selengkapnya($obj1->description);?></td>
					<td><?php echo selengkapnya($obj1->notes);?></td>
					<?php 
					if($name=="web.img"){
						?>
						<td>
							<img width="50" src="<?php echo base_url();?>uploads/<?php echo $obj1->file_gambar;?>">
						</td>
						<?php
					}
					?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>

<form id="form_parameter" name="form_parameter" action="#" enctype="multipart/form-data">
	<input type="hidden" name="groups" value="<?php echo $groups; ?>">
	<input type="hidden" name="name" value="<?php echo $name; ?>">
	<input type="hidden" name="op" value="<?php echo $op; ?>">
	<input type="hidden" name="idLama" value="<?php echo $idLama; ?>">
	<div class="table-responsive">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th class="span3">Item</th>
					<th>Value</th>
				</tr>
			</thead>
			<tr>
				<td>ID</td>
				<td>
					<input type="text" name="id" class="form-control input-sm">
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea rows="4" name="description" class="form-control input-sm"></textarea>
				</td>
			</tr>
			<tr>
				<td>Notes</td>
				<td>
					<textarea rows="4" name="notes" class="form-control input-sm"></textarea>
				</td>
			</tr>
			<?php 
			if($name=="web.img"){
				?>
				<tr>
					<td>file_gambar</td>
					<td>
						<input type="hidden" class="form-control" name="file_gambar_lama" value="<?php echo $file_gambar; ?>">
						<input type="file" class="form-control" name="file_gambar" value="<?php echo $file_gambar; ?>">
					</td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<button type="submit" class="btn btn-block btn-cek"><span class="btn-keterangan"></span> data</button>
</form>

<script type="text/javascript">
	
	$("#form_parameter").submit(function(){
		var string = $("#form_parameter").serialize();
		var groups = document.form_parameter.groups.value;
		var name = document.form_parameter.name.value;
		var op = document.form_parameter.op.value;
		if (confirm("Anda Yakin?")) {

			$.ajax({
				url		: "<?php echo base_url(); ?>apps/a_c_parameter/"+op,
				type: "POST",
				contentType: false,
				processData:false,
				data:  new FormData(this),
				beforeSend: function(){
					$('#coba').html(loading_tabel);
				},
				success: function(e){
					var json = $.parseJSON(e);
					notify(json.tipe,json.msg);
					pilih(groups,name,'tambah');
				},
				error: function(){
					notify('danger','Gagal<br>ID sudah digunakan');
				}           
			});

			/*$.ajax({
				type	: 'POST',
				url		: "<?php echo base_url(); ?>apps/a_c_parameter/"+op,
				data	: string,
				cache	: false,
				success	: function(e){
					var json = $.parseJSON(e);
					notify(json.tipe,json.msg);
					pilih(groups,name,'tambah');
				},
				error: function(){
					notify('danger','Gagal<br>ID sudah digunakan');
				}
			});*/
			return false;
		}

		return false;
	});


</script>