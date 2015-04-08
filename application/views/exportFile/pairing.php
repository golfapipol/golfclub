<style>
    .header h3{ margin-top: 5%;text-align: center; font-size:20pt; }
    .header h4{text-align: center; font-size:18pt; }
    .container p{font-size:16pt; }
    .container u{font-size:16pt; }
	th { font-size:16pt; text-align: center;}
	td { font-size:16pt; padding:5px;text-align: center;}
    </style>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <div class="header">
      <h3>การแข่งขันกีฬากอล์ฟ  <?php echo $tournament_data["tour_name"];?></h3>
      <h4>ระหว่าง วันที่ <?php echo $tournament_data["tour_startdate"];?> - <?php echo $tournament_data["tour_enddate"];?></h4>
      <h4>สนามกอล์ฟ <?php echo $tournament_data["club_name"];?></h4>
    </div>
    <div class="container">
		<?php 
		$hole_start = 0;
		foreach ($hole_data as $field_hole):
			echo '<h4><u>คอร์ส '.$field_hole['field_name'].'</u></h4>';
			for ($hole = 1; $hole < 10; $hole++):
				for ($group = 1; $group <= $field_hole['hole'.$hole.'_max_groups']; $group++):
					$pairing_player = array_filter($player_data, function ($player) use ($hole, $group, $field_hole){
						return ($player['hole'] == $hole && $player['group'] == $group && $player['field_id'] == $field_hole['tour_field_id']);
					});
					echo '<div>';
					echo '<p>หลุม '. ($hole + ($hole_start * 9)) . ' / ' .$group .'</p>';
					echo '<table class="table table-bordered">';
					echo '<thead><tr><th style="width:30%">ชื่อ - นามสกุล</th><th style="width:30%">ทีม</th><th style="width:10%">HC</th><th style="width:10%">อายุ</th><th style="width:10%">เพศ</th></tr></thead>';
					echo '<tbody>';
					foreach($pairing_player as $player):
						echo '<tr><td>'.$player['player_name'].'</td>';
						if ($player['team_id'] == 0):
							echo '<td> - </td>';
						else:
							echo '<td>'.$player['team_name'].'</td>';
						endif;
						echo '<td>'.$player['player_hc'].'</td>';
						echo '<td>';
						echo ($player['player_age'] == 0)? '-': $player['player_age'];
						echo '</td>';
						if ($player['player_sex'] == 1):
							echo '<td> ชาย </td>';
						else:
							echo '<td> หญิง </td>';
						endif;
						echo '</tr>';
					endforeach;
					if(sizeof($pairing_player) == 0):
						echo '<tr><td colspan="5">ไม่พบข้อมูล</td></tr>';
					endif;
					echo '</tbody></table>';
					echo '</div>';
				endfor;
			endfor;
			$hole_start += 1;
		endforeach; ?>
    </div>
