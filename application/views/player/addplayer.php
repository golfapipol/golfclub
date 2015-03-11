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
		<li><a href="<?php echo site_url('playerinfo')?>">ข้อมูลสมาชิก</a></li>
		<li class="active">เพิ่มข้อมูลสมาชิก</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<h4 class="page-header">เพิ่มข้อมูลสมาชิก</h4>
		<div class="box box-primary" >
			<div class="box-header">
				<h3 class="box-title">ข้อมูลสมาชิก</h3>
			</div>
			<form role="form" method="post" action="<?php echo site_url("playerinfo/processPlayer/1");?>">
				<div class="box-body">
					<div class="row">
						<div class="col-md-3 col-md-offset-1">
							<div class="form-group">
								<label for="InputClub">คำนำหน้าชื่อ <span class="required">*</span></label>
								<select class="chosen-select" style="width:40%" name="InputPrefix" id="InputPrefix" data-placeholder="เลือกคำนำหน้าชื่อ" >
									<option value="" selected></option>
									<?php foreach($chosen_prefix->result_array() as $row):
										echo "<option value='".$row['prefix_id']."'>".$row['prefix_name']."</option>";
									endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>ชื่อ - นามสกุล <span class="required">*</span></label>
								<input type="text" name="InputName" id="InputName" class="form-control" placeholder="กรุณากรอกชื่อ - นามสกุล" >
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-3 col-md-offset-1">
							<div class="form-group">
								<label for="InputSex">เพศ<span class="required">*</span></label>
								<div class="input-group">
									<div class="btn-group" data-toggle="buttons">
										<a class="btn type btn-default" id="male"><i class="fa fa-male"></i>ชาย</a>
										<a class="btn type btn-default" id="female"><i class="fa fa-female"></i>หญิง</a>
										<input type="hidden" name="InputSex" id="InputSex" value="0">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>วันเดือนปีเกิด (ค.ศ.)<span class="required">*</span></label>
								<input type="text" class="form-control " id="InputBirthDay" name="InputBirthDay"/>
							</div>
						</div>
						<div class="col-md-3 ">
							<div class="form-group">
								<label>เบอร์โทรติดต่อ<span class="required">*</span></label>
								<input type="text" class="form-control number-input" id="InputTel" name="InputTel"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8 col-md-offset-1">
							<div class="form-group">
								<label>ที่อยู่</label>
								<input type="text" class="form-control" id="InputAddress" name="InputAddress"/>
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-md-offset-1">
							<div class="form-group">
								<label>จังหวัด</label>
								<select class="chosen-select" style="width:40%" name="InputProvince" id="InputProvince" data-placeholder="เลือกจังหวัด"  >
									<option value="0" selected></option>
									<?php foreach($chosen_province->result_array() as $row):
										echo "<option value='".$row['provinceId']."'>".$row['provinceName']."</option>";
									endforeach;?>
								</select>
							
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>อำเภอ</label>
								<select class="chosen-select" style="width:40%" name="InputAmphur" id="InputAmphur" data-placeholder="เลือกอำเภอ" >
									<option value="0" selected></option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>ตำบล</label>
								<select class="chosen-select" style="width:40%" name="InputDistrict" id="InputDistrict" data-placeholder="เลือกตำบล" >
									<option value="0" selected></option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-md-offset-1">
							<div class="form-group">
								<label>สถานะผู้เล่น <span class="required">*</span></label>
								<select class="chosen-select" style="width:40%" name="InputStatus" id="InputStatus" data-placeholder="เลือกสถานะผู้เล่น">
									<option value="" selected></option>
									<?php foreach($chosen_status->result_array() as $row):
										echo "<option value='".$row['status_id']."'>".$row['status_name']."</option>";
									endforeach;?>
								</select>
							
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Handicap (HC)</label>
								<input type="text" class="form-control number-input" name="InputHC"/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-md-offset-1">
							<div class="form-group">
								<label for="InputProfile">รูปประจำตัว ( ถ้ามี )</label>
								<input type="file" id="InputProfile" name="InputProfile">
							</div>
						</div>
					</div>
				</div><!-- /.box-body -->
				<div class="box-footer clearfix" style="text-align:right">
					<button type="button" class="btn btn-default" onclick="javascript:history.back()">ยกเลิก</button>
					<button type="submit" class="btn btn-primary submit-form" disabled>บันทึก</button>
				</div>
			</form>
		</div>
	
</section><!-- /.content -->
<script type="text/javascript">
	// Chosen 
	$(".chosen-select").chosen({no_results_text:'ไม่พบรายการที่ทำการค้นหา',width: '50px'});
	$(".type").click(function(){
		$(".type").removeClass("btn-primary active");
		$(".type").addClass("btn-default");
		$(this).removeClass("btn-default");
		$(this).addClass("btn-primary active");
		var sex = ($(this).attr('id')==='male')? 1:2;
		$("#InputSex").val(sex);
		$('.submit-form').removeAttr('disabled');
	});
	$("#InputBirthDay").datepicker({changeMonth: true,
      changeYear: true,yearRange: '-80:-4',dateFormat: "yy/mm/dd",defaultDate: '1970/01/01' });
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
	$('#InputProvince').change(function(){
		var value = $("#InputProvince").val();
		$.ajax({
			type:'GET',
			url:"<?php echo site_url("playerinfo/chosen/2");?>",
			data:{id:value},
			success:function(data){
				$('#InputAmphur').find('option')
							.remove()
							.end()
							.append(data)
							.trigger('chosen:updated');
	 
			}
		});
	});
	$('#InputAmphur').change(function(){
		var value = $("#InputAmphur").val();
		$.ajax({
			type:'GET',
			url:"<?php echo site_url("playerinfo/chosen/3");?>",
			data:{id:value},
			success:function(data){
				$('#InputDistrict').find('option')
							.remove()
							.end()
							.append(data)
							.trigger('chosen:updated');
	 
			}
		});
	});
	$("form").validate({
		rules: {
			InputName: "required",
			InputBirthDay: "required",
			InputTel: "required",
			InputPrefix: {
                required: true,
            },
			InputStatus: {
                required: true,
            }
		}
	});
	$('form').on('submit', function(e) {
		if(!$('#InputPrefix').valid()) {
			$("#InputPrefix").parent().find(".errorprefix").remove();
			$("#InputPrefix").parent().find(".chosen-container").append('<label for="InputPrefix" class="error errorprefix">กรูณาเลือกคำนำหน้า.</label>');
			$("#InputPrefix").parent().find(".error").hide();
			$("#InputPrefix").parent().find(".errorprefix").show();
			e.preventDefault();
		}
		if(!$('#InputStatus').valid()) {
			$("#InputStatus").parent().find(".errorstatus").remove();
			$("#InputStatus").parent().find(".chosen-container").append('<label for="InputStatus" class="error errorstatus">กรูณาเลือกสถานะ.</label>');
			$("#InputStatus").parent().find(".error").hide();
			$("#InputStatus").parent().find(".errorstatus").show();
			e.preventDefault();
		}
		
});  
	
	
</script>