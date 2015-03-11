<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Zone_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($name) {
		$sql = "INSERT INTO zone (zone_id, zone_name) 
				value( 0, ? )";
		$this->db->query($sql, array($name));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id, $name) {
		$sql = "UPDATE zone 
				SET zone_name = ? 
				WHERE zone_id = ?";
		$this->db->query($sql, array($name, $id));
	}
	public function delete($id) {
		$sql = "DELETE FROM zone 
				WHERE zone_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM zone";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id) {
		$sql = "SELECT * 
				FROM zone 
				WHERE zone_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */