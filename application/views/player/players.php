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
									<th style="width:10%">รหัสสมาชิก</th>
									<th style="width:30%">ชื่อ</th>
									<th style="width:10%">เพศ</th>
									<th style="width:30%">สถานะผู้เล่น</th>
									<th style="width:20%">ดำเนินการ</th>
								</tr>
							</thead>
							<tbody id="table_data">
							</tbody>
						</table>
					</div>
					<div class="col-md-3 col-xs-3">
					<!-- compose message btn -->
						<a href="<?php echo site_url("playerinfo/addPlayer");?>"class="btn btn-block btn-primary" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;เพิ่มข้อมูลผู้เล่น</a><br />	
					</div>
				</div>
			</div><!-- /.box-body -->
			<!-- Loading (remove the following to stop the loading)-->
			<div class="overlay"></div>
			<div class="loading-img"></div>
			
			<!-- end loading -->
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
		"bLengthChange": true,
		"bSort": true
	});
	$(document).ready(function(){
		jqueryon();
		refresh_table();
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
				"bLengthChange": true,
				"bSort": true
			});
			jqueryon();
		})
		.fail(function() { 
			$("#error").modal({ show:true});
		})
		.always(function() {
			$(".overlay").remove();
			$(".loading-img").remove();
		});
		
	}
</script>