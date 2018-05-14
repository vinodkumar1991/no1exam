<nav id="myNavbar"
	class="navbar navbar-default navbar-inverse navbar-fixed-top"
	role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#navbarCollapse">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><img
				src="<?php echo Yii::getAlias('@fasset').'/img/logo.png';?>"></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="main-nav">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a
						href="<?php echo Yii::getAlias('@fweb').'/home'; ?>">Home</a></li>
					<li><a href="<?php echo Yii::getAlias('@fweb').'/about-us'; ?>">About
							Us</a></li>
					<li><a href="<?php echo Yii::getAlias('@fweb').'/event-home'; ?>">Evets</a></li>
					<!-- 					<li><a href="">Blog</a></li> -->
					<li><a class="cd-signin"
						href="<?php echo Yii::getAlias('@fweb').'/account'; ?>">My Account</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>