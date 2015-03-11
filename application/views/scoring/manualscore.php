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
		<li class="active">ส่งออก - นำเข้า Excel</li>
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
			<a href="<?php echo site_url("scoring/livescore/".$tournament_data['tour_id']);?>">
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
			<a href="#">
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
	<h4 class="page-header">บันทึกผลการแข่งขัน</h4>
	<div class="row">
		
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="box box-primary">
				<form role="form">
					<div class="box-header">
						<h3 class="box-title">ส่งออก & นำเข้า Excel</h3>
					</div>
					<div class="box-body ">
						<div class="row">
							<div class="col-md-6 col-xs-6">
								<div class="box-body">
									<p>ส่งออกไฟล์ออกเป็นเอกสาร Excel</p>
									<button class="btn btn-info"><i class="fa fa-download"></i> Generate Excel</button>
								</div>
							</div>
							<div class="col-md-6 col-xs-6">
								<form role="form">
									<div class="box-body">
										<p>นำเข้าข้อมูลที่ได้จากเอกสาร Excel</p>
										<div class="form-group">
											<label for="exampleInputFile">File input</label>
											<input type="file" id="exampleInputFile">
											<p class="help-block">ไฟล์ที่แนบต้องเป็นไฟล์ที่ได้จากการส่งออกเท่านั้น!!</p>
										</div>
									</div>
									<div class="box-footer clearfix no-border">
										<button type="submit" class="btn btn-success pull-right" >บันทึก</button>
									</div>
								</form>
							</div>
						</div>
					</div><!-- /.box-body -->
					
				</form>
			</div>
		</div>
	</div>
</section><!-- /.content -->
