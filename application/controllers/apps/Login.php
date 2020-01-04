<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
	}
	function index(){
		$this->load->view('apps/login');
	}
	function anti_injection($data){
		$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		//$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}
	function proses(){
		$userName = $this->anti_injection($this->input->post('userName'));
		$userPassword = $this->anti_injection(md5($this->input->post('userPassword')));
		$tahun_anggaran = $this->anti_injection($this->input->post('tahun_anggaran'));
		$arrCek = $this->m_security->login($userName,$userPassword);
		if($arrCek['userStatus']==1){
			$arrUser = $this->m_user->detailUser($arrCek['userID']);
			$a = $this->m_parameter->getParameterArray($arrCek['userGroup'],"user.group");
			$theme=config_item('theme');
			$arrayLogin = array(
				'userID' => $arrUser['userID'], 
				'realName' => $arrUser['realName'], 
				'userName' => $arrUser['userName'], 
				'userPassword' => $userPassword, 
				'userGroup' => $arrUser['userGroup'],
				'userSkpd' => $arrUser['userSkpd'],
				'userGroupStr' => $a['description'],
				'accessDate' => $arrUser['accessDate'],
				'theme' => $theme
			);
			$_SESSION['arrayLogin']=$arrayLogin;
			$arrList = $this->m_akses_group->getfunctionID($_SESSION['arrayLogin']['userGroup']);
			$_SESSION['arrList']=$arrList;
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Berhasil";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$data_set = array(
				'status' => 1,
				'type' => 'text-success',
				'msg' => 'Login berhasil, Mohon tunggu...',
			);
		}else if($arrCek['userStatus']==2){
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Gagal";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);
			$data_info="username Masih Pending Hubungi administrator";
			$data_set = array(
				'status' => 2,
				'type' => 'text-warning',
				'msg' => $data_info,
			);
		}else if($arrCek['userStatus']==3){
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Gagal";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$this->m_log->insert($log);

			$data_info="username Sudah Di Blocked Hubungi administrator";
			$data_set = array(
				'status' => 3,
				'type' => 'text-warning',
				'msg' => $data_info,
			);
			session_destroy();
		}else{
			$ket_log ="Login |";
			$ket_log .="userName : ".$userName." |";
			$ket_log .="Login Gagal";
			$log = datalog(
				'LOGIN',
				''.$ket_log.''
			);
			$data_info="Kombinasi username Atau Pessword Salah";
			$data_set = array(
				'status' => 4,
				'type' => 'text-danger',
				'msg' => $data_info,
			);
			session_destroy();
		}
		echo json_encode($data_set);
	}
	function reset_password(){
		$email = $this->anti_injection($this->input->post('email'));
		$data = $this->m_security->cek_email($email);
		if($data !=0){
			$data_set = $this->send_email($email);
		}else{
			$data_info="Email tidak ditemukan";
			$data_set = array(
				'status' => 4,
				'type' => 'text-danger',
				'msg' => $data_info,
			);
		}
		echo json_encode($data_set);
	}


	function send_email($email){
		$data_info="Email reset sudah dikirim ke email anda";
		$pass_new = generateRandomString(5);
		$message = "Password baru anda adalah <b>".$pass_new."</b>";
		$this->emailSends($message,$email);
		$this->m_security->reset_password(md5($pass_new),$email);
		$data_set = array(
			'status' => 4,
			'type' => 'text-success',
			'msg' => $data_info,
		);
		return $data_set;
	}


	//function emailSends(){
	function emailSends($message,$email){
		$this->load->library('MyPHPMailer');

		//$email = "berkat.junaidi.b@gmail.com";
		//$message ="ingin mengunjungi anda";

		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
		//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		//$mail->Port = 465; // or 587
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->Username = "humbahaskab@gmail.com";
		$mail->Password = "AVENGED7X";
		$mail->setFrom('humbahaskab@gmail.com', 'Admin HumbahasKab');
		$mail->Subject = "Reset Password";
		$mail->Body = $message;
		$mail->AddAddress($email);

		if(!$mail->Send()) {
			//echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
			//echo "Message has been sent";
		}
	}

}