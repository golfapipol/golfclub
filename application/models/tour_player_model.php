<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Tour_player_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($player_name, $player_age, $player_sex, $player_hc, $member_id, $team_id, $tour_id) {
		$sql = "INSERT INTO tour_player 
					(player_id,
					player_name,
					player_age,
					player_sex,
					player_hc,
					member_player_id,
					team_id,
					tour_id) 
				VALUE( 0, ? , ? , ? , ? , ? , ? , ?)";
		$this->db->query($sql, array($player_name,
									$player_age,
									$player_sex,
									$player_hc,
									$member_id,
									$team_id,
									$tour_id));
		$this->last_insert_id = $this->db->insert_id();
		return $this->last_insert_id;
	}
	public function delete($id) {
		$sql = "DELETE FROM tour_player 
				WHERE player_id = ?";
		$this->db->query($sql, array($id));
	}
	public function deleteByTeam($id) {
		$sql = "DELETE FROM tour_player 
				WHERE team_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * FROM tour_player";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByTeamId($teamid) {
		$sql = "SELECT * 
				FROM tour_player 
				WHERE team_id = ? ";
		$query = $this->db->query($sql, array($teamid));
		return $query;
	}
	public function pairing($tour_id) {
		$sql = "SELECT * FROM tour_player 
		WHERE tour_id = ? 
		AND player_id not in (SELECT player_id 
							FROM pairing 
							WHERE tour_id = ? )";
		$query = $this->db->query($sql, array($tour_id, $tour_id));
		return $query;
	}
	public function pairingHoleGroup($tour_id) {
		$sql = "SELECT * FROM tour_player
		INNER JOIN pairing ON tour_player.player_id = pairing.player_id
		LEFT JOIN tour_team ON tour_team.team_id = tour_player.team_id
		WHERE tour_player.tour_id = ?
		ORDER BY pairing.hole, pairing.group";
		$query = $this->db->query($sql, array($tour_id, $tour_id));
		return $query;
	}
	public function getByTourIdSingle($id) {
		$sql = "SELECT * 
				FROM tour_player 
				WHERE tour_id = ? 
				AND team_id = 0";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getByTourId($id) {
		$sql = "SELECT * 
				FROM tour_player 
				WHERE tour_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getScoreCard($player_id, $field_id) {
		$sql = "SELECT * 
				FROM tour_player 
				LEFT JOIN score ON tour_player.player_id = score.player_id 
				WHERE tour_player.player_id = ? 
				AND score.field_id = ?";
		$query = $this->db->query($sql, array($player_id, $field_id));
		return $query;
	}
	public function getScoreCardByMemberId($player_id, $field_id, $tour_id) {
		$sql = "SELECT * 
				FROM tour_player 
				LEFT JOIN score ON tour_player.player_id = score.player_id 
				WHERE tour_player.tour_id = ?
				AND tour_player.member_player_id = ? 
				AND score.field_id = ?";
		$query = $this->db->query($sql, array($tour_id, $player_id, $field_id));
		return $query;
	}
	public function getScoreCardByPlayerId($player_id, $field_id, $tour_id) {
		$sql = "SELECT * 
				FROM tour_player 
				LEFT JOIN score ON tour_player.player_id = score.player_id 
				WHERE tour_player.tour_id = ?
				AND tour_player.player_id = ? 
				AND score.field_id = ?";
		$query = $this->db->query($sql, array($tour_id, $player_id, $field_id));
		return $query;
	}
	public function getPlayerByTourId($member, $id) {
		$sql = "SELECT * 
				FROM tour_player 
				WHERE tour_id = ?
				AND member_player_id = ?";
		$query = $this->db->query($sql, array($id, $member));
		return $query;
	}
	public function getPlayer($playerid, $id) {
		$sql = "SELECT * 
				FROM tour_player
				INNER JOIN score
				ON tour_player.player_id = score.player_id
				WHERE tour_player.tour_id = ?
				AND tour_player.player_id = ?";
		$query = $this->db->query($sql, array($id, $playerid));
		return $query;
	}
	public function getPlayerByTeamId($id) {
		$sql = "SELECT * , sum(gross_score) as gross_score
				FROM tour_player
				INNER JOIN score
				ON tour_player.player_id = score.player_id
				WHERE team_id = ?
				GROUP BY score.player_id
				HAVING sum(gross_score) > 0
				ORDER BY sum(gross_score)";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getPlayerNotSubmitScoreByTeamId($id){
		$sql = "SELECT * , sum(gross_score) as gross_score
				FROM tour_player
				INNER JOIN score
				ON tour_player.player_id = score.player_id
				WHERE team_id = ?
				GROUP BY score.player_id
				HAVING sum(gross_score) = 0";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */