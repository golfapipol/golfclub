<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MyModel.php");
class Calculate_score_model extends MyModel {
	public function formatStrokePlay($fieldData, $scoreData, $playerData) {
		
	}
	public function formatStableFord($fieldData, $scoreData, $playerData) {
		
	}
	public function getStrokePlayScore($fieldData, $scoreData, $playerData) {
		
	}
	public function getStableFordScore($fieldData, $scoreData, $playerData) {
		
	}
	
	public function getTeamScoreLimitTo($limit, $scores) {
		$teamScore = array();
		$player_count = 0; $team_id = -1; $team_count = -1;
		foreach ($scores as $score) :
			if ($team_id == $score['team_id'] && $player_count <= $limit):
				$player_count++;
				$teamScore[$team_count]['team_score'] += $score['total_score'];
			elseif($team_id != $score['team_id'] ) : // first time / next team
				$team_count++;
				$team_id = $score['team_id'];
				$player_count = 1;
				$teamScore[$team_count]['team_id'] = $team_id;
				$teamScore[$team_count]['team_name'] = $score['team_name'];
				$teamScore[$team_count]['team_score'] = $score['total_score'];
			elseif($player_count > $limit): // nothing
			endif;
		endforeach;
		return $teamScore;
	}
}

/* End of file zone_model.php */
/* Location: ./application/models/zone_model.php */