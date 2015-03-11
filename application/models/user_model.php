<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/MyModel.php");
class User_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($name,$login,$pass,$pscode,$group) {
		$sql = "INSERT INTO user (user_id,
								user_name,
								user_login,
								user_password,
								user_personcode,
								group_id) 
				VALUE( 0, ?, ?, ?, ?, ?)";
		$this->db->query($sql, array($name,
									$login,
									md5("O]O" . $pass . "O[O"),
									$pscode,
									$group));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function update($id, $name, $login, $pass = '', $pscode, $group) {
		if ($pass == ""):
			$sql = "UPDATE user 
					SET user_name = ?,
						user_login = ?,
						user_personcode = ?,
						group_id = ? 
					WHERE user_id = ?";
			$this->db->query($sql, array($name,
										$login,
										$pscode,
										$group,
										$id));
		else:
			$sql = "UPDATE user 
					SET user_name = ?,
						user_login = ?,
						user_password  = ?,
						user_personcode  = ?,
						group_id = ? 
					WHERE user_id = ?";
			$this->db->query($sql, array($name,
										$login,
										md5("O]O" . $pass . "O[O"),
										$pscode,
										$group,
										$id));
		endif;
	}
	
	public function delete($id) {
		$sql = "DELETE FROM user 
				WHERE user_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getAll() {
		$sql = "SELECT * 
				FROM user";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getById($id) {
		$sql = "SELECT * 
				FROM user 
				INNER JOIN usergroup ON user.group_id = usergroup.group_id 
				WHERE user_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getAllWithGroup(){
		$sql = "SELECT * 
				FROM user 
				INNER JOIN usergroup ON user.group_id = usergroup.group_id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function checklogin($login, $pass){
		$sql = "SELECT * 
				FROM user 
				INNER JOIN usergroup ON user.group_id = usergroup.group_id WHERE user.user_login = ? and user.user_password = ?";
		$query = $this->db->query($sql, array($login, md5("O]O" . $pass . "O[O")));
		return $query;
	}	
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */