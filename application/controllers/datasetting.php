<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Datasetting extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
	}
	public function index() {
		$this->render('datasetting/main', '');
	}
	public function prefix() {
		$this->load->model('prefix_model');
		$data['prefix_data'] = $this->prefix_model->getAll();
		$this->render('datasetting/prefix', $data);
	}
	public function status() {
		$this->load->model('status_model');
		$data['status_data'] = $this->status_model->getAll();
		$this->render('datasetting/status', $data);
	}
	
	public function prefix_control($action = 0) {	
		$this->load->model('prefix_model');
		switch ($action) {
			case 1: // insert
				$sex =  $_POST['sex'];
				$InputName = $_POST['InputName'];
				$this->prefix_model->insert($InputName, $sex);
				break;
			case 2: // update
				$id = $_POST['editId'];
				$sex =  $_POST['sex'];
				$InputName = $_POST['InputName'];
				$this->prefix_model->update($id, $InputName, $sex);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->prefix_model->delete($InputId);
				break;
			case 0: // get all	
				$prefix_data = $this->prefix_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				$i = 1;
				if ($prefix_data->num_rows() > 0):
				foreach ($prefix_data->result_array() as $row):
					echo "<tr><td>" . $i . "</td>";
					echo "<td>" . $row['prefix_name'] . "</td>";
					if ($row['prefix_sex'] == 1): //male
						echo "<td><i class='fa fa-fw big male'>&#9794; </i>
							<p style='display:none' value='1'>1</p></td>";
					elseif ($row['prefix_sex'] == 2): //female
						echo "<td><i class='fa fa-fw big female'>&#9792; </i>
							<p style='display:none' value='2'>2</p></td>";
					else: // not identify
						echo "<td>-<p style='display:none' value='0'>0</p></td>";
					endif;
					echo '<td>
						<div class="btn-group">
							<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="' . $row['prefix_id'] . '"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['prefix_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
						</div>
					</td>';
					$i = $i + 1;
				endforeach;
				endif;
		}
		
	}
	public function status_control($action = 0) {		
		$this->load->model('status_model');
		switch ($action) {
			case 1: // insert
				$InputName = $_POST['InputName'];
				$this->status_model->insert($InputName);
				break;
			case 2: // update
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$this->status_model->update($id, $InputName);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->status_model->delete($InputId);
				break;
			case 0: // get all	
				$status_data = $this->status_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				$i = 1;
				if ($status_data->num_rows() > 0):
				foreach ($status_data->result_array() as $row):
					echo "<tr><td>" . $i . "</td>";
					echo "<td>" . $row['status_name'] . "</td>";
					echo '<td><div class="btn-group">
							<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="' . $row['status_id'] . '"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['status_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
						</div>
					</td>';
					$i = $i + 1;
				endforeach;
				endif;
		}
	}
	public function sex_radio($id){
		header ('Content-type: text/html; charset=utf-8');
		echo '<label><input class="sex" type="radio" name="sex"  value="0" ';
		if ($id == "0"){ echo 'checked';}
		echo ' /> ไม่ระบุ</label><label><input class="sex" type="radio" name="sex" value="1" ';
		if ($id == "1"){ echo 'checked';}
		echo ' /><i class="fa fa-fw big male">&#9794; </i><p style="display:none">M</p>ชาย</label><label><input class="sex" type="radio" name="sex"  value="2" ';
		if ($id == "2"){ echo 'checked';}
		echo '/> <i class="fa fa-fw big female">&#9792; </i><p style="display:none">F</p> หญิง</label>';
	}
	
}

/* End of file datasetting.php */
/* Location: ./application/controllers/datasetting.php */