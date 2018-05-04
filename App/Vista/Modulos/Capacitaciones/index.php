<?php
  $user = $usuarioActivoSesion;

 // $url_action_enviar = PATH_VISTA.'Modulos/Inbox/action_enviar.php';
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Capacitaciones
      <small>Capacitaciones del gestor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Capacitaciones</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-university"></i>       
            <h3 class="box-title">Capacitaciones</h3>          
          </div>
          <div class="box-body">

          </div>
        </div>
      </div>                
    </div>

  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_capacitaciones").addClass("active");
  });
</script>