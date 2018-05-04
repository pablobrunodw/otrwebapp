<?php
  
  $config = (isset($_GET["config"])?$_GET["config"]:"");
  
  $href1 = '?view=configuraciones&config=config1';
  $href2 = '?view=configuraciones&config=config2';
  $href3 = '?view=configuraciones&config=config3';
  $href4 = '?view=configuraciones&config=config4';
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Configuraciones
      <small>Configuración general de la plataforma</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Configuraciones</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-3">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Opciones</h3>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="<?php echo $href1; ?>"><i class="fa fa-cog"></i> Subir Documentación por Servicios</a></li>              
              <li><a href="<?php echo $href2; ?>"><i class="fa fa-cog"></i> Importación de servicios</a></li>              
              <li><a href="<?php echo $href3; ?>"><i class="fa fa-cog"></i> Puntajes por Clientes</a></li>              
              <li><a href="<?php echo $href4; ?>"><i class="fa fa-cog"></i> Puntajes por Gestores</a></li>              
            </ul>
          </div>  
        </div>
      </div>
      <div class="col-md-9">
        <?php
          switch ($config) {
            case 'config1':
              include_once "config1.php";              
              break;

            case 'config2':
              include_once "config2.php";              
              break;

            case 'config3':
              include_once "config3.php";              
              break;

            case 'config4':
              include_once "config4.php";              
              break;                            
          }
        ?>  
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_configuraciones").addClass("active");
  });
</script>