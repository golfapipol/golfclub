<style>.flightinput{width:70%;text-align:center} .modal-dialog { width: 80%; margin: 30px auto;} a:hover{cursor:pointer;}</style>
<!-- ParColor -->
<link href="<?php echo base_url();?>css/golfclub/parcolor.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>ผลการแข่งขัน<small>Summary Result</small></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">ผลการแข่งขัน</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4 col-xs-5">
			<!-- small box -->
			<a href="<?php echo site_url("summary/playerSummary/" . $tournament['tour_id']);?>">
				<div class="small-box bg-blue">
					<div class="inner"><h3>Score Summary</h3><p>ประเภทบุคคล</p></div>
					<div class="icon"><i class="fa fa-fw fa-user"></i></div>
					<div class="small-box-footer">&nbsp;</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-5">
			<a href="<?php echo site_url("summary/teamSummary/" . $tournament['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner"><h3>Group Summary</h3><p>ประเภททีม</p></div>
					<div class="icon"><i class="fa fa-fw fa-users"></i></div>
					<div class="small-box-footer">&nbsp;</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-2">
			<a href="<?php echo site_url("summary/config/" . $tournament['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-light-blue">
					<div class="inner"><h3>Config</h3><p>ตั้งค่า</p></div>
					<div class="icon"><i class="fa fa-fw fa-gear "></i></div>
					<div class="small-box-footer">&nbsp;</div>
				</div>
			</a>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3 style="text-align:center;">
				ผลการแข่งขันประเภทบุคคล 
			<?php echo $tournament['tour_name'];
				if($tournament['tour_scoretype'] == 1):
					echo ' (Stroke Play)';
				elseif($tournament['tour_scoretype'] == 2):
					echo ' (Stable Ford)';
				endif;
			?> 
			</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="row">	
				<div class="col-md-3 col-xs-3">
					<div style="margin-top: 15px;">
						<ul class="nav nav-pills nav-stacked">
							<li class="header">ประเภทบุคคล</li>
							<li class="filter active" value="0"><a><i class="fa fa-folder"></i>ทั้งหมด</a></li>
							<?php 
								if (count($flights)):
									foreach($flights as $flight):
										if ($tournament['tour_flightdivide'] == 1):
											echo '<li class="filter" value="'.$flight['flight_id'].'"><a>Flight '.$flight['flight_name'].'</a></li>';
										else:
											if ($flight['flight_type'] == 1):
												echo '<li class="filter" value="'.$flight['flight_id'].'"><a>ชาย '.$flight['flight_name'].'</a></li>';
											else:
												echo '<li class="filter" value="'.$flight['flight_id'].'"><a>หญิง '.$flight['flight_name'].'</a></li>';
											endif;
										endif;
									endforeach;
								endif;
							?>
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-xs-9">
					<table id="scoreboard" class="table table-bordered">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Flight</th>
							<th style="display:none">Flight</th>
							<th>Handicap</th>
							<th>OUT</th>
							<th>IN</th>
							<th>Gross Score</th>
							<th>Net Score</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$i = 1;
							foreach($player_data as $player):
								echo '<tr><td><a class="player" value="'.$player['player_id'].'">' . $i++ . '</a></td>';
								echo '<td><a class="player" value="'.$player['player_id'].'">'. $player['player_name'] . '</a></td>';
								foreach($flights as $flight):
									if (($flight['flight_startrange'] <= $player['player_hc']) && ($flight['flight_endrange'] >= $player['player_hc'])):
										if($tournament['tour_flightdivide'] == 1):
											echo '<td><a class="player" value="'.$player['player_id'].'">'.$flight['flight_name'].'</a></td><td style="display:none">'.$flight['flight_id'].'</td>';
										elseif($tournament['tour_flightdivide']== 2 && ($flight['flight_type'] == $player['player_sex'])):
											echo ($flight['flight_type'] == 1)? '<td><a class="player" value="'.$player['player_id'].'">ชาย'.$flight['flight_name'].'</a></td>': '<td><a class="player" value="'.$player['player_id'].'">หญิง'.$flight['flight_name'].'</a></td>';
											echo '<td><a class="player" value="'.$player['player_id'].'">'.$flight['flight_id'].'</a></td>';
										endif;
										break;
									endif;
								endforeach;
								echo '<td><a class="player" value="'.$player['player_id'].'">' . $player['player_hc'] . '</a></td>';
								echo '<td><a class="player" value="'.$player['player_id'].'">' . $player['out'] . '</a></td>';
								echo '<td><a class="player" value="'.$player['player_id'].'">' . $player['in'] . '</a></td>';
								echo '<td><a class="player" value="'.$player['player_id'].'">' . $player['total_score'] . '</a></td>';
								echo '<td><a class="player" value="'.$player['player_id'].'">' . $player['net_score'] . '</a></td></tr>';
							endforeach;
						?>
					</tbody></table>
		
				</div>
			</div>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
			
		</div>
	</div>
