<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Score_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	// this version can't upload pic
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($player_id, $field_id, $h1, $h2, $h3, $h4, $h5, $h6, $h7, $h8, $h9, $gross_score, $tour_id) {
		$sql = "INSERT INTO score 
					(score_id,
					player_id,
					field_id,
					hole1_score,
					hole2_score,
					hole3_score,
					hole4_score,
					hole5_score,
					hole6_score,
					hole7_score,
					hole8_score,
					hole9_score,
					gross_score,
					tour_id) 
				VALUE( 0, ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ?, ?, ?)";
		$this->db->query($sql, array($player_id, $field_id, $h1, $h2, $h3, $h4, $h5, $h6, $h7, $h8, $h9, $gross_score, $tour_id));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($playerid, $fieldid, $h1, $h2, $h3, $h4, $h5, $h6, $h7, $h8, $h9, $gross_score, $tour_id){
		$sql = "UPDATE score 
				SET hole1_score = ? ,
					hole2_score = ? ,
					hole3_score = ? ,
					hole4_score = ? ,
					hole5_score = ? ,
					hole6_score = ? ,
					hole7_score = ? ,
					hole8_score = ? ,
					hole9_score = ? ,
					gross_score = ? 
				WHERE player_id = ? 
				AND field_id = ?
				AND tour_id = ?";
		$this->db->query($sql, array($h1, $h2, $h3, $h4, $h5, $h6, $h7, $h8, $h9, $gross_score, $playerid, $fieldid, $tour_id));
	}
	public function check($playerid, $fieldid){
		$sql = "SELECT * 
				FROM score 
				WHERE player_id = ? 
				AND field_id = ?";
		$query = $this->db->query($sql, array($playerid, $fieldid));
		return $query;
	}
	public function delete($player_id) {
		$sql = "DELETE FROM score WHERE player_id = ?";
		$this->db->query($sql,array($player_id));
	}
	
	public function getTopTenScore($tour_id) {
		$sql = "SELECT score.player_id, player_name, player_age, player_sex, player_hc, SUM( gross_score ) as total_score, null as hole_left, IFNULL(team_name,'-') as team_name
				FROM  score 
				INNER JOIN tour_player ON score.player_id = tour_player.player_id 
				LEFT JOIN tour_team ON tour_player.team_id = tour_team.team_id
				WHERE score.tour_id = ?
				GROUP BY (score.player_id) 
				ORDER BY (total_score)
				Limit 10";
		$query = $this->db->query($sql, array($tour_id));
		return $query;
	}
	public function countHoleLeft($player_id) {
		$sql = "SELECT *
				FROM score
				WHERE player_id = ?";
		$query = $this->db->query($sql, array($player_id));
		return $query;
	}
	public function getPlayerScore($tour_id) {
		$sql = "SELECT score.player_id, player_name, SUM( gross_score ) as total_score, tour_team.team_id as team_id,IFNULL(team_name,'-') as team_name
				FROM  score 
				INNER JOIN tour_player ON score.player_id = tour_player.player_id 
				LEFT JOIN tour_team ON tour_player.team_id = tour_team.team_id
				WHERE score.tour_id = ?
				GROUP BY (score.player_id) 
				ORDER BY team_id,total_score desc ";
		$query = $this->db->query($sql, array($tour_id));
		return $query;
	}
	public function getTeamScore($tour_id) {
		$sql = "SELECT *, SUM(total_score) as team_score
				FROM (
					SELECT score.player_id, player_name, SUM( gross_score ) as total_score, tour_team.team_id as team_id,IFNULL(team_name,'-') as team_name
					FROM  score 
					INNER JOIN tour_player ON score.player_id = tour_player.player_id 
					LEFT JOIN tour_team ON tour_player.team_id = tour_team.team_id
					WHERE score.tour_id = ?
					GROUP BY (score.player_id) 
				) as players_score
				GROUP BY (team_id)
				ORDER BY (team_score) desc";
		$query = $this->db->query($sql, array($tour_id));
		return $query;
	}
	public function getByPlayerID($player_id) {
		$sql = "SELECT hole1_score, hole2_score, 
						hole3_score, hole4_score, hole5_score, 
						hole6_score, hole7_score, hole8_score, hole9_score
				FROM score
				WHERE score.player_id = ?
				ORDER BY score_id";
		$query = $this->db->query($sql, array($player_id));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */