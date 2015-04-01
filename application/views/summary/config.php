<style>.flightinput{width:70%;text-align:center}</style>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>ผลการแข่งขัน<small>Summary Result</small></h1>
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
					<div class="inner"><h3>Score Summary</h3><p>ประเภทบุคคล</p></div>
					<div class="icon"><i class="fa fa-fw fa-user"></i></div>
					<div class="small-box-footer">&nbsp;</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-5">
			<a href="<?php echo site_url("summary/teamSummary/" . $tournament['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner"><h3>Group Summary</h3><p>ประเภททีม</p></div>
					<div class="icon"><i class="fa fa-fw fa-users"></i></div>
					<div class="small-box-footer">&nbsp;</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-2">
			<a href="<?php echo site_url("summary/config/" . $tournament['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-light-blue">
					<div class="inner"><h3>Config</h3><p>ตั้งค่า</p></div>
					<div class="icon"><i class="fa fa-fw fa-gear "></i></div>
					<div class="small-box-footer">&nbsp;</div>
				</div>
			</a>
		</div>
	</div>
	<?php if ($tournament['tour_scoretype'] == null || $tournament['tour_scoregroup'] == null || $tournament['tour_flightdivide'] == null) : ?>
	<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-warning"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<b>กรุณาตั้งค่าการประมวลผล</b>
	</div>
	<?php endif; ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">ตั้งค่าการประมวณผล</h3>
		</div>
		<form role="form" name="config_form" id="config_form" method="post" action="<?php echo site_url("summary/config_control/" . $tournament['tour_id']);?>">
			<div class="box-body">
				<div class="box-body no-padding">
					<div class="row">
						<div class="form-group col-md-4 col-md-offset-1">
							<label for="InputName">วิธีการประมวลผล </label>
						</div>
						<div class="col-md-3">
							<div class="btn-group" data-toggle="buttons">
							<?php 
								$strokeplay = 'btn-default';
								$stableford = 'btn-default';
								$scoreType = '';
								if ($tournament['tour_scoretype'] == 1 || $tournament['tour_scoretype'] == null) :
									$strokeplay = 'btn-primary active';
									$scoreType = 'value="1"';

								else:
									$stableford = 'btn-primary active';
									$scoreType = 'value="2"';
								endif;
								echo '<a class="btn '. $strokeplay .' scoreType" id="strokeplay">Stroke Play</a>';
								echo '<a class="btn '. $stableford .' scoreType" id="stableford">Stable Ford</a>';
								echo '<input type="hidden" name="scoreType" id="scoreType" '. $scoreType .' />';
							?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4 col-md-offset-1">
							<label for="InputName">การประมวลผลทีม (จำนวนคนที่คิดคะแนน)</label>
						</div>
						<div class="col-md-2">
							<select class="form-control" name="scoregroup" id="scoregroup">
								<?php 
								for ($i = 3; $i < 6; $i++) :
									if ($tournament['tour_scoregroup'] == $i) :
										echo '<option value="' . $i . '" selected>' . $i . '</option>';
									else :
										echo '<option value="' . $i . '">' . $i . '</option>';
									endif;
								endfor;?>
							</select>
						</div>
						<div class="col-md-1">คน</div>
					</div>
					<div class="row">
						<div class="form-group col-md-4 col-md-offset-1">
							<label for="InputName">แบ่งไฟลท์</label>
						</div>
						<div class="col-md-3">
							<div class="btn-group" data-toggle="buttons">
							<?php 
								$all = 'btn-default';
								$male_female = 'btn-default';
								$scoreType = '';
								if ($tournament['tour_flightdivide'] == 1 || $tournament['tour_flightdivide'] == null) :
									$all = 'btn-primary active';
									$flightdivide = 'value="1"';
								else:
									$male_female = 'btn-primary active';
									$flightdivide = 'value="2"';
								endif;
								echo '<a class="btn '. $all .' flightDivide" id="none"><i class="fa fa-users"></i>รวม</a>';
								echo '<a class="btn '. $male_female .' flightDivide" id="male_female"><i class="fa fa-user"></i>ชาย/หญิง</a>';
								echo '<input type="hidden" name="flightType" id="flightType" '. $flightdivide .' />';?>
							</div>
						</div>
					</div>
					<div class="row" id="male">
						<div class="col-md-3 col-xs-3">
							<h3 style="text-align:center" id="flight_type"><?php echo ($tournament['tour_flightdivide'] == 2)? 'ชาย': 'ทั้งหมด';?></h3>
						</div>
						<div class="col-md-8 col-xs-8">
							<input type="hidden" name="flight-male" id="flight-male" value="1">
							<table class="table " style="text-align:center">
								<tbody class="flight-male">
									<tr>
										<th style="width:40%;text-align:center">Flight</th>
										<th style="width:25%;text-align:center">ระหว่าง</th>
										<th style="width:25%;text-align:center">ถึง</th>
										<th style="width:10%"></th>
									</tr>
									<?php 
										if(sizeof($male_flights) > 0) :
											foreach($male_flights as $flight) :
												if ($flight['flight_type'] == 1) :
													echo '<tr><td>'.$flight['flight_name'].'</td>';
													echo '<td colspan="2"><div class="row">';
													echo '<div class="col-md-4 startrange">'.$flight['flight_startrange'].'</div>';
													echo '<div class="col-md-1">-</div>';
													echo '<div class="col-md-6">
															<select class="endrange" name="male-endrange-'.$flight['flight_name'].'" id="male-endrange-'.$flight['flight_name'].'" onchange="flight_change(this)">';
													for($i = $flight['flight_startrange']; $i <= $flight['flight_endrange']; $i++) :
														if ($i == $flight['flight_endrange']):
															echo '<option value="'. $i .'" selected>'. $i . '</option>';
														else:
															echo '<option value="'. $i .'">'. $i . '</option>';
														endif;
													endfor;
													echo '</select></div>';
													echo '</td><td></td></tr>';
												endif;
											endforeach;
										else:
											echo '<tr><td>A</td>';
											echo '<td colspan="2"><div class="row">';
											echo '<div class="col-md-4 startrange">0</div>';
											echo '<div class="col-md-1">-</div>';
											echo '<div class="col-md-6">
													<select class="endrange" name="male-endrange-A" id="male-endrange-A" onchange="flight_change(this)">
														<option value="24">24</option>
													</select></div>';
											echo '</td><td></td></tr>';
										endif;?>
									<tr class="last_tr_male">
										<td colspan="4">
											<button type="button" class="btn btn-success btn-sm" id="add_flight_male" data-widget="info" data-toggle="tooltip" data-original-title="เพิ่มไฟลท์"><i class="fa fa-fw fa-plus-square"></i>เพิ่มไฟลท์</button> &nbsp
											<button type="button" class="btn btn-danger btn-sm" id="remove_flight_male" data-widget="info" data-toggle="tooltip" data-original-title="ลดไฟลท์" onclick="remove_flight(this)" style="display:none;"><i class="fa fa-fw fa-minus-square"></i>ลดไฟลท์</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row" id="female" <?php echo ($tournament['tour_flightdivide'] == 1 || $tournament['tour_flightdivide'] == null)? 'style="display:none;"': '';?>>
						<div class="col-md-3 col-xs-3">
							<h3 style="text-align:center">หญิง</h3>
						</div>
						<div class="col-md-8 col-xs-8">
							<input type="hidden" name="flight-female" id="flight-female" value="1">
							<table class="table " style="text-align:center">
								<tbody class="flight-female">
									<tr>
										<th style="width:40%;text-align:center">Flight</th>
										<th style="width:25%;text-align:center">ระหว่าง</th>
										<th style="width:25%;text-align:center">ถึง</th>
										<th style="width:10%"></th>
									</tr>
									<?php 
										if(sizeof($female_flights) > 0) :
											foreach($female_flights as $flight) :
												if ($flight['flight_type'] == 2) :
													echo '<tr><td>'.$flight['flight_name'].'</td>';
													echo '<td colspan="2"><div class="row">';
													echo '<div class="col-md-4 startrange">'.$flight['flight_startrange'].'</div>';
													echo '<div class="col-md-1">-</div>';
													echo '<div class="col-md-6">
															<select class="endrange" name="female-endrange-'.$flight['flight_name'].'" id="female-endrange-'.$flight['flight_name'].'" onchange="flight_change(this)">';
													for($i = $flight['flight_startrange']; $i <= $flight['flight_endrange']; $i++) :
														if ($i == $flight['flight_endrange']):
															echo '<option value="'. $i .'" selected>'. $i . '</option>';
														else:
															echo '<option value="'. $i .'">'. $i . '</option>';
														endif;
													endfor;
													echo '</select></div>';
													echo '</td><td></td></tr>';
												endif;
											endforeach;
										else:
											echo '<tr><td>A</td>';
											echo '<td colspan="2"><div class="row">';
											echo '<div class="col-md-4 startrange">0</div>';
											echo '<div class="col-md-1">-</div>';
											echo '<div class="col-md-6">
													<select class="endrange" name="female-endrange-A" id="female-endrange-A" onchange="flight_change(this)">
														<option value="24">24</option>
													</select></div>';
											echo '</td><td></td></tr>';
										endif;?>
									<tr class="last_tr_female">
										<td colspan="4">
											<button type="button" class="btn btn-success btn-sm" id="add_flight_female" data-widget="info" data-toggle="tooltip" data-original-title="เพิ่มไฟลท์"><i class="fa fa-fw fa-plus-square"></i>เพิ่มไฟลท์</button> &nbsp
											<button type="button" class="btn btn-danger btn-sm" id="remove_flight_female" data-widget="info" data-toggle="tooltip" data-original-title="ลดไฟลท์" onclick="remove_flight(this)" style="display:none;"><i class="fa fa-fw fa-minus-square"></i>ลดไฟลท์</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- /.box-body -->
			<div class="box-footer clearfix no-border">
				<button type="submit" class="btn btn-success pull-right" >บันทึก</button>
			</div>
		</form>
	</div>
</section><!-- /.content -->
<script>

$(document).ready(function () {
	if ($(".last_tr_male").is(':nth-child(3)') == false) {
		$("#remove_flight_male").show();
	}
	if ($(".last_tr_female").is(':nth-child(3)') == false) {
		$("#remove_flight_female").show();
	}
});
function flight_change(object) {
	var next_element, two_next_element, two_next_end_hc, option;
	next_element = $(object).parent().parent().parent().parent().next();
	two_next_element = next_element.next();
	var num = $(object).val();
	var plusnum = (parseInt(num, 10) + 1);
	$(next_element).find('.startrange').html(plusnum);
	if ($(next_element).is(':nth-last-child(2)')) {
		$(next_element).find('.endrange').html('<option value="24">24</option>');
		$(next_element).find('.endrange').val(24);
	} else {
		option = '';
		for (i = plusnum + 1; i < 23; i++) {
			option += '<option value="' + i + '">' + i + '</option>';
		}
		$(next_element).find('.endrange').html(option);
		$(next_element).find('.endrange').val((plusnum + 1));
	}
}

$(".flightDivide").click(function(){
	$(".flightDivide").removeClass("btn-primary active");
	$(".flightDivide").addClass("btn-default");
	$(this).removeClass("btn-default");
	$(this).addClass("btn-primary active");
	$("#flightType").val(($(this).attr('id')==='none')? 1:2);
	if ($("#flightType").val() == 1) {
		$("#flight_type").html("ทั้งหมด");
		$("#female").fadeOut();
	} else {
		$("#flight_type").html("ชาย");
		$("#female").fadeIn();
	}
});
$(".scoreType").click(function(){
	$(".scoreType").removeClass("btn-primary active");
	$(".scoreType").addClass("btn-default");
	$(this).removeClass("btn-default");
	$(this).addClass("btn-primary active");
	$("#scoreType").val(($(this).attr('id')==='strokeplay')? 1:2);
});

