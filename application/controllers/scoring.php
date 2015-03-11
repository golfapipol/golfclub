<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/core.php");
class Scoring extends Core {

	/** available
	 * {content}
	 */
	public function __construct () {
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('club_model');
		$this->load->model('field_model');
		$this->load->model('player_model');
		$this->load->model('tournament_model');
		$this->load->model('tour_field_model');
		$this->load->model('tour_player_model');
		$this->load->model('tour_team_model');
		$this->load->model('pairing_model');
		$this->load->model('score_model');
	}
	public function scorekeeper ($id) {
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$data['team_data'] = $this->tour_team_model->getByTourId($id);
		$data['maxhole'] = $this->tour_field_model->getFieldCount($id)->row_array();
		$data['field_data'] = $this->tour_field_model->getFieldCount($id);
		$data['pairing_data'] = $this->pairing_model->getPairingFromTourId($id);
		$this->render('scoring/scoring', $data);
	}
	public function livescore ($id) {
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$this->render('scoring/livescore', $data);
	}
	public function manualscore($id){
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$this->render('scoring/manualscore', $data);
	}
	public function getPlayer ($holeNo, $group, $tourid) {
		$field = ((int) ($holeNo / 9)) + 1;
		$hole = $holeNo % 9;
		$player_list = $this->pairing_model->getPairingScore($hole, $group, $field, $tourid);
		header ('Content-type: text/html; charset=utf-8');
		if($player_list->num_rows() > 0) :
			echo '<li class="header">ผู้เข้าแข่งขัน</li>';
			foreach($player_list->result_array() as $row):
				if ($row['player_sex'] == 1) :
					echo '<li><a onclick="getcard('.$row['player_id'].', this)" value="'.$row['player_id'].'"><i class="fa fa-fw big male">&#9794; </i>'.$row['player_name'].'</a></li>';
				else :
					echo '<li><a onclick="getcard('.$row['player_id'].', this)" value="'.$row['player_id'].'"><i class="fa fa-fw big female">&#9792; </i>'.$row['player_name'].'</a></li>';
				endif;
			endforeach;
		else ://
		endif;
	}
	public function getScoreCard ($playerid, $tourid) {
		$field_data = $this->tour_field_model->getFieldByTourId($tourid);
		
		header ('Content-type: text/html; charset=utf-8');
		echo '<form role="form" id="scorecard-form">';
		echo '<input type="hidden" name="playerid" value="' . $playerid . '"/>';
		echo '<div class="box-header"><h3 class="box-title">บันทึกคะแนน</h3><div class="box-tools pull-right">';
		echo '<ul class="nav nav-tabs">';
		if($field_data->num_rows() > 0):
			foreach($field_data->result_array() as $row):
				if ($row['field_seq'] == 1) : echo '<li class="active"><a href="#' . $row['field_seq'] . '" data-toggle="tab">1-9</a></li>';
				else : echo '<li><a href="#' . $row['field_seq'] . '" data-toggle="tab">' . (($row['field_seq'] - 1) * 9 + 1) . "-".(($row['field_seq'] - 1) * 9 + 9) . '</a></li>';
				endif;
			endforeach;
		endif;
		echo '</ul></div></div><div class="box-body "><div class="tab-content no-padding">';
		if ($field_data->num_rows() > 0) :
			foreach ($field_data->result_array() as $row):
				if ($row['field_seq'] == 1): 
					echo '<div class="tab-pane active" id="' . $row['field_seq'] . '"><table class="table table-bordered" >';
				else : 
					echo '<div class="tab-pane" id="' . $row['field_seq'] . '"><table class="table table-bordered" >';
				endif;
				echo '<thead style="background-color:#3c8dbc"><tr ><th style="width:15%">หลุม</th>';
				for($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq'])*9); $i++):
					echo '<th style="width:7%">' . $i . '</th>'; 
				endfor;
				echo '<th style="width:15%">รวม</th></tr></thead><tbody><tr><td>Par</td>';
				for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
					$holeNo = $i % 9;
					if ($holeNo == 0) :
						echo '<td class="hole_par">' . $row['hole9_par'] . '</td>'; 
					else :
						echo '<td class="hole_par">' . $row['hole' . $holeNo . '_par'] . '</td>'; 
					endif;
				endfor;
				echo '<td class="gross_par"></td></tr><tr><td>คะแนนที่ตี</td>';
				$scorecard_data = $this->tour_player_model->getScoreCard($playerid, $row['field_id']);
				if ($scorecard_data->num_rows > 0):
					$scorecard = $scorecard_data->row_array();
					for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
						$holeNo = $i % 9;
						if ($holeNo == 0) :
							echo '<td><input class="form-control number-input" type="text" name="hole_' . $i . '_score" value="' . $scorecard['hole9_score'] . '" /></td>';
						else:
							echo '<td><input class="form-control number-input" type="text" name="hole_' . $i . '_score" value="' . $scorecard['hole' . $holeNo . '_score'] . '" /></td>';
						endif;
					endfor;
					echo '<td><p class="sum"></p></td>';
				else:
					for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
						$holeNo = $i % 9;
						if ($holeNo == 0) :
							echo '<td><input type="text" name="hole_' . $i . '_score" /></td>';
						else :
							echo '<td><input type="text" name="hole_' . $i . '_score" /></td>';
						endif;
					endfor;
					echo '<td><p class="sum"></p></td>';
				endif;
				echo '</tr></tbody></table></div>';
			endforeach;
			echo '</div></div><!-- /.box-body -->';
			echo '<div class="box-footer clearfix no-border">';
			echo '<button type="button" onclick="submitScore()" class="btn btn-success pull-right" >บันทึก</button></div></form>';
		endif;
	}
	public function score_control ($action, $tourid) {
		switch($action){
			case 1:// get groups number
				$holeNo = $_POST['hole'];
				$field = ((int) ($holeNo / 9)) + 1;
				$hole = $holeNo % 9;
				$group = $this->tour_field_model->getMaxGroupScoring($field, $hole, $tourid);
				header ('Content-type: text/html; charset=utf-8');
				echo $group;
				break;
			case 2: // search by team
				$teamid = $_POST['teamid'];
				$player_list = $this->tour_team_model->getPairingScoreByTeamId($teamid);
				header ('Content-type: text/html; charset=utf-8');
				if ($player_list->num_rows() > 0):
					echo '<li class="header">ผู้เข้าแข่งขัน</li>';
					foreach ($player_list->result_array() as $row):
						if ($row['player_sex'] == 1) :
							echo '<li><a onclick="getcard(' . $row['player_id'] . ', this)" value="' . $row['player_id'] . '"><i class="fa fa-fw big male">&#9794; </i>' . $row['player_name'] . '</a></li>';
						else:
							echo '<li><a onclick="getcard(' . $row['player_id'] . ', this)" value="' . $row['player_id'] . '"><i class="fa fa-fw big female">&#9792; </i>' . $row['player_name'] . '</a></li>';
						endif;
					endforeach;
				else://
				endif;
				break;
			case 3:// submit score player
				$maxhole = $this->tour_field_model->getFieldCount($tourid)->row_array()['field_seq'];
				$player_id = $_POST['playerid'];
				$field_seq = 1;
				for ($i=9 ; $i <= ($maxhole*9) ; $i += 9):
					// insert 
					$field =  $this->tour_field_model->getFieldByIdSeq($tourid,$field_seq)->row_array();
					$check = $this->score_model->check($player_id,$field['field_id']);
					$h1 = $_POST['hole_'.($i-8).'_score'];	$h2 = $_POST['hole_'.($i-7).'_score'];
					$h3 = $_POST['hole_'.($i-6).'_score'];	$h4 = $_POST['hole_'.($i-5).'_score'];
					$h5 = $_POST['hole_'.($i-4).'_score'];	$h6 = $_POST['hole_'.($i-3).'_score'];
					$h7 = $_POST['hole_'.($i-2).'_score'];	$h8 = $_POST['hole_'.($i-1).'_score'];
					$h9 = $_POST['hole_'.($i).'_score']; $gross = $h1+$h2+$h3+$h4+$h5+$h6+$h7+$h8+$h9;
					if($check->num_rows() > 0): // check it have record yet? and update
						$this->score_model->update($player_id,$field['field_id'],$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$gross);
					else: // or insert
						$this->score_model->insert($player_id,$field['field_id'],$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$gross);
					endif;
					$field_seq++;
				endfor;
			/*
				
			*/
				break;
			case 4:// generate excel
				break;
			case 5:// import excel
				break;
		}
	}	
}

/* End of file Scoring.php */
/* Location: ./application/controllers/Scoring.php */