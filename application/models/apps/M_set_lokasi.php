<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_set_lokasi extends CI_Model {
	function proses($data){
		$this->db->insert("tbl_set_lokasi",$data);
	}
	function detail($id_pegawai,$tanggal){
		$q = "SELECT * ";
		$q.= "FROM tbl_set_lokasi ";
		$q.= "WHERE id_pegawai='$id_pegawai' ";
		$q.= "AND tanggal='$tanggal' ";
		$sql = $this->db->query($q);
		return $sql;
	}
	function detail2($id_opd,$tanggal){
		$q = "SELECT * ";
		$q.= "FROM tbl_set_lokasi ";
		$q.= "WHERE id_opd='$id_opd' ";
		$q.= "AND tanggal='$tanggal' ";
		$sql = $this->db->query($q);
		return $sql;
	}
}
?>