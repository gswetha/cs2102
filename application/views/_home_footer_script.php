<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?= $this->config->item('assets_path'); ?>js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?= $this->config->item('assets_path'); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= $this->config->item('assets_path'); ?>js/docs.min.js"></script>
<script type="text/javascript" src="<?= $this->config->item('assets_path'); ?>js/dropdown.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#drop1').click(function() {
    $(this).dropdown();
  })
})
</script>
</body>
</html>
