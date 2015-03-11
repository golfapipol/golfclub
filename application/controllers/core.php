<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core extends CI_Controller {

	/** available
	 * {title_head}
	 * {title}
	 * {logo}
	 * {header_profile}
	 * {left_user_panel}
	 * {left_menu}
	 * {content}
	 * {javascript}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('menu_model');
	}
	public function test() {
		$this->render('template/example');
	}
	public function render($view='template/404',$content_data='') {
		$data['title'] = $this->config->item('title');
		$data['logo'] = $this->config->item('logo');
		$data['css'] = $this->css();
		$data['javascript'] = $this->javascript();
		$data['header_profile'] = $this->header_profile();
		$data['left_user_panel'] = $this->left_user_panel();
		$data['left_menu'] = $this->left_menu();
		$data['content'] = $this->load->view($view, $content_data, true);
		$this->parser->parse('template/masterpage', $data);
	}
	function logo() {
		return $this->load->view('template/logo', '', true);
	}
	function css() {
		return $this->load->view('template/css', '', true);
	}
	function javascript() {
		return $this->load->view('template/javascript', '', true);
	}
	function header_profile() {
		
		if ($this->session->userdata('NowLogIn')):
			// Have Login
			return $this->load->view('template/header_profile', '', true);
		else:	
			// Didn't Login
			return $this->load->view('template/header_login', '', true);
		endif;
	}
	function left_menu() {
	//	echo uri_string(current_url());
		$default_actor =0;
		if ($this->session->userdata('NowLogIn')):
			$data['menu'] = $this->menu_model->getMenu($this->session->userdata('UserGpID'));
			return $this->load->view('template/left_menu',$data,true);
		else:
			$data['menu'] = $this->menu_model->getMenu($default_actor);			
			return $this->load->view('template/left_menu',$data,true);
		endif;
	}
	function left_user_panel() {
		if ($this->session->userdata('NowLogIn')):
			return $this->load->view('template/left_user_panel', '', true);
		else:
			return $this->load->view('template/left_login', '', true);
		endif;
	}
	function error404() {
		$this->render('template/error404');
	}
}

/* End of file core.php */
/* Location: ./application/controllers/core.php */