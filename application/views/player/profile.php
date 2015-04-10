<style>a:hover{cursor:pointer;}.modal-dialog { width: 80%; margin: 30px auto;}</style>
<!-- ParColor -->
<link href="<?php echo base_url();?>css/golfclub/parcolor.css" rel="stylesheet" type="text/css" />

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		ข้อมูลสมาชิก
		<small>Player Informations</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">ข้อมูลสมาชิก</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="box box-solid box-primary">
		<div class="box-header">
			<h2 class="box-title">โปรไฟล์นักกีฬา</h2>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
					<img class="img-circle"
						 src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100"
						 alt="User Pic">
				</div>
				<div class="col-xs-2 col-sm-2 hidden-md hidden-lg">
					<img class="img-circle"
						 src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50"
						 alt="User Pic">
				</div>
				
				<div class=" col-md-6 col-lg-6 ">
					<strong><h4><?php echo $player_data['prefix_name'], " ", $player_data['player_name'];?></h4></strong><br>
					<table class="table table-user-information">
						<tbody>
						<tr>
							<td>วันเดือนปีเกิด :</td>
							<td><?php echo $player_data['player_birthdate']; ?></td>
						</tr>
						<tr>
							<td>สถานะนักกีฬา :</td>
							<td><?php echo $player_data['status_name']; ?></td>
						</tr>
						<tr>
							<td>Handicap ล่าสุด :</td>
							<td><?php echo $player_data['player_last_hc']; ?></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="box-footer clearfix">
			<span class="pull-right">
				<button class="btn btn-sm btn-info" type="button"
						data-toggle="tooltip"
						data-original-title="พิมพ์โปรไฟล์นักกีฬา"><i class="glyphicon glyphicon-print"></i></button>
			</span>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">สถิติการแข่งขัน</h3>
		</div><!-- /.box-header -->
		<div class="box-body no-padding">
			<table class="table table-hover">
				<tbody><tr>
					<th>#</th>
					<th>รายการแข่งขัน</th>
					<th>HC</th>
					<th>Gross Score</th>
				</tr>
				<?php 
					if(sizeof($player_history) > 0):
						$i=1;
						foreach($player_history as $history):
							echo '<tr><td><a onclick="viewHistoryScore('.$history['tour_id'].')">' . $i++ .'</a></td>';
							echo '<td><a onclick="viewHistoryScore('.$history['tour_id'].')">' . $history['tour_name'] . '</a></td>';
							echo '<td><a onclick="viewHistoryScore('.$history['tour_id'].')">' . $history['player_hc'] . '</a></td>';
							echo '<td><a onclick="viewHistoryScore('.$history['tour_id'].')">' . $history['total_score'] . '</a></td></tr>';
						endforeach;
					else:
						echo '<tr><td colspan="4">ไม่พบประวัติการเข้าร่วมการแข่งขัน</td></tr>';
					endif;
				?>
			</tbody></table>
		</div><!-- /.box-body -->
	</div>
</section><!-- /.content -->
<div class="modal fade in" id="player_summary" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myLargeModalLabel">ประวัติการแข่งขันของคุณ <?php echo $player_data['player_name'];?><a class="anchorjs-link" href="#myLargeModalLabel"><span class="anchorjs-icon"></span></a></h4>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
	function viewHistoryScore(tourId) {
		var player_id = '<?php echo $player_data['player_id']?>';
		//ajax
		var url = "<?php echo site_url("playerinfo/getPlayerHistory");?>" +"/"+ tourId + "/" + player_id;
		$.ajax({
			type:'POST',
			url:url,
			success:function(data){
				$('#modal-body').html(data);
				addColor();
				$('#player_summary').modal({show:true});
			}
		});
			
	}
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