<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pegawai extends CI_Model {
	function views($limit,$offset,$sidx,$sord,$where){
		$q = "SELECT * ";
		$q.= "FROM tbl_pegawai t1 ";
		$q.= "LEFT JOIN tbl_opd_lokasi t2 ";
		$q.= "ON t1.id_opd_lokasi=t2.id_opd_lokasi ";
		$q.= "LEFT JOIN tbl_jabatan t3 ";
		$q.= "ON t1.id_jabatan=t3.id_jabatan ";
		$q.= "WHERE t1.id_pegawai!='' ";
		if($where['nama_pegawai']!==""){
			$q.= "AND t1.nama_pegawai LIKE '%".$where['nama_pegawai']."%' ";
		}
		if(!empty($limit)){
			$q.= "ORDER BY $sidx $sord ";
			$q.= "LIMIT $offset,$limit ";
		}
		$sql = $this->db->query($q);
		return $sql;
	}
	function insert($data){
		$this->db->insert("tbl_pegawai",$data);
	}
	function update($id_pegawai,$data){
		$this->db->where("id_pegawai",$id_pegawai);
		$this->db->update("tbl_pegawai",$data);
	}
	function delete($id_pegawai){
		$sql = $this->db->query("DELETE	FROM tbl_pegawai
			WHERE id_pegawai='$id_pegawai'");
		return $sql;
	}
	function detail($id_pegawai){
		$q = "SELECT * ";
		$q.= "FROM tbl_pegawai ";
		$q.= "WHERE id_pegawai='$id_pegawai' ";
		$sql = $this->db->query($q);
		return $sql;
	}
	function get_select($id_pegawai){
		$data="";
		$sql = $this->db->query("SELECT * FROM tbl_pegawai WHERE id_pegawai='$id_pegawai' LIMIT 0,1");
		foreach ($sql->result() as $row) {
			$data = array(
				'id_pegawai' =>  $row->id_pegawai,
				'nama_pegawai' =>  $row->nama_pegawai,
			);
		}
		return $data;
	}
	function pegawai_auto($term){
		$q = " SELECT * ";
		$q.= " FROM tbl_pegawai ";
		$q.= " WHERE id_pegawai !='' ";
		if($term!=""){
			$q.= " AND nama_pegawai LIKE '%$term%' ";
		}
		$q.= " LIMIT 0,10 ";
		//print_r($q);
		$query = $this->db->query($q);
		if($query->num_rows()>0){
			foreach ($query->result() as $obj1) {
				$row['id']=(int)$obj1->id_pegawai;
				$row['value']=htmlentities(stripslashes($obj1->nama_pegawai));
				$row['id_pegawai']=(int)$obj1->id_pegawai;
				$row['nama_pegawai']=htmlentities(stripslashes($obj1->nama_pegawai));
				$row_set[] = $row;
			}
		}else{
			$row['id']='';
			$row['value']='Data Tidak Ditemukan';
			$row['id_pegawai']='';
			$row['nama_pegawai']='';
			$row_set[] = $row;
		}
		return $row_set;
	}
}
?>