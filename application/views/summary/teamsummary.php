<style>.flightinput{width:70%;text-align:center}  .modal-dialog { width: 80%; margin: 30px auto;}</style>
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
			<h3 style="text-align:center;">ผลการแข่งขันประเภททีม</h3>
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
							if (count($team_score) > 0):
								$i = 1;
								foreach($team_score as $team):
									echo '<tr><td>'.$i.'</td><td><a class="team" value="'. $team['team_id'].'">'. $team['team_name'] .'</a></td><td>'. $team['team_score'] .'</td></tr>';
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
          <h4 class="modal-title" id="myLargeModalLabel">Large modal<a class="anchorjs-link" href="#myLargeModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body">
          <h1>Team Name </h1>
		  <p> Total HC : 24</p>
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
				<th>Total</th>
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
				<th>Total</th>
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
				<th>John</th>
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
				<th>John</th>
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
				<th>Jane</th>
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
				<th>Jane</th>
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
			<tr>
				<th>Tim</th>
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
				<th>Tim</th>
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
			<tr>
				<th>Sam</th>
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
				<th>Sam</th>
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
$('.team').click(function () {
	var value = $(this).attr('value');
	var url = "<?php echo site_url('summary/getTeamSummary');?>/" + value;
	$.get( url, function() {})
	.done(function(data) {
		console.log(data);
		//$().html(data);
		$('#team_summary').modal('show');
	});
});
var table = $("#scoreboard").dataTable({
				"bLengthChange": false,
				"bSort": true,"aaSorting": [[ 3, "asc" ]]
			});
</script>