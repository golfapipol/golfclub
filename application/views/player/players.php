<style>
tr:hover { cursor: pointer;}
</style>
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
	<h4 class="page-header">ข้อมูลสมาชิก</h4>
		<!--div class="box box-primary" >
			<div class="box-header">
				<h3 class="box-title">ค้นหาแบบละเอียด</h3>
			</div>
			<form role="form">
			<div class="box-body table-responsive ">
				<div class="row">
					<div class="col-md-3 col-xs-3">
						<div class="form-group">
							<label for="searchName">ชื่อ - นามสกุล</label>
							<input type="text" class="form-control" id="searchName" name="searchName" placeholder="ค้นหาจากชื่อ - นามสกุล">
						</div>
					</div>
					<div class="col-md-3 col-xs-3">
						<div class="form-group">
							<label for="searchName">สถานะผู้เล่น</label>
							<select class="form-control">
								<option>option 1</option>
								<option>option 2</option>
								<option>option 3</option>
								<option>option 4</option>
								<option>option 5</option>
							</select>
						</div>
					</div>
					<div class="col-md-3 col-xs-3">
						<div class="form-group"> 
							<label>เพศ</label>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
									ทั้งหมด
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
									ชาย
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" />
									หญิง
								</label>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-xs-3">
						<a class="btn btn-block btn-primary add" ><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</a>
					</div>
				</div>
			</div>
			</form>
		</div-->
	
		<div class="box box-primary" >
			<div class="box-header">
				<h3 class="box-title">รายชื่อสมาชิกทั้งหมด</h3>
			</div>
			<div class="box-body table-responsive">
				<div class="row">
					<div class="col-md-9 col-xs-9">
						<table id="data" class="table table-hover table-bordered">
							<thead>
								<tr>
									<th style="width:30%">ชื่อ</th>
									<th style="width:10%">เพศ</th>
									<th style="width:30%">สถานะผู้เล่น</th>
									<th style="width:20%">ดำเนินการ</th>
								</tr>
							</thead>
							<tbody id="table_data">
								<?php if($player_data->num_rows() > 0):
										foreach($player_data->result_array() as $row):
											echo '<tr><td>'.$row['player_name'].'</td>';
											if ($row['player_sex'] == 1): //male
												echo "<td><i class='fa fa-fw big male'>&#9794; </i>
													<p style='display:none' value='1'>1</p></td>";
											elseif($row['player_sex'] == 2): //female
												echo "<td><i class='fa fa-fw big female'>&#9792; </i>
													<p style='display:none' value='2'>2</p></td>";
											endif;
											echo '<td>'.$row['status_name'].'</td>';
											echo '<td>
												<div class="btn-group">
													<a href="'.site_url("playerinfo/player_profile").'/'.$row['player_id'].'" class="btn btn-success btn-flat edit" data-toggle="tooltip" data-original-title="โปรไฟล์" ><i class="fa fa-fw fa-user"></i></a>
													<a href="'.site_url("playerinfo/editPlayer").'/'.$row['player_id'].'" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" ><i class="fa fa-edit"></i></a>
													<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="'.$row['player_id'].'"><i class="fa fa-fw fa-trash-o"></i></button>
												</div>
											</td>';
										endforeach;
								endif;?>
							</tbody>
						</table>
					</div>
					<div class="col-md-3 col-xs-3">
					<!-- compose message btn -->
						<a href="<?php echo site_url("playerinfo/addPlayer");?>"class="btn btn-block btn-primary" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;เพิ่มข้อมูลผู้เล่น</a><br />	
					</div>
				</div>
			</div><!-- /.box-body -->
		</div>
	
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
	var table = $("#data").dataTable({
		"bLengthChange": false,
		"bSort": true
	});
	$(document).ready(function(){
		jqueryon();
		
	});
	function jqueryon()
	{
		$(".remove").click(function(){
			var id = $(this).val();
			$("#InputId").val(id);
			$("#remove-modal").modal({ show:true});
		});
	}
	
	
	function deletesubmit(){
		$.ajax({
			type:"post",
			url: "<?php echo site_url('playerinfo/playerinfo_control/3'); ?>",
			cache: false,
			data: $('#deleteform').serialize(),
			success: function(json){
				$("#remove-modal").modal('hide');
				$("#message").modal({ show:true});
				//refresh data table
				refresh_table();
				
			},
			error: function(){
				
				$("#remove-modal").modal('hide');
				$("#error").modal({ show:true});
			}
		});
	}
	function refresh_table(){
		var url = "<?php echo site_url();?>/playerinfo/playerinfo_control/";
		$.get( url, function() {//alert( "success" );
		})
		.done(function(data) {
			table.fnDestroy();
			$("#table_data").html(data);
			table = $("#data").dataTable({
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