<?php
class Testexcelfaculty extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
		header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=test.xls');
		echo '<TABLE BORDER=10 CELLSPACING=2 CELLPADDING=10>';
		echo '<CAPTION>คณะ</CAPTION>';
		echo '<TR>';
		echo '<TD ALIGN = "center">ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">คณะ</TD>';
		echo '<TD ALIGN = "center">รายชื่อของอาจารย์พิเศษ</TD>';
		echo '<TD ALIGN = "center">สถานะของอาจารย์พิเศษ</TD>';
		echo  '</TR>';
		
		echo '<TR>';
		echo '<TD ALIGN = "center"/////ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">///คณะ</TD>';
		echo '<TD ALIGN = "center">///รายชื่อของอาจารย์พิเศษ</TD>';
		echo '<TD ALIGN = "center">///สถานะของอาจารย์พิเศษ</TD>';
		echo  '</TR>';
		
		echo '<TR>';
		echo '<TD ALIGN = "center"/////ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">///คณะ</TD>';
		echo '<TD ALIGN = "center">///รายชื่อของอาจารย์พิเศษ</TD>';
		echo '<TD ALIGN = "center">///สถานะของอาจารย์พิเศษ</TD>';
		echo  '</TR>';
		
		echo '<TR>';
		echo '<TD ALIGN = "center"/////ปีการศึกษา</TD>';
		echo '<TD ALIGN = "center">///คณะ</TD>';
		echo '<TD ALIGN = "center">///รายชื่อของอาจารย์พิเศษ</TD>';
		echo '<TD ALIGN = "center">///สถานะของอาจารย์พิเศษ</TD>';
		echo  '</TR>';
		
		echo '</TABLE>';
		
	}
}

?>