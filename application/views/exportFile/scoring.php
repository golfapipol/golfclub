<html xmlns:o=”urn:schemas-microsoft-com:office:office”
	xmlns:x=”urn:schemas-microsoft-com:office:excel”
	xmlns=”http://www.w3.org/TR/REC-html40″>
<HTML>
<HEAD>
<meta http-equiv=”Content-type” content=”text/html;charset=UTF-8″ />
</HEAD>
<BODY>
<?php 
	echo '<TABLE BORDER=1 CELLSPACING=2 CELLPADDING=15>
		<TR>
			<TD>300</TD>
			<TD colspan="4">Tournament_name</TD>
		</TR>';
	echo '<TR>
			<TD>ID</TD>
			<TD>ชื่อ - นามสกุล</TD>
			<TD>HC</TD>
			<TD>เพศ</TD>	
			<TD>อายุ</TD>';
			
	$field_start = 0;
	//foreach (): //loop for field (9, 18, 27)
	for ($field_start = 0; $field_start < 2; $field_start++): //test
		for ($hole = 1; $hole < 10; $hole++):
			echo '<TD>'.($hole + ($field_start * 9)).'</TD>';
		endfor;
		
	endfor;//test
	//	$field_start++;
	//endforeach;
	echo '</TR>';
	/*foreach ( as $player): //player
		echo '<TR>';
	
		echo '</TR>';
	endforeach;*/
	echo '</TABLE>';
?>
</BODY>
</HTML>