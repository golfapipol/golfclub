<style>
table{text-align:center;cursor:default}
th{text-align:center}
.edit-team{cursor:pointer}
.box .todo-list > li .label { font-size:14px}
.add-team{cursor:pointer}
.change_hc{cursor:pointer}
.inline{display:inline}

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
		<li>รายละเอียดการแข่งขัน</li>
		<li class="active">ลงชื่อนักกีฬา</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4 col-xs-4">
			<a href="<?php echo site_url("challenge/tourinfo/".$tournament_data['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>
							Info
						</h3>
						<p>รายละเอียด
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-info-circle"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-4">
			<!-- small box -->
			<a href="#">
				<div class="small-box bg-blue">
					<div class="inner">
						<h3>
							Player
						</h3>
						<p>ลงชื่อนักกีฬา
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
			<a href="<?php echo site_url("challenge/pairing/".$tournament_data['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-purple">
					<div class="inner">
						<h3>
							Pairing
						</h3>
						<p>จัดก๊วน
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-list-ul"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
	</div>
	<h4 class="page-header">รายชื่อผู้เข้าแข่งขัน</h4>
	<div class="row" >
		<div class="col-md-6 col-xs-6 group-table">
			<div class="box box-solid box-success ">
				<div class="box-header">
					<h3 class="box-title">รายชื่อทีมที่เข้าแข่งขัน</h3>
				</div>
				<form role="form">
					<div class="box-body table-responsive no-padding">
						<br />
						<table id="group" class="table table-hover table-bordered">
							<thead style="background-color:#3c8dbc">
								<tr>
									<th style="width:60%!important">ชื่อทีม</th>
									<th style="width:40%!important">ตัวเลือก</th>
								</tr>
							</thead>
							<tbody id="team-body">
							<?php if($team_data->num_rows() > 0):
								foreach($team_data->result_array() as $row):
									echo '<tr><td>'.$row['team_name'].'</td>';
									echo '<td><button type="button" class="btn btn-warning edit-team" data-toggle="tooltip" data-original-title="ดูรายละเอียด" onclick="edit_team_player('.$row['team_id'].')"><i class="fa fa-pencil"></i></button>
										<button type="button" class="btn btn-danger " data-toggle="tooltip" data-original-title="ลบ" onclick="remove_list_team(this)" value="'.$row['team_id'].'"><i class="fa fa-times"></i></button></td></tr>';
								endforeach;
							endif;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</form>
			</div>
		</div>
		<div class="col-md-3 col-xs-3 add-team" data-toggle="modal" data-target="#add-team-modal">
			<a >
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>
							Create 
						</h3>
						<p>เพิ่มทีม
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-users"></i>
					</div>
					<div class="small-box-footer">
						&nbsp;
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-6 col-xs-6 team-info">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="box-title">
						<button type="button" class="btn btn-primary cancel-team" style="margin-left:2px" data-toggle="tooltip" data-original-title="ย้อนกลับ"><i class="fa fa-arrow-left"></i></button>
						ข้อมูลทีม
					</h3>
				</div>
				<form role="form">
					<div class="box-body " >
						<div class="table-responsive">
							<div id="team-info-body">
							<h3>ทีม <div class="inline"></div><button type="button" class="btn btn-warning edit-team-info pull-right" data-toggle="tooltip" data-original-title="แก้ไขชื่อทีม" ><i class="fa fa-edit"></i></button></h3>
							<input type="hidden" name="teamId" id="teamId" />
							<br />
							</div>
							
							<table id="team-player" class="table table-hover table-bordered" style="width:100%!important">
								<thead style="background-color:#3c8dbc">
									<tr>
										<th style="width:40%!important">ชื่อ</th>
										<th style="width:20%!important">อายุ</th>
										<th style="width:15%!important">HC</th>
										<th style="width:15%!important">เพศ</th>
										<th style="width:15%!important">ตัวเลือก</th>
									</tr>
								</thead>
								<tbody class="drop-team">
								</tbody>
							</table>
						</div>
					</div>
					<div class="box-footer clearfix">
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6 col-xs-6 player">
			<div class="nav-tabs-custom">
				<!-- Tabs within a box -->
				<ul class="nav nav-tabs pull-right" style="cursor: move;">
					<li><a href="#non-member" data-toggle="tab">บุคคลทั่วไป</a></li>
					<li class="active"><a href="#member" data-toggle="tab">สมาชิก</a></li>
					<li class="pull-left header"><i class="fa fa-user"></i>เพิ่มผู้เล่น</li>
				</ul>
				<div class="tab-content no-padding">
					<div class="tab-pane active" id="member">
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">สมาชิก</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							
								<div class="box-body">
									<div class="table-responsive">
										<!-- THE MESSAGES -->
										<table class="table " id="member-table" style="width:100%!important">
											<thead style="background-color:#3c8dbc">
												<tr>
													<th style="width:20%!important"></th>
													<th style="width:30%!important">ชื่อ</th>
													<th style="width:15%!important">อายุ</th>
													<th style="width:25%!important">HC</th>
													<th style="width:10%!important">เพศ</th>
													<th style="display:none"></th>
												</tr>
											</thead>
											<tbody id="member-tbody">
											<?php 
											if($player_member_data->num_rows() > 0):
												foreach($player_member_data->result_array() as $row):
													echo '<tr class="item"><td><input type="checkbox" /></td>';
													echo '<td><a href="#">'.$row['player_name'].'</a></td>';
													// cal player age
													$age = ($row['player_birthdate'] != null )? floor((time() - strtotime($row['player_birthdate'])) / (60*60*24*365)): 0;
													echo '<td>'.$age.'</td>';
													echo '<td><div class="inline">'.$row['player_last_hc'].'</div><a class="change_hc" onclick="change_hc(this)"><i class="fa fa-edit pull-right" data-toggle="tooltip" data-original-title="เปลี่ยน Handicap"></i></a></td>';
													if($row['player_sex'] == 1):
														echo '<td><i class="fa fa-fw big male">&#9794; </i><p style="display:none">1</p></td>';
													else:
														echo '<td><i class="fa fa-fw big female">&#9792; </i><p style="display:none">2</p></td>';
													endif;
													echo '<td style="display:none">'.$row['player_id'].'</td></tr>';
												endforeach;
											endif;?>
											</tbody>	
										</table>
										<form role="form" id="member-form" >
											<input type="hidden" name="inputName" id="member_inputName" />
											<input type="hidden" name="inputAge" id="member_inputAge" />
											<input type="hidden" name="inputHC" id="member_inputHC" />
											<input type="hidden" name="InputSex" id="member_InputSex" />
											<input type="hidden" name="memberId" id="member_memberId" />
											<input type="hidden" name="teamid" id="member_teamid" />
										</form>
									</div><!-- /.table-responsive -->
								</div><!-- /.box-body -->
								<div class="box-footer clearfix no-border">
									<button type="button" class="btn btn-primary add-player-team pull-right" onclick="member_add_team()">เพิ่มผู้เล่น</button>									
								</div>
						</div>
					</div>
					<div class="tab-pane" id="non-member" >
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">บุคคลทั่วไป</h3>
							</div><!-- /.box-header -->
							<!-- form start -->
							<form role="form" id="non-member-form" >
								<input type="hidden" name="teamid" id="teamid_nonmember" />
								<div class="box-body">
									<div class="form-group">
										<label for="InputName">ชื่อ - นามสกุล</label>
										<input type="text" class="form-control" name="inputName" id="inputName" placeholder="กรุณากรอกชื่อ - นามสกุล">
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="InputAge">อายุ</label>
												<select class="form-control" name="inputAge" id="inputAge">
													<?php for($i=5;$i <= 90;$i++){
														if($i == 20){
															echo '<option value="'.$i.'" selected>'.$i.'</option>';
														}else{
															echo '<option value="'.$i.'">'.$i.'</option>';
														}
													}?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="InputHC">HC</label>
												<select class="form-control" name="inputHC" id="inputHC">
													<?php for($i=0;$i <= 24;$i++){
														if($i == 18){
															echo '<option value="'.$i.'" selected>'.$i.'</option>';
														}else{
															echo '<option value="'.$i.'">'.$i.'</option>';
														}
													}?>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="InputSex">เพศ</label>
												<div class="input-group">
													<div class="btn-group" data-toggle="buttons">
														<a class="btn btn-primary active type" id="male"><i class="fa fa-male"></i>ชาย</a>
														<a class="btn btn-default type" id="female"><i class="fa fa-female"></i>หญิง</a>
														<input type="hidden" name="InputSex" id="InputSex" value="1"/>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><!-- /.box-body -->
								<div class="box-footer clearfix no-border">
									<button type="button" class="btn btn-primary add-player-team pull-right" onclick="people_add_team()">เพิ่มผู้เล่น</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- /.content -->
