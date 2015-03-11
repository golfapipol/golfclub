<ul class="nav navbar-nav">
	<!-- User Account: style can be found in dropdown.less -->
	<li class="dropdown user user-menu">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="glyphicon glyphicon-user"></i>
			<span><?php echo $this->session->userdata('UserName');?><i class="caret"></i></span>
		</a>
		<ul class="dropdown-menu">
			<!-- User image -->
			<li class="user-header bg-light-blue" style="height:100%">
				<p>
					<?php echo $this->session->userdata('UserAccount');?>
					<small><?php echo $this->session->userdata('UserGpName');?></small>
				</p>
			</li>
			<!-- Menu Footer-->
			<li class="user-footer">
				<div class="pull-left">
					<a href="#" class="btn btn-default btn-flat">Change Password</a>
				</div>
				<div class="pull-right">
					<a href="<?php echo site_url()."/userinfo/logout";?>" class="btn btn-default btn-flat">Sign out</a>
				</div>
			</li>
		</ul>
	</li>
</ul>