<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class Player_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($player_name, $player_sex, $player_birthdate, $player_last_hc, $prefix_id, $status_id) {
		$sql = "INSERT INTO player (player_id,
									player_name,
									player_sex,
									player_birthdate,
									player_last_hc,
									prefix_id,
									status_id) 
					VALUE( 0, ? , ? , ? , ? , ? , ?)";
		$this->db->query($sql, array($player_name,
									$player_sex,
									$player_birthdate,
									$player_last_hc,
									$prefix_id,
									$status_id));
		$this->last_insert_id = $this->db->insert_id();
		return $this->last_insert_id;
	}
	public function update($id, $player_name, $player_sex, $player_birthdate, $player_last_hc, $prefix_id, $status_id) {
		$sql = "UPDATE player 
				SET player_name = ? , 
					player_sex = ? , 
					player_birthdate = ?, 
					player_last_hc = ?, 
					prefix_id = ?, 
					status_id = ? 
				WHERE player_id = ?";
		$this->db->query($sql, array($player_name, 
									$player_sex, 
									$player_birthdate, 
									$player_last_hc, 
									$prefix_id, 
									$status_id,
									$id));
	}
	public function updateHC($id,$hc) {
		$sql = "UPDATE player 
				SET player_last_hc = ? 
				WHERE player_id = ?";
		$this->db->query($sql, array($hc, $id));
	}
	public function delete($id) {
		$sql = "DELETE FROM player 
				WHERE player_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM player 
				INNER JOIN player_info ON player.player_id = player_info.player_id 
				INNER JOIN status ON status.status_id = player.status_id 
				INNER JOIN prefix ON player.prefix_id = prefix.prefix_id 
				ORDER BY (player.player_id)";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id) {
		$sql = "SELECT * 
				FROM player 
				INNER JOIN player_info ON player.player_id = player_info.player_id 
				INNER JOIN status ON status.status_id = player.status_id 
				INNER JOIN prefix ON player.prefix_id = prefix.prefix_id
				WHERE player.player_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getMember($tourid) {
		$sql = "SELECT * 
				FROM player 
				WHERE player.player_id not in (SELECT member_player_id 
												FROM tour_player 
												WHERE tour_id = ? )";
		$query = $this->db->query($sql,array($tourid));
		return $query;
	}
	public function import($id, $player_name, $player_sex, $player_birthdate, $player_last_hc, $prefix_id, $status_id) {
		$sql = "INSERT INTO player (player_id,
									player_name,
									player_sex,
									player_birthdate,
									player_last_hc,
									prefix_id,
									status_id) 
					VALUE( ?, ? , ? , ? , ? , ? , ?)";
		$this->db->query($sql, array($id,
									$player_name,
									$player_sex,
									$player_birthdate,
									$player_last_hc,
									$prefix_id,
									$status_id));
		$this->last_insert_id = $this->db->insert_id();
		return $this->last_insert_id;
	}
	public function getHistory($member_id) {
		$sql = "SELECT player_hc, SUM( gross_score ) as total_score, tour_name
				FROM  score 
				INNER JOIN tour_player ON score.player_id = tour_player.player_id
				INNER JOIN tournament ON tournament.tour_id = score.tour_id
				INNER JOIN player ON player.player_id = tour_player.member_player_id
				WHERE player.player_id = ?
				GROUP BY (score.player_id) 
				ORDER BY (tournament.tour_id)";
				
		$query = $this->db->query($sql, array($member_id));
		return $query;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */