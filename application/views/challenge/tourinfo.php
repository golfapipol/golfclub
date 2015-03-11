<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?php echo $tournament_data['tour_name'];?>
		<small><?php $TimeStart = explode("-",$tournament_data['tour_startdate']);
		$TimeEnd = explode("-",$tournament_data['tour_enddate']);
		echo '<td>'.$TimeStart[2]."/".$TimeStart[1]."/".$TimeStart[0].' - '.$TimeEnd[2]."/".$TimeEnd[1]."/".$TimeEnd[0].'</td>';?>
		</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url('home')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo site_url("challenge");?>">รายการแข่งขัน</a></li>
		<li>รายละเอียดการแข่งขัน</li>
		<li class="active">รายละเอียด</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4 col-xs-6">
			<a href="#">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>
							Info
						</h3>
						<p>รายละเอียด
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-info-circle"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-6">
			<!-- small box -->
			<a href="<?php echo site_url("challenge/player/".$tournament_data['tour_id']);?>">
				<div class="small-box bg-blue">
					<div class="inner">
						<h3>
							Player
						</h3>
						<p>ลงชื่อนักกีฬา
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-user"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
		<div class="col-lg-4 col-xs-6">
			<a href="<?php echo site_url("challenge/pairing/".$tournament_data['tour_id']);?>">
				<!-- small box -->
				<div class="small-box bg-purple">
					<div class="inner">
						<h3>
							Pairing
						</h3>
						<p>จัดก๊วน
						</p>
					</div>
					<div class="icon">
						<i class="fa fa-fw fa-list-ul"></i>
					</div>
					<div class="small-box-footer">
						&nbsp
					</div>
				</div>
			</a>
		</div>
	</div>
	<h4 class="page-header">ข้อมูลสนามแข่งขัน</h4>
	<div class="row">
		<div class="col-md-6 col-xs-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">คอร์สที่ใช้ในการแข่งขัน</h3>
				</div>
				<form role="form" method="post" action="<?php echo site_url("challenge/tourinfo_save");?>">
					<input type="hidden" name="TourId" value="<?php echo $tournament_data['tour_id'];?>" />
					<div class="box-body drop sortable" style="min-height:15em">
					<?php 
						if($tour_field_data->num_rows() > 0):
							$i=0;
							foreach($tour_field_data->result_array() as $row):
								echo '<div class="box box-info"><div class="box-header">';
								echo '<h3 class="box-title"> หลุม '.(($i*9)+1).' - '.(($i*9)+9).' : '.$row['field_name'].'</h3><input type="hidden" name="InputField[]" value="'.$row['field_id'].'" />';
								echo '<div class="box-tools pull-right">
										<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="ลบ" onclick="remove_list(this)"><i class="fa fa-times"></i></button>
									</div></div></div>';
								$i +=1;
							endforeach;
						endif;
						
					?>
					</div><!-- /.box-body -->

					<div class="box-footer clearfix no-border">
						<button type="submit" class="btn btn-success pull-right " style="margin-left:1%" >บันทึก</button> 
						<button type="button" class="btn btn-default pull-right cancel" >ยกเลิก</button>
						
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6 col-xs-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?php echo $tournament_data['club_name'];?></h3>
				</div>
				<div class="box-body ">
				<?php 
					foreach($field_data->result_array() as $row):
						echo '<div class="box box-info item"><div class="box-header">';
						echo '<h3 class="box-title">'.$row['field_name'].'</h3><input type="hidden" name="InputField[]" value="'.$row['field_id'].'" />';
						echo '<div class="box-tools pull-right">
								<button class="btn btn-info btn-sm field_info" data-widget="info" data-toggle="tooltip" title="" data-original-title="รายละเอียด" value="'.$row['field_id'].'"><i class="fa fa-fw fa-info-circle"></i></button>
							</div></div></div>';
					endforeach;?>
				</div><!-- /.box-body -->
			</div>
		</div>
	</div>
</section><!-- /.content -->
<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">ข้อมูลสนามแข่งขัน</h4>
			</div>
			<div class="modal-body">
				<label id="field_info_name" for="InputName">ชื่อสนามกอล์ฟ</label>
				<table id="field" class="table table-hover table-bordered" >
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
				</table>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
var hole_count = $(".drop").children().length;
//alert(hole_count);
	$(".addhole").click(function(){
		
	});
	$(".cancel").click(function(){
		location.reload(true);
	});
	$(".item").draggable({
		helper: "clone"
	});
	$(".field_info").click(function(e){
			var row = $(this).parent().parent();
			var text = $(row).find(".box-title").text();
			var field = $(this).val();
			$("#field_info_name").text(text);
			var url = "<?php echo site_url();?>/challenge/getFieldInfo/"+field;
			// GET TABLE OF Par
			$.get( url, function() {//alert( "success" );
			})
			.done(function(data) {
				$("#field").show();
				$("#tbody").html(data);
				
			})
			.fail(function(data) { });
		$("#info-modal").modal({ show:true});
	});
	$(".drop").droppable({
		drop: function( event, ui ) {
			if($(ui.draggable).hasClass("item ui-draggable")){
				var new_item = ui.draggable.clone();
				$(this).append(new_item);
				var last_child = $(this).children().last();
				$(last_child).find('.box-tools').empty().append('<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="ลบ" onclick="remove_list(this)"><i class="fa fa-times"></i></button>');
				$(last_child).removeClass( "item ui-draggable" );
				$(last_child).find('.box-title').prepend(" หลุม "+((hole_count*9)+1)+" - "+((hole_count*9)+9)+" : ");
				$("[data-toggle='tooltip']").tooltip();
				hole_count += 1;
			}
		}
	});
	$(".drop").sortable({ helper: "clone",placeholder: "ui-state-highlight" ,
		stop: function( ) {
			sort_field();
        }
	});
    $( ".drop" ).disableSelection();
	function remove_list(object){
		$(object).parent().parent().parent().remove();
		hole_count -= 1;
	}
	function remove_flight(object){
		$(object).parent().parent().remove();
	}
	function sort_field(){
		var start = 0;
		$(".drop").children().each(function(){
			var text = $(this).find('.box-title').text();
			var field_text = text.split(" : ");
			$(this).find('.box-title').text(" หลุม "+((start*9)+1)+" - "+((start*9)+9)+" : "+ field_text[1]);
			start += 1;
		});
	}
</script>