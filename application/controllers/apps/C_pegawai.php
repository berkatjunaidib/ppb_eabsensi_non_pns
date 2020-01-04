<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pegawai extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
		return $this->m_security->cekAkses(6,$action);
	}

	function index(){
		if($this->cekLog){
			$data['access_view'] = $this->cekAccess('view');
			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');

			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_pegawai/';
			$data['tab'] = "tab1";
			$this->load->view('apps/v_pegawai/index',$data);
		}
		else{
			$data["CekLogin"] = $this->cekLogin;
			$this->load->view("apps/home/msg_confirm",$data);
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$data['access_view'] = $this->cekAccess('view');
			$data['access_add'] = $this->cekAccess('add');
			$data['access_edit'] = $this->cekAccess('edit');
			$data['access_delete'] = $this->cekAccess('delete');
			
			$mod = $this->input->get('mod') ? $this->input->get('mod') : '';

			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 't1.id_pegawai';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$id_pegawai = $this->input->post('id_pegawai') ? $this->input->post('id_pegawai') : '';
			$nama_pegawai = $this->input->post('nama_pegawai') ? $this->input->post('nama_pegawai') : '';

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$data_set['id_pegawai'] = $id_pegawai;
			$data_set['nama_pegawai'] = $nama_pegawai;

			$data["sql1"] = $this->m_pegawai->views($limit,$offset,$sidx,$sord,$data_set);
			$tot_row = $this->m_pegawai->views("","",$sidx,$sord,$data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_row->num_rows();

			if($mod=="v"){
				$this->load->view("apps/v_pegawai/data",$data);
			}else{
				$jlh = $tot_row->num_rows();
				echo ceil( $jlh/$limit );
			}
		}
	}

	function add(){
		if($this->cekAccess('add')){
			$menudata="apps/home, home, / |,user,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/c_pegawai';
			$data["tab"] = "tab1";
			$data["form"] = "add";
			$data["op"] = "add";
			$this->load->view('apps/v_pegawai/form',$data);

		}
	}

	function edit(){
		if($this->cekAccess('edit')){
			$data['tab'] = "tab1";
			$id_pegawai = $this->input->get('id_pegawai') ? $this->input->get('id_pegawai') : '';
			$data["sql1"] = $this->m_pegawai->detail($id_pegawai);
			$data["form"] = "edit";
			$data["url_link"] = 'apps/c_pegawai';
			$menudata="apps/home, home, / |,pegawai,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["op"] = "edit";
			$this->load->view('apps/v_pegawai/form',$data);
		}
	}

	function crud(){
		$op = $this->input->post("op");
		$id_pegawai = $this->input->post("id_pegawai");
		$nama_pegawai = $this->input->post("nama_pegawai");
		$id_opd_lokasi = $this->input->post("id_opd_lokasi");
		$id_jabatan = $this->input->post("id_jabatan");

		$data = array(
			'id_pegawai' => $id_pegawai,
			'nama_pegawai' => $nama_pegawai,
			'id_opd_lokasi' => $id_opd_lokasi,
			'id_jabatan' => $id_jabatan,
		);

		if($op=="add"){
			$this->m_pegawai->insert($data);
		}else{
			$this->m_pegawai->update($id_pegawai,$data);
		}
		$ket_log ="Ubah Konten: <br>";
		$ket_log .="id_pegawai : ".$id_pegawai."<br>";
		$ket_log .="nama_pegawai : ".$nama_pegawai."<br>";
		$log = datalog(
			'UPDATE',
			'apps/c_pegawai/update',
			''.$ket_log.''
		);
		$this->m_log->insert($log);

		$ket_log .= "z";
		$data_set = array(
			'tipe' => 'success',
			'msg' => $ket_log,
		);
		echo json_encode($data_set);
	}

	function detail(){
		$data['tab'] = "tab1";
		$id_pegawai = $this->input->get('id_pegawai') ? $this->input->get('id_pegawai') : '';
		$data["sql1"] = $this->m_pegawai->edit($id_pegawai);
		$data["form"] = "edit";
		$data["url_link"] = 'apps/c_pegawai';
		$menudata="apps/home, home, / |,pegawai,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["op"] = "edit";
		$this->load->view('apps/v_pegawai/detail',$data);
	}

	function delete(){
		$pilih = $this->input->post("pilih");
		$ket_log = "";
		if($pilih!=""){
			$i=0;
			foreach ($pilih as $key) {
				$data_a = $this->m_pegawai->get_select($pilih[$i]);
				$this->m_pegawai->delete($pilih[$i]);
				$ket_log ="Hapus Konten<br>";
				$ket_log .="id_pegawai : ".$data_a['id_pegawai']."<br>";
				$log = datalog(
					'DELETE',
					'apps/c_pegawai/delete',
					''.$ket_log.''
				);
				$this->m_log->insert($log);
				$i++;
			}
		}
		$ket_log .= "z";
		$data_set = array(
			'tipe' => 'danger',
			'msg' => $ket_log,
		);
		echo json_encode($data_set);
	}

	function pegawai_auto(){
		$term = $this->input->get('term');
		$x = $this->m_pegawai->pegawai_auto(trim($term));
		echo json_encode($x);
	}

	function koordinat(){
		$this->load->view('apps/v_pegawai/koordinat');
	}
}