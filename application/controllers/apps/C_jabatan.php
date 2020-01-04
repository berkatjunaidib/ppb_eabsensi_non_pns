<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_jabatan extends CI_Controller {
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
			$data["url_link"] = 'apps/c_jabatan/';
			$data['tab'] = "tab1";
			$this->load->view('apps/v_jabatan/index',$data);
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
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'id_jabatan';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "asc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$id_jabatan = $this->input->post('id_jabatan') ? $this->input->post('id_jabatan') : '';
			$nama_jabatan = $this->input->post('nama_jabatan') ? $this->input->post('nama_jabatan') : '';

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$data_set['id_jabatan'] = $id_jabatan;
			$data_set['nama_jabatan'] = $nama_jabatan;

			$data["sql1"] = $this->m_jabatan->views($limit,$offset,$sidx,$sord,$data_set);
			$tot_row = $this->m_jabatan->views("","",$sidx,$sord,$data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_row->num_rows();

			if($mod=="v"){
				$this->load->view("apps/v_jabatan/data",$data);
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
			$data["url_link"] = 'apps/c_jabatan';
			$data["tab"] = "tab1";
			$data["form"] = "add";
			$data["op"] = "add";
			$this->load->view('apps/v_jabatan/form',$data);

		}
	}

	function edit(){
		if($this->cekAccess('edit')){
			$data['tab'] = "tab1";
			$id_jabatan = $this->input->get('id_jabatan') ? $this->input->get('id_jabatan') : '';
			$data["sql1"] = $this->m_jabatan->detail($id_jabatan);
			$data["form"] = "edit";
			$data["url_link"] = 'apps/c_jabatan';
			$menudata="apps/home, home, / |,jabatan,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["op"] = "edit";
			$this->load->view('apps/v_jabatan/form',$data);
		}
	}

	function crud(){
		$op = $this->input->post("op");
		$id_jabatan = $this->input->post("id_jabatan");
		$nama_jabatan = $this->input->post("nama_jabatan");

		$data = array(
			'id_jabatan' => $id_jabatan,
			'nama_jabatan' => $nama_jabatan,
		);

		if($op=="add"){
			$this->m_jabatan->insert($data);
		}else{
			$this->m_jabatan->update($id_jabatan,$data);
		}
		$ket_log ="Ubah Konten: <br>";
		$ket_log .="id_jabatan : ".$id_jabatan."<br>";
		$ket_log .="nama_jabatan : ".$nama_jabatan."<br>";
		$log = datalog(
			'UPDATE',
			'apps/c_jabatan/update',
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
		$id_jabatan = $this->input->get('id_jabatan') ? $this->input->get('id_jabatan') : '';
		$data["sql1"] = $this->m_jabatan->edit($id_jabatan);
		$data["form"] = "edit";
		$data["url_link"] = 'apps/c_jabatan';
		$menudata="apps/home, home, / |,jabatan,";
		$data["breadcrumb"]= data_breadcrumb($menudata);
		$data["op"] = "edit";
		$this->load->view('apps/v_jabatan/detail',$data);
	}

	function delete(){
		$pilih = $this->input->post("pilih");
		$ket_log = "";
		if($pilih!=""){
			$i=0;
			foreach ($pilih as $key) {
				$data_a = $this->m_jabatan->get_select($pilih[$i]);
				$this->m_jabatan->delete($pilih[$i]);
				$ket_log ="Hapus Konten<br>";
				$ket_log .="id_jabatan : ".$data_a['id_jabatan']."<br>";
				$log = datalog(
					'DELETE',
					'apps/c_jabatan/delete',
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

	function jabatan_auto(){
		$term = $this->input->get('term');
		$x = $this->m_jabatan->jabatan_auto(trim($term));
		echo json_encode($x);
	}

	function koordinat(){
		$this->load->view('apps/v_jabatan/koordinat');
	}
}