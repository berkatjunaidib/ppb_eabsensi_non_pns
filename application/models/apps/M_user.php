<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	function views($limit,$offset,$sidx,$sord,$where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			ORDER BY $sidx $sord LIMIT $offset,$limit");
		return $sql;
	}

	function rows($where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			");
		return $sql;
	}

	function insert($data){
		$this->db->insert("tbl_users",$data);
	}

	function update($userID,$data){
		$this->db->where("userID",$userID);
		$this->db->update("tbl_users",$data);
	}

	function update2($data){
		$this->db->update("tbl_users",$data);
	}

	function detail($userID){
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			WHERE userID='$userID'");
		return $sql;
	}

	function delete($userID){
		$sql = $this->db->query("DELETE	FROM tbl_users
			WHERE userID='$userID'");
		return $sql;
	}

	function group_views($sidx,$sord,$where){
		$where = $this->parameterWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_parameter
			$where
			ORDER BY $sidx $sord");
		return $sql;
	}

	function akses_tgl_views($limit,$offset,$sidx,$sord,$where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			ORDER BY $sidx $sord LIMIT $offset,$limit");
		return $sql;
	}

	function akses_tgl_rows($where){
		$where = $this->userWhere($where);
		$sql = $this->db->query("SELECT *
			FROM tbl_users
			$where
			");
		return $sql;
	}

	function user_anak_skpd($tahun_anggaran,$id_skpd){
		$q = "SELECT * FROM 
		(SELECT * FROM tbl_kegiatan a 
		WHERE a.tahun_anggaran='$tahun_anggaran'
		AND a.id_skpd='$id_skpd' 
		GROUP BY a.id_skpd,a.id_kpa)a 
		INNER JOIN tbl_users b 
		ON a.id_kpa=b.userID ";
		//$q.= "WHERE a.id_skpd='$id_skpd' ";
		$query = $this->db->query($q);
		return $query;	

	}

	function user_anak_kpa($tahun_anggaran,$id_skpd,$id_kpa){
		$q = "SELECT * FROM (
		SELECT * FROM tbl_kegiatan a 
		WHERE a.tahun_anggaran='$tahun_anggaran' 
		AND a.id_skpd='$id_skpd' 
		AND a.id_kpa='$id_kpa' 
		GROUP BY a.id_kpa,a.id_ppk)a 
		INNER JOIN tbl_users b 
		ON a.id_ppk=b.userID ";
		//$q.= "WHERE a.id_kpa='$id_kpa' ";
		$query = $this->db->query($q);
		return $query;	

	}
	function user_anak_ppk($tahun_anggaran,$id_skpd,$id_kpa,$id_ppk){
		$q = "SELECT * FROM (SELECT * FROM tbl_kegiatan a 
		WHERE a.tahun_anggaran='$tahun_anggaran'
		AND a.id_skpd='$id_skpd'
		AND a.id_kpa='$id_kpa'
		AND a.id_ppk='$id_ppk'
		 GROUP BY a.tahun_anggaran,a.id_skpd,a.id_skpd,a.id_ppk,a.id_pptk)a INNER JOIN tbl_users b ON a.id_pptk=b.userID ";
		$q.= "WHERE a.id_ppk='$id_ppk' ";
		$query = $this->db->query($q);
		return $query;	

	}


	function cek_logon($userID){
		$status_login = "Log On";
		$sessionTimeout = config_item('sessionTimeout');
		$sessionTimeoutSecond = 60 * $sessionTimeout;
		$time = time();

		$q = "SELECT statusLogin, userLastUpdate FROM tbl_users WHERE userID = '$userID'";


		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$statusLogin = $row->statusLogin;
			$lastAction = $row->userLastUpdate;
			if ($statusLogin=="Log Off" || $time-$lastAction >= $sessionTimeoutSecond){
				$status_login = "Log Off";
			}
		}
		return $status_login;
	}

	function parameterWhere($where){
		$str = " WHERE id!='' AND groups='USER' AND name='user.group'";
		foreach ($where as $key => $value) {
			if($key=="userID" AND $value!=""){
				$str .= " AND ".$key. "='".$value."'";
			}
			if($key=="userName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
			if($key=="realName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
		}
		return $str;
	}

	function userWhere($where){
		$str = " WHERE userID!='' ";
		foreach ($where as $key => $value) {
			if($key=="kecamatan_id" AND $value!=""){
				$str .= " AND ".$key. "='".$value."'";
			}
			if($key=="desa_id" AND $value!=""){
				$str .= " AND ".$key. "='".$value."'";
			}
			if($key=="realName" AND $value!=""){
				$str .= " AND ".$key. " LIKE '%".$value."%' ";
			}
		}
		return $str;
	}


	function detailUser($userID){
		$q = " SELECT * ";
		$q .= " FROM tbl_users t1";
		$q .= " WHERE t1.userID='$userID' ";
		$sql = $this->db->query($q);
		$row = $sql->row();
		if (isset($row)) {
			$data = array(
				'userID' => $row->userID,
				'realName' => $row->realName,
				'userName' => $row->userName,
				'userGroup' => $row->userGroup,
				'userSkpd' => $row->userSkpd,
				'accessDate' => $row->accessDate
			);
		}
		return $data;
	}

	function all_user_opd($userSkpd,$userGroup,$id_induk){
		$q = "SELECT * FROM tbl_users ";
		$q.= "WHERE userSkpd='$userSkpd' ";
		if($userGroup!=""){
			$q.= "AND userGroup='$userGroup' ";
		}
		if($id_induk!=""){
			$q.= "AND id_induk='$id_induk' ";
		}

		//print_r($q);
		$query = $this->db->query($q);
		return $query->result();	
		
	}

}
?>