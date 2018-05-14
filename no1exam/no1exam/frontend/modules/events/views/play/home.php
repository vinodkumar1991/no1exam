<!DOCTYPE html>
<html lang="en">
<head>
<title>QUIZ APP</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo $this->render('../play_header_scripts'); ?>
</head>

<body class="playroom">
	<div class="container-fluid">
		<div class='rounds-container'>
			<div class="rounds-title">Rapid Fire</div>
			<h1 class='timer' data-minutes-left=30></h1>
			<div class='actions'></div>
		</div>
		<div class="tables-chr-wrapper">
			<div class="col-md-1">&nbsp;</div>
			<div class="col-md-10">
				<div class="tbl-chr first-tbl-1">
					<div class="inner-tblr">
						<h3 class="user-name-txt">User 1</h3>
						<img
							src="<?php echo Yii::getAlias('@fasset').'/img/playroom/table1.png'; ?>">
						<span class="coins-count">50</span>
						<div class="cns-img">
							<img
								src="<?php echo Yii::getAlias('@fasset').'/img/playroom/coins.png';  ?>" />
						</div>
					</div>
				</div>
				<div class="tbl-chr first-tbl-2">
					<div class="inner-tblr">
						<h3 class="user-name-txt">User 2</h3>
						<img
							src="<?php echo Yii::getAlias('@fasset').'/img/playroom/table2.png'; ?>">
						<span class="coins-count">50</span>
						<div class="cns-img">
							<img
								src="<?php echo Yii::getAlias('@fasset').'/img/playroom/coins.png'; ?>" />
						</div>
					</div>
				</div>
				<div class="tbl-chr first-tbl-3 selcted-tbl">
					<div class="inner-tblr">
						<h3 class="user-name-txt">User 3</h3>
						<img
							src="<?php echo Yii::getAlias('@fasset').'/img/playroom/selected-table.png'; ?>" />
						<span class="coins-count">50</span>
						<div class="cns-img">
							<img
								src="<?php echo Yii::getAlias('@fasset').'/img/playroom/coins.png';  ?>" />
						</div>
					</div>
				</div>
				<div class="tbl-chr first-tbl-4">
					<div class="inner-tblr">
						<h3 class="user-name-txt">User 1</h3>
						<img
							src="<?php echo Yii::getAlias('@fasset').'/img/playroom/table.png'; ?>" />
						<span class="coins-count">50</span>
						<div class="cns-img">
							<img
								src="<?php echo Yii::getAlias('@fasset').'/img/playroom/coins.png';  ?>" />
						</div>
					</div>
				</div>
				<div class="tbl-chr first-tbl-5">
					<div class="inner-tblr">
						<h3 class="user-name-txt">User 1</h3>
						<img
							src="<?php echo Yii::getAlias('@fasset').'/img/playroom/table.png'; ?>" />
						<span class="coins-count">50</span>
						<div class="cns-img">
							<img
								src="<?php echo Yii::getAlias('@fasset').'/img/playroom/coins.png'; ?>" />
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1">&nbsp;</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div class="qustion-txt-wrapper">
			<div class="col-md-1 text-center">
				<div class="quest-count">10</div>
			</div>
			<div class="col-md-10">
				<div class="quest-ans-bg">
					<h4 class="bold">This is User Vs User Game Formula?</h4>
					<div class="row">
						<div class="col-md-6">a) Answer1</div>
						<div class="col-md-6">a) Answer2</div>
						<div class="col-md-6">a) Answer3</div>
						<div class="col-md-6">a) Answer4</div>
					</div>
				</div>
			</div>
			<div class="col-md-1 text-center">
				<div class="qs-time-count">
					60 <span>Sec</span>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid no-padding">
		<div class="btm-bg-wrapper">
			<p>This is User Vs User Game Formula</p>
		</div>
	</div>
	<script
		src="<?php echo Yii::getAlias('@fasset').'/plugins/Countdown-Timer/jquery.simple.timer.js'; ?>"></script>
	<script
		src="<?php echo Yii::getAlias('@fasset').'/plugins/Countdown-Timer/dojo.js'; ?>"></script>
</body>
</html>
