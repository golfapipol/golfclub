<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Prefix_model extends MyModel {
	public $id;
	public $name;
	public $sex;
	
	public $last_insert_id;
	
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($name, $sex){
		$sql = "INSERT INTO prefix (prefix_id, prefix_name, prefix_sex) 
				VALUE( 0, ? , ?)";
		$this->db->query($sql,array($name,$sex));
	}
	public function update($id, $name, $sex){
		$sql = "UPDATE prefix 
				SET prefix_name = ? , 
					prefix_sex = ? 
				WHERE prefix_id = ?";
		$this->db->query($sql,array($name,$sex,$id));
	}
	public function delete($id) {
		$sql = "DELETE FROM prefix 
				WHERE prefix_id = ?";
		$this->db->query($sql, array($id));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM prefix";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id) {
		$sql = "SELECT * 
				FROM prefix 
				WHERE prefix_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
}

/* End of file Prefix_model.php */
/* Location: ./application/models/Prefix_model.php */