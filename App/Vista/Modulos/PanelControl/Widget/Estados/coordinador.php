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

  	$arrEstados = $handler->selectGroupServiciosByEstados($fHOY,$fHOY,null,null,null,null,$user->getAliasUserSistema(),null);     
	$allEstados = $handler->selectAllEstados();
?>

<div class="col-md-12 nopadding">
	<div class="box box-solid">
	  <div class="box-header with-border">
	    <i class="fa fa-flag"></i>
	    <h3 class="box-title">Seguimiento de Estados. <span class='text-yellow'><b><?php echo $dFecha->FormatearFechas($fHOY,'Y-m-d','d/m/Y'); ?></b></span></h3>
	  </div>
	  <div class="box-body table-responsive no-padding">
	    <table class="table table-striped table-bordered" id="tabla" cellspacing="0" width="100%">
	      <thead>
	        <tr>
	          <th class='text-left'>Estado</th>
	          <th class='text-center'>Cantidad</th>
	          <th class='text-center'>%</th>
	          <th class='text-center'></th>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	          if(!empty($arrEstados))
	          {                    
	            foreach ($arrEstados as $key => $value) {
	              $url_estados = "?view=servicio&fdesde=".$fHOY."&fhasta=".$fHOY."&festado=".$value->SERTT91_ESTADO;

	              $f_array = new FuncionesArray;
	              $class_estado = $f_array->buscarValor($allEstados,"1",$value->ESTADOS_DESCCI,"2");

	              if(!($value->ESTADOS_DESCCI=="Liquidar C. Parcial") || !($value->ESTADOS_DESCCI=="No Efectivas"))
	              {
	                echo "
	                  <tr>
	                    <td class='text-left'><span class='".$class_estado."' style='font-size:15px;'>".$value->ESTADOS_DESCCI."</span></td>
	                    <td class='text-center' style='style='font-size:18px;'><b>".$value->CANTIDAD_SERVICIOS."</b></td>
	                    <td class='text-center' style='style='font-size:18px;'><b>".round(($value->CANTIDAD_SERVICIOS/$countServiciosHoy[0]->CANTIDAD_SERVICIOS)*100,2)."%</b></td>
	                    <td class='text-center'>
	                      <a href='".$url_estados."' class='btn btn-default btn-xs'><b>Detalle</b></a>
	                    </td>
	                  </tr>
	                ";
	              }
	            }
	          }                  
	        ?>
	      </tbody>
	    </table>
	  </div>
	</div>	
</div>