<ul class="sidebar-menu">
<?php 
if(isset($menu)):
	foreach($menu->result_array() as $list):
		echo '<li><a href="'.site_url().'/'.$list['menu_url'].'"><span>'.$list['menu_name'].'</span></a></li>';
	endforeach;
endif;
?>
</ul>