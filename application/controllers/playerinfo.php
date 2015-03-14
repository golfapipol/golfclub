<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Playerinfo extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('player_model');
		$this->load->model('player_info_model');
		$this->load->model('location_model');
		$this->load->model('status_model');
		$this->load->model('prefix_model');
		$this->load->model('format_time_model');
	}
	public function index() {
		$data['player_data'] = $this->player_model->getAll();
		$this->render('player/players', $data);
	}
	public function addPlayer() {
		$data['chosen_province'] = $this->location_model->getProvince();
		$data['chosen_status'] = $this->status_model->getAll();
		$data['chosen_prefix'] = $this->prefix_model->getAll();
		$this->render('player/addplayer', $data);
	}
	public function processPlayer($action) {
		switch ($action) {
			case 1: // addPlayer
				$InputPrefix = $_POST['InputPrefix'];
				$InputName = $_POST['InputName'];
				$InputSex = $_POST['InputSex'];
				$InputBirthDay = $this->format_time_model->BEtoCE($_POST['InputBirthDay']);
				$InputTel = $_POST['InputTel'];
				$InputAddress = $_POST['InputAddress'];
				$InputProvince = $_POST['InputProvince'];
				$InputAmphur = $_POST['InputAmphur'];
				$InputDistrict = $_POST['InputDistrict'];
				$InputStatus = $_POST['InputStatus'];
				$InputHC = $_POST['InputHC'];
				$last_insert_id = $this->player_model->insert($InputName,
															$InputSex,
															str_replace("/", "-", $InputBirthDay),
															$InputHC,
															$InputPrefix,
															$InputStatus);
				$this->player_info_model->insert($last_insert_id,
												$InputTel,
												$InputAddress,
												$InputProvince,
												$InputAmphur,
												$InputDistrict);
				/*
					//upload picture & link with profile
					....
					$InputProfile = $_POST['InputProfile'];
				*/
				redirect('playerinfo','refresh');
				break;
			case 2: //editPlayer
				$InputEditId = $_POST['InputEditId'];
				$InputPrefix = $_POST['InputPrefix'];
				$InputName = $_POST['InputName'];
				$InputSex = $_POST['InputSex'];
				$InputBirthDay = $this->format_time_model->BEtoCE($_POST['InputBirthDay']);
				$InputTel = $_POST['InputTel'];
				$InputAddress = $_POST['InputAddress'];
				$InputProvince = $_POST['InputProvince'];
				$InputAmphur = $_POST['InputAmphur'];
				$InputDistrict = $_POST['InputDistrict'];
				$InputStatus = $_POST['InputStatus'];
				$InputHC = $_POST['InputHC'];
				$this->player_model->update($InputEditId,
											$InputName,
											$InputSex,
											str_replace("/", "-", $InputBirthDay),
											$InputHC,
											$InputPrefix,
											$InputStatus);
				$this->player_info_model->update($InputEditId,
												$InputTel,
												$InputAddress,
												$InputProvince,
												$InputAmphur,
												$InputDistrict);
				/*
					//upload picture & link with profile
					....
					$InputProfile = $_POST['InputProfile'];
				*/
				redirect('playerinfo', 'refresh');
				break;
		}
	}
	public function editPlayer($id) {
		$data['player_data'] = $this->player_model->getById($id)->row_array();
		$data['player_data']['player_birthdate'] = $this->format_time_model->CEtoBE($data['player_data']['player_birthdate']);
		$data['chosen_province'] = $this->location_model->getProvince();
		$data['chosen_status'] = $this->status_model->getAll();
		$data['chosen_prefix'] = $this->prefix_model->getAll();
		$data['chosen_amphur'] = $this->location_model->getAmphur($data['player_data']['info_province_id']);
		$data['chosen_district'] = $this->location_model->getDistrict($data['player_data']['info_amphur_id']);
		$this->render('player/editplayer', $data);
	}
	
	public function chosen($action) {
		header ('Content-type: text/html; charset=utf-8');
		switch ($action) {
			case 2: // amphur
				$chosen_amphur = $this->location_model->getAmphur($this->input->get('id'));
				foreach ($chosen_amphur->result_array() as $row):
					echo "<option value='" . $row['amphurId'] . "'>" . $row['amphurName'] . "</option>";
				endforeach;
				break;
			case 3: // district
				$chosen_district = $this->location_model->getDistrict($this->input->get('id'));
				foreach ($chosen_district->result_array() as $row):
					echo "<option value='" . $row['districtId'] . "'>" . $row['districtName'] . "</option>";
				endforeach;
				break;
		}
	}
	public function playerinfo_control($action = 0) {
		switch($action){
			case 0: 
				$player_data = $this->player_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				if($player_data->num_rows() > 0):
					foreach($player_data->result_array() as $row):
						echo '<tr><td>' . $row['player_name'] . '</td>';
						if ($row['player_sex'] == 1): //male
							echo "<td><i class='fa fa-fw big male'>&#9794; </i>
								<p style='display:none' value='1'>1</p></td>";
						elseif ($row['player_sex'] == 2): //female
							echo "<td><i class='fa fa-fw big female'>&#9792; </i>
								<p style='display:none' value='2'>2</p></td>";
						endif;
						echo '<td>' . $row['status_name'] . '</td>';
						echo '<td>
							<div class="btn-group">
								<a href="' . site_url("playerinfo/player_profile") . '/' . $row['player_id'] . '" class="btn btn-success btn-flat edit" data-toggle="tooltip" data-original-title="รูปประจำตัว" ><i class="fa fa-fw fa-picture-o"></i></a>
								<a href="' . site_url("playerinfo/editPlayer") . '/' . $row['player_id'] . '" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" ><i class="fa fa-edit"></i></a>
								<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['player_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
							</div>
						</td>';
					endforeach;
				endif;
				break;
			case 3:
				$InputId =  $_POST['InputId'];
				$this->player_info_model->delete($InputId);
				$this->player_model->delete($InputId);
				break;
		}
	}
	public function player_profile($id){
		$data['player_data'] = $this->player_model->getById($id)->row_array();
		$data['player_data']['player_birthdate'] = $this->format_time_model->formatToText($data['player_data']['player_birthdate']);
		// ..... get history
		$this->render('player/profile', $data);
	}
}

/* End of file playerinfo.php */
/* Location: ./application/controllers/playerinfo.php */