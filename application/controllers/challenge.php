<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/required.php");
class Challenge extends Required {

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
		$this->load->model('format_time_model');
		
	}
	public function index() {
		$data['tournament_data'] = $this->tournament_model->getAll();
		$data['chosen_club'] = $this->club_model->getSelect();
		$this->render('challenge/challenges',$data);
	}
	public function tourinfo($id) {
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$data['tournament_data']['tour_startdate'] = $this->format_time_model->formatToText($data['tournament_data']['tour_startdate']);
		$data['tournament_data']['tour_enddate'] = $this->format_time_model->formatToText($data['tournament_data']['tour_enddate']);
		$data['field_data'] = $this->field_model->getByClub($data['tournament_data']['club_id']);
		$data['tour_field_data'] = $this->tour_field_model->getByTourId($data['tournament_data']['tour_id']);
		$data['pairing_data'] = $this->pairing_model->getPairingFromTourId($data['tournament_data']['tour_id'])->num_rows();
		$this->render('challenge/tourinfo',$data);
	}
	public function player($id) {
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$data['player_single_data'] = $this->tour_player_model->getByTourIdSingle($id);
		$data['player_member_data'] = $this->player_model->getMember($id);
		$data['team_data'] = $this->tour_team_model->getByTourId($id);
		$this->render('challenge/player', $data);
	}
	public function pairing($id) {
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$data['player_data'] = $this->tour_player_model->pairing($id);
		$data['field_data'] = $this->tour_field_model->getFieldCount($id);
		$data['hole_data'] = $this->tour_field_model->getFirstField($id)->row_array();
		$data['team_data'] = $this->tour_team_model->getByTourId($id);
		$this->render('challenge/pairing', $data);
	}
	public function pairing_control($action=0, $tourid=0){
		switch($action){
			case 0: // get table pairing
				$hole = $_POST['No_Hole'];
				$group = $_POST['No_Group'];
				$field_id = $_POST['No_Field'];
				$player_data = $this->pairing_model->getPairing($hole, 
																$group, 
																$field_id, 
																$tourid);
				header ('Content-type: text/html; charset=utf-8');
				if ($player_data->num_rows() > 0):
					foreach ($player_data->result_array() as $row ):
						echo '<tr><td>' . $row['player_name'] . '</td>';
						echo '<td>' . $row['player_age'] . '</td>';
						echo '<td>' . $row['player_hc'] . '</td>';
						echo '<td>';
						if ($row['player_sex'] == 1): //male
							echo '<i class="fa fa-fw big male">&#9794; </i><p style="display:none">M</p>';
						else: //female
							echo '<i class="fa fa-fw big female">&#9792; </i><p style="display:none">F</p>';
						endif;
						echo '</td><td><button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="ลบ" onclick="remove_list(this)" value="' . $row['pairing_id'] . '"><i class="fa fa-times"></i></button></td></tr>';
					endforeach;
				endif;
				break;
			case 1: // insert people to table
				$player_id = $_POST['playerId'];
				$hole = $_POST['No_Hole'];
				$group = $_POST['No_Group'];
				$field_id = $_POST['No_Field'];
				$this->pairing_model->insert($hole, 
											$group, 
											$player_id, 
											$field_id, 
											$tourid);
				break;
			case 2: // remove people off table
				$pairing_id = $_POST['InputId'];
				$this->pairing_model->delete($pairing_id);
				break;
			case 3: // getHole
				$field_id = $_POST["No_Field"];
				$hole_data = $this->tour_field_model->getByFieldId($field_id)->row_array();
				$seq = $hole_data['field_seq'];
				header ('Content-type: text/html; charset=utf-8');
				echo '<li class="header">' . $hole_data['field_name'] . '</li>
					<li class="filter" value="1"><a>หลุม ' . (($seq * 9) - 8) . '</a></li>
					<li class="filter" value="2"><a>หลุม ' . (($seq * 9) - 7) .'</a></li>
					<li class="filter" value="3"><a>หลุม ' . (($seq * 9) - 6) .'</a></li>
					<li class="filter" value="4"><a>หลุม ' . (($seq * 9) - 5) .'</a></li>
					<li class="filter" value="5"><a>หลุม ' . (($seq * 9) - 4) .'</a></li>
					<li class="filter" value="6"><a>หลุม ' . (($seq * 9) - 3) .'</a></li>
					<li class="filter" value="7"><a>หลุม ' . (($seq * 9) - 2) .'</a></li>
					<li class="filter" value="8"><a>หลุม ' . (($seq * 9) - 1) .'</a></li>
					<li class="filter" value="9"><a>หลุม ' . ($seq * 9) . '</a></li>';
				break;
			case 4: // getGroup
				$field_id = $_POST['No_Field'];
				$hole = $_POST['No_Hole'];
				$group_count = $this->tour_field_model->getMaxGroup($field_id, $hole);
				header ('Content-type: text/html; charset=utf-8');
				echo '<li id="remove-group" onclick="remove_group()" ';
				if ($group_count == 1) echo 'style="display:none"';
				echo '><a >-</a></li>';
				for ($i = 1; $i <= $group_count; $i++) {
					echo '<li class="group" value="' . $i . '"><a >' . $i . '</a></li>';
				}
				echo '<li id="add-group" onclick="add_group()"><a >+</a></li>';
				break;
			case 5: // add group count
				$field_id = $_POST['No_Field'];
				$hole = $_POST['No_Hole'];
				$this->tour_field_model->addMaxGroup($field_id, $hole);
				break;
			case 6: // remove group count
				$field_id = $_POST['No_Field'];
				$hole = $_POST['No_Hole'];
				$max_group = $this->tour_field_model->getMaxGroup($field_id, $hole);
				$this->pairing_model->removeFromGroup($max_group, 
														$hole, 
														$field_id, 
														$tourid);
				$this->tour_field_model->removeMaxGroup($field_id, $hole);
				break;
			case 7: // get player table
				$player_data = $this->tour_player_model->pairing($tourid);
				header ('Content-type: text/html; charset=utf-8');
				if ($player_data->num_rows() > 0):
					foreach ($player_data->result_array() as $row):
						echo '<tr class="item"><td><input type="checkbox" /></td><td>' . $row['player_name'] . '</td>';
							echo '<td>' . $row['player_age'] . '</td>';
							echo '<td>' . $row['player_hc'] . '</td>';
							echo '<td>';
							if ($row['player_sex'] == 1): //male
								echo '<i class="fa fa-fw big male">&#9794; </i><p style="display:none">1</p>';
							else: //female
								echo '<i class="fa fa-fw big female">&#9792; </i><p style="display:none">2</p>';
							endif;
							echo '</td><td style="display:none">' . $row['player_id'] . '</td>';
							echo '</td><td style="display:none">' . $row['team_id'] . '</td></tr>';
					endforeach;
				endif;
				break;
		}
	}
	public function scoring($id) {
		$data['tournament_data'] = $this->tournament_model->getById($id)->row_array();
		$this->render('challenge/scoring', $data);
	}
	public function getFieldInfo($fieldid) {
		$field_data = $this->field_model->getById($fieldid)->row_array();
		header ('Content-type: text/html; charset=utf-8');
		echo '<tr><td>Par</td><td>';
		echo $field_data['hole1_par'];
		echo '</td><td>'.$field_data['hole2_par'];
		echo '</td><td>'.$field_data['hole3_par'];
		echo '</td><td>'.$field_data['hole4_par'];
		echo '</td><td>'.$field_data['hole5_par'];
		echo '</td><td>'.$field_data['hole6_par'];
		echo '</td><td>'.$field_data['hole7_par'];
		echo '</td><td>'.$field_data['hole8_par'];
		echo '</td><td>'.$field_data['hole9_par'];
		echo '</td></tr>';
		
	}
	public function tourinfo_save(){
		$tour_id = $_POST['TourId'];
		$tour_field = $_POST['InputField'];
		$i = 1;
		$this->tour_field_model->delete($tour_id);
		foreach ($tour_field as $field_id):
			$this->tour_field_model->insert($tour_id, $field_id, $i);
			$i += 1;
		endforeach;
		redirect('challenge/tourinfo/' . $tour_id, 'refresh');
	}
	public function getTeamTable($teamid) {
		$team_data = $this->tour_team_model->getByTeamId($teamid)->row_array();
		$team_player_data = $this->tour_player_model->getByTeamId($teamid);
		header ('Content-type: text/html; charset=utf-8');
		echo '<h3>ทีม <div class="inline">' . $team_data['team_name'].'</div>';
		echo '<button type="button" class="btn btn-warning edit-team-info pull-right" data-toggle="tooltip" data-original-title="แก้ไขชื่อทีม" value="' . $team_data['team_id'] . '" ><i class="fa fa-edit"></i></button></h3>';
		echo '<input type="hidden" name="teamId" id="teamId" value="' . $team_data['team_id'] . '"/><br />';
	}
	public function player_control($action = 0, $tourid = 0, $teamid = 0){
		switch ($action) {
			case 1: // add player single
				$InputName = $_POST['inputName'];
				$InputAge = $_POST['inputAge'];
				$InputHC = $_POST['inputHC'];
				$InputSex = $_POST['InputSex'];
				$TourId = $tourid;
				$memberId = (isset($_POST['memberId']))? $_POST['memberId']: 0;
				$InputTeam = (isset($_POST['teamid']))? $_POST['teamid']: 0; // 0 is mean single player
				//print_r($_POST);
				if ($memberId != 0) {
					$this->player_model->updateHC($memberId, $InputHC);
				}
				$this->tour_player_model->insert($InputName, 
													$InputAge, 
													$InputSex, 
													$InputHC, 
													$memberId, 
													$InputTeam, 
													$TourId);
				break;
			
			case 2: // add team
				$InputName = $_POST['InputName'];
				$TourId = $_POST['tourId'];
				$teamid = $this->tour_team_model->insert($InputName, $TourId);
				header ('Content-type: text/html; charset=utf-8');
				echo $teamid;
				break;
			case 3: // edit team
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$this->tour_team_model->update($InputName, $id);
				echo $id;
				break;
			case 4: // get team
				$team_data = $this->tour_team_model->getByTourId($tourid);
				header ('Content-type: text/html; charset=utf-8');
				if ($team_data->num_rows() > 0):
					foreach ($team_data->result_array() as $row):
						echo '<tr><td>'.$row['team_name'].'</td>';
						echo '<td><button type="button" class="btn btn-warning edit-team" data-toggle="tooltip" data-original-title="ดูรายละเอียด" value="' . $row['team_id'] . '"><i class="fa fa-pencil"></i></button>
							<button type="button" class="btn btn-danger " data-toggle="tooltip" data-original-title="ลบ" onclick="remove_list_team(this)" value="' . $row['team_id'] . '"><i class="fa fa-times"></i></button></td></tr>';
					endforeach;
				endif;
				break;
			case 6: // get player team by id
				$player_group_data = $this->tour_player_model->getByTeamId($teamid);
				header ('Content-type: text/html; charset=utf-8');
				if ($player_group_data->num_rows() > 0):
					foreach ($player_group_data->result_array() as $row ):
					echo '<tr><td>' . $row['player_name'] . '</td>';
					echo '<td>' . $row['player_age'] . '</td>';
					echo '<td>' . $row['player_hc'] . '</td>';
					echo '<td>';
					if ($row['player_sex'] == 1): //male
						echo '<i class="fa fa-fw big male">&#9794; </i><p style="display:none">M</p>';
					else: //female
						echo '<i class="fa fa-fw big female">&#9792; </i><p style="display:none">F</p>';
					endif;
					echo '</td><td><button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="ลบ" onclick="remove_list_group(this)" value="' . $row['player_id'] . '"><i class="fa fa-times"></i></button></td></tr>';
				endforeach;
				endif;
				break;
			case 7: // get member
				$player_member_data = $this->player_model->getMember($tourid);
				header ('Content-type: text/html; charset=utf-8');
				if ($player_member_data->num_rows() > 0):
					foreach ($player_member_data->result_array() as $row):
						echo '<tr class="item"><td><input type="checkbox" /></td>';
						echo '<td><a href="#">'.$row['player_name'].'</a></td>';
						// cal player age
						$age = ($row['player_birthdate'] != null )? floor((time() - strtotime($row['player_birthdate'])) / (60*60*24*365)): 0;
						echo '<td>' . $age . '</td>';
						echo '<td><div class="hc_number">' . $row['player_last_hc'] . '</div><a class="change_hc" onclick="change_hc(this)"><i class="fa fa-edit pull-right" data-toggle="tooltip" data-original-title="เปลี่ยน Handicap"></i></a></td>';
						if ($row['player_sex'] == 1):
							echo '<td><i class="fa fa-fw big male">&#9794; </i><p style="display:none">1</p></td>';
						else:
							echo '<td><i class="fa fa-fw big female">&#9792; </i><p style="display:none">2</p></td>';
						endif;
						echo '<td style="display:none">' . $row['player_id'] . '</td></tr>';
					endforeach;
				endif;
				break;
			case 0:
				$select_table = $_POST['select_table'];
				if ($select_table == 2): // remove team
					echo "team";
					$team_id = $_POST['InputId'];
					$this->tour_player_model->deleteByTeam($team_id);
					$this->tour_team_model->delete($team_id);
				else: // remove player
					$player_id = $_POST['InputId'];
					$this->score_model->delete($player_id);
					$this->pairing_model->deleteByPlayerID($player_id);
					$this->tour_player_model->delete($player_id);
				endif;
				break;
		}
	}
	public function challenge_control($action = 0, $editId = 0) {
		switch ($action) {
			case 1://insert
				$InputName = $_POST['InputName'];
				$InputClub = $_POST['InputClub'];
				$InputTime = str_replace("/", "-", $_POST['InputTime']);
				// split time from inputtime 
				$Time = explode(" - ",$InputTime);	
				$TimeStart = explode("-",$Time[0]);
				$TimeEnd = explode("-",$Time[1]);
				$this->tournament_model->insert($InputName,
												$TimeStart[2] . "-" . $TimeStart[1] . "-" . $TimeStart[0],
												$TimeEnd[2] . "-" . $TimeEnd[1] . "-" . $TimeEnd[0],
												$InputClub);
				break;
			case 2://update
				
				$editId = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$InputClub = $_POST['InputClub'];
				$InputTime = str_replace("/", "-", $_POST['InputTime']);
				// split time from inputtime 
				$Time = explode(" - ",$InputTime);	
				$TimeStart = explode("-",$Time[0]);
				$TimeEnd = explode("-",$Time[1]);
				$this->tournament_model->update($editId,
												$InputName,
												$TimeStart[2] . "-" . $TimeStart[1] . "-" . $TimeStart[0],
												$TimeEnd[2] . "-" . $TimeEnd[1] . "-" . $TimeEnd[0],
												$InputClub);
				
				break;
			case 3://delete
				$InputId = $_POST['InputId'];
				echo $InputId;
				$this->tournament_model->delete($InputId);
				break;
			case 4:// edit get select
				$edit_data = $this->tournament_model->getById($editId)->row_array();
				$chosen_club = $this->club_model->getSelect();
				header ('Content-type: text/html; charset=utf-8');
				foreach ($chosen_club->result_array() as $row):
					if ($row['club_id'] != $edit_data['club_id']):
						echo "<option value='" . $row['club_id'] . "' >" . $row['club_name'] . "</option>";
					else:
						echo'<option value="' . $row['club_id'] . '" selected>' . $row['club_name'] . '</option>';
					endif;
				endforeach;
				break;
			case 0://getAll
				$tournament_data = $this->tournament_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				if ($tournament_data->num_rows() > 0):
					foreach ($tournament_data->result_array() as $row):
						echo '<tr><td>' . $row['tour_name'] . '</td>';
						$TimeStart = explode("-", $row['tour_startdate']);
						$TimeEnd = explode("-", $row['tour_enddate']);
						echo '<td>' . $TimeStart[2] . "/" . $TimeStart[1] . "/" . $TimeStart[0] . ' - ' . $TimeEnd[2] . "/" . $TimeEnd[1] . "/" . $TimeEnd[0] . '</td>';
						echo '<td><div class="btn-group">
								<a class="btn btn-info btn-flat" data-toggle="tooltip" data-original-title="รายละเอียดการแข่งขัน"  href="' . site_url('challenge/tourinfo/' . $row['tour_id']) . '"><i class="fa fa-fw fa-info-circle"></i></a>
								<a class="btn btn-success btn-flat" data-toggle="tooltip" data-original-title="กรอกคะแนน" href="#"><i class="fa fa-fw fa-clipboard" ></i></a>
								<a class="btn bg-orange btn-flat" data-toggle="tooltip" data-original-title="ผลการแข่งขัน" href="#"><i class="fa fa-fw fa-trophy"></i></a>
								<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไขการแข่งขัน" value="' . $row['tour_id'] . '"><i class="fa fa-edit" ></i></button>
								<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['tour_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
							</div>
						</td><td style="display:none"></td></tr>';
					endforeach;
				endif; 
		}
	}
		
}

/* End of file Challenge.php */
/* Location: ./application/controllers/Challenge.php */