<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_opd_lokasi extends CI_Controller {
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
			$data["url_link"] = 'apps/c_opd_lokasi/';
			$data['tab'] = "tab1";
			$this->load->view('apps/v_opd_lokasi/index',$data);
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
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'id_opd_lokasi';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$id_opd_lokasi = $this->input->post('id_opd_lokasi') ? $this->input->post('id_opd_lokasi') : '';
			$nama_lokasi = $this->input->post('nama_lokasi') ? $this->input->post('nama_lokasi') : '';

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$data_set['id_opd_lokasi'] = $id_opd_lokasi;
			$data_set['nama_lokasi'] = $nama_lokasi;

			$data["sql1"] = $this->m_opd_lokasi->views($limit,$offset,$sidx,$sord,$data_set);
			$tot_row = $this->m_opd_lokasi->views("","",$sidx,$sord,$data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_row->num_rows();

			if($mod=="v"){
				$this->load->view("apps/v_opd_lokasi/data",$data);
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
			$data["url_link"] = 'apps/c_opd_lokasi';
			$data["tab"] = "tab1";
			$data["form"] = "add";
			$data["op"] = "add";
			$this->load->view('apps/v_opd_lokasi/form',$data);

		}
	}

	function edit(){
		if($this->cekAccess('edit')){
			$data['tab'] = "tab1";
			$id_opd_lokasi = $this->input->get('id_opd_lokasi') ? $this->input->get('id_opd_lokasi') : '';
			$data["sql1"] = $this->m_opd_lokasi->detail($id_opd_lokasi);
			$data["form"] = "edit";
			$data["url_link"] = 'apps/c_opd_lokasi';
			$menudata="apps/home, home, / |,opd_lokasi,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["op"] = "edit";
			$this->load->view('apps/v_opd_lokasi/form',$data);
		}
	}

	function crud(){
		$op = $this->input->post("op");
		$id_opd_lokasi = $this->input->post("id_opd_lokasi");
		$nama_lokasi = $this->input->post("nama_lokasi");
		$koordinat = $this->input->post("koordinat");

		$data = array(
			'id_opd_lokasi' => $id_opd_lokasi,
			'nama_lokasi' => $nama_lokasi,
			'koordinat' => $koordinat,
		);

		if($op=="add"){
			$this->m_opd_lokasi->insert($data);
		}else{
			$this->m_opd_lokasi->update($id_opd_lokasi,$data);
		}
		$ket_log ="Ubah Konten: <br>";
		$ket_log .="id_opd_lokasi : ".$id_opd_lokasi."<br>";
		$ket_log .="nama_lokasi : ".$nama_lokasi."<br>";
		$log = datalog(
			'UPDATE',
			'apps/c_opd_lokasi/update',
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
		$id_opd_lokasi = $this->input->get('id_opd_lokasi') ? $this->input->get('id_opd_lokasi') : '';
		$data["sql1"] = $this->m_opd_lokasi->edit($id_opd_lokasi);
		$data["form"] = "edit";
		$data["url_link"] = 'apps/c_opd_lokasi';
		$menudata="apps/home, home, / |,opd_lokasi,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["op"] = "edit";
		$this->load->view('apps/v_opd_lokasi/detail',$data);
	}

	function delete(){
		$pilih = $this->input->post("pilih");
		$ket_log = "";
		if($pilih!=""){
			$i=0;
			foreach ($pilih as $key) {
				$data_a = $this->m_opd_lokasi->get_select($pilih[$i]);
				$this->m_opd_lokasi->delete($pilih[$i]);
				$ket_log ="Hapus Konten<br>";
				$ket_log .="id_opd_lokasi : ".$data_a['id_opd_lokasi']."<br>";
				$log = datalog(
					'DELETE',
					'apps/c_opd_lokasi/delete',
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

	function opd_lokasi_auto(){
		$term = $this->input->get('term');
		$x = $this->m_opd_lokasi->opd_lokasi_auto(trim($term));
		echo json_encode($x);
	}

	function koordinat(){
		$this->load->view('apps/v_opd_lokasi/koordinat');
	}
}