<style>
tr:hover { cursor: pointer;}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		ข้อมูลสนามกอล์ฟ
		<small>Club Informations</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">ข้อมูลสนามกอล์ฟ</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<h4 class="page-header">คำนำหน้าชื่อ</h4>
	<div class="box box-primary" >
		<div class="box-header">
			<h3 class="box-title">รายชื่อสนามกอล์ฟทั้งหมด</h3>
		</div>
		<div class="box-body table-responsive no-padding">
			<div class="row">
				<div class="col-md-9 col-xs-9">
					<table id="data" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width:5%">No.</th>
								<th style="width:30%">ชื่อสนามแข่งขัน</th>
								<th style="width:20%">ภาค</th>
								<th style="width:20%">ดำเนินการ</th>
							</tr>
						</thead>
						<tbody id="table_data">
							<?php $i=1;
							if($club_data->num_rows() > 0):
							foreach($club_data->result_array() as $row):
								echo '<a href="'.site_url('clubinfo/information/'.$row['club_id']).'"><tr><td>'.$i.'</td>';
								echo '<td>'.$row['club_name'].'</td>';
								echo '<td>'.$row['zone_name'].'</td>';
								echo '<td>
									<div class="btn-group">
										<button type="button" class="btn btn-info btn-flat information" data-toggle="tooltip" data-original-title="รายละเอียด" value="'.$row['club_id'].'"><i class="fa fa-fw fa-list-alt"></i></button>
										<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไข" value="'.$row['club_id'].'"><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบ" value="'.$row['club_id'].'"><i class="fa fa-fw fa-trash-o"></i></button>
									</div>
								</td></tr></a>';
								$i = $i +1;
							endforeach;
							endif; ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-3 col-xs-3">
					<!-- compose message btn -->
					<a class="btn btn-block btn-primary add" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;เพิ่มสนามกอล์ฟ</a>
				</div>
			</div>
		</div><!-- /.box-body -->
	</div>
</section><!-- /.content -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">จัดการสนามกอล์ฟ</h4>
			</div>
			<form action="#" method="post" id="addform">
				<input name="action" type="hidden" value="1" id="action" />
				<input name="editId" type="hidden" id="editId" />
				<div class="modal-body" id="addbody">
					<div class="form-group">
						<label for="InputName">ชื่อสนามกอล์ฟ</label>
						<input type="text" class="form-control" name="InputName" id="InputName" placeholder="โปรดระบุชื่อสนามกอล์ฟ">
					</div>
					<div class="form-group">
						<label for="InputGroup">ภาค</label>
						<select data-placeholder="กรุณาเลือกภาค" class="chosen-select" style="width:400px" id="InputGroup" name="InputGroup"  >
						<?php if($zone_select->num_rows() >0):
								foreach($zone_select->result_array() as $option):
									echo '<option value="'.$option['zone_id'].'">'.$option['zone_name'].'</option>';
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
	var table = $("#data").dataTable({
		"bLengthChange": false,
		"bSort": true
	});
	$(document).ready(function(){
		jqueryon();
		
	});
	function jqueryon()
	{
		$(".add").click(function(){
			$("#action").val(1);
			$("#InputName").val("");
		});
		$(".edit").click(function(){
			var id = $(this).val();
			$("#action").val(2);
			$("#editId").val(id);
			var row = $(this).parent().parent().parent();
			$("#InputName").val(row.find('td:nth-child(2)').text());
			// get data 
			var url = "<?php echo site_url();?>/clubinfo/clubinfo_edit/"+id;
			$.get( url, function() {})
			.done(function(data) {
				$("#addbody").html(data);
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
					InputName: "required"
				},
				 submitHandler: function(form) {
					var url = "<?php echo site_url();?>/clubinfo/clubinfo_control/"+$("#action").val();
					$.ajax({
						type:"post",
						url: url,
						cache: false,
						data: $('#addform').serialize(),
						success: function(json){
							$("#add-modal").modal('hide');
							$("#message").modal({ show:true});
							//refresh data table
							refresh_table();
						},
						error: function(request, status, error) {
							$("#add-modal").modal('hide');
							$("#error").modal({ show:true});
						}
					});
				} 
			});
			
		});
		$(".chosen-select").chosen({width: '400px',disable_search_threshold: 10});
		$(".information").click(function(){
			location.href = '<?php echo site_url('clubinfo/information');?>/'+$(this).val();
		});
		$("td:nth-child(2)").click(function(){
			location.href = '<?php echo site_url('clubinfo/information');?>/'+$(this).parent().find('.information').val();
		});
		
	}
	
	
	function deletesubmit(){
		$.ajax({
			type:"post",
			url: "<?php echo site_url('clubinfo/clubinfo_control/3'); ?>",
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
		var url = "<?php echo site_url();?>/clubinfo/clubinfo_control/";
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