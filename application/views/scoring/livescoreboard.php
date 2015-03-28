<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Live Score Board</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
		<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- font Awesome -->
		<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="<?php echo base_url();?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="<?php echo base_url();?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<style>body { font-size:60px} th { text-align:center;} td { text-align:center;} .tab_hover{ background: red!important; } .error { color:red} .required{ color:red} .big{font-size:x-large} .male {color:#22A7F0} .female {color:#9A12B3}
		</style>
		<!-- jQuery 2.0.2 -->
		<script src="<?php echo base_url();?>js/jquery.min.js"></script>
		<!-- jQuery UI 1.10.3 -->
		<script src="<?php echo base_url();?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
		<!-- Bootstrap -->
		<script src="<?php echo base_url();?>js/bootstrap.min.js" type="text/javascript"></script>
		<!-- AdminLTE App -->
		<script src="<?php echo base_url();?>js/AdminLTE/app.js" type="text/javascript"></script>
		<!-- JQuery Validate -->
		<script src="<?php echo base_url();?>js/plugins/jqueryValidate/jquery.validate.min.js" type="text/javascript"></script>
    </head>
	<body class="skin-blue fixed container">
		<div class="content">
			<div class="box">
				<div class="box-header">
					<h1 style="text-align:center"><button class="btn btn-danger">Live</button>ผลการแข่งขันล่าสุด ชลบุรีเกมส์ ครั้งที่ 41</h1>
				</div>
				<div class="box-body no-padding">
					<table class="table table-condensed" id="scoreboard">
						<thead>
							<tr>
								<th style="width: 10px">No.</th>
								<th>Name</th>
								<th>Team</th>
								<th>HC</th>
								<th>Thru</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i = 1;
							foreach($livescore as $row) :
								echo '<tr><td>' . $i++ . '</td>';
								echo '<td>' . $row["player_name"] . '</td>';
								echo '<td>' . $row['team_name'] . '</td>';
								echo '<td>' . $row["player_hc"] . '</td>';
								echo '<td>' . $row["hole_left"] . '</td>';
								echo '<td>' . $row["total_score"] . '</td></tr>';
							endforeach;?>
						</tbody></table>
				</div><!-- /.box-body -->
			</div>
		</div>
		<script>
var mTable = document.getElementById('scoreboard')
    ,mTBody = mTable.querySelector('tbody')
	,mTR = mTBody.querySelectorAll('tr')
;
$(document).ready(function() {
	setInterval(function() {
		var url = "<?php echo site_url("scoring/refreshLiveScore/".$tournament_data['tour_id']);?> ";
		$.ajax({
			type:'POST',
			url:url,
			success:function(data){
				$(mTBody).fadeOut();
				$(mTBody).html(data);
				$(mTBody).fadeIn();
			}
		});
	}, 12000);
});
		</script>
	</body>
</html>
