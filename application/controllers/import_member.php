<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Import_member extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
	}
	public function index() {
		
		$this->render('player/import_member', '');
	}
	public function listOfData() {
		if(is_uploaded_file($_FILES['file']['tmp_name'])) :
			$file = $_FILES['file']['tmp_name'];
			//load the excel library
			$this->load->library('excel');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			 
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			 
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) :
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			 
				//header will/should be in row 1 only. of course this can be modified to suit your need.
				if ($row == 1) {
					$header[$row][$column] = $data_value;
				} else {
					$arr_data[$row][$column] = $data_value;
				}
				$arr_data[$row][$column] = $data_value;
			endforeach;
			//$data['header'] = $header;
			$response = $this->insertToDB($header, $arr_data);
			header ('Content-type: text/html; charset=utf-8');
			echo $response;
		endif;
	}
	public function insertToDB($header, $data) {
		$this->load->model('prefix_model');
		$this->load->model('player_model');
		$this->load->model('player_info_model');
		$data_prefix = $this->prefix_model->getAll()->result_array();
		$total = sizeof($data);
		$complete_import = 0;
		$message = "";
		foreach ($data as $row) :
			foreach ($data_prefix as $prefix):
				if ($prefix["prefix_name"] == $row["B"]) :
					$prefix_id = $prefix['prefix_id'];
					$sex_id = 1; // default ชาย
					if($row['G'] == null || $row['G'] == 'หญิง' ) :
						$sex_id = 2;
					endif;
					$this->db->trans_begin();
					$last_insert_id = $this->player_model->import($row['A'],$row['C'], $sex_id, null, $row['F'], $prefix_id, 1);
					$this->player_info_model->insert($last_insert_id, $row['E'], $row['D'], null, null, null);
					if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
						$message .= 'ไม่สามารถเพิ่มข้อมูลของสมาชิกหมายเลข' . $row['A'] . ' ' . $row['B'] . ' ' . $row['C'] . '<br>';
					}
					else
					{
						$this->db->trans_commit();
						$complete_import++;
					}
				endif;
			endforeach;
		endforeach;
		$message .= "รายการที่ทำการนำเข้าจากทั้งหมด " . $total . " นำเข้าได้  " . $complete_import .'<br>';
		return $message;
	}
}

/* End of file import_member.php */
/* Location: ./application/controllers/import_member.php */