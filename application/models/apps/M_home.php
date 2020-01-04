<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_home extends CI_Model {

	function jumlah_lokasi(){
		$q = $this->db->query("
			SELECT count(*) as jlh_lokasi FROM tbl_opd_lokasi
			");
		return $q->result();
	}

}
?>