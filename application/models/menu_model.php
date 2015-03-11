<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Menu_model extends MyModel {
	public $id;
	public $name;
	public $url;
	public $seq;
	public $last_insert_id;
	
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($name, $url) {
		$max = $this->getMaxId();
		$sql = "INSERT INTO menu 
					(menu_id,
					menu_name,
					menu_url,
					menu_seq) 
				VALUE( 0, ? , ?, ?)";
		$this->db->query($sql, array($name, $url,($max + 1)));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id, $name, $url) {
		$sql = "UPDATE menu 
				SET menu_name = ?,
					menu_url = ? 
				WHERE menu_id = ?";
		$this->db->query($sql, array($name, $url, $id));
	}
	public function delete($id) {
		$sql = "DELETE FROM menu 
				WHERE menu_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM menu 
				ORDER BY (menu_seq)";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id){
		$sql = "SELECT * 
				FROM menu 
				WHERE menu_id = ? 
				ORDER BY (menu_seq)";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getMaxId() {
		$sql = "SELECT max(menu_seq) AS maxid 
				FROM menu";
		$query = $this->db->query($sql)->row_array();
		return $query['maxid'];
	}
	public function updateSeq($id, $seq) {
		$sql = "UPDATE menu 
				SET menu_seq = ? 
				WHERE menu_id = ?";
		$this->db->query($sql, array($seq, $id));
	}
	public function getMenu($group) {
		$sql = "SELECT * 
				FROM permission 
				INNER JOIN menu ON permission.menu_id = menu.menu_id 
				WHERE group_id = ? 
				ORDER BY (menu_seq)";
		$query = $this->db->query($sql, array($group));
		return $query;
	}
}

/* End of file group_model.php */
/* Location: ./application/models/group_model.php */