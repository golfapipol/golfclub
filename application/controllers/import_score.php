<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Import_score extends Required {

	/** available
	 * {content}
	 */
	public function __construct() {
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('tournament_model');
		$this->load->model('tour_field_model');
		$this->load->model('score_model');
	}
	public function listOfData($tourId) {
		//$pairing_data = $this->pairing_model->getPairingFromTourId($tourId);
		if(is_uploaded_file($_FILES['file']['tmp_name'])) :
			$file = $_FILES['file']['tmp_name'];
			//load the excel library
			$this->load->library('excel');
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			$max_row = $objPHPExcel->getActiveSheet()->getHighestRow();
			$excel = array();
			
			foreach(range('A','Z') as $column):
				foreach(range(1,$max_row) as $row):
					$excel[$column.$row] = "";
				endforeach;
			endforeach;
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) :
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
				$excel[$column.$row] = $data_value;
			endforeach;
			
			if ($this->validTournament($tourId, $excel)):
				echo $this->insertToDB($excel, $max_row);
			else:
				echo "error";
			endif;
		else:
			echo "error";
		endif;
	}
	public function insertToDB($excelData, $max_row) {
		$tourId = $excelData['A1'];
		$field_count = $this->tour_field_model->getFieldCount($tourId)->row_array()['field_seq'];
		for($row=3; $row <= $max_row; $row++):
			$player_id = $excelData['A'.$row];
			$field_seq = 1;
			$column = 'H';
			for($field_start = 0; $field_start < $field_count; $field_start++):
				$field = $this->tour_field_model->getFieldByIdSeq($tourId,$field_seq)->row_array();
				$check = $this->score_model->check($player_id, $field['field_id']);
				$h1 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h2 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h3 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h4 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h5 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h6 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h7 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h8 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$h9 = ($excelData[($column).$row]== "")? null: $excelData[$column.$row]; $column++;
				$gross = $h1+$h2+$h3+$h4+$h5+$h6+$h7+$h8+$h9;
				if($check->num_rows() > 0): // check it have record yet? and update
					$this->score_model->update($player_id,$field['field_id'],$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$gross,$tourId);
				else: // or insert
					$this->score_model->insert($player_id,$field['field_id'],$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$gross,$tourId);
				endif;
				$field_seq++;
			endfor;
		endfor;
		return "success";
	}
	function validTournament($tourId, $excelData) {
		$tournament_data = $this->tournament_model->getById($tourId)->row_array();
		$field_data = $this->tour_field_model->getFirstField($tourId)->result_array();
		if ($tournament_data['tour_id'] == $excelData['A1'] && $tournament_data['tour_name'] == $excelData['B1']):
			$column = 'H';
			foreach($field_data as $field):
				for($i = 1; $i < 10; $i++):
					if($field['hole'.$i.'_par'] != $excelData[$column.'2']):
						return false;
					endif;
					$column++;
				endfor;
			endforeach;
			return true;
		else:
			return false;
		endif;
	}
}

/* End of file import_member.php */
/* Location: ./application/controllers/import_member.php */