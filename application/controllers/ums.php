<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Ums extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
	}
	public function index() {
		$this->render('ums/main', '');
	}
	public function menu() {
		$this->load->model('menu_model');
		$data['menu_data'] = $this->menu_model->getAll();
		$this->render('ums/menu', $data);
	}
	public function actor() {
		$this->load->model('group_model');
		$data['group_data'] = $this->group_model->getAll();
		$this->render('ums/actor', $data);
	}
	public function user() {
		$this->load->model('user_model');
		$this->load->model('group_model');
		$data['actor_select'] = $this->group_model->getAll();
		$data['user_data'] = $this->user_model->getAllWithGroup();
		$this->render('ums/user', $data);
	}
	public function menu_control($action = 0) {		
		$this->load->model('menu_model');
		switch ($action) {
			case 1: // insert
				$InputName = $_POST['InputName'];
				$InputURL = $_POST['InputURL'];
				$this->menu_model->insert($InputName, $InputURL);
				break;
			case 2: // update
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$InputURL = $_POST['InputURL'];
				$this->menu_model->update($id, $InputName, $InputURL);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->menu_model->delete($InputId);
				break;
			case 0: // get all	
				$menu_data = $this->menu_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				$i = 1;
				if ($menu_data->num_rows() > 0):
				foreach ($menu_data->result_array() as $row): 
					echo '<li><span class="handle"><i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i></span>';
					echo '<input type="hidden" name="menu[]" value="' . $row['menu_id'] . '" />';
					echo '<span class="text"><span class="text text-name">' . $row['menu_name'] . '</span>';
					echo '<small class="label label-default">' . $row['menu_url'] . '</small></span>';
					echo '<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไขเมนู" value="' . $row['menu_id'] . '"><i class="fa fa-edit"></i></button>
					<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบเมนู" value="' . $row['menu_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button></li>';
				endforeach;						
				endif;
				break;
			case 5: // save seq
				$menu_seq = $_POST['menu'];
				$seq=1;
				foreach($menu_seq as $id){
					$this->menu_model->updateSeq($id, $seq);
					$seq += 1;
				}
			
		}
	}
	public function actor_control($action = 0) {		
		$this->load->model('group_model');
		switch ($action) {
			case 1: // insert
				$InputName = $_POST['InputName'];
				$this->group_model->insert($InputName);
				break;
			case 2: // update
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$this->group_model->update($id, $InputName);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->group_model->delete($InputId);
				break;
			case 0: // get all	
				$group_data = $this->group_model->getAll();
				header ('Content-type: text/html; charset=utf-8');
				$i = 1;
				if ($group_data->num_rows() > 0):
				foreach ($group_data->result_array() as $row):
					echo "<tr><td>" . $i . "</td>";
					echo "<td>" . $row['group_name'] . "</td>";
					echo '<td>
						<div class="btn-group">
							<button type="button" class="btn btn-primary btn-flat permission" data-toggle="tooltip" data-original-title="กำหนดสิทธิเมนู" value="' . $row['group_id'] . '"><i class="fa fa-fw fa-wrench"></i></button>
							<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="' . $row['group_id'] . '"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['group_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
						</div>
					</td>';
					$i = $i + 1;
				endforeach;
				endif;
		}
	}
	public function permission_control($groupid, $action = "0") {
		$this->load->model('permission_model');
		$this->load->model('menu_model');
		if ($action == "0"):
			$menu_data = $this->menu_model->getAll();
			$permission_data = $this->permission_model->getById($groupid);
			header ('Content-type: text/html; charset=utf-8');
			echo '<ul class="todo-list">';
			foreach ($menu_data->result_array() as $menu):
				$check = "";
				foreach ($permission_data->result_array() as $per):
					if ($per['menu_id'] == $menu['menu_id'])	$check = 'checked';
				endforeach;
				echo '<li><input type="checkbox" value="true" name="menu_' . $menu['menu_id'] . '" ' . $check . '/>';
				echo '<span class="text">' . $menu['menu_name'] . '</span>';
				echo '</li>';
			endforeach;
			echo '</ul>';
		else:
			$groupid = $_POST['groupid'];
			$menu_data = $this->menu_model->getAll();
			$permission_data = $this->permission_model->getById($groupid);
			foreach ($menu_data->result_array() as $menu):
				if (isset($_POST['menu_' . $menu['menu_id']])):
					if($this->permission_model->checkPermission($menu['menu_id'], $groupid)->num_rows() > 0):
						// nothing echo "nothing";
					else:
						// add new echo "add new ";
						$this->permission_model->insert($menu['menu_id'], $groupid);
					endif;
				else:
					if ($this->permission_model->checkPermission($menu['menu_id'], $groupid)->num_rows() > 0):
						// delete oldecho "delete old";
						$this->permission_model->delete($menu['menu_id'], $groupid);
					else:
						// nothing
					endif;
				endif;
			endforeach;
		endif;
	}
	public function user_control($action = 0) {		
		$this->load->model('user_model');
		switch ($action) {
			case 1: // insert
				$InputName = $_POST['InputName'];
				$InputCode = $_POST['InputCode'];
				$InputUser = $_POST['InputUser'];
				$InputPassword = $_POST['InputPassword'];
				$InputGroup = $_POST['InputGroup'];
				$this->user_model->insert($InputName,
											$InputUser,
											$InputPassword,
											$InputCode,
											$InputGroup);
				break;
			case 2: // update
				$id = $_POST['editId'];
				$InputName = $_POST['InputName'];
				$InputCode = $_POST['InputCode'];
				$InputUser = $_POST['InputUser'];
				$InputPassword = $_POST['InputPassword'];
				$InputGroup = $_POST['InputGroup'];
				$this->user_model->update($id,
										$InputName,
										$InputUser,
										$InputPassword,
										$InputCode,
										$InputGroup);
				break;
			case 3: // delete
				$InputId =  $_POST['InputId'];
				$this->user_model->delete($InputId);
				break;
			case 0:
				$user_data = $this->user_model->getAllWithGroup();
				header ('Content-type: text/html; charset=utf-8');
				$i = 1;
				if ($user_data->num_rows() > 0):
				foreach ($user_data->result_array() as $row):
					echo "<tr><td>".$i."</td>";
					echo "<td>" . $row['user_name'] . "</td>";
					echo "<td>" . $row['group_name'] . "</td>";
					echo '<td>
						<div class="btn-group">
							<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="' . $row['user_id'] . '"><i class="fa fa-edit"></i></button>
							<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="' . $row['user_id'] . '"><i class="fa fa-fw fa-trash-o"></i></button>
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
	public function get_userinfo($id = '0') {
		$this->load->model('user_model');
		$this->load->model('group_model');
		$actor_select = $this->group_model->getAll();
		$user_data = $this->user_model->getById($id)->row_array();
		header('Content-Type: application/json');
		echo json_encode($user_data);
	}
}

/* End of file ums.php */
/* Location: ./application/controllers/ums.php */