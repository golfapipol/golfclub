<?php
class Testexcelsias extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
		header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=test.xls');
		echo '<table><tr>';
		echo '<th>บัญชีรายละเอียดการแต่งตั้งอาจารย์พิเศษ  แนบท้ายคำสั่งมหาวิทยาลัยบูรพา ที่              / ๒๕๕๖  ลงวันที่         สิงหาคม  พ.ศ. ๒๕๕๖</th>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>ลำดับที่</td>';
		echo '<td>ชื่อ -นามสกุล/ หมายเลขบัตรประชาชน</td>';
		echo '<td>คุณวุฒิ/ สาขาวิชา/ สถาบัน/ ปีที่จบ (ก.พ. รับรองคุณวุฒิ)</td>';
		echo '<td>ตำแหน่ง/สังกัด</td>';
		echo '</tr>';
		echo '</table>';
	} 
}

?>