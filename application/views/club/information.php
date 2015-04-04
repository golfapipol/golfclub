<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url()?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<style>th{ text-align:center;} td{ text-align:center;} .field-name{display:inline-block!important;width:65%} .tools{display:inline-block;width:30%}
.tools > a {display:inline-block;}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		ข้อมูลสนามกอล์ฟ
		<small>Club Informations</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('clubinfo')?>">ข้อมูลสนามกอล์ฟ</a></li>
		<li class="active"><?php echo $club_data['club_name']?> ( <?php echo $club_data['zone_name']?> )<input type="hidden" id="clubid" value="<?php echo $club_data['club_id']?>" /></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<h4 class="page-header"><?php echo $club_data['club_name']?> ( <?php echo $club_data['zone_name']?> )</h4>
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
			<li class=""><a href="#tab_2-2" data-toggle="tab">ข้อมูลสนาม</a></li>
			<li class="active"><a href="#tab_1-1" data-toggle="tab">รายละเอียดทั่วไป</a></li>
			<li class="pull-left header"><i class="fa fa-th"></i>ข้อมูลสนามกอล์ฟ</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1-1">
				<form role="form" method="post" action="<?php echo site_url("clubinfo/updateInformation");?>">
				<div class="box">
					<div class="box-header">
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-danger cancel-info" data-toggle="tooltip" title="" data-original-title="ยกเลิก" style="display:none"><i class="fa fa-fw fa-times"></i></button>
							<button type="button" class="btn btn-warning edit-info"  data-toggle="tooltip" title="" data-original-title="แก้ไข"><i class="fa fa-fw fa-edit"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-lg-3 col-xs-3 col-md-3">
								<img src="http://t0.gstatic.com/images?q=tbn:ANd9GcSlDTpISYJteBG40FqmeFFp7wEGU3rJ5YOzCWO34OFdCXvK-SnZUw" width="100%" height="100%" />
								<div class="form-group pic-info" style="display:none">
									<label for="exampleInputFile">รูปสนามกอล์ฟ</label>
									<input type="file" id="exampleInputFile" name="InputPhoto">
									<p class="help-block">หากต้องการเปลี่ยนรูปให้ทำการอัพโหลด</p>
								</div>
							</div>
							<div class="col-lg-9 col-xs-9 col-md-9">
								<input type="hidden" name="ClubId" value="<?php echo $club_data['club_id']?>">
								<div class="row">
									<div class="col-lg-2 col-xs-2 col-md-2">ที่อยู่
									</div>
									<div class="col-lg-10 col-xs-10 col-md-10">
										<div class="form-group">
											<input type="text" class="form-control info-input"  name="InputAddress" placeholder="ที่อยู่ติดต่อ..." value="<?php echo $club_data['club_address']?>" disabled="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-xs-2 col-md-2">เว็บไซต์
									</div>
									<div class="col-lg-10 col-xs-10 col-md-10">
										<div class="form-group">
											<input type="text" class="form-control info-input" name="InputWebSite" placeholder="เว็บไซต์..." value="<?php echo $club_data['club_website']?>" disabled="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-xs-2 col-md-2">เบอร์โทรติดต่อ
									</div>
									<div class="col-lg-10 col-xs-10 col-md-10">
										<div class="form-group">
											<input type="text" class="form-control info-input" name="InputTel" placeholder="เบอร์โทรติดต่อ..." value="<?php echo $club_data['club_tel']?>" disabled="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-xs-2 col-md-2">โทรสาร
									</div>
									<div class="col-lg-10 col-xs-10 col-md-10">
										<div class="form-group">
											<input type="text" class="form-control info-input" name="InputFax"placeholder="โทรสาร..." value="<?php echo $club_data['club_fax']?>" disabled="">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-2 col-xs-2 col-md-2">รายละเอียด
									</div>
									<div class="col-lg-10 col-xs-10 col-md-10">
										<div class='box-body pad'>
											<textarea name="InputDesc" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $club_data['club_desc']?></textarea>                      
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.box-body -->
					<div class="box-footer clearfix info-footer" style="text-align:right;display:none">
						<button type="button" class="btn btn-default cancel-button">ยกเลิก</button>
						<button type="submit" class="btn btn-primary">บันทึก</button>
					</div>
				</div>
				</form>
			</div><!-- /.tab-pane -->
			<div class="tab-pane " id="tab_2-2">
				<form role="form" id="parTable">
					<div class="box">
						<div class="box-header">
						</div>
						<div class="box-body">
							<div class="row">	
								<div class="col-md-3 col-xs-3">
									<!-- compose message btn data-toggle="modal" data-target="#add-modal" -->
									<a class="btn btn-block btn-primary add-field" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;เพิ่มคอร์ส</a>
									<!-- Navigation - folders-->
									<div style="margin-top: 15px;">
										<ul class="nav nav-pills nav-stacked " id="field-list">
											<li class="header">คอร์สทั้งหมด</li>
											<?php if($field_data->num_rows() > 0):
												foreach($field_data->result_array() as $row):
													echo '<li class="field" value="'.$row['field_id'].'">';
													echo '<a class="field-name">'.$row['field_name'].'</a>';
													echo '<div class="tools"><a class="edit-field" data-toggle="tooltip" title="" data-original-title="แก้ไข" ><i class="fa fa-edit" ></i></a>&nbsp;<a class="remove-field"  data-toggle="tooltip" title="" data-original-title="ลบข้อมูล" ><i class="fa fa-trash-o"></i></a></div></li>';
												endforeach;
												endif;
											?>
										</ul>
									</div>
								</div>
								<div class="col-md-9 col-xs-9">
									<table id="field" class="table table-hover table-bordered" style="display:none" >
										<thead>
											<tr style="text-align:center">
												<th style="width:10%"></th>
												<th style="width:10%">หลุม 1</th>
												<th style="width:10%">หลุม 2</th>
												<th style="width:10%">หลุม 3</th>
												<th style="width:10%">หลุม 4</th>
												<th style="width:10%">หลุม 5</th>
												<th style="width:10%">หลุม 6</th>
												<th style="width:10%">หลุม 7</th>
												<th style="width:10%">หลุม 8</th>
												<th style="width:10%">หลุม 9</th>
											</tr>
										</thead>
										<tbody id="tbody">
											
										</tbody>
										<input type="hidden" name="editField" id="editField" />
									</table>
								</div>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix" style="text-align:right">
							<button type="button" class="btn btn-default cancel-field">ยกเลิก</button>
							<button type="button" class="btn btn-primary submit-field">บันทึก</button>
						</div>
					</div>
				</form>
			</div><!-- /.tab-pane -->
		</div><!-- /.tab-content -->
	</div>
