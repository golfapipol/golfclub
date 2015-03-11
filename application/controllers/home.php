<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Home extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
	}
	public function index() {
		$this->render('template/home');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */