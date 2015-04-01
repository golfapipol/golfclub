<style>
input{width:70%;}
.number-input{text-align:center}
table{text-align:center}
th{text-align:center}
li{cursor:pointer}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?php echo $tournament_data['tour_name'];?>
		<small>
		<?php echo '<td>'.$tournament_data['tour_startdate'].' - '.$tournament_data['tour_enddate'].'</td>';?>
		</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url("challenge");?>">รายการแข่งขัน</a></li>
		<li>บันทึกผลการแข่งขัน</li>
		<li class="active">กรอกคะแนน</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<h4 class="page-header">บันทึกผลการแข่งขัน</h4>
	<div class="box box-primary">
		<div class="box-body">
			<?php if($field_data->num_rows() > 0 && $pairing_data->num_rows() > 0): ?>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="row">
						<div class="col-md-4 col-xs-4">
							<form role="form" id="scoring-form">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
								  <li class="active"><a href="#filter_hole" role="tab" data-toggle="tab">ค้นหาจากหลุม</a></li>
								  <li><a href="#filter_team" role="tab" data-toggle="tab">ค้นหาจากทีม</a></li>
								  <li><a href="#filter_manual" role="tab" data-toggle="tab">ส่งออก-นำเข้า</a></li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane active" id="filter_hole"><br />						
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group">
													<label>หลุม</label>
													<select class="form-control chosen-select" name="hole" id="hole">
														<?php for($i=1; $i <= ($maxhole['field_seq']*9) ; $i++){
															echo '<option value="'.$i.'">'.$i.'</option>';
														}?>
													</select>
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group">
													<label>ก๊วน</label>
													<select class="form-control chosen-select" name="group" id="group">
													</select>
												</div>
											</div>
										</div>
										<div class="form-group clearfix ">
											<button type="button" class="btn btn-success pull-right" onclick="search_by_hole()">ค้นหา</button>
										</div>
									</div>
									<div class="tab-pane" id="filter_team"><br />
										<!--div class="form-group">
											<label for="InputName">ชื่อผู้เข้าแข่งขัน</label>
											<input type="text" class="form-control" id="InputName" placeholder="ค้นหาด้วยชื่อ...">
										</div-->
										<div class="form-group">
											<label>ทีม</label>
											<select class="form-control chosen-select" name="team" id="team">
												<?php if($team_data->num_rows() > 0):
												foreach($team_data->result_array() as $row):
													echo '<option value="'.$row['team_id'].'">'.$row['team_name'].'</option>';
												endforeach;
												endif;?>
											</select>
										</div>
										<div class="form-group clearfix ">
											<button type="button" class="btn btn-success pull-right" onclick="search_by_team()">ค้นหา</button>
										</div>
									</div>
									<div class="tab-pane" id="filter_manual"><br />
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
									</div>
										
								</div>
							</form>
						</div>
						<div class="col-md-4 col-xs-4">
							<ul class="nav nav-pills nav-stacked" id="player">
							</ul>
						</div>
						<div class="col-md-4 col-xs-4">
							<button class="btn btn-warning col-md-12" onclick="window.open('http://localhost/project/local/index.php/scoring/scoreboard/9');">Live Score</button>
							<!--p id="player_left">ผลการกรอกคะแนนจาก  ?? / ?? คน</p-->
						</div>
					</div>
				</div>
			</div>
			<?php else : ?>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">บันทึกผลการแข่งขัน</h3>
						</div>
						<div class="box-body ">
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>เกิดข้อผิดพลาด</b> กรุณาเลือกสนาม, ข้อมูลการแข่งขัน และจัดก๊วนผู้เล่นที่ใช้ก่อนทำคิดคะแนน
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix">
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row" id="scorecard-row">
		<div class="col-md-12 col-xs-12">
			<div class="box box-primary" id="scorecard">
			</div>
		</div>
	</div>
</section><!-- /.content -->
<div class="modal fade bs-example-modal-sm" id="message" tabindex="-3" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">การดำเนินการ</h4>
			</div>
			<div class="modal-body">
				บันทึกเรียบร้อย	
			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-info" data-dismiss="modal">ตกลง</button>
			</div>
		</div>
	</div>
	
</div>
<div class="modal fade bs-example-modal-sm" id="error" tabindex="-3" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">เกิดข้อผิดพลาด</h4>
			</div>
			<div class="modal-body">
				เกิดข้อผิดพลาด ขณะทำการส่งข้อมูล โปรดติดต่อผู้ดูแลระบบ
			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ตกลง</button>
			</div>
		</div>
	</div>
	
