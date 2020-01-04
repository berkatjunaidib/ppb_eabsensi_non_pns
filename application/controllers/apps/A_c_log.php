<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_c_log extends CI_Controller {
	var $cekLog;
	public function __construct(){
		parent::__construct(); 
	 	$this->cekLog = $this->m_security->cekArrayLogin();
	}

	function cekAccess($action){
	 	return $this->m_security->cekAkses(21,$action);
	}

	function index(){
		if($this->cekLog){
			$menudata="apps/home, home, / |,log,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = 'apps/a_c_log';
			
			$data['access_cetak'] = "";
			$data['access_view'] = "";
			$data['access_add'] = "";
			$data['access_update'] = "";
			$data['access_delete'] = "";
			
		
			$data["tab"] = "tab1";
			
			if($this->cekAccess('view')){
				$this->load->view('apps/a_v_log/index',$data);
			}
		}
	}

	function views(){
		if($this->cekAccess('view')){
			$data['access_view'] = $this->cekAccess('view');
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$sidx = $this->input->post('sidx') ? $this->input->post('sidx') : 'logID';
			$sord = $this->input->post("sord") ? $this->input->post("sord") : "desc";
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'logID' => $this->input->post('logID')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

				
			$data["sql1"] = $this->m_log->views($limit,$offset,$sidx,$sord,$data_set);
			$tot_hal = $this->m_log->rows($data_set);

			$data["offset"] = $offset;
			$data["total"] = $tot_hal->num_rows();

			$this->load->view("apps/a_v_log/data",$data);
		}
	}

	function rows(){
		if($this->cekAccess('view')){
			$page = $this->input->post("page") ? $this->input->post("page") : 1;
			$limit = $this->input->post("limit") ? $this->input->post("limit") : config_item('displayperpage');

			$data_set = array(
				'logID' => $this->input->post('logID')
			);

			if($page<=0){
				$offset=0;
			}
			else{
				$offset=($page-1) * $limit;
			}

			$tot_hal = $this->m_log->rows($data_set);

			$jlh = $tot_hal->num_rows();
			echo ceil( $jlh/$limit );
		}
	}

	function detail($logID){
		if($this->cekAccess('view')){
			$data["sql1"] = $this->m_log->detail($logID);
			$this->load->view('apps/a_v_log/detail',$data);
		}
	}
}