<style>
tr:hover { cursor: pointer;}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		นำเข้ารายชื่อ
		<small>Import Member</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url('playerinfo')?>">ข้อมูลสมาชิก</a></li>
		<li class="active">นำเข้ารายชื่อ</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-3"> 
			<div class="box box-primary" >
				<form role="form" id="import_member" name="import_member">
					<div class="box-header">
						<h3 class="box-title">ข้อมูลสมาชิก</h3>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputFile">Import Excel/CSV </label>
							<input type="file" name="InputFile" id="InputFile">
							<p class="help-block">Please upload Excel or CSV file only</p>
						</div>	
					</div>
					<div class="box-footer">
						<button class="btn btn-success" id="import_submit" type="button">Import</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-9"> 
			<div class="box box-primary" >
				<div class="box-header">
					<h3 class="box-title">ข้อมูลสมาชิก</h3>
				</div>
				<div class="box-body" id="response">
				</div>
			</div>
		</div>
	</div>
</section><!-- /.content -->
<script type="text/javascript">
$(document).ready(function () {
	$('#import_submit').click(function () {
		var file_data = $('#InputFile').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		$.ajax({
			url: '<?php echo site_url('import_member/listOfData');?>',
			type: 'POST',
			data: form_data,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#response").html(data);
			}
		});
	});
});
</script>