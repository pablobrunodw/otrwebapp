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

    //ESTADO = 300 --> Cerrado Parcial, Re pactado, Re llamar, Cerrado, Negativo (los 5 estados que se toman como operacion en la calle)
    $countServiciosMesCursoGestion = $handler->selectCountServiciosGestion($fMES,$fHOY,null,$user->getUserSistema(),null,null,null,null);  
    $countDiasMesCurso = $handler->selectCountFechasServicios($fMES,$fHOY,null,$user->getUserSistema(),null,null,null,null);

    if(!empty($countDiasMesCurso[0]->CANTIDAD_DIAS))
      $countServiciosTotalGestion = round((intval($countServiciosMesCursoGestion[0]->CANTIDAD_SERVICIOS) / intval($countDiasMesCurso[0]->CANTIDAD_DIAS)),0);
    else
      $countServiciosTotalGestion = round(0,2);    

    //ESTADO = 200 --> Cerrado, Enviado y Liquidar (los 3 estados que se toman como operacion cerrada)
    $countServiciosCerradosMesCursoGestion = $handler->selectCountServiciosGestion($fMES,$fHOY,200,$user->getUserSistema(),null,null,null,null);        

    if(!empty($countServiciosMesCursoGestion[0]->CANTIDAD_SERVICIOS))
      $efectividadMesCursoGestion = round(($countServiciosCerradosMesCursoGestion[0]->CANTIDAD_SERVICIOS) / intval(intval($countServiciosMesCursoGestion[0]->CANTIDAD_SERVICIOS))*100,0);
    else
      $efectividadMesCursoGestion = round(0,2);
?>


  <div class="col-md-12 nopadding">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><i class='fa fa-bar-chart'></i> GESTIÓN. <span class='text-yellow'><b><?php echo strtoupper($nombreMES)." ".$anioMES; ?></b></span></h3>
      </div>
      <div class="box-body">            
        <div class="col-lg-3 col-xs-12">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $countServiciosMesCursoGestion[0]->CANTIDAD_SERVICIOS; ?></h3>
              <p><b>Gestión Totales</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paperplane"></i>
            </div>                
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countServiciosTotalGestion;?>&nbsp;<small style='font-size: 40%; color:white;'><b><u>En <?php echo $countDiasMesCurso[0]->CANTIDAD_DIAS; ?> Días</u></b></small></h3>
              <p><b>Gestión Promedio</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>                
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $countServiciosCerradosMesCursoGestion[0]->CANTIDAD_SERVICIOS; ?></h3>
              <p><b>Gestión Cerrados</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-locked"></i>
            </div>                
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $efectividadMesCursoGestion."%"; ?></h3>
              <p><b>Efectividad</b></p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-speedometer"></i>
            </div>                
          </div>
        </div>
      </div>
      
    </div>
  </div>
