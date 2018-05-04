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

  $countServiciosHoy = $handler->selectCountServicios($fHOY,$fHOY,null,$user->getUserSistema(),null,null,null,null);    

  //ESTADO = 100 --> EN EL METODO ESTA PARA QUE FILTRE COMO GESTIONADO (MAYOR QUE DOS **2**)
  $countServiciosHoyGestionado = $handler->selectCountServicios($fHOY,$fHOY,100,$user->getUserSistema(),null,null,null,null);    

  if(!empty($countServiciosHoy[0]->CANTIDAD_SERVICIOS))
    $countServiciosHoyGestionado = round((intval($countServiciosHoyGestionado[0]->CANTIDAD_SERVICIOS) / intval($countServiciosHoy[0]->CANTIDAD_SERVICIOS))*100,2);
  else
    $countServiciosHoyGestionado = round(0,2); 

?>        

  <div class="col-md-12 nopadding">
    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><i class='fa fa-bolt'></i> Visor de Servicios Gestionados. <span class='text-yellow'><b><?php echo $dFecha->FormatearFechas($fHOY,'Y-m-d','d/m/Y'); ?></b></span></h3>
      </div>
      <div class="box-body">            
        <p style='padding-bottom: 35px;'>
          
          <span class='pull-left' style='font-size: 13px;'>
            <b style='font-size: 30px;'>
              <?php echo $countServiciosHoy[0]->CANTIDAD_SERVICIOS; ?>                
            </b> 
            <span style='background-color: rgba(128, 128, 128, 0.17);'>
              <b>Servicios</b>
            </span> 
          </span>

          <span class='pull-right' style='font-size: 13px;'>
            <span style='background-color: rgba(128, 128, 128, 0.17);'>
              <b>Gestionados</b>
            </span> 
            <b style='font-size: 30px;'>
              <?php echo $countServiciosHoyGestionado."%"; ?>              
            </b>
          </span>
        </p>            
        <div class="progress" style='margin-bottom: 10px;'>
          <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $countServiciosHoyGestionado; ?>" aria-valuemin="0" aria-valuemax="100" style="<?php echo "width: ".$countServiciosHoyGestionado."%"; ?>">
            <span class="sr-only"><?php echo $countServiciosHoyGestionado."% Completado"; ?></span>
          </div>
        </div>

      </div>
    </div>
  </div>