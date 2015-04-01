<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/required.php");
class Summary extends Required {

	/** available
	 * {content}
	 */
	public function __construct () {
		//call parent::__construct() for use $this->load
		parent::__construct();
		$this->load->model('club_model');
		$this->load->model('field_model');
		$this->load->model('flight_model');
		$this->load->model('player_model');
		$this->load->model('tournament_model');
		$this->load->model('tour_field_model');
		$this->load->model('tour_player_model');
		$this->load->model('tour_team_model');
		$this->load->model('pairing_model');
		$this->load->model('score_model');
		$this->load->model('format_time_model');
		$this->load->model('calculate_score_model');
	}
	
	public function playerSummary($tour_id) {
		$data['tournament'] = $this->tournament_model->getById($tour_id)->row_array();
		if ($data['tournament']['tour_scoregroup'] == null || $data['tournament']['tour_flightdivide'] == null) :
			redirect('summary/config/' . $tour_id, 'refresh');
		endif;
		$data['flights'] = $this->flight_model->getByTourId($tour_id)->result_array();
		//$data['team_score'] = $this->score_model->getTeamScore($tour_id)->result_array();
		$this->render('summary/summary', $data);
	}
	
	public function teamSummary($tour_id) {
		$data['tournament'] = $this->tournament_model->getById($tour_id)->row_array();
		if ($data['tournament']['tour_scoregroup'] == null || $data['tournament']['tour_flightdivide'] == null) :
			redirect('summary/config/' . $tour_id, 'refresh');
		endif;
		$player_score = $this->score_model->getPlayerScore($tour_id)->result_array();
		$data['team_score'] = $this->calculate_score_model->getTeamScoreLimitTo($data['tournament']['tour_scoregroup'], $player_score);
		//$data['team_score'] = $this->score_model->getTeamScore($tour_id)->result_array();
		$this->render('summary/teamsummary', $data);
	}
	
	public function config($tour_id) {
		$data['tournament'] = $this->tournament_model->getById($tour_id)->row_array();
		$data['male_flights'] = $this->flight_model->getMaleFlightByTourId($tour_id)->result_array();
		$data['female_flights'] = $this->flight_model->getFemaleFlightByTourId($tour_id)->result_array();
		$this->render('summary/config', $data);
	}
	
	public function config_control($tour_id) {
		$scoreType = $_POST['scoreType'];
		$scoregroup = $_POST['scoregroup'];
		$flightType = $_POST['flightType'];
		$this->tournament_model->update_config($tour_id, $scoreType, $scoregroup, $flightType);
		$name = '';
		$start = 0;
		$end = 24;
		$maletype = 1; $femaletype = 2;
		$this->flight_model->deleteByTourID($tour_id);
		if ($flightType == 1): // All
			for($i = 'A'; $i <= 'Z'; $i++):
				if (isset($_POST['male-endrange-'.$i])):
					$name = $i;
					$end = $_POST['male-endrange-'.$i];
					$this->flight_model->insert($name, $start, $end, $maletype, $tour_id);
					$start = $end + 1;
				else:
					 break;
				endif;
				
			endfor;
		else: // Male Female
			for($i = 'A'; $i <= 'Z'; $i++): // male flight
				if (isset($_POST['male-endrange-'.$i])):
					$name = $i;
					$end = $_POST['male-endrange-'.$i];
					$this->flight_model->insert($name, $start, $end, $maletype, $tour_id);
					$start = $end + 1;
				else:
					 break;
				endif;
			endfor;
			$start = 0;
			for($i = 'A'; $i <= 'Z'; $i++): // female flight
				if (isset($_POST['female-endrange-'.$i])):
					$name = $i;
					$end = $_POST['female-endrange-'.$i];
					$this->flight_model->insert($name, $start, $end, $femaletype, $tour_id);
					$start = $end + 1;
				else:
					 break;
				endif;
			endfor;
		endif;
		redirect('summary/config/' . $tour_id, 'refresh');
	}
	
	public function getPlayerSummary($player_id, $tour_id) {
		
	}
	
	public function getTeamSummary($team_id, $tour_id) {
		
	}
}

/* End of file Summary.php */
/* Location: ./application/controllers/Summary.php */