<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_lokasi extends CI_Controller {

	public function index(){

		error_reporting(0);

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: *");
		header('Content-Type: application/json');

		$lat_x = $this->input->get('lat');
		$lng_y = $this->input->get('lng'); 
		$id_pegawai = $this->input->get('id_pegawai'); 
		$id_opd = $this->input->get('id_opd'); 

		$data['lat_x'] = $lat_x;
		$data['lng_y'] = $lng_y; 
		$data['id_pegawai'] = $id_pegawai; 
		$data['id_opd'] = $id_opd; 


		$data1 = $this->m_cek_lokasi->view($id_pegawai,$id_opd);
		$koordinat_all = $data1[0]['koordinat'];
		$koordinat_all = str_replace(")","",$koordinat_all);
		$koordinat_all = str_replace("(","",$koordinat_all);
		$koordinat_all = str_replace(" ","",$koordinat_all);

		$koordinat_all_explode = explode(",",$koordinat_all);

		$i=0;
		foreach ($koordinat_all_explode as $value1) {
			$i++;
			if($i%2==0){
				$koordinat_y_arr[] = $value1;
			}else{
				$koordinat_x_arr[] = $value1;
			}
		}

		//$koordinat_x = array(2.554583014155121, 2.5610996473341987,2.5568981376286746,2.5448937484495056,2.5430073342586277, 2.5483235853591855, 2.550295737445332);
		$vertices_x = $koordinat_x_arr;

		//$koordinat_y = array(98.31793349204054, 98.32454245505323, 98.33518546042433, 98.32728903708448, 98.32153838095655, 98.31922095236769, 98.3173326772212);
		$vertices_y = $koordinat_y_arr;


		$points_polygon = count($vertices_x) - 1;  // number vertices - zero-based array
		//$longitude_x = "2.5619425385858436";  // x-coordinate of the point to test
		//$latitude_y = "98.31984234833772";    // y-coordinate of the point to test

		if(!$lat_x || !isset($lng_y))
		{
			//$longitude_x = "2.5619425385858436";  // x-coordinate of the point to test
			//$latitude_y = "98.31984234833772";    // y-coordinate of the point to test
			echo json_encode(array(array("msg"=>"gagal","deskripsi"=>"longitude_x dan latitude_y harus isset")));
			die();

		}else{
			$longitude_x = $lat_x;  // x-coordinate of the point to test
			$latitude_y = $lng_y;    // y-coordinate of the point to test

		}

			//2.5560689995404826,98.32310391449982
			//[{"type":"MARKER","id":null,"geometry":[2.5619425385858436,98.31984234833772]}]
		if ($this->is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)){
			//echo "1";//"Is in polygon!";
			echo json_encode(array(array("msg"=>"sukses","deskripsi"=>"Anda di posisi")));
		}
		else {
			//echo "0";//"Is not in polygon";
			echo json_encode(array(array("msg"=>"gagal","deskripsi"=>"Anda tidak di posisi")));
		}

	}

	public function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y){
		$i = $j = $c = 0;
		for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
			if ( (($vertices_y[$i]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
				($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
				$c = !$c;
		}
		return $c;
	}

	public function visual(){
		error_reporting(0);

		$lat_x = $this->input->get('lat');
		$lng_y = $this->input->get('lng'); 
		$id_pegawai = $this->input->get('id_pegawai'); 
		$id_opd = $this->input->get('id_opd'); 

		$data['lat_x'] = $lat_x;
		$data['lng_y'] = $lng_y; 
		$data['id_pegawai'] = $id_pegawai; 
		$data['id_opd'] = $id_opd; 


		$data1 = $this->m_cek_lokasi->view($id_pegawai,$id_opd);
		//print_r($data1);
		$koordinat_all = $data1[0]['koordinat'];
		$koordinat_all = str_replace(")","",$koordinat_all);
		$koordinat_all = str_replace("(","",$koordinat_all);
		$koordinat_all = str_replace(" ","",$koordinat_all);

		$koordinat_all_explode = explode(",",$koordinat_all);

		$i=0;
		foreach ($koordinat_all_explode as $value1) {
			$i++;
			if($i%2==0){
				$koordinat_y_arr[] = $value1;
			}else{
				$koordinat_x_arr[] = $value1;
			}
		}

		//$koordinat_x = array(2.554583014155121, 2.5610996473341987,2.5568981376286746,2.5448937484495056,2.5430073342586277, 2.5483235853591855, 2.550295737445332);
		$data['vertices_x'] = $koordinat_x_arr;

		//$koordinat_y = array(98.31793349204054, 98.32454245505323, 98.33518546042433, 98.32728903708448, 98.32153838095655, 98.31922095236769, 98.3173326772212);
		$data['vertices_y'] = $koordinat_y_arr;

		$this->load->view('v_cek_lokasi',$data);
	}
}