<div class="modal fade" id="add-team-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">ข้อมูลทีม</h4>
			</div>
			<form action="#" method="post" id="addform-team">
				<input name="action" type="hidden" value="2" id="action-team" />
				<input name="editId" type="hidden" id="editId" />
				<input name="tourId" type="hidden" id="tourId" value="<?php echo $tournament_data['tour_id'];?>" />
				<div class="modal-body" id="addbody-team">
					<div class="form-group">
						<label for="InputName">ชื่อทีม</label>
						<input type="text" class="form-control" name="InputName" id="InputName" placeholder="โปรดระบุชื่อทีม">
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-danger cancel-team-name" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
					<button type="submit" class="btn btn-primary submit-team"  ><i class="fa  fa-save "></i>บันทึก</button>
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
						<input type="hidden" class="form-control" name="InputId" id="InputId" />
						<input type="hidden" name="select_table" id="select_table" />
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
					<button type="button" onclick="submit_remove()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-o "></i> ลบ</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade bs-example-modal-sm" id="hc_changer" tabindex="-3" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">การดำเนินการ</h4>
			</div>
			<div class="modal-body">
				กรุณาเลือก Handicap
				<select name="select_hc" id="select_hc">
				<?php
					for($i=0;$i <= 24;$i++){
						if($i == 18){
							echo '<option value="'.$i.'" selected>'.$i.'</option>';
						}else{
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					}
				?>
				</select>
			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-info" data-dismiss="modal" onclick="submit_hc(this)">ตกลง</button>
			</div>
		</div>
	</div>
	
</div>
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
$(".player").hide();
$(".team-info").fadeOut();
// Chosen 
$(".chosen-select").chosen({no_results_text:'ไม่พบรายการที่ทำการค้นหา',width: '300px'});
$(".add-team").click(function(){
	$("#InputName").val("");
	$("#InputName").next().hide();
	$("#action-team").val(2);
});

$(".cancel-team-name").click(function(){
	$("#action-team").val(2);
	$(".team-info").find('.overlay').remove();
	$(".team-info").find('.loading-img').remove();
});
$(".edit-team-info").click(function(){
	$(".team-info").find('.box').append('<div class="overlay"></div><div class="loading-img"></div>');
	$("#action-team").val(3);
	$("#editId").val($(this).val());
	var team_name = $(this).parent().find('.inline').text();
	$("#InputName").val(team_name);
	$("#add-team-modal").modal('show');
});
$(".submit-team").click(function(){
	$("#addform-team").validate({
		rules: {
			InputName: "required"
		},
		 submitHandler: function(form) {
			var url = "<?php echo site_url();?>/challenge/player_control/"+$("#action-team").val()+"/<?php echo $tournament_data['tour_id'];?>";
			$.ajax({
				type:"post",
				url: url,
				cache: false,
				data: $('#addform-team').serialize(),
				success: function(teamid){
					// show new team
					var get_team_info = "<?php echo site_url();?>/challenge/getTeamTable/"+teamid;
					$.get( get_team_info, function() {//alert( "success" );
					})
					.done(function(data) {
						$("#team-info-body").html(data);
						refresh_table_group_player();
						$("#teamid_nonmember").val(teamid);
					})
					.fail(function() { 
						$("#error").modal({ show:true}); 
					});
					
					//hide & show select team
					$("#add-team-modal").modal('hide');
					$(".group-table").fadeOut();
					$(".add-team").fadeOut();
					$(".team-info").fadeIn();					
					$(".player").fadeIn('slow');
					$(".team-info").find('.overlay').remove();
					$(".team-info").find('.loading-img').remove();
					refresh_table_team();
					
					$("#member_teamid").val(teamid);
				},
				error: function(request, status, error) {
					$("#add-modal").modal('hide');
					$("#error").modal({ show:true});
				}
			});
			$("#InputName").val("");
			
		} 	
	});
});
$(".cancel-team").click(function(){
	$(".team-info").hide();
	$(".player").hide();
	$(".add-team").fadeIn();
	$(".group-table").fadeIn();
});
$(".group-button").click(function(){
	$(".add-player-single").hide();
	$(".add-player-team").show();
	$(".group-table").fadeIn();$(".add-team").fadeIn();
	$(".team-info").hide();$(".player").hide();
});

var table_group = $("#group").dataTable({
	"bLengthChange": false,
	"bSort": true
});
var table_player_group = $("#team-player").dataTable({
	"bLengthChange": false,
	"bSort": true
});
var table_member = $("#member-table").dataTable({
	"fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
	$("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });
    return "แสดงรายการที่ "+iStart+" ถึง "+iEnd+" จาก "+iTotal+" รายการ";
  },
	"fnDrawCallback": function( oSettings ) {
		$(".item").draggable({
			cursor: 'move',
			revert: 'valid',
			helper:'clone'
		});
	}
});
// **************************************************************** group ************************
// **************************************************************** single ************************
$(".item").draggable({
	cursor: 'move',
	revert: 'valid',
	helper:'clone'
});
$(".type").click(function(){
	$(".type").removeClass("btn-primary active");
	$(".type").addClass("btn-default");
	$(this).removeClass("btn-default");
	$(this).addClass("btn-primary active");
	var sex = ($(this).attr('id')==='male')? 1:2;
	$("#InputSex").val(sex);
});
$(".drop-team").droppable({
	accept: '.item',
	activeClass: "drop-area",
	drop: function( event, ui ) {
		
		$(ui.helper).remove();
		table_member.fnDeleteRow($(ui.draggable).index());
		$("#member_inputName").val(ui.draggable.find("td:nth-child(2)").text());
		$("#member_inputAge").val(ui.draggable.find("td:nth-child(3)").text());
		$("#member_inputHC").val(ui.draggable.find("td:nth-child(4)").text());
		$("#member_InputSex").val(ui.draggable.find("td:nth-child(5)").find('p').text());
		$("#member_memberId").val(ui.draggable.find("td:nth-child(6)").text());
		if($("#member_inputName").val()!=""){
			var url = "<?php echo site_url();?>/challenge/player_control/1/<?php echo $tournament_data['tour_id'];?>";
				$.ajax({
					type:"post",
					url: url,
					cache: false,
					data: $('#member-form').serialize(),
					success: function(json){//alert(json);
						
					},
					error: function(request, status, error) {
						$("#error").modal({ show:true});
					}
				});
		}
		$("#member_inputName").val("");
		sleep(50);
		refresh_table_group_player();
		refresh_table();
	}
});
function edit_team_player(id) {
	// get data 
	$("#teamId").val(id);
	$("#member_teamid").val(id);
	$("#teamid_nonmember").val(id);
	var url = "<?php echo site_url();?>/challenge/getTeamTable/"+id;
	$.get( url, function() {})
	.done(function(data) {
		$("#team-info-body").html(data);
		refresh_table_group_player();
		$(".edit-team-info").off("click");
		$(".edit-team-info").click(function(){
			$(".team-info").find('.box').append('<div class="overlay"></div><div class="loading-img"></div>');
			$("#action-team").val(3);
			$("#editId").val($(this).val());
			var team_name = $(this).parent().find('.inline').text();
			$("#InputName").val(team_name);
			$("#add-team-modal").modal('show');
		});
			$("#add-team-modal").modal('hide');
			$(".group-table").fadeOut();
			$(".add-team").fadeOut();
			$(".team-info").fadeIn();
			$(".player").fadeIn('slow');
	})
	.fail(function() { 
		$("#error").modal({ show:true});
	});
}
function member_add_team(){
	table_member.fnDestroy();
	var num_insert = $(".checked").length;
	$(".checked").delay(15000).each(function(){
		var row = $(this).parent().parent();
		$("#member_inputName").val(row.find("td:nth-child(2)").text());
		$("#member_inputAge").val(row.find("td:nth-child(3)").text());
		$("#member_inputHC").val(row.find("td:nth-child(4)").text());
		$("#member_InputSex").val(row.find("td:nth-child(5)").find('p').text());
		$("#member_memberId").val(row.find("td:nth-child(6)").text());
		if($("#member_inputName").val()!=""){
			var url = "<?php echo site_url();?>/challenge/player_control/1/<?php echo $tournament_data['tour_id'];?>";
				$.ajax({
					type:"post",
					url: url,
					cache: false,
					data: $('#member-form').serialize(),
					success: function(json){//alert(json);
						
					},
					error: function(request, status, error) {
						$("#error").modal({ show:true});
					}
				});
		}
		$("#member_inputName").val("");
	});
	table_member = $("#member-table").dataTable({
		"fnDrawCallback": function( oSettings ) {
			$(".item").draggable({
				cursor: 'move',
				revert: 'valid',
				helper:'clone'
			});
		}
	});
	if(num_insert > 1 ){
		sleep(2000);
	}{ sleep(500); }
	refresh_table_group_player();
	refresh_table();
}
function people_add_team(){
	if($("#inputName").val()){
		var url = "<?php echo site_url();?>/challenge/player_control/1/<?php echo $tournament_data['tour_id'];?>";
			$.ajax({
				type:"post",
				url: url,
				cache: false,
				data: $('#non-member-form').serialize(),
				success: function(json){
					//alert(json);
					refresh_table_group_player();
				},
				error: function(request, status, error) {
					$("#add-modal").modal('hide');
					$("#error").modal({ show:true});
				}
			});
		$("#inputName").val("");
	} else {
		alert("กรุณากรอกชื่อ");
	}
}
function remove_list_group(object){
	var id = $(object).val();
	$("#InputId").val(id);
	$("#select_table").val(3);
	$("#remove-modal").modal({ show:true});
}
function remove_list_team(object){
	var id = $(object).val();
	$("#InputId").val(id);
	$("#select_table").val(2);
	$("#remove-modal").modal({ show:true});
}
function submit_remove(){
	var select_table = $("#select_table").val();
	var team_id = $("#team_id").val();
	$.ajax({
		type:"post",
		url: "<?php echo site_url('challenge/player_control/0/'.$tournament_data['tour_id']); ?>",
		cache: false,
		data: $('#deleteform').serialize(),
		success: function(json){
			$("#remove-modal").modal('hide');
			//$("#message").modal({ show:true});
			//refresh data table
			if(select_table == '2'){ // team
				refresh_table_team();
			}else if(select_table == '3'){ // group player
				refresh_table_group_player();
			}
			refresh_table();
		},
		error: function(data){
			//alert($(data).html());
			$("#remove-modal").modal('hide');
			$("#error").modal({ show:true});
		}
	});
}

function refresh_table_team(){
		var url = "<?php echo site_url();?>/challenge/player_control/4/<?php echo $tournament_data['tour_id'];?>";
		$.get( url, function() {//alert( "success" );
		})
		.done(function(data) {
			table_group.fnDestroy();
			$("#team-body").html(data);
			table_group = $("#group").dataTable({
				"bLengthChange": false,
				"bSort": true
			});
		})
		.fail(function() { 
			$("#error").modal({ show:true});
		});
}

function refresh_table(){
	
	var url = "<?php echo site_url();?>/challenge/player_control/7/<?php echo $tournament_data['tour_id'];?>";
	$.get( url, function() {//alert( "success" );
	})
	.done(function(data) {
		table_member.fnDestroy();
		$("#member-tbody").html(data);
		table_member = $("#member-table").dataTable({
			"fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
			$("input[type='checkbox'], input[type='radio']").iCheck({
				checkboxClass: 'icheckbox_minimal',
				radioClass: 'iradio_minimal'
			});
			return "แสดงรายการที่ "+iStart+" ถึง "+iEnd+" จาก "+iTotal+" รายการ";
		  },
			"fnDrawCallback": function( oSettings ) {
				$(".item").draggable({
					cursor: 'move',
					revert: 'valid',
					helper:'clone'
				});
			}
		  
		});
		$(".item").draggable({
			cursor: 'move',
			revert: 'valid',
			helper:'clone'
		});
		
	})
	.fail(function() { 
		$("#error").modal({ show:true});
	});
	
	$("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });
}

function refresh_table_group_player(){
	// get data 
	var url = "<?php echo site_url();?>/challenge/player_control/6/<?php echo $tournament_data['tour_id'];?>/"+$("#teamId").val();
	$.get( url, function() {})
	.done(function(data) {
		table_player_group.fnDestroy();
		$(".drop-team").html(data);
		table_player_group = $("#team-player").dataTable({
			"bLengthChange": false,
			"bSort": true
		});
	})
	.fail(function() { 
		$("#error").modal({ show:true});
	});
}
// **************************************************************** single ************************
var changing_hc;
function change_hc(object){
	changing_hc = $(object).parent().find('div');
	$("#hc_changer").modal({ show:true});
	
}
function submit_hc(object){
	$(changing_hc).text($("#select_hc").val());
}
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
</script>