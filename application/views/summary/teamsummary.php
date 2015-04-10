<style>.flightinput{width:70%;text-align:center} a:hover{cursor:pointer;}  .modal-dialog { width: 80%; margin: 30px auto;}</style>
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
			<h3 style="text-align:center;">ผลการแข่งขันประเภททีม <?php echo $tournament['tour_name'];?></h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<table id="scoreboard" class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th style="width:50%">Team</th>
								<th>Total Gross Score</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if (count($team_data) > 0):
								$i = 1;
								foreach($team_data as $team):
									echo '<tr><td><a class="team" value="'. $team['team_id'].'">'.$i++.'</a></td><td><a class="team" value="'. $team['team_id'].'">'. $team['team_name'] .'</a></td><td><a class="team" value="'. $team['team_id'].'">'. $team['team_score'] .'</a></td></tr>';
								endforeach;
							else:
								echo '<tr><td colspan="3">ไม่พบข้อมูลผลการแข่งขัน</td></tr>';
							endif;
						?>
					</tbody></table>
				</div>
			</div>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
		</div>
	</div>
</section><!-- /.content -->
<div class="modal fade in" id="team_summary" tabindex="-2" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">ผลการแข่งขันประเภททีม<a class="anchorjs-link" href="#myLargeModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body" id="summary_body">
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<script>
$('.team').click(function () {
	var value = $(this).attr('value');
	var url = "<?php echo site_url('summary/getTeamSummary');?>/" + value;
	$.get( url, function() {})
	.done(function(data) {
		console.log(data);
		$("#summary_body").html(data);
		addColor();
		$('#team_summary').modal('show');
	});
});
var table = $("#scoreboard").dataTable({
				"bLengthChange": false,
				"bSort": true,"aaSorting": [[ 3, "asc" ]]
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