<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Club_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	// this version can't upload pic
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($name, $zone_id) {
		$sql = "INSERT INTO club (club_id,club_name,zone_id) 
				VALUE( 0, ? , ?)";
		$this->db->query($sql,array($name, $zone_id));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id, $name, $zone_id) {
		$sql = "UPDATE club 
				SET club_name = ?, 
					zone_id = ? 
				WHERE club_id = ?";
		$this->db->query($sql,array($name, $zone_id, $id));
	}
	public function update_information($id, $address = '', $website = '', $tel = '', $fax = '', $desc = '') {
		$sql = "UPDATE club 
				SET club_address = ?, 
					club_website = ?, 
					club_tel = ?,
					club_fax = ? , 
					club_desc = ? 
				WHERE club_id = ?";
		$this->db->query($sql,array($address, 
									$website, 
									$tel, 
									$fax, 
									$desc, 
									$id));
	}
	public function update_pic($id, $picid) {
		
	}
	public function delete($id) {
		$sql = "DELETE FROM club 
				WHERE club_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM club 
				INNER JOIN zone ON zone.zone_id = club.zone_id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getSelect(){
		$sql = "SELECT club_id, club_name 
				FROM club ";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id){
		$sql = "SELECT * 
				FROM club 
				INNER JOIN zone ON zone.zone_id = club.zone_id 
				WHERE club_id = ?";
		$query = $this->db->query($sql,array($id));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */