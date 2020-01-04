<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_edit_password extends CI_Model {
	
	function update($pass_lama,$pass_baru,$ulang_pass_baru){
		$userID = $this->session->userdata('arrayLogin')['id_pegawai'];
		$userPassword = $this->session->userdata('arrayLogin')['password'];
		if($pass_lama!=$userPassword){
			$data = array(
				'status' => 0,
				'keterangan' => 'password lama tidak sama'
			);
		}
		else if($pass_baru!=$ulang_pass_baru){
			$data = array(
				'status' => 0,
				'keterangan' => 'anda salah mengulang password'
			);
		}
		else{
			$sql = $this->db->query("UPDATE tbl_pegawai SET password='$pass_baru' WHERE id_pegawai='$userID'");
			if($sql){
				$arrayLogin = array(
					'id_pegawai' => $this->session->userdata('arrayLogin')['id_pegawai'], 
					'nama_pegawai' => $this->session->userdata('arrayLogin')['nama_pegawai'], 
					'nip' => $this->session->userdata('arrayLogin')['nip'], 
					'password' => $pass_baru, 
					'id_group_user' => $this->session->userdata('arrayLogin')['id_group_user'],
					'group_user_str' => $this->session->userdata('arrayLogin')['group_user_str'],
					'last_login' => $this->session->userdata('arrayLogin')['last_login'],
					'theme' => $this->session->userdata('arrayLogin')['theme'],
				);
				$sess_data['arrayLogin'] = $arrayLogin;
				$this->session->set_userdata($sess_data);
				$data = array(
					'status' => 1,
					'keterangan' => 'password berhasil di edit'
				);
			}
			else{
				$data = array(
					'status' => 0,
					'keterangan' => 'gagal update password'
				);
			}
		}
		return $data;

	}
}