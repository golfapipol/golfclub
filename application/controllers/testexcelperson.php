<?php
class Testexcelperson extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
		header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=test.xls');
		echo '<TABLE BORDER=10 CELLSPACING=2 CELLPADDING=10>';
		echo '<br></br>';
		echo '<CAPTION>รายบุคคล</CAPTION>';
		echo '<TR>';
		echo '<TD ALIGN = "center">ชื่อ-นามสกุล</TD>';
		echo '<TD ALIGN = "center"><br></br>สัญชาติ</TD>';
		echo '<TD ALIGN = "center"><br></br>วันเดือนปีเกิด</TD>';
		echo '<TD ALIGN = "center"><br></br>อายุ</TD>';
		echo '<TD ALIGN = "center"><br></br><br></br>ที่อยู่</TD>';
		echo '<TD ALIGN = "center"><br></br>ปัจจุบันดำรงตำแหน่ง</TD>';
		echo '<TD ALIGN = "center"><br></br>สถานที่ทำงาน</TD>';
		echo  '</TR>';
		echo '<TR>';
		
		echo '<TD ALIGN = "center">///////////
				xxxxxxxxxxxx</TD>';
		echo '<TD ALIGN = "center">สัญชาติ//////</TD>';
		echo '<TD ALIGN = "center">วันเดือนปีเกิด////////</TD>';
		echo '<TD ALIGN = "center"อายุ//</TD>';
		echo '<TD ALIGN = "center">ที่อยู่////</TD>';
		echo '<TD ALIGN = "center">ปัจจุบันดำรงตำแหน่ง///</TD>';
		echo '<TD ALIGN = "center">สถานที่ทำงาน/////</TD>';
		echo  '</TR>';

		
		echo '<TD ALIGN = "center">///////////
				xxxxxxxxxxxx</TD>';
		echo '<TD ALIGN = "center">สัญชาติ//////</TD>';
		echo '<TD ALIGN = "center">วันเดือนปีเกิด////////</TD>';
		echo '<TD ALIGN = "center"อายุ//</TD>';
		echo '<TD ALIGN = "center">ที่อยู่////</TD>';
		echo '<TD ALIGN = "center">ปัจจุบันดำรงตำแหน่ง///</TD>';
		echo '<TD ALIGN = "center">สถานที่ทำงาน/////</TD>';
		echo  '</TR>';
		
		
		echo '<TD ALIGN = "center">///////////
				xxxxxxxxxxxx</TD>';
		echo '<TD ALIGN = "center">สัญชาติ//////</TD>';
		echo '<TD ALIGN = "center">วันเดือนปีเกิด////////</TD>';
		echo '<TD ALIGN = "center"อายุ//</TD>';
		echo '<TD ALIGN = "center">ที่อยู่////</TD>';
		echo '<TD ALIGN = "center">ปัจจุบันดำรงตำแหน่ง///</TD>';
		echo '<TD ALIGN = "center">สถานที่ทำงาน/////</TD>';
		echo  '</TR>';
		
		echo '</TABLE>';
		
	}
}

?>