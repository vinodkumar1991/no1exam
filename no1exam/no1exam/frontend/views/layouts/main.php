<?php
$strAction = Yii::$app->controller->action->id;
$arrActions = [
    'play'
];
if (! in_array($strAction, $arrActions)) {
    ?>
<!DOCTYPE html>
<html>
<head>
  <?php
    echo $this->render('common/metatags');
    echo $this->render('common/header_script');
    ?>
</head>

<body>
<?php
    echo $this->render('common/header');
    echo $content;
    echo $this->render('common/footer');
    echo $this->render('common/footer_script');
    ?>
</body>

</html>
<?php }else{ ?>
<?php echo $content; } ?>