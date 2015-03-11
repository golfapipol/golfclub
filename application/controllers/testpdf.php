<?php
class Testpdf extends CI_Controller{	
	public function __construct()
	{ 
		parent::__construct();
	}
	public function index()
	{
		$this->load->library('MPDF57/mpdf');
		$this->mpdf = new mPDF();
		$this->mpdf->WriteHTML('<p>Hello There</p>');
		$this->mpdf->Output();
	}
}

?>