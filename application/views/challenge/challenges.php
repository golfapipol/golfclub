<section class="content-header">
	<h1>
		รายการแข่งขัน
		<small>Challenges</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">รายการแข่งขัน</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">รายการแข่งขันทั้งหมด</h3>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="row">	
				<div class="col-md-9 col-xs-9">
					<table id="tournament" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width:30%">รายการแข่งขัน</th>
								<th style="width:20%">ระยะเวลาแข่งขัน</th>
								<th style="width:30%">ดำเนินการ</th>
								<th style="display:none"></th>
							</tr>
						</thead>
						<tbody id="table_data">
							<?php 
							if($tournament_data->num_rows() > 0):
								foreach($tournament_data->result_array() as $row):
									echo '<tr><td>'.$row['tour_name'].'</td>';
									
									$TimeStart = explode("-",$row['tour_startdate']);
									$TimeEnd = explode("-",$row['tour_enddate']);
									echo '<td>'.$TimeStart[2]."/".$TimeStart[1]."/".(intval($TimeStart[0])+ 543 ).' - '.$TimeEnd[2]."/".$TimeEnd[1]."/".(intval($TimeStart[0])+ 543 ).'</td>';
									echo '<td>
										<div class="btn-group">
											<a class="btn btn-info btn-flat" data-toggle="tooltip" data-original-title="รายละเอียดการแข่งขัน"  href="'.site_url('challenge/tourinfo/'.$row['tour_id']).'"><i class="fa fa-fw fa-info-circle"></i></a>
											<a class="btn btn-success btn-flat" data-toggle="tooltip" data-original-title="กรอกคะแนน" href="'.site_url('scoring/scorekeeper/'.$row['tour_id']).'"><i class="fa fa-fw fa-clipboard" ></i></a>
											<a class="btn bg-orange btn-flat" data-toggle="tooltip" data-original-title="ผลการแข่งขัน" href="'.site_url('summary/playerSummary/'.$row['tour_id']).'"><i class="fa fa-fw fa-trophy"></i></a>
											<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไขการแข่งขัน" value="'.$row['tour_id'].'"><i class="fa fa-edit" ></i></button>
											<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="'.$row['tour_id'].'"><i class="fa fa-fw fa-trash-o"></i></button>
										</div>
									</td><td style="display:none">'.'</td></tr>';
								endforeach;
							endif;  ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-3 col-xs-3">
							<!-- compose message btn data-toggle="modal" data-target="#add-modal" -->
							<a class="btn btn-block btn-primary add" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;สร้างรายการแข่งขัน</a>
							<!-- Navigation - folders-->
							<!--div style="margin-top: 15px;">
								<ul class="nav nav-pills nav-stacked">
									<li class="header">สถานะการแข่งขัน</li>
									<li class="filter active" value="0"><a href="#"><i class="fa fa-folder"></i>การแข่งขันทั้งหมด</a></li>
									<li class="filter" value="1"><a href="#"><i class="fa fa-file-o"></i>ยังไม่เริ่มการแข่งขัน</a></li>
									<li class="filter" value="2"><a href="#"><i class="fa fa-fw fa-exclamation"></i>กำลังแข่งขัน</a></li>
									<li class="filter" value="3"><a href="#"><i class="fa fa-fw fa-flag-checkered"></i>สิ้นสุดการแข่งขัน</a></li>
								</ul>
							</div-->
					
				</div>
			</div><!-- /.box-body -->
		</div>
	</div>
