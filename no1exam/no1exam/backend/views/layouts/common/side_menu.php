
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Logo -->
		<div class="logo-wrapper">
			<a href="<?php echo Yii::getAlias('@web') . '/dashboard'; ?>"
				class="logo"> <span class="logo-mini"><img
					src="<?= Yii::getAlias('@asset') . '/dist/img/logo.png'; ?>"
					width="90"></span>
			</a>
		</div>

		<ul class="sidebar-menu" data-widget="tree">
			<!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> -->
			<!-- Users Module :: START -->
			<li class="active"><a
				href="<?php echo Yii::getAlias('@web').'/users';?>"><i
					class="fa fa-user"></i> <span>Users</span></a></li>
			<!-- Users Module :: END -->
			<!-- Education Module :: START -->
			<li class="treeview"><a href=""><i class="fa fa-book"></i> <span>Education</span>
					<span class="pull-right-container"> <i
						class="fa fa-angle-left pull-right"></i>
				</span> </a>
				<ul class="treeview-menu">
					<li><a href="<?php echo Yii::getAlias('@web').'/boards';?>"> Boards</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/streams';?>">Streams</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/groups';?>">Groups</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/subjects';?>">Subjects</a></li>
				</ul></li>
			<!-- Education Module :: END -->
			<!-- Quizes :: START -->
			<li class="treeview"><a href=""><i class="fa fa-question"
					aria-hidden="true"></i> <span>Quiz</span> <span
					class="pull-right-container"> <i
						class="fa fa-angle-left pull-right"></i>
				</span> </a>
				<ul class="treeview-menu">
					<li><a
						href="<?php echo Yii::getAlias('@web').'/competitive-type';?>">
							Competitive Types</a></li>
					<li><a
						href="<?php echo Yii::getAlias('@web').'/competitive-methods';?>">
							Competitive Methods</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/questions';?>">
							Questions</a></li>
				</ul></li>
			<!-- Quizes :: END -->
			<!-- Notification :: START -->
			<li class="treeview"><a href=""><i class="fa fa-question"
					aria-hidden="true"></i> <span>Notification</span> <span
					class="pull-right-container"> <i
						class="fa fa-angle-left pull-right"></i>
				</span> </a>
				<ul class="treeview-menu">
					<li><a href="<?php echo Yii::getAlias('@web').'/sender-ids';?>">
							SenderIds</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/templates';?>">
							Templates</a></li>
				</ul></li>
			<!-- Notification :: END -->
			<!-- Settings Module :: START -->
			<li class="treeview"><a href=""><i class="fa fa-cog"
					aria-hidden="true"></i> <span>Settings</span> <span
					class="pull-right-container"> <i
						class="fa fa-angle-left pull-right"></i>
				</span> </a>
				<ul class="treeview-menu">
					<li><a href="<?php echo Yii::getAlias('@web').'/roles';?>">Roles</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/permissions';?>">Permission Types</a></li>
					<li><a
						href="<?php echo Yii::getAlias('@web').'/role-permissions';?>">Role
							Permissions</a></li>
					<li><a href="<?php echo Yii::getAlias('@web').'/locations';?>">Locations</a></li>
					<!-- 					
						<li><a href="<?php //echo Yii::getAlias('@web').'/create-quiz-settings';?>">Quiz
<!-- 							Settings</a></li> -->
				</ul></li>
			<!-- Settings Module :: END -->
			<!-- <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li class="active"><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li> -->
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>

