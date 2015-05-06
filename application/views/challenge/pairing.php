<style> li { cursor:pointer;}table{text-align:center;cursor:default}th{text-align:center}
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
		<li class="active">จัดก๊วน</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4 col-xs-6">
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
		<div class="col-lg-4 col-xs-6">
			<!-- small box -->
			<a href="<?php echo site_url("challenge/player/".$tournament_data['tour_id']);?>">
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
		<div class="col-lg-4 col-xs-6">
			<a href="#">
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
	<h4 class="page-header">จัดก๊วน</h4>
	<?php if($field_data->num_rows() > 0): ?>
	<div class="row">
		<div class="col-md-7 col-xs-7">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">จัดก๊วน</h3>
					<div class="box-tools pull-right">
						<ul class="pagination pagination-sm inline" id="count">
							<?php 
								
								$field_seq = $field_data->row_array()['field_seq'];
								$i=1;
								foreach(array_reverse($field_data->result_array()) as $row):
									if($i ==1):
										echo '<li class="field active" value="'.$row['tour_field_id'].'"><a >'.(($i*9)-8).'-'.($i*9).'</a></li>';
									else:
										echo '<li class="field" value="'.$row['tour_field_id'].'"><a >'.(($i*9)-8).'-'.($i*9).'</a></li>';
									endif;
									$i +=1;
								endforeach;
							for($i=1; $i <= $field_seq ;$i++):
								
							endfor;?>
						</ul>
					</div>
				</div>
				<div class="box-body ">
					<div class="row" >
						<div class="col-md-3 col-xs-3">
							<ul class="nav nav-pills nav-stacked" id="hole">
								<?php 
									echo '<li class="header">'.$hole_data['field_name'].'</li>
										<li class="filter" value="1"><a>หลุม 1</a></li>
										<li class="filter" value="2"><a>หลุม 2</a></li>
										<li class="filter" value="3"><a>หลุม 3</a></li>
										<li class="filter" value="4"><a>หลุม 4</a></li>
										<li class="filter" value="5"><a>หลุม 5</a></li>
										<li class="filter" value="6"><a>หลุม 6</a></li>
										<li class="filter" value="7"><a>หลุม 7</a></li>
										<li class="filter" value="8"><a>หลุม 8</a></li>
										<li class="filter" value="9"><a>หลุม 9</a></li>';
								?>
							</ul>
						</div>
						<div class="col-md-9 col-xs-9">
							<div class="row" id="group-row">
								<h4>ก๊วน</h4>
								<ul class="pagination inline" id="group">
									
								</ul>
							</div>
							<div class="row" id="pairing-row">
								<div class="table-responsive"><br />
									<table class="table " id="pairing-table" style="width:95%!important">
										<thead style="background-color:#3c8dbc">
											<tr>
												<th style="width:30%!important">ชื่อ</th>
												<th style="width:15%!important">อายุ</th>
												<th style="width:25%!important">HC</th>
												<th style="width:10%!important">เพศ</th>
												<th style="width:15%!important">ตัวเลือก</th>
											</tr>
										</thead>
										<tbody id="pairing-tbody">
										
										</tbody>	
									</table>
								</div><!-- /.table-responsive -->
							</div>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
					<form role="form" id="add-form">
						<input type="hidden" name="No_Hole" id="No_Hole" placeholder="No_Hole" />
						<input type="hidden" name="No_Group" id="No_Group" placeholder="No_Group" />
						<input type="hidden" name="No_Field" id="No_Field" placeholder="No_Field" />
						<input type="hidden" name="Tour_id" id="Tour_id" value="<?php echo $tournament_data['tour_id'];?>" placeholder="Tour_id" />
						<input type="hidden" name="playerId" id="playerId" placeholder="playerId" />
						
					</form>
					<a href="<?php echo site_url("exportFile/pairing/".$tournament_data['tour_id'])?>"class="btn btn-info pull-right"><i class="fa fa-download"></i> ส่งออกเป็น PDF</a>
				</div>
			</div>
		</div>
		<div class="col-md-5 col-xs-5">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">รายชื่อผู้เข้าแข่งขัน</h3>
				</div>
				<div class="box-body table-responsive">
					
						<?php 
							if ($team_data->num_rows() > 0):
								echo '<div class="form-group">
                                            <label>กรองโดยทีม</label>
                                            <select id="filter_team"class="form-control" onchange="filter_team()"><option value="0">ทั้งหมด</option>';
							   foreach($team_data->result_array() as $team):
									echo '<option value="-'.$team['team_id'].'-">'.$team['team_name'].'</option>';
								endforeach;
                                echo '</select></div>';
								
								echo "</select>";
							endif;
						?>
					
					<table id="people" class="table table-hover table-bordered"  style="width:100%!important">
						<thead style="background-color:#3c8dbc">
							<tr>
								<th style="width:5%!important"></th>
								<th style="width:40%">ชื่อ</th>
								<th style="width:20%">อายุ</th>
								<th style="width:15%">HC</th>
								<th style="width:15%">เพศ</th>
								<th style="display:none"></th>
								<th style="display:none"></th>
							</tr>
						</thead>
						<tbody id="player-tbody">
						<?php 
						if($player_data->num_rows() > 0):
							foreach($player_data->result_array() as $row):
								echo '<tr class="item"><td><input type="checkbox" /></td><td>'.$row['player_name'].'</td>';
									echo '<td>'.$row['player_age'].'</td>';
									echo '<td>'.$row['player_hc'].'</td>';
									echo '<td>';
									if($row['player_sex'] == 1): //male
										echo '<i class="fa fa-fw big male">&#9794; </i><p style="display:none">1</p>';
									else: //female
										echo '<i class="fa fa-fw big female">&#9792; </i><p style="display:none">2</p>';
									endif;
									echo '</td><td style="display:none">'.$row['player_id'].'</td>';
									echo '</td><td style="display:none">-'.$row['team_id'].'-</td></tr>';
							endforeach;
						endif;?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix no-border">
					<button type="button" class="btn btn-primary add-player-single pull-right" onclick="add_player()" style="display: block;">เพิ่มผู้เล่น</button>							
				</div>
			</div>
		</div>
	</div>
	<?php else : ?>
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">จัดก๊วน</h3>
				</div>
				<div class="box-body ">
					<div class="alert alert-danger alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<b>เกิดข้อผิดพลาด</b> กรุณาเลือกสนามที่ใช้แข่งขันก่อนทำการจัดก๊วนด้วย
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix">
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</section><!-- /.content -->
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
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
					<button type="button" onclick="remove_submit()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-o "></i> ลบ</button>
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
<div class="modal fade bs-example-modal-sm" id="warning" tabindex="-3" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">ขออภัย</h4>
			</div>
			<div class="modal-body">
				กรุณาเลือก สนาม หลุม และกลุ่มที่ต้องการเพิ่มผู้เล่นดังกล่าว
			</div>
			<div class="modal-footer clearfix">
				<button type="button" class="btn btn-danger" data-dismiss="modal">ตกลง</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#No_Field").val($(".field").first().val());
	$("#pairing-row").hide();
	jqueryon();
});
function jqueryon(){
	$('.filter').off('click');
	$('.group').off('click');
	$('.field').off('click');
	$('.filter').click(function(e){
		$('.filter').each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		var filter = $(this).val();
		$("#No_Hole").val(filter);
		$("#pairing-row").hide();
		// ajax get group list
		var url = "<?php echo site_url();?>/challenge/pairing_control/4/<?php echo $tournament_data['tour_id'];?>";
		$.ajax({
			type:"post",
			url: url,
			cache: false,
			data: $('#add-form').serialize(),
			success: function(json){
				$("#group").html(json);
				jqueryon();
			},
			error: function(request, status, error) {
				console.log(error);
				$("#error").modal({ show:true});
			}
		});
		$("#pairing-row").hide();
	});
	$('.group').click(function(e){
		$('.group').each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		var group = $(this).val();
		$("#No_Group").val(group);
		// ajax get table pairing-table
		refresh_table_pairing();
		$("#pairing-row").fadeIn();
	});
	$('.field').click(function(e){
		$('.field').each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		var field = $(this).val();
		$("#No_Field").val(field);
		// ajax get hole list
		var url = "<?php echo site_url();?>/challenge/pairing_control/3/<?php echo $tournament_data['tour_id'];?>";
		$.ajax({
			type:"post",
			url: url,
			cache: false,
			data: $('#add-form').serialize(),
			success: function(json){
				$("#hole").html(json);
				jqueryon();
			},
			error: function(request, status, error) {
				console.log(error);
				$("#error").modal({ show:true});
			}
		});
		$("#pairing-row").hide();
		
	});
}
var table = $("#people").dataTable({
		"oLanguage": {
			"oPaginate": {
				"sPrevious": "",
				"sNext": ""
			}
		},
        "aaSorting": [[ 3, "asc" ]],
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
var pairing_table = $("#pairing-table").dataTable({
	"bLengthChange": false,
	"bFilter": false,
	
});
$(".item").draggable({
	cursor: 'move',
	revert: 'valid',
	helper:'clone'
});
$("#pairing-tbody").droppable({
	accept: '.item',
	activeClass: "drop-area",
	drop: function( event, ui ) {
		$(ui.helper).remove();
		// ajax
		$("#playerId").val($(ui.draggable).find("td:nth-child(6)").text());
		if($("#playerId").val()!=""){
			var url = "<?php echo site_url();?>/challenge/pairing_control/1/<?php echo $tournament_data['tour_id'];?>";
			$.ajax({
				type:"post",
				url: url,
				cache: false,
				data: $('#add-form').serialize(),
				success: function(json){ 
					// refresh table
					refresh_table_pairing();
					refresh_table_player();
				},
				error: function(request, status, error) {$("#error").modal({ show:true});}
			});
		}
		
	}
});
function add_player(){
	if($("#pairing-row").is(":visible")){
		table.fnDestroy();
		var num_insert = $(".checked").length;
		$(".checked").delay(15000).each(function(){
			var row = $(this).parent().parent();
			$("#playerId").val(row.find("td:nth-child(6)").text());
			if($("#playerId").val()!=""){
				var url = "<?php echo site_url();?>/challenge/pairing_control/1/<?php echo $tournament_data['tour_id'];?>";
				$.ajax({
					type:"post",
					url: url,
					cache: false,
					data: $('#add-form').serialize(),
					success: function(json){},
					error: function(request, status, error) {$("#error").modal({ show:true});}
				});
			}
			$("#playerId").val("");
		});
		table = $("#people").dataTable();
		if(num_insert > 1 ){
			sleep(2000);
		}{ sleep(500); }
		refresh_table_pairing()
		refresh_table_player();
	}else{
		$("#warning").modal({ show:true});
	}
}
function remove_list(object){
	var id = $(object).val();
	$("#InputId").val(id);
	$("#remove-modal").modal({ show:true});
}
function remove_submit(){
	var url = "<?php echo site_url();?>/challenge/pairing_control/2/<?php echo $tournament_data['tour_id'];?>";
	$.ajax({
		type:"post",
		url: url,
		cache: false,
		data: $('#deleteform').serialize(),
		success: function(json){
			$("#remove-modal").modal('hide');
			refresh_table_pairing();
			refresh_table_player();
		},
		error: function(request, status, error) {$("#remove-modal").modal('hide');$("#error").modal({ show:true});}
	});
}
function add_group(){
	// ajax add group
	var num = $(".group").length+1;
	$("#add-group").remove();
	$(".group").parent().append('<li class="group" value="'+num+'"><a >'+num+'</a></li><li id="add-group" onclick="add_group()"><a >+</a></li>');
	if($(".group").length > 4){
		$("#add-group").hide();
		$("#remove-group").show();
	}else if($(".group").length < 2){
		$("#remove-group").hide();
		$("#add-group").show();
	}else{
		$("#add-group").show();
		$("#remove-group").show();
	}
	
	var url = "<?php echo site_url();?>/challenge/pairing_control/5/<?php echo $tournament_data['tour_id'];?>";
		$.ajax({
			type:"post",
			url: url,
			cache: false,
			data: $('#add-form').serialize(),
			success: function(json){},
			error: function(request, status, error) {}
		});
	jqueryon();
}
function remove_group(){
	// ajax remove group
	$(".group").last().remove();
	if($(".group").length > 4){
		$("#add-group").hide();
		$("#remove-group").show();
	}else if($(".group").length < 2){
		$("#remove-group").hide();
		$("#add-group").show();
	}else{
		$("#add-group").show();
		$("#remove-group").show();
	}
	var url = "<?php echo site_url();?>/challenge/pairing_control/6/<?php echo $tournament_data['tour_id'];?>";
	$.ajax({
		type:"post",
		url: url,
		cache: false,
		data: $('#add-form').serialize(),
		success: function(json){},
		error: function(request, status, error) {}
	});
	refresh_table_player();
}
function refresh_table_pairing(){
	var url = "<?php echo site_url();?>/challenge/pairing_control/0/<?php echo $tournament_data['tour_id'];?>";
	$.ajax({
		type:"post",
		url: url,
		cache: false,
		data: $('#add-form').serialize(),
		success: function(json){
			pairing_table.fnDestroy();
			$("#pairing-tbody").html(json);
			console.log(json);
			pairing_table = $("#pairing-table").dataTable({
				"bLengthChange": false,
				"bFilter": false,
			});
		},
		error: function(request, status, error) {
			$("#error").modal({ show:true});
		}
	});
}
function refresh_table_player(){
	var url = "<?php echo site_url();?>/challenge/pairing_control/7/<?php echo $tournament_data['tour_id'];?>";
	$.get( url, function() {//alert( "success" );
	})
	.done(function(data) {
		table.fnDestroy();
		$("#player-tbody").html(data);
		table = $("#people").dataTable({
			"aaSorting": [[ 3, "asc" ]],
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
		filter_team();
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
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
function filter_team() {
	var filter = $("#filter_team").val();
	if(filter == "0"){ 
		table.fnFilter("",6);
	}else {
		table.fnFilter(filter,6);
	}
}
</script>