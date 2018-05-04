<?php

  if(isset($_GET["err"]))
    $err= $_GET["err"];
  else
    $err="";

  if(!empty($err))
  {
?>

  <div class="box-body" id="mensaje_error" style="position: fixed; right: 0px; z-index: 1">
    <div class="alert alert-dismissable bg-red">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Ups!</h4>
        <?php echo $err; ?>
    </div>
  </div>

  <script type="text/javascript">
    var myVarError=setInterval(function () {myTimerError()}, 10000);

    function myTimerError() {      
        document.getElementById("mensaje_error").style.display = "none";
    }
  </script>


<?php
  }
?>