</section><!-- /.content -->
		
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-plus-square"></i> สร้างรายการแข่งขัน</h4>
			</div>
			<form method="post" id="addform">
				<input type="hidden" name="action" value="1" id="action"/>
				<input type="hidden" name="editId" id="editId" />
				<div class="modal-body" id="addbody">
					<div class="form-group">
						<label for="InputName">ชื่อการแข่งขัน</label>
						<input type="text" class="form-control" id="InputName" name="InputName" placeholder="โปรดระบุชื่อการแข่งขัน">
					</div>
					<div class="form-group">
						<label for="InputClub">สนามแข่งขัน</label>
						<select data-placeholder="กรุณาเลือกสนามแข่งขัน" class="chosen-select" style="width:1000px" id="InputClub" name="InputClub"  >
							<option value=""></option>
							<?php foreach($chosen_club->result_array() as $row):
								echo "<option value='".$row['club_id']."' >".$row['club_name']."</option>";
								endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label>ระยะเวลาในการแข่งขัน</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" name="InputTime" id="InputTime"/>
						</div><!-- /.input group -->
					</div><!-- /.form group -->
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-primary submit"  ><i class="fa  fa-save "></i>บันทึก</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="remove-modal" tabindex="-2" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">ลบข้อมูล</h4>
			</div>
			<form id="deleteform">
				<div class="modal-body">
					<div class="form-group">
						<label for="InputName">คุณแน่ใจว่าต้องการลบข้อมูลนี้หรือไม่</label>
						<input type="hidden" class="form-control" name="InputId" id="InputId" >
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
					<button type="button" onclick="deletesubmit()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-o "></i> ลบ</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade bs-example-modal-sm" id="message" tabindex="-3" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">การดำเนินการ</h4>
			</div>
			<div class="modal-body">
				ทำรายการเสร็จสิ้น	
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
var table = $("#tournament").dataTable({
	"bLengthChange": false,
	"bSort": true
});
$(document).ready(function(){
	jqueryon();	
	//Date range picker
	$('#InputTime').daterangepicker();
	
	// Chosen 
	
});
function jqueryon()
{

	$(".add").off("click");
	$(".edit").off("click");
	$(".remove").off("click");
	$(".submit").off("click");
	$(".add").click(function(e){
		$("#action").val(1);
		$("#InputName").val("");
		$("#InputTime").val("");

		$("#add-modal").modal({show:true});
	});
	$(".edit").click(function(){
		var id = $(this).val();
		$("#action").val(2);
		$("#editId").val(id);
		var row = $(this).parent().parent().parent();
		$("#InputName").val(row.find('td:nth-child(1)').text());
		var timerange = row.find('td:nth-child(2)').text();
		var times = timerange.split("-");
		var starttime = times[0].split("/");
		var endtime = times[1].split("/");
		var show = starttime[0] + "/" + starttime[1] + "/" + (parseInt(starttime[2], 10) - 543).toString();
		show += " -" +endtime[0] + "/" + endtime[1] + "/" + (parseInt(endtime[2],10) - 543).toString()
		$('#InputTime').data("daterangepicker").setStartDate(starttime[0] + "/" + starttime[1] + "/" + (parseInt(starttime[2], 10) - 543).toString());
		$('#InputTime').data("daterangepicker").setEndDate(endtime[0] + "/" + endtime[1] + "/" + (parseInt(endtime[2],10) - 543).toString());
		// get data
		var url = "<?php echo site_url();?>/challenge/challenge_control/4/"+id;
		$.get( url, function() {})
		.done(function(data) {
			$("#InputClub").html(data);
			jqueryon();
		})
		.fail(function() { 
			$("#error").modal({ show:true});
		});
		$("#add-modal").modal({ show:true});
	});
	$(".remove").click(function(){
		var id = $(this).val();
		$("#InputId").val(id);
		$("#remove-modal").modal({ show:true});
	});
	$(".submit").click(function(){
		$("#addform").validate({
			rules: {
				InputName: "required",
				InputTime: "required",
				InputClub: {
					required: true
				}
			},submitHandler: function(form) {
				var url = "<?php echo site_url();?>/challenge/challenge_control/"+$("#action").val();
				$.ajax({
					type:"post",
					url: url,
					cache: false,
					data: $('#addform').serialize(),
					success: function(data){
						//alert(data);
						$("#add-modal").modal('hide');
						$("#message").modal({ show:true});
						//refresh data table
						refresh_table();
					},
					error: function(request, status, error) {
						$("#add-modal").modal('hide');
						$("#error").modal({ show:true});
						//alert(request.responseText);
					}
				});
			} 
		});
	});
	$('.filter').click(function(e){
		$('.filter').each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		var filter = $(this).val();
		if(filter == "0"){ 
			table.fnFilter("",4);
		}else if(filter == "1"){
			table.fnFilter( filter,4);
		}else if(filter == "2"){
			table.fnFilter( filter,4);
		}else if(filter == "3"){
			table.fnFilter( filter,4);
		}
		//
	});
	$(".chosen-select").chosen({no_results_text:'ไม่พบรายการที่ทำการค้นหา',width: '400px',search_contains: true});	
	$(".chosen-select").trigger("chosen:updated");	
}
function deletesubmit(){
	$.ajax({
		type:"post",
		url: "<?php echo site_url('challenge/challenge_control/3'); ?>",
		cache: false,
		data: $('#deleteform').serialize(),
		success: function(json){
			//alert(json);
			$("#remove-modal").modal('hide');
			$("#message").modal({ show:true});
			//refresh data table
			refresh_table();
			
		},
		error: function(e){
			//alert(e);
			$("#remove-modal").modal('hide');
			$("#error").modal({ show:true});
		}
	});
}
function refresh_table(){
	var url = "<?php echo site_url();?>/challenge/challenge_control/";
	$.get( url, function() {//alert( "success" );
	})
	.done(function(data) {
		table.fnDestroy();
		$("#table_data").html(data);
		table = $("#tournament").dataTable({
			"bLengthChange": false,
			"bSort": true
		});
		
		jqueryon();
	})
	.fail(function() { 
		$("#error").modal({ show:true});
	});
}
</script>