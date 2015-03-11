<?php
class Testexcel extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
		header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=test.xls');
		echo '<table><tr>';
		echo '<th>headers</th>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>hello excel</td>';
		echo '</tr>';
		echo '</table>';
	} 
}

?>