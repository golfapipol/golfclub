<?php
class Testexcelsystem extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
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

?>