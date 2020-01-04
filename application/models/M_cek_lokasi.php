<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_cek_lokasi extends CI_Model {
	function view($id_pegawai,$id_opd_lokasi){
		$q1 = "SELECT * ";
		$q1.= "FROM tbl_set_lokasi t1 ";
		$q1.= "LEFT JOIN tbl_opd_lokasi t2 ";
		$q1.= "ON t1.id_opd_lokasi=t2.id_opd_lokasi ";
		$q1.= "WHERE t1.id_opd='".$id_opd_lokasi."' ";
		$q1.= "AND t1.tanggal='".date("Y-m-d")."' ";
		$q1.= "ORDER BY id_set_lokasi DESC LIMIT 0,1 ";

		$q2 = "SELECT * ";
		$q2.= "FROM tbl_set_lokasi t1 ";
		$q2.= "LEFT JOIN tbl_opd_lokasi t2 ";
		$q2.= "ON t1.id_opd_lokasi=t2.id_opd_lokasi ";
		$q2.= "WHERE t1.id_pegawai='".$id_pegawai."' ";
		$q2.= "AND t1.tanggal='".date("Y-m-d")."' ";
		$q2.= "ORDER BY id_set_lokasi DESC LIMIT 0,1 ";

		$q3 = "SELECT * ";
		$q3.= "FROM tbl_opd_lokasi ";
		$q3.= "WHERE id_opd_lokasi='".$id_opd_lokasi."' ";

		//print_r($q);
		$sql1 = $this->db->query($q1);
		$sql2 = $this->db->query($q2);
		$sql3 = $this->db->query($q3);
		$b1 = $sql1->result();
		$b2 = $sql2->result();
		$b3 = $sql3->result();
		
		if($sql1->num_rows()>0){
			$da['id_opd_lokasi'] = $b1[0]->id_opd_lokasi;
			$da['nama_lokasi'] = $b1[0]->nama_lokasi;
			$da['koordinat'] = $b1[0]->koordinat;
			$data[] = $da;
		}else if($sql2->num_rows()>0){
			$da['id_opd_lokasi'] = $b2[0]->id_opd_lokasi;
			$da['nama_lokasi'] = $b2[0]->nama_lokasi;
			$da['koordinat'] = $b2[0]->koordinat;
			$data[] = $da;
		}else{
			$da['id_opd_lokasi'] = $b3[0]->id_opd_lokasi;
			$da['nama_lokasi'] = $b3[0]->nama_lokasi;
			$da['koordinat'] = $b3[0]->koordinat;
			$data[] = $da;
		}
	//	print_r($data);
		return $data;
		//return $sql->result();
	}
}