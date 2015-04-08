<HTML xmlns:o=”urn:schemas-microsoft-com:office:office”
	xmlns:x=”urn:schemas-microsoft-com:office:excel”
	xmlns=”http://www.w3.org/TR/REC-html40″>
<HEAD>
<meta http-equiv=”Content-type” content=”text/html;charset=UTF-8″ />
<style> td { font-size:18px}
</style>
</HEAD>
<BODY>
<?php 
	$color = array(0=> 'OrangeRed', 1 =>'DarkOrange', 2 =>'Orange', 3=>'Red', 4=>'SlateBlue', 5=>'Indigo');
	echo '<TABLE BORDER=1 CELLSPACING=2 CELLPADDING=15>
		<TR>
			<TD>'.$tournament_data['tour_id'].'</TD>
			<TD colspan="4">'.$tournament_data['tour_name'].'</TD>';
	$field_limit = count($field_data);
	for ($field_start = 0; $field_start < $field_limit; $field_start++):
		for ($hole = 1; $hole < 10; $hole++):
			echo '<TD style="width:30px;background-color:'.$color[$field_start].';">'.($hole + ($field_start * 9)).'</TD>';
		endfor;
	endfor;
	echo '</TR>';
	echo '<TR style="background-color:yellow;"> <TD style="width:40px;">ID</TD> <TD style="width:200px;">ชื่อ - นามสกุล</TD> <TD style="width:50px;">เพศ</TD> <TD style="width:50px;">อายุ</TD> <TD style="width:50px;">HC</TD>';
	$field_start = 0;
	$field_count = count($field_data);
	foreach ($field_data as $par): 
		echo '<TD style="width:50px">'.$par['hole1_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole2_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole3_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole4_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole5_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole6_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole7_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole8_par'].'</TD>';
		echo '<TD style="width:50px">'.$par['hole9_par'].'</TD>';
	endforeach;
	echo '</TR>';
	foreach ($player_data as $player): //player
		echo '<TR>';
		echo '<TD>'.$player['player_id'].'</TD>';
		echo '<TD>'.$player['player_name'].'</TD>';
		echo ($player['player_sex'] == 1) ? '<TD>ชาย</TD>':'<TD>หญิง</TD>';
		echo ($player['player_age'] == 0) ? '<TD>-</TD>':'<TD>'.$player['player_age'].'</TD>';
		echo '<TD>'.$player['player_hc'].'</TD>';
		if (count($player['scores']) == 2):
			foreach ($player['scores'] as $score):
				echo ($score['hole1_score'] == null)? '<TD></TD>':'<TD>'.$score['hole1_score'].'</TD>';
				echo ($score['hole2_score'] == null)? '<TD></TD>':'<TD>'.$score['hole2_score'].'</TD>';
				echo ($score['hole3_score'] == null)? '<TD></TD>':'<TD>'.$score['hole3_score'].'</TD>';
				echo ($score['hole4_score'] == null)? '<TD></TD>':'<TD>'.$score['hole4_score'].'</TD>';
				echo ($score['hole5_score'] == null)? '<TD></TD>':'<TD>'.$score['hole5_score'].'</TD>';
				echo ($score['hole6_score'] == null)? '<TD></TD>':'<TD>'.$score['hole6_score'].'</TD>';
				echo ($score['hole7_score'] == null)? '<TD></TD>':'<TD>'.$score['hole7_score'].'</TD>';
				echo ($score['hole8_score'] == null)? '<TD></TD>':'<TD>'.$score['hole8_score'].'</TD>';
				echo ($score['hole9_score'] == null)? '<TD></TD>':'<TD>'.$score['hole9_score'].'</TD>';
			endforeach;
		else:
			$i = 1;
			for( ; $i <= $field_count; $i++ ):
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
				echo '<TD></TD>';
			endfor;
		endif;
		echo '</TR>';
	endforeach;
	echo '</TABLE>';
?>
</BODY>
</HTML>