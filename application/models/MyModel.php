<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyModel extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function check(){
		$this->db->query("SELECT * FROM flight");
	}
}

/* End of file MyModel.php */
/* Location: ./application/models/MyModel.php */