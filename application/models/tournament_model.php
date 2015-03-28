<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Tournament_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($name, $start, $end, $clubId) {
		$sql = "INSERT INTO tournament (tour_id,
										tour_name,
										tour_startdate,
										tour_enddate,
										club_id) 
				VALUE( 0, ?, ?, ?, ? )";
		$this->db->query($sql, array($name, $start, $end, $clubId));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id,$name,$start,$end,$clubId){
		$sql = "UPDATE tournament 
				SET tour_name = ?,
					tour_startdate = ?,
					tour_enddate = ?, 
					club_id = ? 
				WHERE tour_id = ?";
		$this->db->query($sql, array($name,
									$start,
									$end,
									$clubId,
									$id));
	}
	public function delete($id){
		$sql = "DELETE FROM tournament WHERE tour_id = ?";
		$this->db->query($sql,array($id));
	}
	public function getAll(){
		$sql = "SELECT * FROM tournament";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id){
		$sql = "SELECT * 
				FROM tournament 
				INNER JOIN club ON club.club_id = tournament.club_id 
				WHERE tour_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function update_config($tour_id, $scoreType, $scoregroup, $flightType) {
		$sql = "UPDATE tournament 
				SET tour_scoretype = ?,
					tour_scoregroup = ?,
					tour_flightdivide = ?
				WHERE tour_id = ?";
		$this->db->query($sql, array($scoreType,
									$scoregroup,
									$flightType,
									$tour_id));
	}
}

/* End of file tournament_model.php */
/* Location: ./application/models/tournament_model.php */