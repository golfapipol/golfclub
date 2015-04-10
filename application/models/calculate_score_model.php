<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Calculate_score_model extends MyModel {
	
	public function stableford ($par, $score) {
		$stable = 0;
		if($par != null && $score != null):
			$diff = $score - $par;
			switch ($diff):
				case 0:
					$stable = 2;
				break;
				case -1:
					$stable = 3;
				break;
				case -2:
					$stable = 4;
				break;
				case -3:
					$stable = 5;
				break;
				case 1:
					$stable = 1;
				break;
				case 2:
					$stable = 0;
				break;
				default:
			endswitch;
		else:
			$stable = 0;
		endif;
		return $stable;
	}
	public function getTeamScoreLimitTo($limit, $team_id) {
		$sql = "SELECT tour_player.team_id,team_name, tour_player.player_id, player_name, sum(gross_score) as gross_score 
				FROM score
				INNER JOIN tour_player 
				ON score.player_id = tour_player.player_id
				INNER JOIN tour_team
				ON tour_team.team_id = tour_player.team_id
				WHERE tour_player.team_id = ?
				GROUP BY score.player_id
				Limit ".$limit;
		$query = $this->db->query($sql, array($team_id));
		$sum_score = 0;
		foreach($query->result_array() as $player_score):
			$sum_score += $player_score['gross_score'];
		endforeach;
		return $sum_score;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */