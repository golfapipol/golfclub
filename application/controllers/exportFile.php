<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/required.php");
class ExportFile extends Required {
	public function __construct () {
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
	public function pairing($tourId) {
		header('Content-type: application/pdf');
		$data['tournament_data'] = $this->tournament_model->getById($tourId)->row_array();
		$data['tournament_data']['tour_startdate'] = $this->format_time_model->formatToText($data['tournament_data']['tour_startdate']);
		$data['tournament_data']['tour_enddate'] = $this->format_time_model->formatToText($data['tournament_data']['tour_enddate']);
		$data['player_data'] = $this->tour_player_model->pairingHoleGroup($tourId)->result_array();
		$data['hole_data'] = $this->tour_field_model->getFirstField($tourId)->result_array();
		$this->load->library('mpdflib/mpdf');

		$content = $this->load->view('exportFile/pairing', $data, true);
		
		$this->mpdf = new mPDF('th');
		$this->mpdf->WriteHTML($content);
		$this->mpdf->Output();
	}
	public function testingpairing($tourId) {
		$data['tournament_data'] = $this->tournament_model->getById($tourId)->row_array();
		$data['tournament_data']['tour_startdate'] = $this->format_time_model->formatToText($data['tournament_data']['tour_startdate']);
		$data['tournament_data']['tour_enddate'] = $this->format_time_model->formatToText($data['tournament_data']['tour_enddate']);
		$data['player_data'] = $this->tour_player_model->pairingHoleGroup($tourId)->result_array();
		$data['hole_data'] = $this->tour_field_model->getFirstField($tourId)->result_array();
		$this->load->library('mpdflib/mpdf');

		$content = $this->load->view('exportFile/pairing', $data, true);
		echo $content;
	}
	public function score($tourId) {
		$tournament_data = $this->tournament_model->getById($tourId)->row_array();
		$player_data = $this->pairing_model->getPlayerOrderByHoleSeq($tourId)->result_array();
		foreach($player_data as $key => $player):
			$player_data[$key]['scores'] = $this->score_model->getByPlayerID($player['player_id'])->result_array();
		endforeach;
		$field_data = $this->tour_field_model->getFieldByTourId($tourId)->result_array();
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle($tournament_data['tour_name'])->setDescription("ผลการแข่งขัน".$tournament_data['tour_name']);
		// Assign cell values
		$objPHPExcel->setActiveSheetIndex(0);
		// set width 
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(5);
		foreach(range('H','Z') as $char):
			$objPHPExcel->getActiveSheet()->getColumnDimension($char)->setWidth(9);
		endforeach;
		$objPHPExcel->getActiveSheet()->setCellValue('A1', $tournament_data['tour_id']);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', $tournament_data['tour_name']);
		$objPHPExcel->getActiveSheet()->mergeCells('B1:G1');
		$field_limit = count($field_data);
		$column = 'H';
		$default_border = array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb'=>'1006A3'));
		$color = array(0=> 'FF8080', 1 =>'FF6600', 2 =>'0000FF', 3=>'00FFFF', 4=>'FFFFCC');
		$style_header = array(
			'borders' => array(
				'bottom' => $default_border,
				'left' => $default_border,
				'top' => $default_border,
				'right' => $default_border,
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb'=> $color[0]),
			),
			'font' => array(
				'bold' => true,
			)
		);

		for ($field_start = 0; $field_start < $field_limit; $field_start++):
			for ($hole = 1; $hole < 10; $hole++):
				$objPHPExcel->getActiveSheet()->getStyle($column.'1')->applyFromArray($style_header);
				$objPHPExcel->getActiveSheet()->setCellValue(($column++).'1', 'หลุม '.($hole + ($field_start * 9)));
			endfor;
			$style_header['fill']['color']['rgb'] = $color[$field_start+1];

		endfor;
		$style_header['fill']['color']['rgb'] = 'FFFF00';
			
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'ID');
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'ชื่อ - นามสกุล');
		$objPHPExcel->getActiveSheet()->setCellValue('C2', 'เพศ');
		$objPHPExcel->getActiveSheet()->setCellValue('D2', 'อายุ');
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'HC');
		$objPHPExcel->getActiveSheet()->setCellValue('F2', 'OUT');
		$objPHPExcel->getActiveSheet()->setCellValue('G2', 'IN');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($style_header);
		$field_start = 0; $column = 'H';
		$field_count = count($field_data);
		foreach ($field_data as $par): 
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole1_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole2_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole3_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole4_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole5_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole6_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole7_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).'2', $par['hole8_par']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column).'2', $par['hole9_par']);
			$objPHPExcel->getActiveSheet()->getStyle('H2:'.($column++).'2')->applyFromArray($style_header);
		endforeach;
		$row = 3; $column = 'A';
		foreach ($player_data as $player): //player
			
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $player['player_id']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $player['player_name']);
			$player_sex = ($player['player_sex'] == 1) ? 'ชาย': 'หญิง';
			$player_age = ($player['player_age'] == 0) ? '-': $player['player_age'];
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $player_sex);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $player_age);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $player['player_hc']);
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, '=SUM(H'.$row.':P'.$row.')');
			$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, '=SUM(Q'.$row.':Y'.$row.')');
			if (count($player['scores']) == 2):
				foreach ($player['scores'] as $score):
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole1_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole2_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole3_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole4_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole5_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole6_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole7_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole8_score']);
					$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole9_score']);
				endforeach;
			else:
				$i = 1;
				foreach ($player['scores'] as $score):
					if ($i == $score['field_seq']):
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole1_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole2_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole3_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole4_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole5_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole6_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole7_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole8_score']);
						$objPHPExcel->getActiveSheet()->setCellValue(($column++).$row, $score['hole9_score']);				
					else:
						$column += 9;
					endif;
					$i++;
				endforeach;
				for( ; $i <= $field_count; $i++ ):
					$column += 9;
				endfor;
			endif;
			
			$row++;
			$column = 'A';
		endforeach;
		// Save it as an excel 2003 file
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="'. $tournament_data['tour_name'].'.xls"');
		$objWriter->save('php://output');
	}
	
	public function testingscore($tourId) {
		$data['tournament_data'] = $this->tournament_model->getById($tourId)->row_array();
		$data['player_data'] = $this->pairing_model->getPlayerOrderByHoleSeq($tourId)->result_array();
		foreach($data['player_data'] as $key => $player):
			$data['player_data'][$key]['scores'] = $this->score_model->getByPlayerID($player['player_id'])->result_array();
		endforeach;
		$data['field_data'] = $this->tour_field_model->getFieldByTourId($tourId)->result_array();
		$content = $this->load->view('exportFile/scoring', $data, true);
		echo $content;
	}
}

/* End of file exportFile.php */
/* Location: ./application/controllers/exportFile.php */