<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_edit_profil extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		$this->m_security->cekArrayLogin();
	}
	
	function index(){
		$menudata="apps/home,Home, / |,Edit Password,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["keterangan"]="";
		$data["url_link"]="";
		$data["menu"]="home";
		$this->load->view('apps/edit_profil',$data);
	}

	function update(){
		$pass_lama = md5($this->input->post('pass_lama'));
		$pass_baru = md5($this->input->post('pass_baru'));
		$ulang_pass_baru = md5($this->input->post('ulang_pass_baru'));

		$data = $this->m_edit_password->update($pass_lama,$pass_baru,$ulang_pass_baru);
		if($data['status']==1){
			$a_type = 'success';
			$ket_log ="Ubah Password: <br>";
			$ket_log .="id_pegawai : ".$this->session->userdata('arrayLogin')['id_pegawai']."|";
			$ket_log .="nip : ".$this->session->userdata('arrayLogin')['nip']."|";
			$ket_log .="Ubah Password Berhasil";
			$log = datalog(
				'UPDATE',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
		}
		else{
			$a_type = 'danger';
			$ket_log ="Ubah Password: <br>";
			$ket_log .="nip : ".$this->session->userdata('arrayLogin')['nip']."|";
			$ket_log .="Ubah Password Gagal|";
			$ket_log .=$data['keterangan'];

			$log = datalog(
				'UPDATE',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
		}
		$data_set = array(
			'tipe' => $a_type,
			'msg' => $ket_log,
		);
		echo json_encode($data_set);
	}

	function update_desa(){
		$dusun = $this->input->post('dusun');
		$jalan = $this->input->post('jalan');
		$kode_pos = $this->input->post('kode_pos');
		$kepdes = $this->input->post('kepdes');
		$sekdes = $this->input->post('sekdes');
		$email = $this->input->post('email');
		$website = $this->input->post('website');

		$kecamatan_id = $_SESSION['arrayLogin']['kecamatan_id'];
		$desa_id = $_SESSION['arrayLogin']['desa_id'];

		$data = array(
			'dusun' => $dusun,
			'jalan' => $jalan,
			'kode_pos' => $kode_pos,
			'kepdes' => $kepdes,
			'sekdes' => $sekdes,
			'email' => $email,
			'website' => $website
		);
		$data = $this->m_kecamatan->update($kecamatan_id,$desa_id,$data);
		
		$a_type = 'success';
		$ket_log ="Ubah profil desa: <br>";
		$ket_log .="Ubah Berhasil !";

		$log = datalog(
			'UPDATE',
			''.$ket_log.''
		);
		$this->m_log->insert($log);
		$data_set = array(
			'tipe' => $a_type,
			'msg' => $ket_log,
		);
		echo json_encode($data_set);
	}
}