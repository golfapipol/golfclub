<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Status_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($name) {
		$sql = "INSERT INTO status (status_id,status_name) 
				VALUE( 0, ? )";
		$this->db->query($sql, array($name));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id, $name) {
		$sql = "UPDATE status 
				SET status_name = ? 
				WHERE status_id = ?";
		$this->db->query($sql, array($name, $id));
	}
	public function delete($id) {
		$sql = "DELETE FROM status 
				WHERE status_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM status";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id) {
		$sql = "SELECT * 
				FROM status 
				WHERE status_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
}

/* End of file status_model.php */
/* Location: ./application/models/status_model.php */