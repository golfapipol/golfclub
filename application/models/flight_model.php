<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Flight_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($name, $start, $end, $type, $tourId) {
		$sql = "INSERT INTO flight (flight_id,
										flight_name,
										flight_startrange,
										flight_endrange,
										flight_type,
										tour_id) 
				VALUE( 0, ?, ?, ?, ?, ?)";
		$this->db->query($sql, array($name, $start, $end, $type, $tourId));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id,$name,$start,$end,$clubId){
		$sql = "UPDATE flight 
				SET flight_name = ?,
					flight_startrange = ?,
					flight_endrange = ?, 
					flight_type = ? 
				WHERE flight_id = ?";
		$this->db->query($sql, array($name,
									$start,
									$end,
									$clubId,
									$id));
	}
	public function delete($id){
		$sql = "DELETE FROM flight WHERE flight_id = ?";
		$this->db->query($sql,array($id));
	}
	public function deleteByTourID($tourid){
		$sql = "DELETE FROM flight WHERE tour_id = ?";
		$this->db->query($sql,array($tourid));
	}
	public function getAll(){
		$sql = "SELECT * FROM flight";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id) {
		$sql = "SELECT * FROM flight where flight = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getByTourId($tourid) {
		$sql = "SELECT * FROM flight where tour_id = ?";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
	public function getMaleFlightByTourId($tourid) {
		$sql = "SELECT * FROM flight where tour_id = ? and flight_type = 1";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
	public function getFemaleFlightByTourId($tourid) {
		$sql = "SELECT * FROM flight where tour_id = ? and flight_type = 2";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
}

/* End of file flight_model.php */
/* Location: ./application/models/flight_model.php */