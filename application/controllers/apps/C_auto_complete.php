<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_auto_complete extends CI_Controller {
	
	function loadJabatan(){
		$id_jenis_jabatan = $this->input->get('id_jenis_jabatan');
		$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_jabatan ";
		$q.= "WHERE id_jenis_jabatan='$id_jenis_jabatan' ";
		$q.= "AND id_opd='$id_opd' ";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_jabatan; ?>'><?php echo $value->id_jabatan; ?> - <?php echo $value->jabatan; ?></option><?php
		}
	}

	function loadJenisJabastan(){
		$term = $this->input->get('term');
		$x = $this->m_master_bidang->master_bidang_auto(trim($term));
		echo json_encode($x);
	}
    function loadPangkat(){
		$id_pangkat = $this->input->get('id_pangkat');
		//$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_pangkat ";
		$q.= "WHERE id_pangkat='$id_pangkat' ";
		
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_pangkat; ?>'><?php echo $value->id_pangkat; ?> - <?php echo $value->nama_pangkat; ?></option><?php
		}
	}
    function loadTipe(){
		$id_tipe_pegawai = $this->input->get('id_tipe_pegawai');
		//$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM tbl_riwayat_tipe_pegawai ";
		$q.= "WHERE id_tipe_pegawai='$id_tipe_pegawai' ";
		
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_tipe_pegawai; ?>'><?php echo $value->id_tipe_pegawai; ?> - <?php echo $value->nama_tipe; ?></option><?php
		}
	}
    function loadRiwayatOpd(){
		$id_opd = $this->input->get('id_opd');
		//$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_opd ";
		$q.= "WHERE id_opd='$id_opd' AND status='A' ";
		
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_opd; ?>'><?php echo $value->id_opd; ?> - <?php echo $value->nama_opd; ?></option><?php
		}
	}

	function loadstatus(){
		$id_keterangan_status_pegawai = $this->input->get('id_keterangan_status_pegawai');
		//$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_keterangan_status ";
		$q.= "WHERE id_keterangan_status_pegawai='$id_keterangan_status_pegawai' ";
		//$q.= "AND id_opd='$id_opd' ";
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_keterangan_status_pegawai; ?>'><?php echo $value->id_keterangan_status_pegawai; ?> - <?php echo $value->keterangan_status; ?></option><?php
		}
	}

	function loadopd(){
		$id_unit = $this->input->get('id_unit');
		$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_unit ";
		$q.= "WHERE id_opd='$id_opd' ";
		if($id_unit!="")
		{
			$q.= "AND id_unit='$id_unit' ";
		}

		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_unit; ?>'><?php echo $value->id_unit; ?> - <?php echo $value->nama_unit; ?></option><?php
		}


	}
	
	
	function loadbidang(){
		//$id_unit = $this->input->get('id_bidang');
		$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_bidang ";
		$q.= "WHERE id_opd='$id_opd' ";
		
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_bidang; ?>'><?php echo $value->id_bidang; ?> - <?php echo $value->nama_bidang; ?></option><?php
		}


	}


	function loadsubbidang(){
		//$id_unit = $this->input->get('id_bidang');
		$id_bidang = $this->input->get('id_bidang');
		$q = "SELECT * ";
		$q.= "FROM master_sub_bidang ";
		$q.= "WHERE id_bidang='$id_bidang' ";
		
		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_sub_bidang; ?>'><?php echo $value->id_sub_bidang; ?> - <?php echo $value->nama_sub_bidang; ?></option><?php
		}


	}
	function loadpustu(){
		$id_pustu = $this->input->get('id_pustu');
		$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_pustu ";
		$q.= "WHERE id_opd='$id_opd' ";
		if($id_pustu!="")
		{
			$q.= "AND id_pustu='$id_pustu' ";
		}

		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_pustu; ?>'><?php echo $value->id_pustu; ?> - <?php echo $value->nama_pustu; ?></option><?php
		}


	}

function loadopdupt(){
		$id_upt = $this->input->get('id_upt');
		$id_opd = $this->input->get('id_opd');
		$q = "SELECT * ";
		$q.= "FROM master_upt ";
		$q.= "WHERE id_opd='$id_opd' ";
		$q.= "AND status='A' ";

		if($id_upt!="")
		{
			$q.= "AND id_upt='$id_upt' ";
		}

		$sql = $this->db->query($q);
		foreach ($sql->result() as $key => $value) {
			?><option value='<?php echo $value->id_upt; ?>'><?php echo $value->id_upt; ?> - <?php echo $value->nama_upt; ?></option><?php
		}


	}


	function loadUpt(){
		$term = $this->input->get('term');
		$x = $this->m_mutasi_upt->master_upt_auto(trim($term));
		echo json_encode($x);
	}

}