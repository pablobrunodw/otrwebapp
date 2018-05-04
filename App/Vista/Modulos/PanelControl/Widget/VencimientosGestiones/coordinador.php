<?php
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
    
    $dFecha = new Fechas;    
    $handler = new HandlerSistema;
  
  $user = $usuarioActivoSesion;

    /*-------------------------*/
    /* --- gestion de fechas --*/
    $fHOY = $dFecha->FechaActual();
    $fHOY = $dFecha->FormatearFechas($fHOY,"Y-m-d","Y-m-d"); 

    $f = new DateTime();
    $f->modify('first day of this month');
    $fMES = $f->format('Y-m-d'); 

    setlocale(LC_TIME, 'spanish');  
    $nombreMES = strftime("%B",mktime(0, 0, 0, $f->format('m'), 1, 2000));      
    $anioMES = $f->format('Y'); 
    /*-------------------------*/

    //PARA TRABAJAR MAS COMODOS EN MODO DESARROLLO
    if(!PRODUCCION)
      $fHOY = "2016-08-12";

    $arrVencido = $handler->selectServiciosPorVencerByGestor(2,null,null,null,$user->getAliasUserSistema(),null,'VENCIDOS');     
    $arrPorVencer = $handler->selectServiciosPorVencerByGestor(2,null,null,null,$user->getAliasUserSistema(),null,'A TIEMPO');     
?>


<div class="box box-warning">
  <div class="box-header">
    <h3 class="box-title">
      <i class="ion-ios-timer-outline"> </i> Vencimientos.  
      <span class="pull-right text-yellow"><b> <?php echo $dFecha->FormatearFechas($fHOY,'Y-m-d','d/m/Y  - h:i'); ?></b></span>
    </h3>
  </div>
  <div class="box-body no-padding">
    <div class="col-xs-12 text-center with-border" style="color: #777 !important;">
      <h3 class="text-yellow"><i class="fa fa-exclamation-triangle"></i> 
        <span class="text-black" id="widget-vencimiento-titulo-por-vencer"> 
            
        </span>
      </h3>
    </div>
    <div class="col-xs-12 no-padding">
      <ul class="nav nav-stacked">
        <?php 

          $sum_por_vencer=0;
          if(!empty($arrPorVencer)) {
            foreach ($arrPorVencer as $key => $value) {

              $url_por_vencer = "?view=servicio&fdesde=".$fHOY."&fhasta=".$fHOY."&festado=2&fgestor=".$value->CODGESTOR;

              echo "<li><a href='".$url_por_vencer."'>".$value->NOMGESTOR."<span class='pull-right'>".$value->CANTIDAD." op</span></a></li>";

              $sum_por_vencer = $sum_por_vencer + $value->CANTIDAD;
            }

          }
        ?>        
      </ul>
    </div>

    <div class="col-xs-12 text-center with-border" style="color: #777 !important;">
      <h3 class="text-red"><i class="fa fa-exclamation-circle"></i> 
        <span class="text-black" id="widget-vencimiento-titulo-vencido"> 
            
        </span>
      </h3>
    </div>
    <div class="col-xs-12 no-padding">
      <ul class="nav nav-stacked">
        <?php 

          $sum_vencido=0;
          if(!empty($arrVencido)) {            
            foreach ($arrVencido as $key => $value) {
              $url_vencido = "?view=servicio&fdesde=".$fHOY."&fhasta=".$fHOY."&festado=2&fgestor=".$value->CODGESTOR;

              echo "<li><a href='".$url_vencido."'>".$value->NOMGESTOR."<span class='pull-right'>".$value->CANTIDAD." op</span></a></li>";

              $sum_vencido = $sum_vencido + $value->CANTIDAD;
            }

          }
        ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#widget-vencimiento-titulo-por-vencer").append("<?php echo $sum_por_vencer ?> <small>gestiones próximas a vencerse</small>");
  $("#widget-vencimiento-titulo-vencido").append("<?php echo $sum_vencido ?> <small>gestiones vencidas</small>");  
</script>