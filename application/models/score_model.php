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
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */