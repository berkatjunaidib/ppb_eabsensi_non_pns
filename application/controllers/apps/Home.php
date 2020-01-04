<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $cekLog;
	var $access_view;
	public function __construct(){
		parent::__construct(); 
		$this->cekLog = $this->m_security->cekArrayLogin();
	}


	function index(){
		if($this->cekLog){
		    
			$menudata="apps/home, home,";
			$data["breadcrumb"]= data_breadcrumb($menudata);
			$data["url_link"] = '';
            
            $data['jumlah_lokasi'] =  $this->m_home->jumlah_lokasi();
           
            $url_opd = "https://sibahanpe.pakpakbharatkab.go.id/api/all_opd.php";
			$data['jumlah_opd'] = $response = count(json_decode(curl_api($url_opd)));
            
			$data["tab"] = "tab1";
			$this->load->view('apps/header',$data);
			$this->load->view('apps/navbar',$data);
			$this->load->view('apps/navleft',$data);
			$this->load->view('apps/home/home',$data);
			$this->load->view('apps/footer');
		}
	}
	function index2(){
			$this->load->view('apps/tes');

	}
}