$("#add_flight_male").click(function () {
	var last_char, last_start_hc, last_end_hc;
	last_row = $('.flight-male tr:nth-last-child(2)');
	last_char = $(last_row).find('td:nth-child(1)').html();
	last_start_hc = $(last_row).find('.startrange').html();
	last_end_hc = $('#male-endrange-' + last_char).val();
	var edit_endrange_option, new_char, new_row, new_start_hc, new_end_hc;
	new_char = String.fromCharCode(last_char.charCodeAt(0) + 1);
	new_start_hc = (parseInt(last_start_hc, 10) + 2);
	new_row = '<tr><td>' + new_char + ' </td>';
	new_row += '<td colspan="2"><div class="row"><div class="col-md-4 startrange">' + new_start_hc +'</div>';
	new_row += '<div class="col-md-1">-</div><div class="col-md-6"><select class="endrange" name="male-endrange-' + new_char + '" id="male-endrange-' + new_char + '" onchange="flight_change(this)"><option value="24">24</option>';
	new_row += '</select></div></td><td></td></tr>';
	edit_endrange_option = '';
	for (i = parseInt(last_start_hc, 10) + 1; i < 23; i++) {
		edit_endrange_option += '<option value="' + i + '">' + i + '</option>';
	}
	$(last_row).after(new_row);
	$(last_row).find('.endrange').html(edit_endrange_option);
	$(last_row).find('.endrange').val(parseInt(last_start_hc, 10) + 1);
	// if row > 2 show remove flight button
	if ($(".last_tr_male").is(':nth-last-child(2)') == false) {
		$("#remove_flight_male").show();
	}
});

