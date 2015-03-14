<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Format_time_model extends MyModel {
	
	public function __construct() {
		parent::__construct();
		
	}
	
	public function formatToText($date) { // yyyy/mm/dd yyyy.mm.dd yyyy-mm-dd
		if ($date != null) {
			list($year, $month, $day) = explode('-', $date);
			$output = $day . ' ';
			switch ($month) :
				case '01':	
					$output .= 'มกราคม';	break;
				case '02':	
					$output .= 'กุมภาพันธ์';	break;
				case '03':	
					$output .= 'มีนาคม';	break;
				case '04':	
					$output .= 'เมษายน';	break;
				case '05':	
					$output .= 'พฤษภาคม';	break;
				case '06':	
					$output .= 'มิถุนายน';	break;
				case '07':	
					$output .= 'กรกฏาคม';	break;
				case '08':	
					$output .= 'สิงหาคม';	break;
				case '09':	
					$output .= 'กันยายน';	break;
				case '10':	
					$output .= 'ตุลาคม';	break;
				case '11':	
					$output .= 'พฤศจิกายน';	break;
				case '12':	
					$output .= 'ธันวาคม';	break;
			endswitch;
			$output .= ' ' . (intval($year) + 543);
			return $output;
		}
	}

	public function BEtoCE($date) {
		list($year, $month, $day) = explode('/', $date);
		$CE_format = (intval($year) - 543) . "-" . $month . "-" . $day;
		return $CE_format;
	}
	public function CEtoBE($date) {
		list($year, $month, $day) = explode('-', $date);
		$BE_format = (intval($year) + 543) . "-" . $month . "-" . $day;
		return $BE_format;
	}
}

/* End of file format_time_model.php */
/* Location: ./application/models/format_time_model.php */