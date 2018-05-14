<?php
$strAction = Yii::$app->controller->action->id;
$arrActions = ['login','forgot-password'];
if (!in_array($strAction,$arrActions)) {
    ?>
<!DOCTYPE html>
<html>
<head>
<?php
    echo $this->render('common/metatags');
    echo $this->render('common/header_script');
    ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
	<?php
    echo $this->render('common/header');
    echo $this->render('common/side_menu');
    
    ?>
    <div class="content-wrapper">
    <?php
    echo $content;
    ?>
    
    </div>
		<?php
    echo $this->render('common/footer');
    ?>
	</div>
	<?php
    echo $this->render('common/footer_script');
    ?>
</body>

</html>
<?php
} else {
    echo $content;
}

?>

