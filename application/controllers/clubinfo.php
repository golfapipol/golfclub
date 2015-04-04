<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Clubinfo extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('zone_model');
		$this->load->model('club_model');
		$this->load->model('field_model');
	}
	public function index() {
		$data['zone_select'] = $this->zone_model->getAll();
		$data['club_data'] = $this->club_model->getAll();
		$this->render('club/club', $data);
	}
	public function information($clubid) {
		$data['field_data'] = $this->field_model->getByClub($clubid);
		$data['club_data'] = $this->club_model->getById($clubid)->row_array();
		$this->render('club/information', $data);
	}
	public function updateInformation() {
		$editId = $_POST['ClubId'];
		$InputAddress = $_POST['InputAddress'];
		$InputWebSite = $_POST['InputWebSite'];
		$InputTel = $_POST['InputTel'];
		$InputFax = $_POST['InputFax'];
		$InputDesc = $_POST['InputDesc'];
		
		//$this->club_model->update_pic($id,$picid);
		$this->club_model->update_information($editId,
											$InputAddress,
											$InputWebSite,
											$InputTel,
											$InputFax,
											$InputDesc);
		redirect("clubinfo/information/" . $editId, "refresh");
	}
	public function clubinfo_edit($id){
		$club_data = $this->club_model->getById($id)->row_array();
		$zone_select = $this->zone_model->getAll();
		echo '<div class="form-group"><label for="InputName">ชื่อสนามกอล์ฟ</label><input type="text" class="form-control" name="InputName" id="InputName" placeholder="โปรดระบุชื่อสนามกอล์ฟ" value="' . $club_data['club_name'] . '"></div>';
		echo '<div class="form-group"><label for="InputGroup">ภาค</label><select data-placeholder="กรุณาเลือกภาค" class="chosen-select" style="width:400px" id="InputGroup" name="InputGroup">';
		echo '<option selected value="';
		echo $club_data['zone_id'];
		echo '">' . $club_data['zone_name'] . '</option>';
		if ($zone_select->num_rows() >0):
			foreach ($zone_select->result_array() as $option):
				if ($option['zone_id'] != $club_data['zone_id']) echo '<option value="' . $option['zone_id'] . '">' . $option['zone_name'] . '</option>';
			endforeach;
		endif;
		echo '</select></div>';
	}
	public function clubinfo_control($action = 0) {
		
		switch ($action) {
			case 1: // insert
				$InputName = $_POST['InputName'];
				$InputGroup = $_POST['InputGroup'];
				$club_id = $this->club_model->insert($InputName, $InputGroup);
				echo $club_id;
				break;
			case 2: // update
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$InputGroup = $_POST['InputGroup'];
				$this->club_model->update($id, $InputName, $InputGroup);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->field_model->deleteAllField($InputId);
				$this->club_model->delete($InputId);
				break;
			case 0: // get all	
				$club_data = $this->club_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				$i = 1;
				if ($club_data->num_rows() > 0):
				foreach ($club_data->result_array() as $row):
					echo '<a href="' . site_url('clubinfo/information/' . $row['club_id']) . '"><tr><td>' . $i . '</td>';
					echo '<td>' . $row['club_name'] . '</td>';
					echo '<td>' . $row['zone_name'] . '</td>';
					echo '<td>
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-flat information" data-toggle="tooltip" data-original-title="รายละเอียด" value="' . $row['club_id'] . '"><i class="fa fa-fw fa-list-alt"></i></button>
							<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="' . $row['club_id'] . '"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['club_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
						</div>
					</td></tr></a>';
					$i = $i + 1;
				endforeach;
				endif; 
		}
	
	}
	public function getParTable($fieldid) {
		$field_data = $this->field_model->getById($fieldid)->row_array();
		header ('Content-type: text/html; charset=utf-8');
		echo '<tr><td>Par</td><td>';
		echo '<input type="text" class="form-control number-input" name="hole1"  placeholder="Par" value="' . $field_data['hole1_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole2" placeholder="Par" value="' . $field_data['hole2_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole3" placeholder="Par" value="' . $field_data['hole3_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole4"  placeholder="Par" value="' . $field_data['hole4_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole5"  placeholder="Par" value="' . $field_data['hole5_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole6"  placeholder="Par" value="' . $field_data['hole6_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole7" placeholder="Par" value="' . $field_data['hole7_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole8"  placeholder="Par" value="' . $field_data['hole8_par'] . '">';
		echo '</td><td><input type="text" class="form-control number-input" name="hole9"  placeholder="Par" value="' . $field_data['hole9_par'] . '">';
		$sum = 36;
		echo '</td></tr><tr><td colspan="7" align="right">รวม</td><td colspan="3" ><p class="sum">' . $sum . '</p></td></tr>';
	}
	public function field_control($action = 0, $clubid){
		switch ($action) {
			case 1: // insert
				$InputName = $_POST['InputName'];
				$this->field_model->insert($InputName, $clubid);
				break;
			case 2: // update
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$this->field_model->update($id, $InputName);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->field_model->delete($InputId);
				break;
			
			case 4: // update hole par
				$InputId = $_POST['editField'];
				$hole1 = $_POST['hole1'];
				$hole2 = $_POST['hole2'];
				$hole3 = $_POST['hole3'];
				$hole4 = $_POST['hole4'];
				$hole5 = $_POST['hole5'];
				$hole6 = $_POST['hole6'];
				$hole7 = $_POST['hole7'];
				$hole8 = $_POST['hole8'];
				$hole9 = $_POST['hole9'];
				$this->field_model->update_par($InputId,
												$hole1,
												$hole2,
												$hole3,
												$hole4,
												$hole5,
												$hole6,
												$hole7,
												$hole8,
												$hole9);
				break;
			case 0: // get all	
				$field_data = $this->field_model->getByClub($clubid);
				header ('Content-type: text/html; charset=utf-8');
				echo '<li class="header">คอร์สทั้งหมด</li>';
				if ($field_data->num_rows() > 0):
				foreach ($field_data->result_array() as $row):
					echo '<li class="field" value="' . $row['field_id'] . '">';
					echo '<a class="field-name">' . $row['field_name'] . '</a>';
					echo '<div class="tools"><a class="edit-field" data-toggle="tooltip" title="" data-original-title="แก้ไข" ><i class="fa fa-edit" ></i></a>&nbsp;<a class="remove-field"  data-toggle="tooltip" title="" data-original-title="ลบข้อมูล" ><i class="fa fa-trash-o"></i></a></div></li>';
				endforeach;
				endif;
		}
	
	}
}

/* End of file clubinfo.php */
/* Location: ./application/controllers/clubinfo.php */