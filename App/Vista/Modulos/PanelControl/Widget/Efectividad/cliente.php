<?php
  	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  

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

    $cerrados_efec =  $handler->selectCountServicios($fHOY,$fHOY, 6, $user->getUserSistema(), null, null, null, null);
    $despachados_efec = $handler->selectCountServicios($fHOY,$fHOY, 100, $user->getUserSistema(), null, null, null, null);
    //$total_efec = $handler->selectCountServicios($fHOY,$fHOY, null, $user->getUserSistema(), null, null, null, null);    

    if($despachados_efec[0]->CANTIDAD_SERVICIOS>0){        
      $efectividad_dia = 100 * $cerrados_efec[0]->CANTIDAD_SERVICIOS / $despachados_efec[0]->CANTIDAD_SERVICIOS;
    }
    else{
      $efectividad_dia = 0;
    }
?>

<div class="col-md-12 nopadding">
	<div class="box box-solid">
	  <div class="box-header with-border">
	    <i class="ion ion-ios-speedometer"></i>
	    <h3 class="box-title">Efectividad de cierre. 
	    	<span class='text-yellow'><b><?php echo $dFecha->FormatearFechas($fHOY,'Y-m-d','d/m/Y'); ?></b></span>
	    </h3>
	  </div>
	  <div class="box-body" style='text-align: center;'>
	  	<b style='font-size: 50px;'><?php echo round($efectividad_dia,2); ?> % </b>	  
	  </div>
	</div>
</div>