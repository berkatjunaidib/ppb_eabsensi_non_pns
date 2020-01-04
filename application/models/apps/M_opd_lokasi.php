<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_opd_lokasi extends CI_Model {
	function views($limit,$offset,$sidx,$sord,$where){
		$q = "SELECT * ";
		$q.= "FROM tbl_opd_lokasi ";
		$q.= "WHERE id_opd_lokasi!='' ";
		if($where['id_opd_lokasi']!==""){
			$q.= "AND id_opd_lokasi ='".$where['id_opd_lokasi']."' ";
		}
		if($where['nama_lokasi']!==""){
			$q.= "AND nama_lokasi LIKE '%".$where['nama_lokasi']."%' ";
		}
		if(!empty($limit)){
			$q.= "ORDER BY $sidx $sord ";
			$q.= "LIMIT $offset,$limit ";
		}
		$sql = $this->db->query($q);
		return $sql;
	}
	function insert($data){
		$this->db->insert("tbl_opd_lokasi",$data);
	}
	function update($id_opd_lokasi,$data){
		$this->db->where("id_opd_lokasi",$id_opd_lokasi);
		$this->db->update("tbl_opd_lokasi",$data);
	}
	function delete($id_opd_lokasi){
		$sql = $this->db->query("DELETE	FROM tbl_opd_lokasi
			WHERE id_opd_lokasi='$id_opd_lokasi'");
		return $sql;
	}
	function detail($id_opd_lokasi){
		$q = "SELECT * ";
		$q.= "FROM tbl_opd_lokasi ";
		$q.= "WHERE id_opd_lokasi='$id_opd_lokasi' ";
		$sql = $this->db->query($q);
		return $sql;
	}
	function get_select($id_opd_lokasi){
		$data="";
		$sql = $this->db->query("SELECT * FROM tbl_opd_lokasi WHERE id_opd_lokasi='$id_opd_lokasi' LIMIT 0,1");
		foreach ($sql->result() as $row) {
			$data = array(
				'id_opd_lokasi' =>  $row->id_opd_lokasi,
				'nama_lokasi' =>  $row->nama_lokasi,
			);
		}
		return $data;
	}
	function opd_lokasi_auto($term){
		$q = " SELECT * ";
		$q.= " FROM tbl_opd_lokasi ";
		$q.= " WHERE id_opd_lokasi !='' ";
		if($term!=""){
			$q.= " AND nama_lokasi LIKE '%$term%' ";
		}
		$q.= " LIMIT 0,10 ";
		//print_r($q);
		$query = $this->db->query($q);
		if($query->num_rows()>0){
			foreach ($query->result() as $obj1) {
				$row['id']=(int)$obj1->id_opd_lokasi;
				$row['value']=htmlentities(stripslashes($obj1->nama_lokasi));
				$row['id_opd_lokasi']=(int)$obj1->id_opd_lokasi;
				$row['nama_lokasi']=htmlentities(stripslashes($obj1->nama_lokasi));
				$row_set[] = $row;
			}
		}else{
			$row['id']='';
			$row['value']='Data Tidak Ditemukan';
			$row['id_opd_lokasi']='';
			$row['nama_lokasi']='';
			$row_set[] = $row;
		}
		return $row_set;
	}
}
?>