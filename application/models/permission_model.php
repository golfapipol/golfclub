<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Permission_model extends MyModel {
	public $id;
	public $menuid;
	public $groupid;
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($menu, $group) {
		$sql = "INSERT INTO permission 
					(permission_id, group_id, menu_id) 
				VALUE( 0, ? , ?)";
		$this->db->query($sql, array($group, $menu));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function delete($menu, $group) {
		$sql = "DELETE FROM permission 
				WHERE menu_id = ? 
				AND group_id = ?";
		$this->db->query($sql, array($menu, $group));
	}
	public function getAll() {
		$sql = "SELECT * FROM permission ";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($groupid) {
		$sql = "SELECT * FROM permission 
				WHERE group_id = ?";
		$query = $this->db->query($sql, array($groupid));
		return $query;
	}
	public function checkPermission($menu, $group) {
		$sql = "SELECT * 
				FROM permission 
				WHERE menu_id = ? 
				AND group_id = ?";
		$query = $this->db->query($sql, array($menu, $group));
		return $query;
	}
}

/* End of file group_model.php */
/* Location: ./application/models/group_model.php */