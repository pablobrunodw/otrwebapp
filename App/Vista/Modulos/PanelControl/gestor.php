<?php
    include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
?>
    


<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Panel de Control
      <small>Resumen general de toda la actividad</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Panel de Control</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class='container-fluid'>


      <div class="row">     
        <div class='col-md-4'>
          <?php include_once "Widget/ServiciosGestionados/gestor.php"; ?>
          <?php include_once "Widget/Efectividad/gestor.php"; ?>
          <?php include_once "Widget/Estados/gestor.php"; ?>
        </div>
        <div class='col-md-8 '>
          <?php include_once "Widget/GestionMensual/gestor.php"; ?>
          <?php include_once "Widget/ServiciosMensual/gestor.php"; ?>
          <?php include_once "Widget/UltimasVisitas/gestor.php"; ?>
        </div>                
      </div>
    </div>  

  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_panelcontrol").addClass("active");
  });

  setTimeout('document.location.reload()',300000);
</script>