$('#add_flight_female').click(function(){
	var last_char, last_start_hc, last_end_hc;
	last_row = $('.flight-female tr:nth-last-child(2)');
	last_char = $(last_row).find('td:nth-child(1)').html();
	last_start_hc = $(last_row).find('.startrange').html();
	last_end_hc = $('#female-endrange-' + last_char).val();
	var edit_endrange_option, new_char, new_row, new_start_hc, new_end_hc;
	new_char = String.fromCharCode(last_char.charCodeAt(0) + 1);
	new_start_hc = (parseInt(last_start_hc, 10) + 2);
	new_row = '<tr><td>' + new_char + ' </td>';
	new_row += '<td colspan="2"><div class="row"><div class="col-md-4 startrange">' + new_start_hc +'</div>';
	new_row += '<div class="col-md-1">-</div><div class="col-md-6"><select class="endrange" name="female-endrange-' + new_char + '" id="female-endrange-' + new_char + '" onchange="flight_change(this)"><option value="24">24</option>';
	new_row += '</select></div></td><td></td></tr>';
	edit_endrange_option = '';
	for (i = parseInt(last_start_hc, 10) + 1; i < 23; i++) {
		edit_endrange_option += '<option value="' + i + '">' + i + '</option>';
	}
	$(last_row).after(new_row);
	$(last_row).find('.endrange').html(edit_endrange_option);
	$(last_row).find('.endrange').val(parseInt(last_start_hc, 10) + 1);
	// if row > 2 show remove flight button
	if ($(".last_tr_female").is(':nth-last-child(2)') == false) {
		$("#remove_flight_female").show();
	}
});
function remove_flight(object){
	var parent_of_remove_button, last_flight;
	parent_of_remove_button = $(object).parent().parent();
	last_flight = $(parent_of_remove_button).prev();
	if ($(last_flight).is(':nth-child(2)') == false) {
		$(last_flight).prev().find('.endrange').html('<option value="24">24</option>');
		$(last_flight).remove();
		if ($(parent_of_remove_button).is(':nth-child(3)')) {
			$(object).hide();
		}
	} 
}
			
</script>