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
		$data['player_data'] = $this->getStorkPlayScore($tour_id);
		if($data['tournament']['tour_scoretype'] == 2):// Stable Ford
			$data['player_data'] = $this->getStableFordScore($data['player_data'], $tour_id);
		endif;
		$this->render('summary/summary', $data);
	}
	public function getStorkPlayScore($tour_id) {
		$players = $this->score_model->getScore($tour_id)->result_array();
		foreach ($players as $key => $player) :
			$count = 0;
			$holeLeft = $this->score_model->countHoleLeft($player['player_id']);
			$isOUT = 0;
			$players[$key]['out'] = 0;
			$players[$key]['in'] = 0;
			foreach ($holeLeft->result_array() as $Left) :
				if ($isOUT == 0):
					$players[$key]['out'] = $Left['gross_score'];
					$isOUT++;
				else:
					$players[$key]['in'] = $Left['gross_score'];
				endif;
			endforeach;
		endforeach;
		return $players;
	}
	public function teamSummary($tour_id) {
		$data['tournament'] = $this->tournament_model->getById($tour_id)->row_array();
		if ($data['tournament']['tour_scoregroup'] == null || $data['tournament']['tour_flightdivide'] == null) :
			redirect('summary/config/' . $tour_id, 'refresh');
		endif;
		$player_score = $this->score_model->getPlayerScore($tour_id)->result_array();
		$data['team_data'] = $this->tour_team_model->getByTourIdWithTeamScore($tour_id)->result_array();
		foreach($data['team_data'] as $key => $team):
			$data['team_data'][$key]['team_score'] = $this->calculate_score_model->getTeamScoreLimitTo($data['tournament']['tour_scoregroup'], $team['team_id']);
		endforeach;
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
	
	public function getPlayerSummary($player_id, $tourId) {
		header ('Content-type: text/html; charset=utf-8');
		$this->load->model('tour_field_model');
		$this->load->model('tour_player_model');
		$this->load->model('tournament_model');
		$tour_data = $this->tournament_model->getById($tourId)->row_array();
		$player_data = $this->tour_player_model->getPlayer($player_id, $tourId);
		$field_data = $this->tour_field_model->getFieldByTourId($tourId);
		if($tour_data['tour_scoretype'] == 2):
			$player_data = $this->getStableFordScore($player_data->result_array(), $tourId)[0];	
		else:
			$player_data = $player_data->row_array();
		endif;
		header ('Content-type: text/html; charset=utf-8');
		echo '<h1>'.$player_data['player_name'].' (HC: '.$player_data['player_hc'].')</h1>';
		echo '<table class="table table-bordered" >';
		echo '<thead><tr><th>หลุม</th>';
		$field_seq = 1;
		foreach ($field_data->result_array() as $row):
			for($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq'])*9); $i++):
				echo '<th>' . $i . '</th>'; 
			endfor;
			if ($field_seq == 1):
				echo '<th>OUT</th>';
				$field_seq++;
			else:
				echo '<th>IN</th>';
				echo '<th>Total</th><th>HC</th><th>NET Score</th></tr>';
			endif;
		endforeach;
		$field_seq = 1; $Score =0;
		echo '<tr><td>Par</td>';
		foreach ($field_data->result_array() as $row):
			for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
				$holeNo = $i % 9;
				if ($holeNo == 0) :
					echo '<td class="hole" id="hole'.$i.'">' . $row['hole9_par'] . '</td>'; 
				else :
					echo '<td class="hole" id="hole'.$i.'">' . $row['hole' . $holeNo . '_par'] . '</td>'; 
				endif;
			endfor;
			if ($field_seq == 1):
				$Score = $row['hole1_par']+$row['hole2_par']+$row['hole3_par']+$row['hole4_par']+$row['hole5_par']+$row['hole6_par']+$row['hole7_par']+$row['hole8_par']+$row['hole9_par'];
				echo '<th>'.$Score.'</th>';
				$field_seq++;
			else:
				$total = $Score;
				$Score = $row['hole1_par']+$row['hole2_par']+$row['hole3_par']+$row['hole4_par']+$row['hole5_par']+$row['hole6_par']+$row['hole7_par']+$row['hole8_par']+$row['hole9_par'];
				$total = $total + $Score;
				echo '<th>'.$Score.'</th>';
				echo '<th>'.$total.'</th><th></th><th></th></tr>';
			endif;
		endforeach;
		echo '<tr><td>Gross</td>';
		$field_seq = 1; $Score =0;
		foreach ($field_data->result_array() as $row):
			$scorecard = $this->tour_player_model->getScoreCardByPlayerId($player_id, $row['field_id'], $tourId)->row_array();
			for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
				$holeNo = $i % 9;
				if ($holeNo == 0) :
					echo '<td class="gross" id="'.$i.'">'. $scorecard['hole9_score'] . '</td>';
				else:
					echo '<td class="gross" id="'.$i.'">'. $scorecard['hole' . $holeNo . '_score'] . '</td>';
				endif;
			endfor;
			if ($field_seq == 1):
				$Score = $scorecard['gross_score'];
				echo '<td>'.$Score.'</td>';
				$field_seq++;
			else:
				$total = $Score;
				$Score = $scorecard['gross_score'];
				$total = $total + $Score;
				echo '<td>'.$Score.'</td>';
				echo '<td>'.$total.'</td><td>'.$player_data['player_hc'].'</td>';
				if ($tour_data['tour_scoretype'] == 1):
					echo '<td>'.($total - $player_data['player_hc']).'</td></tr>';
				else:
					echo '<td></td></tr>';
				endif;
			endif;
		endforeach;
		if ($tour_data['tour_scoretype'] == 2):
			echo '<tr><td>Stableford</td>';
			$sum = 0;
			foreach($player_data['stable_out'] as $stable):
				echo '<td>'. $stable . '</td>';
				$sum += $stable;
			endforeach;
			echo '<td>'.$sum.'</td>';
			$sum2 = 0;
			foreach($player_data['stable_in'] as $stable):
				echo '<td>'. $stable . '</td>';
				$sum2 += $stable;
			endforeach;
			echo '<td>'.$sum2.'</td>';
			echo '<td></td><td></td>';
			echo '<td>'.($sum+$sum2).'</td>';
			echo '</tr>';
		endif;
		echo '</tbody></table>';
		echo '<table class="table table-bordered"><tr><td class="manybogey">&nbsp;</td><td>More</td><td class="doublebogey">&nbsp;</td><td>Double Bogey</td><td class="bogey">&nbsp;</td><td>Bogey</td><td class="par">&nbsp;</td><td>par</td><td class="birdie">&nbsp;</td><td>Birdie</td><td class="eagle">&nbsp;</td><td>Eagle</td><td class="albatross">&nbsp;</td><td>Albatross</td><td class="holeinone">&nbsp;</td><td>Hole in One</td></tr></table>';
	
	}
	
	public function getTeamSummary($team_id) {
		$team_data = $this->tour_team_model->getByTeamId($team_id)->row_array();
		$field_data = $this->tour_field_model->getFieldByTourId($team_data['tournament_tour_id']);
		$player_data = $this->tour_player_model->getPlayerByTeamId($team_id);
		header ('Content-type: text/html; charset=utf-8');
		echo '<h1>'.$team_data['team_name'].'</h1>';
		echo '<table class="table table-bordered">';
		echo '<tbody><tr><th>Hole</th>';
		for($hole = 1; $hole < 10; $hole++):
			echo '<th>'.$hole.'</th>';
		endfor;
		echo '<th>OUT</th>';
		for($hole = 10; $hole < 19; $hole++):
			echo '<th>'.$hole.'</th>';
		endfor;
		echo '<th>IN</th>';
		echo '<th>HC</th><th>Total</th></tr>';
		$field_seq = 1; $Score =0;
		echo '<tr><td>Par</td>';
		foreach ($field_data->result_array() as $hole):
			for ($i = (($hole['field_seq']) * 9 - 8); $i <= (($hole['field_seq']) * 9); $i++):
				$holeNo = $i % 9;
				if ($holeNo == 0) :
					echo '<td class="hole" id="hole'.$i.'">' . $hole['hole9_par'] . '</td>'; 
				else :
					echo '<td class="hole" id="hole'.$i.'">' . $hole['hole' . $holeNo . '_par'] . '</td>'; 
				endif;
			endfor;
			if ($field_seq == 1):
				$Score = $hole['hole1_par']+$hole['hole2_par']+$hole['hole3_par']+$hole['hole4_par']+$hole['hole5_par']+$hole['hole6_par']+$hole['hole7_par']+$hole['hole8_par']+$hole['hole9_par'];
				echo '<th>'.$Score.'</th>';
				$field_seq++;
			else:
				$total = $Score;
				$Score = $hole['hole1_par']+$hole['hole2_par']+$hole['hole3_par']+$hole['hole4_par']+$hole['hole5_par']+$hole['hole6_par']+$hole['hole7_par']+$hole['hole8_par']+$hole['hole9_par'];
				$total = $total + $Score;
				echo '<th>'.$Score.'</th>';
				echo '<th></th><th>'.$total.'</th></tr>';
			endif;
		endforeach;
		foreach ($player_data->result_array() as $player):
			echo '<tr><td>'.$player['player_name'].'</td>';
			$field_seq = 1; $Score =0;
			foreach ($field_data->result_array() as $row):
				$scorecard = $this->tour_player_model->getScoreCardByPlayerId($player['player_id'], $row['field_id'], $team_data['tournament_tour_id']);
				if ($scorecard->num_rows() == 1):
					$scorecard = $scorecard->row_array();
					for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
						$holeNo = $i % 9;
						if ($holeNo == 0) :
							echo '<td class="gross" id="'.$i.'">'. $scorecard['hole9_score'] . '</td>';
						else:
							echo '<td class="gross" id="'.$i.'">'. $scorecard['hole' . $holeNo . '_score'] . '</td>';
						endif;
					endfor;
					if ($field_seq == 1):
						$Score = $scorecard['gross_score'];
						echo '<td>'.$Score.'</td>';
						$field_seq++;
					else:
						$total = $Score;
						$Score = $scorecard['gross_score'];
						$total = $total + $Score;
						echo '<td>'.$Score.'</td>';
						echo '<td>'.$player['player_hc'].'</td><td style="background-color:#F4FA58">'.$total.'</td></tr>';
					endif;
				else:
					for ($i = (($row['field_seq']) * 9 - 8); $i <= (($row['field_seq']) * 9); $i++):
						echo '<td></td>';
					endfor;
					if ($field_seq == 1):
						$Score = 0;
						echo '<td>'.$Score.'</td>';
						$field_seq++;
					else:
						$total = $Score;
						echo '<td>'.$Score.'</td>';
						echo '<td>'.$player['player_hc'].'</td><td style="background-color:#F4FA58">'.$total.'</td></tr>';
					endif;
				endif;
			endforeach;
		endforeach;
		echo '</table>';
		echo '<table class="table table-bordered"><tr><td class="manybogey">&nbsp;</td><td>More</td><td class="doublebogey">&nbsp;</td><td>Double Bogey</td><td class="bogey">&nbsp;</td><td>Bogey</td><td class="par">&nbsp;</td><td>par</td><td class="birdie">&nbsp;</td><td>Birdie</td><td class="eagle">&nbsp;</td><td>Eagle</td><td class="albatross">&nbsp;</td><td>Albatross</td><td class="holeinone">&nbsp;</td><td>Hole in One</td></tr></table>';
	}
	
	public function getStableFordScore($player_data, $tourId) {
		$field_data = $this->tour_field_model->getFieldByTourId($tourId);
		
		foreach($player_data as $key => $player):
			$isOUT = 0;
			$player_data[$key]['stable_out'] = array();
			$player_data[$key]['stable_in'] = array();
			$player_data[$key]['net_score'] = 0;
			foreach($field_data->result_array() as $field):
				$scorecard = $this->tour_player_model->getScoreCardByPlayerId($player['player_id'], $field['field_id'], $tourId)->row_array();
				$stableH1 = $this->calculate_score_model->stableford($field['hole1_par'], $scorecard['hole1_score']);
				$stableH2 = $this->calculate_score_model->stableford($field['hole2_par'], $scorecard['hole2_score']);
				$stableH3 = $this->calculate_score_model->stableford($field['hole3_par'], $scorecard['hole3_score']);
				$stableH4 = $this->calculate_score_model->stableford($field['hole4_par'], $scorecard['hole4_score']);
				$stableH5 = $this->calculate_score_model->stableford($field['hole5_par'], $scorecard['hole5_score']);
				$stableH6 = $this->calculate_score_model->stableford($field['hole6_par'], $scorecard['hole6_score']);
				$stableH7 = $this->calculate_score_model->stableford($field['hole7_par'], $scorecard['hole7_score']);
				$stableH8 = $this->calculate_score_model->stableford($field['hole8_par'], $scorecard['hole8_score']);
				$stableH9 = $this->calculate_score_model->stableford($field['hole9_par'], $scorecard['hole9_score']);
				if ($isOUT == 0):
					$player_data[$key]['net_score'] = $stableH1 + $stableH2 + $stableH3 + $stableH4 + $stableH5 + $stableH6 + $stableH7 + $stableH8 + $stableH9;
					$player_data[$key]['stable_out'] = array($stableH1, $stableH2, $stableH3, $stableH4, $stableH5, $stableH6, $stableH7, $stableH8, $stableH9);
					$isOUT++;
				else:
					$player_data[$key]['net_score'] += $stableH1 + $stableH2 + $stableH3 + $stableH4 + $stableH5 + $stableH6 + $stableH7 + $stableH8 + $stableH9;
					$player_data[$key]['stable_in'] = array($stableH1, $stableH2, $stableH3, $stableH4, $stableH5, $stableH6, $stableH7, $stableH8, $stableH9);
				endif;
			endforeach;
		endforeach;
		return $player_data;
	}
	
	
}

/* End of file Summary.php */
/* Location: ./application/controllers/Summary.php */