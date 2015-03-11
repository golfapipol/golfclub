<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Group_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($name){
		$sql = "INSERT INTO usergroup (group_id,group_name) VALUE( 0, ?)";
		$this->db->query($sql,array($name));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id,$name){
		$sql = "UPDATE usergroup SET group_name = ? WHERE group_id = ?";
		$this->db->query($sql,array($name,$id));
	}
	public function delete($id){
		$sql = "DELETE FROM usergroup WHERE group_id = ?";
		$this->db->query($sql,array($id));
	}
	public function getAll(){
		$sql = "SELECT * FROM usergroup";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id){
		$sql = "SELECT * FROM usergroup WHERE group_id = ?";
		$query = $this->db->query($sql,array($id));
		return $query;
	}
}

/* End of file group_model.php */
/* Location: ./application/models/group_model.php */