</section><!-- /.content -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">จัดการคอร์ส</h4>
			</div>
			<form action="#" method="post" id="addform">
				<input name="action" type="hidden" value="1" id="action" />
				<input name="editId" type="hidden" id="editId" />
				<div class="modal-body">
					<div class="form-group">
						<label for="InputName">ชื่อคอร์ส</label>
						<input type="text" class="form-control" name="InputName" id="InputName" placeholder="โปรดระบุชื่อคอร์ส">
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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>		
<script type="text/javascript">
$(".textarea").wysihtml5();
	var club_id = $("#clubid").val();
	var table = $("#data").dataTable({
		"bLengthChange": false,
		"bSort": true
	});
	$(document).ready(function(){
		$(".add-field").click(function(){
			$("#field").hide();
			$("#tbody").html("");
			$("#action").val(1);
			$("#InputName").val("");
			$("#add-modal").modal({ show:true});
		});
		$(".edit-info").click(function(){
			$(".info-input").removeAttr("disabled");
			$(".edit-info").hide();
			$(".cancel-info").show();
			$(".info-footer").show();
			$(".pic-info").show();
		});
			
		$(".cancel-button").click(function(){
			$(".edit-info").show();
			$(".cancel-info").hide();
			$(".info-footer").hide();
			$(".info-input").attr("disabled","disabled");
			$(".pic-info").hide();
		});

		$(".cancel-info").click(function(){
			$(".edit-info").show();
			$(".cancel-info").hide();
			$(".info-footer").hide();
			$(".info-input").attr("disabled","disabled");
			$(".pic-info").hide();
		});
		$(".cancel-field").click(function(){
			$("#field").hide();
			$("#tbody").html("");
		});
		jqueryon();
	});
	function jqueryon()
	{	//reset old function
		$(".add").off("click");
		$(".edit-field").off("click");
		$(".remove-field").off("click");
		$(".submit-field").off("click");
		$(".submit").off("click");
		$('.field').off("click");
		
		$(".edit-field").click(function(){
			var row = $(this).parent().parent();
			$("#action").val(2);
			$("#editId").val(row.val());
			$("#InputName").val(row.find('.field-name').text());
			$("#add-modal").modal({ show:true});
		});
		$(".remove-field").click(function(){
			var row = $(this).parent().parent();
			$("#InputId").val(row.val());
			$("#remove-modal").modal({ show:true});
		});
		$(".submit-field").click(function(){
			var url = "<?php echo site_url();?>/clubinfo/field_control/4/"+club_id;
			$.ajax({
				type:"post",
				url: url,
				cache: false,
				data: $('#parTable').serialize(),
				success: function(data){
					$("#message").modal({ show:true});
					//refresh data table
					refresh_field();
				},
				error: function(request, status, error) {
					$("#add-modal").modal('hide');
					$("#error").modal({ show:true});
					//alert(request.responseText);
				}
			});
		});
		$(".submit").click(function(){
			$("#addform").validate({
				rules: {
					InputName: "required"
				},
				 submitHandler: function(form) {
					var url = "<?php echo site_url();?>/clubinfo/field_control/"+$("#action").val()+"/"+club_id;
					
					$.ajax({
						type:"post",
						url: url,
						cache: false,
						data: $('#addform').serialize(),
						success: function(data){
							$("#field").hide();
							$("#tbody").html("");
							$("#add-modal").modal('hide');
							$("#message").modal({ show:true});
							//refresh data table
							refresh_field();

						},
						error: function(request, status, error) {
							$("#field").hide();
							$("#tbody").html("");
							$("#add-modal").modal('hide');
							$("#error").modal({ show:true});
							//alert(request.responseText);
						}
					});
				} 
			});
			
		});
		
		$('.field').click(function(e){	
			$('.field').removeClass("active");
			$(this).addClass("active");
			var field = $(this).val();
			$("#editField").val(field);
			var url = "<?php echo site_url();?>/clubinfo/getParTable/"+field;
			// GET TABLE OF Par
			$.get( url, function() {//alert( "success" );
			})
			.done(function(data) {
				$("#field").show();
				$("#tbody").html(data);
				sum();
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
						(e.keyCode >= 35 && e.keyCode <= 39)) {
							 // let it happen, don't do anything
							 return;
					}
					// Ensure that it is a number and stop the keypress
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						
						e.preventDefault();
					}
					
				});
			})
			.fail(function(data) { 
				$("#error").modal({ show:true});
			});
		});
	}
	
	
	function deletesubmit(){
		
		$.ajax({
			type:"post",
			url: "<?php echo site_url('clubinfo/field_control/3'); ?>/"+club_id,
			cache: false,
			data: $('#deleteform').serialize(),
			success: function(json){
				$("#field").hide();
				$("#tbody").html("");
				$("#remove-modal").modal('hide');
				$("#message").modal({ show:true});
				//refresh data table
				refresh_field();
				
			},
			error: function(){
				$("#field").hide();
				$("#tbody").html("");
				$("#remove-modal").modal('hide');
				$("#error").modal({ show:true});
			}
		});
	}
	function refresh_field(){
		var url = "<?php echo site_url();?>/clubinfo/field_control/0/"+club_id;
		$.get( url, function() {//alert( "success" );
		})
		.done(function(data) {
			$("#field-list").html(data);
			jqueryon();
		})
		.fail(function() { 
			$("#error").modal({ show:true});
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
</script>