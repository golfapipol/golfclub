<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/required.php");
class Userinfo extends Required {

	/** available
	 * {content}
	 */
	public function __construct(){
		//call parent::__construct() for use $this->load
		parent::__construct();
	}
	
	public function change_password() {
		
	}
}

/* End of file controlpanel.php */
/* Location: ./application/controllers/controlpanel.php */