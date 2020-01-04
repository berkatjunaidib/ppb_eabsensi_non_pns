<ul class="nav nav-tabs">
	<li class="nav-item"><a class="nav-link <?php if($tab=="tab1"){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_user')">Daftar Pengguna</a></li>
	<li class="nav-item"><a class="nav-link <?php if($tab=="tab2"){echo "active";}?>" href="javascript:eksekusi_get('<?php echo base_url(); ?>apps/a_c_user/group')">Akses Group Pengguna</a></li>
</ul>