</div>
<script type="text/javascript">
// Chosen 
$(".chosen-select").chosen({no_results_text:'ไม่พบรายการที่ทำการค้นหา',width: '50px'});
$("#scorecard-row").fadeOut();
$(document).ready(function(){
	if($("#hole").val()){
		var value = $("#hole").val();
		var url = "<?php echo site_url("scoring/score_control/1/".$tournament_data['tour_id']);?>";
		$.ajax({
			type:'POST',
			url:url,
			data:{hole:value},
			success:function(data){
				$('#group').find('option').remove();
				// add option groups
				for(i = 1 ; i <= parseInt(data); i++)
					if(i==1){
						$('#group').append('<option value="'+i+'" selected>'+i+'</option>');
					}else{
						$('#group').append('<option value="'+i+'">'+i+'</option>');
					}
				$('#group').trigger('chosen:updated');
			}
		});
	}
});
$('#hole').change(function(){
	var value = $("#hole").val();
	var url = "<?php echo site_url("scoring/score_control/1/".$tournament_data['tour_id']);?>";
	$.ajax({
		type:'POST',
		url:url,
		data:{hole:value},
		success:function(data){
			$('#group').find('option').remove();
			// add option groups
			for(i = 1 ; i <= parseInt(data); i++)
				if(i==1){
					$('#group').append('<option value="'+i+'" selected>'+i+'</option>');
				}else{
					$('#group').append('<option value="'+i+'">'+i+'</option>');
				}
			$('#group').trigger('chosen:updated');
		}
	});
});
function search_by_hole(){
	var hole = $('#hole').val();
	var group = $('#group').val();
	if(group){
		var url = "<?php echo site_url("scoring/getPlayer"); ?>/"+hole+"/"+group+"/<?php echo $tournament_data['tour_id'];?>";
		//$holeid,$group,$fieldid
		$.ajax({
			type:'POST',
			url:url,
			success:function(data){
				$('#player').html(data);
			}
		});
	}else{//alert("null");
		
	}
}
function search_by_team(){
	var team = $("#team").val();
	var url = "<?php echo site_url("scoring/score_control/2/".$tournament_data['tour_id']);?>";
		$.ajax({
			type:'POST',
			url:url,
			data:{teamid:team},
			success:function(data){
				$('#player').html(data);
				console.log(url);
			}
		});
}
function getcard(id, element){
	$("#player").find("li").removeClass("active");
	$(element).parent().addClass("active");
	var url = "<?php echo site_url("scoring/getScoreCard"); ?>/"+id+"/<?php echo $tournament_data['tour_id'];?>";
		//$holeid,$group,$fieldid
		$.ajax({
			type:'POST',
			url:url,
			success:function(data){
				$("#scorecard").html(data);
				sum();gross();
				$(".number-input").keyup(function(e) { 
					sum();
				});
				$(".number-input").keydown(function(e) { 
				// from http://stackoverflow.com/questions/995183/how-to-allow-only-numeric-0-9-in-html-inputbox-using-jquery
					// Allow: backspace, delete, tab, escape, enter and . (190)
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
						 // Allow: Ctrl+A
						(e.keyCode == 65 && e.ctrlKey === true) || 
						 // Allow: home, end, left, right
						(e.keyCode >= 35 && e.keyCode <= 39) ||
						 // Allow: -
						(e.keyCode == 109 || e.keyCode == 189)) {
							 // let it happen, don't do anything
							 return;
					}
					// Ensure that it is a number and stop the keypress
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						
						e.preventDefault();
					}
					
				});
			}
		});
	$("#scorecard-row").fadeIn();
}
function submitScore(){
	var url = "<?php echo site_url("scoring/score_control/3/".$tournament_data['tour_id']);?>";		
	$.ajax({
		type:"post",
		url: url,
		cache: false,
		data: $('#scorecard-form').serialize(),
		success: function(data){
			$("#message").modal({ show:true});
		},
		error: function(request, status, error) {
			$("#error").modal({ show:true});
			//alert(request.responseText);
		}
	});
}
function sum(){
	var sum = 0;
	$(".number-input").each(function(){
		if($(this).val() != "")
		sum += parseInt($(this).val());
	});
	$(".sum").text(sum);
}
function gross(){
	var sum = 0;
	$(".hole_par").each(function(){	
		if($(this).text() != "")
		sum += parseInt($(this).text());
	});
	$(".gross_par").text(sum);
}
</script>