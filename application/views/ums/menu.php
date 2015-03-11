<!-- 0 % -->
<!-- Content Header (Page header) -->
<style>
.box .todo-list > li .text { width:75% }
</style>
<section class="content-header">
	<h1>
	จัดการผู้ใช้งาน
		<small>Account Settings</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('ums') ?>">ปรับแต่งระบบ</a></li>
		<li class="active">เมนูระบบ</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<h4 class="page-header">เมนูระบบ</h4>
	<div class="box box-primary" >
		<div class="box-header">
			<h3 class="box-title">เมนูระบบ</h3>
		</div>
		<div class="box-body table-responsive no-padding">
		
			<div class="row">
				<div class="col-md-9 col-xs-9">
					<form id="menu_seq" name="menu_seq">
					<ul class="todo-list">
						<?php	$i=1;
							if($menu_data->num_rows() > 0):
							foreach($menu_data->result_array() as $row): 
								echo '<li><span class="handle"><i class="fa fa-ellipsis-v"></i>
									<i class="fa fa-ellipsis-v"></i></span>';
								echo '<input type="hidden" name="menu[]" value="'.$row['menu_id'].'" />';
								echo '<span class="text"><span class="text text-name">'.$row['menu_name'].'</span>';
								echo '<small class="label label-default">'.$row['menu_url'].'</small></span>';
								echo '<button type="button" class="btn btn-warning btn-flat edit" data-toggle="tooltip" data-original-title="แก้ไขเมนู" value="'.$row['menu_id'].'"><i class="fa fa-edit"></i></button>
								<button type="button" class="btn btn-danger btn-flat remove" data-toggle="tooltip" data-original-title="ลบเมนู" value="'.$row['menu_id'].'"><i class="fa fa-fw fa-trash-o"></i></button></li>';
							endforeach;						
							endif;
						?>
						
					</ul>
					</form>
				</div>
				<div class="col-md-3 col-xs-3">
					<!-- compose message btn -->
					<a class="btn btn-block btn-primary add" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;เพิ่มเมนู</a>
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
				<h4 class="modal-title">จัดการกลุ่มผู้ใช้ระบบ</h4>
			</div>
			<form action="#" method="post" id="addform">
				<input name="action" type="hidden" value="1" id="action" />
				<input name="editId" type="hidden" id="editId" />
				<div class="modal-body" id="addbody">
					<div class="form-group">
						<label for="InputName">ชื่อเมนู</label>
						<input type="text" class="form-control" name="InputName" id="InputName" placeholder="โปรดระบุชื่อผู้ใช้" required >
					</div>
					<div class="form-group">
						<label for="InputURL">URL</label>
						<input type="text" class="form-control" name="InputURL" id="InputURL" placeholder="โปรดระบุลิงค์" required >
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
		$(".add").off("click");
		$(".edit").off("click");
		$(".remove").off("click");
		$(".submit").off("click");
		$(".add").click(function(){
			$("#action").val(1);
			$("#InputName").val("");
			$("#InputURL").val("");
		});
		$(".edit").click(function(){
			var id = $(this).val();
			$("#action").val(2);
			$("#editId").val(id);
			var row = $(this).parent();
			// get data 
			$("#InputName").val(row.find('.text-name').text());
			$("#InputURL").val(row.find('.label').text());
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
					InputURL: "required"
				},
				 submitHandler: function(form) {
					var url = "<?php echo site_url();?>/ums/menu_control/"+$("#action").val();
					$.ajax({
						type:"post",
						url: url,
						cache: false,
						data: $('#addform').serialize(),
						success: function(data){
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
					$("#InputName").val("");
				} 
			});
		});
		$(".chosen-select").chosen({width: '400px',disable_search_threshold: 10});
		//jQuery UI sortable for the todo list
		$(".todo-list").sortable({
			placeholder: "sort-highlight",
			handle: ".handle",
			forcePlaceholderSize: true,
			zIndex: 999999,
			beforeStop: function( event, ui ) {
				$.ajax({
					type:"post",
					url: "<?php echo site_url('ums/menu_control/5'); ?>",
					cache: false,
					data: $('#menu_seq').serialize(),
					success: function(json){},
					error: function(){
						$("#remove-modal").modal('hide');
						$("#error").modal({ show:true});
					}
				});
			}
		}).disableSelection();;
		/* The todo list plugin */
		$(".todo-list").todolist({
			onCheck: function(ele) {
				//console.log("The element has been checked")
			},
			onUncheck: function(ele) {
				//console.log("The element has been unchecked")
			}
		});
	}
	
	
	function deletesubmit(){
		$.ajax({
			type:"post",
			url: "<?php echo site_url('ums/menu_control/3'); ?>",
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
		var url = "<?php echo site_url();?>/ums/menu_control/";
		$.get( url, function() {//alert( "success" );
		})
		.done(function(data) {
			$(".todo-list").html(data);
			jqueryon();
		})
		.fail(function() { 
			$("#error").modal({ show:true});
		});
	}
</script>