</section><!-- /.content -->

<div class="modal fade in" id="player_summary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">ผลการแข่งขัน <?php echo $tournament['tour_name'];?><a class="anchorjs-link" href="#myLargeModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body" id="modal-body">
          <h1>Name </h1>
		  <p> HC : 24</p>
		  <table class="table table-bordered">
			<tbody>
			<tr>
				<th>Hole</th>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>OUT</th>
				<th>Total Score</th>
				<th>Hole</th>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
				<th>7</th>
				<th>8</th>
				<th>9</th>
				<th>OUT</th>
				<th>Total Score</th>
			</tr>
			<tr>
				<th>Par</th>
				<th>5</th>
				<th>4</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>3</th>
				<th>36</th>
				<th>72</th>
			</tr>
			<tr>
				<th>Gross</th>
				<th>5</th>
				<th>4</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>3</th>
				<th>36</th>
				<th>76</th>
			</tr>
			<tr>
				<th>Stableford</th>
				<th>5</th>
				<th>4</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>3</th>
				<th>36</th>
				<th>36</th>
			</tr>
		</tbody></table>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
 <script>
var table = $("#scoreboard").dataTable({
				"bLengthChange": false,
				"bSort": true//,"aaSorting": [[ 3, "desc" ]]
			});
			
$('.filter').click(function(e){
	$('.filter').each(function(){
		$(this).removeClass("active");
	});
	$(this).addClass("active");
	var filter = $(this).val();
	if(filter == "0"){ 
		table.fnFilter("",3);
	}else {
		table.fnFilter( filter,3);
	}
	//
});

$('.player').click(function () {
	var value = $(this).attr('value');
	var url = "<?php echo site_url('summary/getPlayerSummary');?>/" + value + "/<?php echo $tournament['tour_id'];?>";
	$.get( url, function() {})
	.done(function(data) {
		console.log(data);
		$("#modal-body").html(data);
		addColor();
		$('#player_summary').modal('show');
	});
	
});
function addColor(){
	$(".gross").each(function () {
		var id = $(this).attr('id');
		var par = $("#hole" + id).text();
		var gross = $(this).text();
		if (gross != "" && par != "") {
			var number = parseInt(gross, 10) - parseInt(par, 10); 
			switch(number) {
				case 0:
					$(this).addClass("par");
				break;
				case 1:
					$(this).addClass("bogey");
				break;
				case 2:
					$(this).addClass("doublebogey");
				break;
				case 3:
					$(this).addClass("manybogey");
				break;
				case -1:
					$(this).addClass("birdie");
				break;
				case -2:
					if (par == 3) {
						$(this).addClass("holeinone");
					} else {
						$(this).addClass("eagle");
					}
				break;
				case -3:
					if (par == 4) {
						$(this).addClass("holeinone");
					} else {
						$(this).addClass("albatross");
					}
				break;
				case -4:
					if (par == 5) {
						$(this).addClass("holeinone");
					} else {
						$(this).addClass("albatross");
					}
				break;
				default: // > 3
					$(this).addClass("manybogey");
				break;
			}
		}
	});
}
</script>