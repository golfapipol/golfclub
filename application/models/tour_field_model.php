<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Tour_field_model extends MyModel {
	public $id;
	public $name;
	
	public $last_insert_id;
	
	public function __construct() {
		parent::__construct();
		
	}
	public function insert($tour_id, $field_id, $field_seq) {
		$sql = "INSERT INTO tour_field (tour_field_id,
										tour_id,
										field_id,
										field_seq,
										hole1_max_groups,
										hole2_max_groups,
										hole3_max_groups,
										hole4_max_groups,
										hole5_max_groups,
										hole6_max_groups,
										hole7_max_groups,
										hole8_max_groups,
										hole9_max_groups) 
						VALUE( 0, ? , ?, ?, 1, 1, 1, 1, 1, 1, 1, 1, 1)";
		$this->db->query($sql, array($tour_id, $field_id, $field_seq));
		$this->last_insert_id = $this->db->insert_id();
	}
	public function delete($id) {
		$sql = "DELETE FROM tour_field 
				WHERE tour_id = ?";
		$this->db->query($sql, array($id));
	}
	public function getByTourId($id) {
		$sql = "SELECT * 
				FROM tour_field 
				INNER JOIN field ON field.field_id = tour_field.field_id 
				WHERE tour_id = ? 
				ORDER BY field_seq";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getByFieldId($id) {
		$sql = "SELECT * 
				FROM tour_field 
				INNER JOIN field ON field.field_id = tour_field.field_id 
				WHERE tour_field_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	public function getFieldCount($tourid) {
		$sql = "SELECT * 
				FROM tour_field 
				INNER JOIN field ON field.field_id = tour_field.field_id 
				WHERE tour_id = ? 
				ORDER BY (field_seq) DESC";
		$query = $this->db->query($sql, array($tourid));
		return $query;
	}
	public function getFirstField($id) {
		$sql = "SELECT * 
				FROM tour_field 
				INNER JOIN field ON field.field_id = tour_field.field_id 
				WHERE tour_id = ? 
				ORDER BY (field_seq)";
		$query = $this->db->query($sql,array($id));
		return $query;
	}
	public function addMaxGroup($field_id,$hole) {
		$sql = "UPDATE tour_field 
				SET hole" . $hole . "_max_groups = (hole" . $hole . "_max_groups+1) 
				WHERE tour_field_id = ?";
		$query = $this->db->query($sql, array($field_id))->row_array();
	}
	public function removeMaxGroup($field_id, $hole) {
		$sql = "UPDATE tour_field 
				SET hole" . $hole . "_max_groups = (hole" . $hole . "_max_groups-1) 
				WHERE tour_field_id = ?";
		$query = $this->db->query($sql, array($field_id))->row_array();
	}
	public function getMaxGroup($field_id, $hole) {
		$sql = "SELECT hole" . $hole . "_max_groups 
				FROM tour_field 
				WHERE tour_field_id = ?";
		$query = $this->db->query($sql, array($field_id))->row_array();
		return $query['hole' . $hole . '_max_groups'];
	}
	public function getMaxGroupScoring($field_seq, $hole, $tourid) {
		$sql = "SELECT hole".$hole."_max_groups 
				FROM tour_field 
				WHERE field_seq = ? 
				AND tour_id = ?";
		$query = $this->db->query($sql, array($field_seq, $tourid))->row_array();
		return $query['hole' . $hole . '_max_groups'];
	}
	public function getFieldByTourId($tourid) {
		$sql ="SELECT * 
				FROM tour_field 
				INNER JOIN field ON tour_field.field_id = field.field_id 
				WHERE tour_id = ? 
				ORDER BY field_seq";
		$query = $this->db->query($sql,array($tourid));
		return $query;
	}
	public function getFieldByIdSeq($tourid, $field_seq) {
		$sql ="SELECT * 
				FROM tour_field 
				INNER JOIN field ON tour_field.field_id = field.field_id 
				WHERE tour_id = ? AND field_seq = ?";
		$query = $this->db->query($sql, array($tourid, $field_seq));
		return $query;
	}
}

/* End of file tour_field_model.php */
/* Location: ./application/models/tour_field_model.php */