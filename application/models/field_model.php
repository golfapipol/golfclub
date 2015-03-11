<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Field_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	// this version can't upload pic
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($name,$club_id){
		$sql = "INSERT INTO field (field_id,field_name,club_id) 
				VALUE( 0, ? , ?)";
		$this->db->query($sql,array($name,$club_id));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id,$name){
		$sql = "UPDATE field 
				SET field_name = ? 
				WHERE field_id = ?";
		$this->db->query($sql,array($name,$id));
	}
	public function update_par($id,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9){
		$sql = "UPDATE field 
				SET hole1_par = ? , 
					hole2_par = ? , 
					hole3_par = ? , 
					hole4_par = ? , 
					hole5_par = ? , 
					hole6_par = ? , 
					hole7_par = ? , 
					hole8_par = ? , 
					hole9_par = ? 
				WHERE field_id = ?";
		$this->db->query($sql,array($h1,
									$h2,
									$h3,
									$h4,
									$h5,
									$h6,
									$h7,
									$h8,
									$h9,
									$id));
	}
	public function delete($id){
		$sql = "DELETE FROM field 
				WHERE field_id = ?";
		$this->db->query($sql,array($id));
	}
	public function deleteAllField($clubid){
		$sql = "DELETE FROM field 
				WHERE club_id = ?";
		$this->db->query($sql,array($clubid));
	}
	public function getAll(){
		$sql = "SELECT * 
				FROM field";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id){
		$sql = "SELECT * 
				FROM field 
				WHERE field_id = ?";
		$query = $this->db->query($sql,array($id));
		return $query;
	}
	public function getByClub($clubid){
		$sql = "SELECT * 
				FROM field 
				WHERE club_id = ?";
		$query = $this->db->query($sql,array($clubid));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */