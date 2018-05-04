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

   	$arrUltimosHistorico = $handler->selectUltimosServiciosHistorico($fHOY,$fHOY,null,null,null,null,null);
    $allEstados = $handler->selectAllEstados();
?>

<div class="col-md-12 nopadding">
  <div class="box box-solid">
    <div class="box-header with-border">
      <i class="fa fa-clock-o"></i>
      <h3 class="box-title">Últimos Servicios Gestionados <span class='text-yellow'><b><?php echo $dFecha->FormatearFechas($fHOY,'Y-m-d','d/m/Y'); ?></span></b></h3>
    </div>
    <div class="box-body table-responsive no-padding">

      <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">

        <thead>
          <tr>                  
            <th class='text-center' style=''>Hora</th>
            <th class='text-center' style=''>DNI</th>
            <th class='text-left' style=''>Nombre</th>
            <th class='text-left' style=''>Teléfono</th>
            <th class='text-left' style=''>Estado</th>

            <th class='text-left' style=''>Empresa</th>        
            <th class='text-left' style=''>Gerente</th>  

            <th class='text-left' style=''>Observaciones</th>
            <th class='text-center' style=''></th>
          </tr>
        </thead>

        <tbody>
          <?php
            if(!empty($arrUltimosHistorico))
            {

              foreach ($arrUltimosHistorico as $key => $value) {

                if($value->HSETT91_OBSERV == $value->HSETT91_OBRESPU)
                  $observaciones = $value->HSETT91_OBSERV;
                else
                  $observaciones = $value->HSETT91_OBSERV."<br>".$value->HSETT91_OBRESPU; 

                $observaciones = $observaciones."<br>".$value->HSETT91_OBSEENT ;

                $url_servicio = "?view=detalle_servicio&fechaing=".$value->HSETT12_FECSER->format('Y-m-d')."&nroing=".$value->HSETT13_NUMEING;

                $f_array = new FuncionesArray;
                $class_estado = $f_array->buscarValor($allEstados,"1",$value->ESTADOS_DESCCI,"3");


                echo "
                  <tr>                          
                    <td class='text-center'>".$value->HSETT11_FECEST->format("H:i:s")."</td>              
                    <td class='text-center'>".$value->HSETT31_PERNUMDOC."</td>";

                    if(!empty(trim(strip_tags($value->HSETT91_NOMBRE))))
                      if(strlen(trim(strip_tags($value->HSETT91_NOMBRE)))>10)
                        echo "<td class='text-left'>".substr(trim(strip_tags($value->HSETT91_NOMBRE)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->HSETT91_NOMBRE))."'></i></td>";
                      else
                        echo "<td class='text-left'>".trim(strip_tags($value->HSETT91_NOMBRE))."</td>";
                    else
                      echo "<td class='text-left'></td>";

                    if(!empty(trim(strip_tags($value->HSETT91_TELEFONO))))
                      if(strlen(trim(strip_tags($value->HSETT91_TELEFONO)))>10)
                        echo "<td class='text-left'>".substr(trim(strip_tags($value->HSETT91_TELEFONO)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->HSETT91_TELEFONO))."'></i></td>";
                      else
                        echo "<td class='text-left'>".trim(strip_tags($value->HSETT91_TELEFONO))."</td>";
                    else
                      echo "<td class='text-left'></td>";

                echo "              
                    <td class='text-left'><span class='".$class_estado."'>".$value->ESTADOS_DESCCI."</span></td>";

                //####################################################################

                    //EMPRESA
                      echo "<td class='text-left'>".$value->EMPTT21_ABREV."</td>";

                    //GERENTE
                    if(!empty(trim(strip_tags($value->SERTT91_GTEALIAS))))
                      if(strlen(trim(strip_tags($value->SERTT91_GTEALIAS)))>10)
                        echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_GTEALIAS)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_GTEALIAS))."'></i></td>";
                      else
                        echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_GTEALIAS))."</td>";
                    else
                      echo "<td class='text-left'></td>";

                //####################################################################

                    if(!empty(trim(strip_tags($observaciones))))
                      if(strlen(trim(strip_tags($observaciones)))>10)
                        echo "<td class='text-left'>".substr(trim(strip_tags($observaciones)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($observaciones))."'></i></td>";
                      else 
                        echo "<td class='text-left'>".trim(strip_tags($observaciones))."</td>";
                    else
                      echo "<td class='text-left'></td>";         

                  echo "
                    <td class='text-center'><a href='".$url_servicio."' class='btn btn-default btn-xs'><b>Detalle</b></a></td>
                  </tr>
                ";
              }
            }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</div>