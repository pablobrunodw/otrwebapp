<?php
  include_once PATH_NEGOCIO."Sistema/handlerconsultas.class.php";  
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 

  include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php"; 
  
  $view_detalle= "index.php?view=puntajes_coordinador_detalle";

  $user = $usuarioActivoSesion;

  $dFecha = new Fechas;

  $handler = new HandlerSistema;
  $arrCoordinador = $handler->selectAllCoordinadorFiltro(null,null,null,null,null);  

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());      
  $fcoordinador= $user->getAliasUserSistema();

  $handler =  new HandlerConsultas;
  $consulta = $handler->consultaPuntajesCoordinador($fdesde, $fhasta, $fcoordinador);
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Puntajes
      <small>Puntajes generados desde los servicios</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Puntajes</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">

      <div class='col-md-12'>
          <div class="box box-solid">
              <div class="box-header with-border">
                <i class="fa fa-filter"></i>
                <h3 class="box-title">Filtros Disponibles</h3>
                <button type="button" class="btn btn-box-tool pull-right bg-red" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>    
              <div class="box-body">
                <div class='row'>     
                  <div class="col-md-10">     
                <div class="col-md-3" id='sandbox-container'>
                  <label>Fecha Resolucion Desde - Hasta </label>                
                  <div class="input-daterange input-group" id="datepicker">
                      <input type="text" class="input-sm form-control" onchange="crearHref()" id="start" name="start" value="<?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y'); ?>"/>
                      <span class="input-group-addon">a</span>
                        <input type="text" class="input-sm form-control" onchange="crearHref()" id="end" name="end" value="<?php echo $dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?>"/>
                    </div>  
                </div>
                
                <div class="col-md-2" style="margin-top: 30px;">              
                    <label></label>                
                  <a class="btn btn-warning btn-xs" href="<?php echo $view_detalle."&fdesde=".$fdesde."&fhasta=".$fhasta; ?>"> Ver detalle</a>                         
                </div>
              </div>
              <div class="col-md-2">              
                  <label></label>                
                <a class="btn btn-block btn-success" id="filtro_reporte" onclick="crearHref()"><i class='fa fa-filter'></i> Filtrar</a>                         
              </div>
            </div>
          </div>
        </div>
      </div>      
      <div class="row">      
        <?php
            $total_servicios = 0;
            $total_servicios_cerrados = 0;
            $total_efectividad = 0;
            $total_puntajes_cerrados = 0;

            $total_servicios_enviadas = 0;
            $total_puntajes_enviadas = 0;

            $objetivo=0;

            if(!empty($consulta))
            {
              foreach ($consulta as $key => $value) { 

                $handlerP = new HandlerPuntaje;
                $objetivo = $handlerP->buscarObjetivoCoordinador($value->ALIAS_COORDINADOR);                        
                $puntaje = $handlerP->buscarPuntaje($value->COD_EMPRESA);

                if(empty($objetivo))                                                  
                  $objetivo = 0;

                if(empty($puntaje))
                  $puntaje_cerrados = 0;
                else
                  $puntaje_cerrados = round($value->CERRADO*$puntaje,2);

                if(empty($puntaje))
                  $puntaje_enviadas = 0;
                else
                  $puntaje_enviadas = round($value->ENVIADO*$puntaje,2);                        

                if(!empty($value->TOTAL_SERVICIOS))
                  $efectividad = round($value->CERRADO/$value->TOTAL_SERVICIOS,2) * 100;
                else
                  $efectividad = 0;
                

                $total_servicios = $total_servicios + $value->TOTAL_SERVICIOS;
                $total_servicios_cerrados = $total_servicios_cerrados + $value->CERRADO;
                $total_puntajes_cerrados = $total_puntajes_cerrados + $puntaje_cerrados;                        

                $total_servicios_enviadas = $total_servicios_enviadas + $value->ENVIADO;
                $total_puntajes_enviadas = $total_puntajes_enviadas + $puntaje_enviadas;                        
              }
            }

            if(!empty($total_servicios))
              $total_efectividad = round($total_servicios_cerrados/$total_servicios,2) *100;
            else
              $total_efectividad = 0;                    
        ?>

        
        <div class="col-md-12">
          <!--
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-trophy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">OBJETIVO</span>
                <span class="info-box-number"><?php echo $objetivo; ?> puntos</span>
              </div>
            </div>
         </div>
          -->

          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">FECHA DESDE / FECHA HASTA</span>
                <span class="info-box-number"><?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')." al ".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?></span>
              </div>
            </div>
          </div>

          <!--
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gray"><i class="fa fa-truck" style="color: white;"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL DE SERVICIOS</span>
                <span class="info-box-number"><?php echo $total_servicios; ?></span>
              </div>
            </div>
          </div>
          -->
          
        </div>            
        

        <div class="col-md-12">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-briefcase"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SERVICIOS CERRADOS</span>
                <span class="info-box-number"><?php echo $total_servicios_cerrados." de ".$total_servicios; ?></span>
              </div>
            </div>
          </div>
                 
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-calculator"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PUNTAJE</span>
                <span class="info-box-number"><?php echo $total_puntajes_cerrados."/".$objetivo; ?></span>
              </div>
            </div>
          </div>
                 
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-sliders"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">EFECTIVIDAD</span>
                <span class="info-box-number"><?php echo $total_efectividad; ?> %</span>
              </div>
            </div>
          </div>
        </div>        

        <div class="col-md-12">
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-paper-plane-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SERVICIOS ENVIADOS</span>
                <span class="info-box-number"><?php echo $total_servicios_enviadas." de ".$total_servicios; ?></span>
              </div>
            </div>
          </div>
                 
          <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-calculator"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">PUNTAJE</span>
                <span class="info-box-number"><?php echo $total_puntajes_enviadas."/".$objetivo; ?></span>
              </div>
            </div>
          </div>

        </div>

      </div>                
    </div>

  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_puntajes").addClass("active");
  });

  $('#sandbox-container .input-daterange').datepicker({
      format: "dd/mm/yyyy",
      clearBtn: false,
      language: "es",
      keyboardNavigation: false,
      forceParse: false,
      autoclose: true,
      todayHighlight: true,                                                                        
      multidate: false,
      todayBtn: "linked",  
  });

  crearHref();  
  function crearHref()
  {
      aStart = $("#start").val().split('/');
      aEnd = $("#end").val().split('/');

      f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
      f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                              
      
      url_filtro_reporte="index.php?view=puntajes_coordinador&fdesde="+f_inicio+"&fhasta="+f_fin;

      $("#filtro_reporte").attr("href", url_filtro_reporte);
  }     
</script>