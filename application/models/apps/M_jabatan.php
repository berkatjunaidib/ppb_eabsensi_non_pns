<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_jabatan extends CI_Model {
	function views($limit,$offset,$sidx,$sord,$where){
		$q = "SELECT * ";
		$q.= "FROM tbl_jabatan ";
		$q.= "WHERE id_jabatan!='' ";
		if($where['id_jabatan']!==""){
			$q.= "AND id_jabatan ='".$where['id_jabatan']."' ";
		}
		if($where['nama_jabatan']!==""){
			$q.= "AND nama_jabatan LIKE '%".$where['nama_jabatan']."%' ";
		}
		if(!empty($limit)){
			$q.= "ORDER BY $sidx $sord ";
			$q.= "LIMIT $offset,$limit ";
		}
		$sql = $this->db->query($q);
		return $sql;
	}
	function insert($data){
		$this->db->insert("tbl_jabatan",$data);
	}
	function update($id_jabatan,$data){
		$this->db->where("id_jabatan",$id_jabatan);
		$this->db->update("tbl_jabatan",$data);
	}
	function delete($id_jabatan){
		$sql = $this->db->query("DELETE	FROM tbl_jabatan
			WHERE id_jabatan='$id_jabatan'");
		return $sql;
	}
	function detail($id_jabatan){
		$q = "SELECT * ";
		$q.= "FROM tbl_jabatan ";
		$q.= "WHERE id_jabatan='$id_jabatan' ";
		$sql = $this->db->query($q);
		return $sql;
	}
	function get_select($id_jabatan){
		$data="";
		$sql = $this->db->query("SELECT * FROM tbl_jabatan WHERE id_jabatan='$id_jabatan' LIMIT 0,1");
		foreach ($sql->result() as $row) {
			$data = array(
				'id_jabatan' =>  $row->id_jabatan,
				'nama_jabatan' =>  $row->nama_jabatan,
			);
		}
		return $data;
	}
	function jabatan_auto($term){
		$q = " SELECT * ";
		$q.= " FROM tbl_jabatan ";
		$q.= " WHERE id_jabatan !='' ";
		if($term!=""){
			$q.= " AND nama_jabatan LIKE '%$term%' ";
		}
		$q.= " LIMIT 0,10 ";
		//print_r($q);
		$query = $this->db->query($q);
		if($query->num_rows()>0){
			foreach ($query->result() as $obj1) {
				$row['id']=(int)$obj1->id_jabatan;
				$row['value']=htmlentities(stripslashes($obj1->nama_jabatan));
				$row['id_jabatan']=(int)$obj1->id_jabatan;
				$row['nama_jabatan']=htmlentities(stripslashes($obj1->nama_jabatan));
				$row_set[] = $row;
			}
		}else{
			$row['id']='';
			$row['value']='Data Tidak Ditemukan';
			$row['id_jabatan']='';
			$row['nama_jabatan']='';
			$row_set[] = $row;
		}
		return $row_set;
	}
}
?>