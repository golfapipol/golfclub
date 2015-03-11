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
					<th>ID</th>
					<th>User</th>
					<th>Date</th>
					<th>Status</th>
					<th>Reason</th>
				</tr>
				<tr>
					<td>183</td>
					<td>John Doe</td>
					<td>11-7-2014</td>
					<td><span class="label label-success">Approved</span></td>
					<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				</tr>
				<tr>
					<td>219</td>
					<td>Jane Doe</td>
					<td>11-7-2014</td>
					<td><span class="label label-warning">Pending</span></td>
					<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				</tr>
				<tr>
					<td>657</td>
					<td>Bob Doe</td>
					<td>11-7-2014</td>
					<td><span class="label label-primary">Approved</span></td>
					<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				</tr>
				<tr>
					<td>175</td>
					<td>Mike Doe</td>
					<td>11-7-2014</td>
					<td><span class="label label-danger">Denied</span></td>
					<td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
				</tr>
			</tbody></table>
		</div><!-- /.box-body -->
	</div>
</section><!-- /.content -->