<!-- SlimScroll -->
<!-- <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->
<!-- FastClick -->
<!-- <script src="bower_components/fastclick/lib/fastclick.js"></script> -->
<!-- AdminLTE App -->
<script src="<?=Yii::getAlias('@asset').'/dist/js/adminlte.min.js'; ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=Yii::getAlias('@asset').'/dist/js/demo.js'; ?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>