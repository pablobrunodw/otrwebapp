<?php
  
  $consulta = (isset($_GET["consulta"])?$_GET["consulta"]:"");
  
  $href1 = '?view=estadisticas&consulta=cons1';
  $href2 = '?view=estadisticas&consulta=cons2';
  $href3 = '?view=estadisticas&consulta=cons3';
  $href4 = '?view=estadisticas&consulta=cons4';
  $href5 = '?view=estadisticas&consulta=cons5';
  $href6 = '?view=estadisticas&consulta=cons6';
  $href7 = '?view=estadisticas&consulta=cons7';
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Estadísticas
      <small>Consultas personalizadas</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Estadísticas</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-2">

        <div class="box box-solid">
          <div class="box-header with-border bg-green">
            <h3 class="box-title">Gerenciales</h3>
            <div class="box-tools">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>                
              </div>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="<?php echo $href6; ?>"><i class="fa fa-area-chart"></i> General</a></li>
              <li><a href="<?php echo $href1; ?>"><i class="fa fa-area-chart"></i> Re Trabajo</a></li>
              <li><a href="<?php echo $href2; ?>"><i class="fa fa-area-chart"></i> Cierre por Localidad</a></li>
              <li><a href="<?php echo $href3; ?>"><i class="fa fa-area-chart"></i> Sub Estados</a></li>
              <li><a href="<?php echo $href4; ?>"><i class="fa fa-area-chart"></i> Comparativas</a></li>
              <li><a href="<?php echo $href5; ?>"><i class="fa fa-area-chart"></i> Cronológicas</a></li>
            </ul>
          </div>  
        </div>

        <div class="box box-solid">
          <div class="box-header with-border bg-red">
            <h3 class="box-title">Control</h3>
            <div class="box-tools">                
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>                
              </div>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="<?php echo $href7; ?>"><i class="fa fa-area-chart"></i> Inicios de Sesión</a></li>
            </ul>
          </div>  
        </div>

      </div>
      <div class="col-md-10">
        <?php
          switch ($consulta) {
            case 'cons1':
              include_once "consulta1.php";              
              break;

            case 'cons2':
              include_once "consulta2.php";
              break;

            case 'cons3':
              include_once "consulta3.php";
              break;            

            case 'cons4':
              include_once "consulta4.php";
              break;            

            case 'cons5':
              include_once "consulta5.php";
              break;            

            case 'cons6':
              include_once "consulta6.php";
              break;            

            case 'cons7':
              include_once "consulta7.php";
              break;                          
          }
        ?>  
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_estadisticas").addClass("active");
  });
</script>