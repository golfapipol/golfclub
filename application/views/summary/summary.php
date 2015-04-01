<style>.flightinput{width:70%;text-align:center}</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		ผลการแข่งขัน
		<small>Summary Result</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">ผลการแข่งขัน</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4 col-xs-5">
			<!-- small box -->
			<a href="<?php echo site_url("summary/playerSummary/" . $tournament['tour_id']);?>">
				<div class="small-box bg-blue">
					<div class="inner">
						<h3>Score Summary</h3><p>ประเภทบุคคล</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-user"></i>
					</div>
					<div class="small-box-footer">
						&nbsp;
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-5">
			<a href="<?php echo site_url("summary/teamSummary/" . $tournament['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>Group Summary</h3><p>ประเภททีม</p>
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
		<div class="col-lg-4 col-xs-2">
			<a href="<?php echo site_url("summary/config/" . $tournament['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-light-blue">
					<div class="inner">
						<h3>Config</h3><p>ตั้งค่า</p>
					</div>
					
					<div class="icon">
						<i class="fa fa-fw fa-gear "></i>
					</div>
					<div class="small-box-footer">
						&nbsp;
					</div>
				</div>
			</a>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3 style="text-align:center;">Bordered Table</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div class="row">	
				<div class="col-md-3 col-xs-3">
					<div style="margin-top: 15px;">
						<ul class="nav nav-pills nav-stacked">
							<li class="header">ประเภทบุคคล</li>
							<li class="filter active" value="0"><a><i class="fa fa-folder"></i>ทั้งหมด</a></li>
							<li class="filter" value="1"><a><i class="fa fa-file-o"></i>Flight A</a></li>
							<li class="filter" value="2"><a><i class="fa fa-fw fa-exclamation"></i>Flight B</a></li>
							<li class="filter" value="3"><a><i class="fa fa-fw fa-flag-checkered"></i>Flight C</a></li>
							<li class="filter" value="4"><a><i class="fa fa-fw fa-flag-checkered"></i>Flight D</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-xs-9">
					<table class="table table-bordered">
						<tbody><tr>
							<th>#</th>
							<th>Name</th>
							<th>Flight</th>
							<th>Gross Score</th>
							<th>Handicap</th>
							<th>Total Score</th>
						</tr>
						<tr>
							<td>1.</td>
							<td>Update software</td>
							<td>
								<div class="progress xs">
									<div class="progress-bar progress-bar-danger" style="width: 55%"></div>
								</div>
							</td>
							<td><span class="badge bg-red">55%</span></td>
							<td><span class="badge bg-red">55%</span></td>
							<td><span class="badge bg-red">55%</span></td>
						</tr>
						<tr>
							<td>2.</td>
							<td>Clean database</td>
							<td>
								<div class="progress xs">
									<div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
								</div>
							</td>
							<td><span class="badge bg-yellow">70%</span></td>
							<td><span class="badge bg-yellow">70%</span></td>
							<td><span class="badge bg-yellow">70%</span></td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Cron job running</td>
							<td>
								<div class="progress xs progress-striped active">
									<div class="progress-bar progress-bar-primary" style="width: 30%"></div>
								</div>
							</td>
							<td><span class="badge bg-light-blue">30%</span></td>
							<td><span class="badge bg-light-blue">30%</span></td>
							<td><span class="badge bg-light-blue">30%</span></td>
						</tr>
						<tr>
							<td>4.</td>
							<td>Fix and squish bugs</td>
							<td>
								<div class="progress xs progress-striped active">
									<div class="progress-bar progress-bar-success" style="width: 90%"></div>
								</div>
							</td>
							<td><span class="badge bg-green">90%</span></td>
							<td><span class="badge bg-green">90%</span></td>
							<td><span class="badge bg-green">90%</span></td>
						</tr>
					</tbody></table>
		
				</div>
			</div>
		</div><!-- /.box-body -->
		<div class="box-footer clearfix">
			
		</div>
	</div>
</section><!-- /.content -->
<script>
$("select").change(function(){
	var num =$(this).val();
	if(num!=="none"){
		var plusnum = (parseInt(num)+1);
		$(this).parent().parent().parent().parent().next().find('div:first-child').find('div:first-child').html(plusnum);
		$(this).parent().parent().parent().parent().next().find('option').each(function(){
			if(parseInt($(this).val()) <= plusnum ){ $(this).hide();}else{$(this).show();}
		});
	}else{
		$(this).parent().parent().parent().parent().next().find('option').each(function(){$(this).show();});
		$(this).parent().parent().parent().parent().next().find('select').prop("selectedIndex",0);
		$(this).parent().parent().parent().parent().next().find('input').val("");
	}
	//$(this).parent().parent().parent().parent().next().find('select').prop("selectedIndex",plusnum);
});
			
			$(".flightDivide").click(function(){
				$(".flightDivide").removeClass("btn-primary active");
				$(".flightDivide").addClass("btn-default");
				$(this).removeClass("btn-default");
				$(this).addClass("btn-primary active");
				$("#flightType").val(($(this).attr('id')==='none')? 0:1);
			});
			$('#add_flight').click(function(){
				var last_char = $('.flight tr:nth-last-child(2) td').text();
				var option = $('.flight tr:nth-last-child(2)').find('select').html();
				var code = last_char.charCodeAt(0)+1;
				$('.flight tr:last').before('<tr><td>'+String.fromCharCode(code)+'</td><td colspan="2"><div class="row"><div class="col-md-4">'
				+'</div><div class="col-md-1">-</div><div class="col-md-6">'
				+'<select class="form-control" >'+option+'</select>'
				+'</div></div>'
				+'</td></td><td><button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" onclick="remove_flight(this)" data-original-title="ลบ" ><i class="fa fa-times"></i></button></td></tr>');
				$("select").change(function(){
					var num =$(this).val();
					if(num!=="none"){
						var plusnum = (parseInt(num)+1);
						$(this).parent().parent().parent().parent().next().find('input').val(plusnum);
						$(this).parent().parent().parent().parent().next().find('option').each(function(){
							if(parseInt($(this).val()) <= plusnum ){ $(this).hide();}else{$(this).show();}
						});
					}else{
						$(this).parent().parent().parent().parent().next().find('option').each(function(){$(this).show();});
						$(this).parent().parent().parent().parent().next().find('select').prop("selectedIndex",0);
						$(this).parent().parent().parent().parent().next().find('input').val("");
					}
				});
			});
			function remove_flight(object){
				$(object).parent().parent().remove();
			}
</script>