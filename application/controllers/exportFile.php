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
		
	}
	public function pairing($tourId) {
		header('Content-type: application/pdf');
		$data['tournament_data'] = $this->tournament_model->getById($tourId)->row_array();
		$data['player_data'] = $this->tour_player_model->pairing($tourId);
		$data['hole_data'] = $this->tour_field_model->getFirstField($tourId)->row_array();
		$this->load->library('mpdflib/mpdf');

		$content = $this->load->view('exportFile/prototypepdf', '', true);

		$this->mpdf = new mPDF('th');
		$this->mpdf->WriteHTML($content);
		$this->mpdf->Output();
	}
	public function testingpairing($tourId) {
		$data['tournament_data'] = $this->tournament_model->getById($tourId)->row_array();
		$data['player_data'] = $this->tour_player_model->pairingHoleGroup($tourId)->result_array();
		$data['hole_data'] = $this->tour_field_model->getFirstField($tourId)->result_array();
		$this->load->library('mpdflib/mpdf');

		$content = $this->load->view('exportFile/pairing', $data, true);
		echo $content;
	}
	public function score($tourId) {
		$content = $this->load->view('exportFile/scoring', '', true);
		ob_end_clean();
		header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=test.xls');
		echo $content;
	}
	public function testingscore($tourId) {
		$content = $this->load->view('exportFile/scoring', '', true);
		echo $content;
	}
	public function test() {
		header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=test.xls');
		echo '<TABLE BORDER=10 CELLSPACING=2 CELLPADDING=10>';
		echo '<CAPTION> บัญชีรายละเอียดการแต่งตั้งอาจารย์พิเศษ  แนบท้ายคำสั่งมหาวิทยาลัยบูรพา ที่              / ๒๕๕๖  ลงวันที่         สิงหาคม  พ.ศ. ๒๕๕๖ </CAPTION>';
		echo '<CAPTION>  </CAPTION>';
		echo '<BR></BR>';
		echo '<TR>';
		echo '<TD ALIGN = "center">ลำดับที่</TD>';
		echo '<TD ALIGN = "center">ชื่อ -นามสกุล
		     หมายเลขบัตรประชาชน</TD>';
		echo '<TD ALIGN = "center">คุณวุฒิ/ สาขาวิชา/ สถาบัน/ ปีที่จบ (ก.พ. รับรองคุณวุฒิ)</TD>';
		echo '<TD ALIGN = "center">รหัสวิชา</TD>';
		echo '<TD ALIGN = "center">ชื่อวิชา</TD>';
		echo '<TD ALIGN = "center">หน่วยกิต</TD>';
		echo '<TD ALIGN = "center">ภาคการศึกษา/ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">ระดับการศึกษาที่สอน</TD>';
		echo  '</TR>';
		
		echo '<TR>';
		echo '<TD ALIGN = "center">ลำดับที่</TD>';
		echo '<TD ALIGN = "center">ชื่อ -นามสกุล/ หมายเลขบัตรประชาชน</TD>';
		echo '<TD ALIGN = "center"คุณวุฒิ/ สาขาวิชา/ สถาบัน/ ปีที่จบ (ก.พ. รับรองคุณวุฒิ)</TD>';
		echo '<TD ALIGN = "center"รหัสวิชา</TD>';
		echo '<TD ALIGN = "center">ชื่อวิชา</TD>';
		echo '<TD ALIGN = "center">หน่วยกิต</TD>';
		echo '<TD ALIGN = "center">ภาคการศึกษา/ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">ระดับการศึกษาที่สอน</TD>';
		echo '</TR>';
		
		
		
		echo '<TR>';
		echo '<TD ALIGN = "center">ลำดับที่</TD>';
		echo '<TD ALIGN = "center">ชื่อ -นามสกุล/ หมายเลขบัตรประชาชน</TD>';
		echo '<TD ALIGN = "center"คุณวุฒิ/ สาขาวิชา/ สถาบัน/ ปีที่จบ (ก.พ. รับรองคุณวุฒิ)</TD>';
		echo '<TD ALIGN = "center"รหัสวิชา</TD>';
		echo '<TD ALIGN = "center">ชื่อวิชา</TD>';
		echo '<TD ALIGN = "center">หน่วยกิต</TD>';
		echo '<TD ALIGN = "center">ภาคการศึกษา/ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">ระดับการศึกษาที่สอน</TD>';
		echo '</TR>';
		
		
		echo '<TR>';
		echo '<TD ALIGN = "center">ลำดับที่</TD>';
		echo '<TD ALIGN = "center">ชื่อ -นามสกุล/ หมายเลขบัตรประชาชน</TD>';
		echo '<TD ALIGN = "center"คุณวุฒิ/ สาขาวิชา/ สถาบัน/ ปีที่จบ (ก.พ. รับรองคุณวุฒิ)</TD>';
		echo '<TD ALIGN = "center"รหัสวิชา</TD>';
		echo '<TD ALIGN = "center">ชื่อวิชา</TD>';
		echo '<TD ALIGN = "center">หน่วยกิต</TD>';
		echo '<TD ALIGN = "center">ภาคการศึกษา/ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">ระดับการศึกษาที่สอน</TD>';
		echo '</TR>';
		
		echo '<TR>';
		echo '<TD ALIGN = "center">ลำดับที่</TD>';
		echo '<TD ALIGN = "center">ชื่อ -นามสกุล/ หมายเลขบัตรประชาชน</TD>';
		echo '<TD ALIGN = "center"คุณวุฒิ/ สาขาวิชา/ สถาบัน/ ปีที่จบ (ก.พ. รับรองคุณวุฒิ)</TD>';
		echo '<TD ALIGN = "center"รหัสวิชา</TD>';
		echo '<TD ALIGN = "center">ชื่อวิชา</TD>';
		echo '<TD ALIGN = "center">หน่วยกิต</TD>';
		echo '<TD ALIGN = "center">ภาคการศึกษา/ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">ระดับการศึกษาที่สอน</TD>';
		echo '</TR>';
		echo '</TABLE>';
	}
}

/* End of file exportFile.php */
/* Location: ./application/controllers/exportFile.php */