<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Player_info_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($player_id, $info_tel, $info_address, $info_province_id, $info_amphur_id, $info_district_id) {
		$sql = "INSERT INTO player_info 
					(info_id,
					player_id,info_tel,info_address,info_province_id,info_amphur_id,info_district_id) VALUE( 0, ? , ?,?,?,?,?)";
		$this->db->query($sql,array($player_id,
									$info_tel,
									$info_address,
									$info_province_id,
									$info_amphur_id,
									$info_district_id));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($player_id, $info_tel, $info_address, $info_province_id, $info_amphur_id, $info_district_id) {
		$sql = "UPDATE player_info 
				SET info_tel = ? , 
					info_address = ?, 
					info_province_id = ? ,
					info_amphur_id = ? ,
					info_district_id = ?  
				WHERE player_id = ?";
		$this->db->query($sql,array($info_tel,
									$info_address,
									$info_province_id,
									$info_amphur_id,
									$info_district_id,
									$player_id));
	}
	public function delete($id) {
		$sql = "DELETE FROM player_info 
				WHERE player_id = ?";
		$this->db->query($sql, array($id));
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */