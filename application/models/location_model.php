<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Location_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function getProvince() {
		$sql = "SELECT * 
				FROM province";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAmphur($provinceid) {
		$sql = "SELECT * 
				FROM amphur 
				WHERE provinceId = ?";
		$query = $this->db->query($sql,array($provinceid));
		return $query;
	}
	public function getDistrict($amphurid) {
		$sql = "SELECT * 
				FROM district 
				WHERE amphurId = ?";
		$query = $this->db->query($sql, array($amphurid));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */