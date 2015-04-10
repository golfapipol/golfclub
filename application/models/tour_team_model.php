<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Tour_team_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($team_name, $tour_id) {
		$sql = "INSERT INTO tour_team (team_id,team_name,tournament_tour_id) VALUE( 0,  ? , ?)";
		$this->db->query($sql,array($team_name, $tour_id));
		$this->last_insert_id = $this->db->insert_id();
		return $this->last_insert_id;
	}
	public function update($team_name, $team_id) {
		$sql = "UPDATE tour_team SET team_name = ? WHERE team_id = ?";
		$this->db->query($sql, array($team_name, $team_id));
	}
	public function delete($id) {
		$sql = "DELETE FROM tour_team WHERE team_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * FROM tour_team";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByTourId($tourid) {
		$sql = "SELECT * FROM tour_team 
		WHERE tournament_tour_id = ? ";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
	public function getByTourIdWithTeamScore($tourid) {
		$sql = "SELECT *, null as team_score FROM tour_team 
		WHERE tournament_tour_id = ? ";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
	
	public function getByTeamId($teamid) {
		$sql = "SELECT * FROM tour_team 
		WHERE team_id = ? ";
		$query = $this->db->query($sql, array($teamid));
		return $query;
	}
	public function getPairingScoreByTeamId($teamid) {
		$sql = "SELECT * FROM tour_team INNER JOIN tour_player ON tour_player.team_id = tour_team.team_id
		 where tour_team.team_id = ? ";
		$query = $this->db->query($sql, array($teamid));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */