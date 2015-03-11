<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?php echo $tournament_data['tour_name'];?>
		<small><?php $TimeStart = explode("-",$tournament_data['tour_startdate']);
		$TimeEnd = explode("-",$tournament_data['tour_enddate']);
		echo '<td>'.$TimeStart[2]."/".$TimeStart[1]."/".$TimeStart[0].' - '.$TimeEnd[2]."/".$TimeEnd[1]."/".$TimeEnd[0].'</td>';?>
		</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url("challenge");?>">รายการแข่งขัน</a></li>
		<li>บันทึกผลการแข่งขัน</li>
		<li class="active">ผลการแข่งขันล่าสุด</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4 col-xs-4">
			<!-- small box -->
			<a href="<?php echo site_url("scoring/scorekeeper/".$tournament_data['tour_id']);?>">
				<div class="small-box bg-blue">
					<div class="inner">
						<h3>
							Scoring
						</h3>
						<p>บันทึกคะแนน
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-user"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-4">
			<a href="#">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>
							Live Score
						</h3>
						<p>ผลการแข่งขัน
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-users"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-4">
			<a href="<?php echo site_url("scoring/manualscore/".$tournament_data['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>
							Manual Score
						</h3>
						<p>ส่งออก - นำเข้า Excel
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-retweet"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
	</div>
	<h4 class="page-header">ผลการแข่งขันล่าสุด</h4>
	<div class="box box-primary">
		<div class="box-body table-responsive no-padding">
			<div class="row">	
				<div class="col-md-3 col-xs-3">
					<div style="margin-top: 15px;">
						<ul class="nav nav-pills nav-stacked">
							<li class="header">ประเภทบุคคล</li>
							<li class="filter active" value="0"><a><i class="fa fa-folder"></i>ทั้งหมด</a></li>
							<li class="filter" value="1"><a><i class="fa fa-file-o"></i>Flight A</a></li>
							<li class="filter" value="2"><a><i class="fa fa-fw fa-exclamation"></i>Flight B</a></li>
							<li class="filter" value="3"><a><i class="fa fa-fw fa-flag-checkered"></i>Flight C</a></li>
							<li class="filter" value="4"><a><i class="fa fa-fw fa-flag-checkered"></i>Flight D</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-xs-9">
					<table id="people" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width:30%">ชื่อผู้เข้าแข่งขัน</th>
								<th style="width:20%">ทีม</th>
								<th style="width:20%">Gross</th>
								<th style="width:30%">HC</th>
								<th style="display:none"></th>
							</tr>
						</thead>
						<tbody >
							<tr>
								<td>Jane</td>
								<td>BUU</td>
								<td>36</td>
								<td>20</td>
								<td style="display:none">1</td>
							</tr>
							<tr>
								<td>Wirote</td>
								<td>KU</td>
								<td>42</td>
								<td>22</td>
								<td style="display:none">2</td>
							</tr>
							<tr>
								<td>John</td>
								<td>MIT</td>
								<td>30</td>
								<td>10</td>
								<td style="display:none">3</td>
							</tr>
							<tr>
								<td>Pop</td>
								<td>BUU</td>
								<td>31</td>
								<td>16</td>
								<td style="display:none">4</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
			<div class="row">	
				<div class="col-md-3 col-xs-3">
					<div style="margin-top: 15px;">
						<ul class="nav nav-pills nav-stacked">
							<li class="header">ผลคะแนนของทีมต่างๆ</li>
							<li class="filter" value="1"><a><i class="fa fa-file-o"></i>BUU</a></li>
							<li class="filter" value="2"><a><i class="fa fa-fw fa-exclamation"></i>RU</a></li>
							<li class="filter" value="3"><a><i class="fa fa-fw fa-flag-checkered"></i>KU</a></li>
							<li class="filter" value="4"><a><i class="fa fa-fw fa-flag-checkered"></i>KKU</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-xs-9">
					<table id="people" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width:30%">ชื่อผู้เข้าแข่งขัน</th>
								<th style="width:20%">ทีม</th>
								<th style="width:20%">Gross</th>
								<th style="width:30%">HC</th>
								<th style="display:none"></th>
							</tr>
						</thead>
						<tbody >
							<tr>
								<td>Jane</td>
								<td>BUU</td>
								<td>36</td>
								<td>20</td>
								<td style="display:none">1</td>
							</tr>
							<tr>
								<td>Wirote</td>
								<td>KU</td>
								<td>42</td>
								<td>22</td>
								<td style="display:none">2</td>
							</tr>
							<tr>
								<td>John</td>
								<td>MIT</td>
								<td>30</td>
								<td>10</td>
								<td style="display:none">3</td>
							</tr>
							<tr>
								<td>Pop</td>
								<td>BUU</td>
								<td>31</td>
								<td>16</td>
								<td style="display:none">4</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
			<div class="row">	
				<div class="col-md-3 col-xs-3">
					<div style="margin-top: 15px;">
						<ul class="nav nav-pills nav-stacked">
							<li class="header">ประเภททีม</li>
							
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-xs-9">
					<table id="people" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width:20%">ทีม</th>
								<th style="width:20%">Gross</th>
								<th style="width:30%">HC</th>
								<th style="display:none"></th>
							</tr>
						</thead>
						<tbody >
							<tr>
								<td>BUU</td>
								<td>200</td>
								<td>30</td>
								<td style="display:none">1</td>
							</tr>
							<tr>
								<td>KU</td>
								<td>190</td>
								<td>23</td>
								<td style="display:none">2</td>
							</tr>
							<tr>
								<td>KKU</td>
								<td>300</td>
								<td>40</td>
								<td style="display:none">3</td>
							</tr>
							<tr>
								<td>RU</td>
								<td>240</td>
								<td>30</td>
								<td style="display:none">4</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div><!-- /.box-body -->
			
		</div>
	</div>
</section><!-- /.content -->