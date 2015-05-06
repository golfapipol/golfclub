<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Pairing_model extends MyModel {
	public $id;
	public $name;
	public $sex;
	
	public $last_insert_id;
	
	public function __construct(){
		parent::__construct();
		
	}
	public function insert($hole,$group,$player_id,$field_id,$tour_id){
		$sql = "INSERT INTO pairing(pairing_id,
									hole,
									pairing.group,
									player_id,
									field_id,
									tour_id) 
				VALUE( 0, ? , ? , ? , ? , ?)";
		$this->db->query($sql,array($hole,
									$group,
									$player_id,
									$field_id,
									$tour_id));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function delete($pairing_id){
		$sql = "DELETE FROM pairing WHERE pairing_id = ?";
		$this->db->query($sql,array($pairing_id));
	}
	public function deleteByPlayerID($player_id){
		$sql = "DELETE FROM pairing WHERE player_id = ?";
		$this->db->query($sql,array($player_id));
	}
	public function removeFromGroup($max_group,
									$hole,
									$field_id,
									$tour_id){
		$sql = "DELETE FROM pairing 
				WHERE pairing.group = ? 
				AND hole = ? 
				AND field_id = ? 
				AND tour_id = ?";
		$this->db->query($sql,array($max_group,
									$hole,
									$field_id,
									$tour_id));
	}
	public function getPairingScore($hole, $group, $field_seq, $tourid) {
		$sql = "SELECT * 
				FROM pairing 
				INNER JOIN tour_player ON tour_player.player_id = pairing.player_id
				INNER JOIN tour_field ON tour_field.tour_field_id = pairing.field_id 
				WHERE hole = ? 
				AND pairing.group = ? 
				AND field_seq = ? 
				AND tour_player.tour_id = ?";
		$query = $this->db->query($sql,array($hole,
											$group,
											$field_seq,
											$tourid));
		return $query;
	}
	public function getPairing($hole, $group, $field_id, $tourid) {
		$sql = "SELECT * 
				FROM pairing 
				INNER JOIN tour_player ON tour_player.player_id = pairing.player_id
				INNER JOIN tour_field ON tour_field.tour_field_id = pairing.field_id 
				WHERE hole = ? 
				AND pairing.group = ? 
				AND pairing.field_id = ? 
				AND tour_player.tour_id = ?";
		$query = $this->db->query($sql, array($hole, 
											$group, 
											$field_id, 
											$tourid));
		return $query;
	}
	public function getPairingFromTourId($tourid) {
		$sql = "SELECT * 
				FROM pairing 
				WHERE pairing.tour_id = ?";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
	public function getPlayerOrderByHoleSeq($tour_id) {
		$sql = "SELECT pairing.player_id, player_name, player_sex, player_hc, player_age, field_seq, hole, pairing.group
				FROM pairing
				INNER JOIN tour_player
				ON pairing.player_id = tour_player.player_id
				INNER JOIN tour_field
				ON pairing.field_id = tour_field.tour_field_id
				WHERE pairing.tour_id = ?
				ORDER BY field_seq, hole, pairing.group";
		$query = $this->db->query($sql, array($tour_id));
		return $query;
	}
}

/* End of file Prefix_model.php */
/* Location: ./application/models/Prefix_model.php */