<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/core.php");
class Required extends Core {

	/** available
	 * {content}
	 */
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
	}
	
	public function render($view='template/404', $content_data=''){
		if ($this->session->userdata("NowLogIn")):
			parent::render($view, $content_data);
		else:
			redirect('login', 'refresh');
		endif;
	}
	
	public function login ($loginerror = 'ok') {
		$data['loginerror'] = $loginerror;
		$this->load->view('template/login', $data);
	}
	function checkLogin () {
		$this->load->model('user_model');
		$login = $_POST['userid'];
		$password = $_POST['password'];
		$logged_in = $this->user_model->checklogin($login, $password);
		if ($logged_in->num_rows() == 1):
			$user = $logged_in->row_array();
			$this->session->set_userdata("NowLogIn", 1);
			$this->session->set_userdata("UserAccount", $user['user_login']);
			$this->session->set_userdata("UserID", $user['user_id']);
			$this->session->set_userdata("UserName", $user['user_name']);
			$this->session->set_userdata("UserPsCode", $user['user_personcode']);
			$this->session->set_userdata("UserGpID", $user['group_id']);
			$this->session->set_userdata("UserGpName", $user['group_name']);
			redirect('home');
		else:
			redirect('userinfo/login/error', 'refresh');
		endif;
	}
	public function logout() {
		$this->session->unset_userdata("NowLogIn");
		$this->session->unset_userdata("UserAccount");
		$this->session->unset_userdata("UserID");
		$this->session->unset_userdata("UserName");
		$this->session->unset_userdata("UserPsCode");
		$this->session->unset_userdata("UserGpID");			
		$this->session->unset_userdata("UserGpName");
		redirect('userinfo/login','refresh');
	}
	public function change_password() {
		
	}
}

/* End of file required.php */
/* Location: ./application/controllers/required.php */