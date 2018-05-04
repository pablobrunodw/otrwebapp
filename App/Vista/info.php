<?php

  if(isset($_GET["info"]))
    $info= $_GET["info"];
  else
    $info="";

  if(!empty($info))
  {
?>
  
  <div class="box-body" id="mensaje_info" style="position: fixed; right: 0px; z-index: 1">
    <div class="alert alert-dismissable bg-green">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-info"></i> Información</h4>
        <?php echo $info; ?>
    </div>
  </div>
    
  <script type="text/javascript">
    var myVarInfo=setInterval(function () {myTimerInfo()}, 10000);

    function myTimerInfo() {      
        document.getElementById("mensaje_info").style.display = "none";
    }
  </script>
  
<?php
  }
?>
