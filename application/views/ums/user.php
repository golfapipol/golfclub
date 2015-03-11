<!-- 0 % -->
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
	จัดการผู้ใช้งาน
		<small>Account Settings</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('ums') ?>">ข้อมูลพื้นฐาน</a></li>
		<li class="active">ผู้ใช้งานระบบ</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<h4 class="page-header">ผู้ใช้งานระบบ</h4>
	<div class="box box-primary" >
		<div class="box-header">
			<h3 class="box-title">ผู้ใช้งานระบบ</h3>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="row">
				<div class="col-md-9 col-xs-9">
					<table id="data" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width:5%">No.</th>
								<th style="width:20%">ชื่อผู้ใช้</th>
								<th style="width:20%">กลุ่มผู้ใช้งาน</th>
								<th style="width:10%">ดำเนินการ</th>
							</tr>
						</thead>
						<tbody id="table_data">
							<?php $i=1;
							if($user_data->num_rows() > 0):
							foreach($user_data->result_array() as $row):
								echo "<tr><td>".$i."</td>";
								echo "<td>".$row['user_name']."</td>";
								echo "<td>".$row['group_name']."</td>";
								echo '<td>
									<div class="btn-group">
										<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="'.$row['user_id'].'"><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="'.$row['user_id'].'"><i class="fa fa-fw fa-trash-o"></i></button>
									</div>
								</td>';
								$i = $i +1;
							endforeach;
							endif;?>
						</tbody>
					</table>
				</div>
				<div class="col-md-3 col-xs-3">
					<!-- compose message btn -->
					<a class="btn btn-block btn-primary add" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;เพิ่มผู้ใช้งานระบบ</a>
				</div>
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
				<h4 class="modal-title">จัดการผู้ใช้งานระบบ</h4>
			</div>
			<form action="#" method="post" id="addform">
				<input name="action" type="hidden" value="1" id="action" />
				<input name="editId" type="hidden" id="editId" />
				<div class="modal-body" id="addbody">
					<div class="form-group">
						<label for="InputName">ชื่อผู้ใช้</label>
						<input type="text" class="form-control" name="InputName" id="InputName" placeholder="โปรดระบุชื่อ - นามสกุล" required >
					</div>
					<div class="form-group">
						<label for="InputCode">รหัสบุคคลากร</label>
						<input type="text" class="form-control" name="InputCode" id="InputCode" placeholder="โปรดระบุรหัสบุคคลากร" required >
					</div>
					<div class="form-group">
						<label for="InputUser">ชื่อบัญชีเข้าใช้งาน</label>
						<input type="text" class="form-control" name="InputUser" id="InputUser" placeholder="โปรดระบุบัญชีเข้าใช้งาน" required >
					</div>
					<div class="form-group">
						<label for="InputPassword">รหัสผ่าน <p style="color:red">* ไม่เปลี่ยนไม่ต้องกรอก</p></label>
						<input type="password" class="form-control" name="InputPassword" id="InputUser" placeholder="โปรดกรอกรหัสผ่านเข้าใช้งานระบบ" >
					</div>
					<div class="form-group">
						<label for="InputGroup">กลุ่มผู้ใช้งาน</label>
						<select data-placeholder="กรุณาเลือกกลุ่มผู้ใช้งาน" class="chosen-select" style="width:400px" id="InputGroup" name="InputGroup"  >
						<?php if($actor_select->num_rows() >0):
								foreach($actor_select->result_array() as $option):
									echo '<option value="'.$option['group_id'].'">'.$option['group_name'].'</option>';
								endforeach;
								endif;
						?>
						</select>
					</div>
				</div>
				<div class="modal-footer clearfix">
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> ยกเลิก</button>
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
	$('input[name="InputPassword"]').attr('autocomplete', 'off');
    $('input[name="InputUser"]').attr('autocomplete', 'off');
	var table = $("#data").dataTable({ "bLengthChange": false, "bSort": true });
	$(document).ready(function(){ jqueryon(); });
	function jqueryon() {
		$(".add").off("click"); $(".edit").off("click"); $(".remove").off("click"); $(".submit").off("click");
		$(".add").click(function(){
			$("#action").val(1);
			$("#InputName").val("");
			$("#InputCode").val("");
			$("#InputUser").val("");
		});
		$(".edit").click(function(){
			var id = $(this).val();
			$("#action").val(2);
			$("#editId").val(id);
			var row = $(this).parent().parent().parent();
			// get data 
			var url = "<?php echo site_url();?>/ums/get_userinfo/"+id;
			$.get( url, function() {})
				.done(function(data) {
					console.log(data);
					$("#InputName").val(data['user_name']);
					$("#InputCode").val(data['user_personcode']);
					$("#InputUser").val(data['user_login']);
					$('#InputGroup').val(data['group_id']);
					$('#InputGroup').trigger('chosen:updated');
					jqueryon();
				})
				.fail(function() { 
					$("#error").modal({ show: true });
				});
			$("#add-modal").modal({ show: true });
		});
		$(".remove").click(function(){
			var id = $(this).val();
			$("#InputId").val(id);
			$("#remove-modal").modal({ show: true });
		});
		$(".submit").click(function(){
			$("#addform").validate({
				rules: {
					InputName: "required", InputUser: "required", InputCode: "required"
				},
				 submitHandler: function(form) {
					var url = "<?php echo site_url();?>/ums/user_control/"+$("#action").val();
					$.ajax({
						type:"post",
						url: url,
						cache: false,
						data: $('#addform').serialize(),
						success: function(data){
							$("#InputPassword").val("");
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
		$(".chosen-select").chosen({width: '400px',disable_search_threshold: 10});
	}
	function deletesubmit(){
		$.ajax({
			type:"post",
			url: "<?php echo site_url('ums/user_control/3'); ?>",
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
		var url = "<?php echo site_url();?>/ums/user_control/";
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