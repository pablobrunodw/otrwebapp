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

    $arrServicios = $handler->selectServicios($fHOY,$fHOY,null,$user->getUserSistema(),null,null,null,null,null);                        
    $allEstados = $handler->selectAllEstados();
?>

<div class="col-md-12 nopadding">
  <div class="box box-solid">
    <div class="box-header with-border">
      <i class="fa fa-clock-o"></i>
      <h3 class="box-title">Servicios del día <span class='text-yellow'><b><?php echo $dFecha->FormatearFechas($fHOY,'Y-m-d','d/m/Y'); ?></span></b></h3>
    </div>
    <div class="box-body table-responsive no-padding">    

      <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
        
        <thead>
          <tr>                  
            <th class='text-center'>Fecha</th>
            <th class='text-center'>Nro</th>            
            <th class='text-left'>DNI</th>            
            <th class='text-left'>Nombre</th>      
            <th class='text-left'>Telefono</th>      
            <th class='text-left'>Localidad</th>      
            <th class='text-left'>Estado</th>  
            <th class='text-left'>Observaciones</th>    
            
            <th style="width: 5%;" class='text-center'></th>
          </tr>
        </thead>

        <tbody>
          <?php
            if(!empty($arrServicios))
            {

              $url_detalle = "index.php?view=detalle_servicio";     

              foreach ($arrServicios as $key => $value) {

                if($value->SERTT91_OBSERV == $value->SERTT91_OBRESPU)
                  $observaciones = $value->SERTT91_OBSERV;
                else
                  $observaciones = $value->SERTT91_OBSERV."<br>".$value->SERTT91_OBRESPU; 

                $observaciones = $observaciones."<br>".$value->SERTT91_OBSEENT ;

                $url_hist = $url_detalle."&fechaing=".$value->SERTT11_FECSER->format('Y-m-d')."&nroing=".$value->SERTT12_NUMEING;        

                echo "<tr>";

                  //FECHA
                  echo "<td class='text-center'>".$value->SERTT11_FECSER->format('d/m/Y')."</td>";              

                  //NUMERO
                  echo "<td class='text-center'>".$value->SERTT12_NUMEING."</td>";

                  //DNI              
                  echo "<td class='text-left'>".$value->SERTT31_PERNUMDOC."</td>";              

                  //NOMBRE
                  if(!empty(trim(strip_tags($value->SERTT91_NOMBRE))))
                    if(strlen(trim(strip_tags($value->SERTT91_NOMBRE)))>15)
                      echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_NOMBRE)),0,15)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_NOMBRE))."'></i></td>";
                    else
                      echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_NOMBRE))."</td>";
                  else
                    echo "<td class='text-left'></td>";

                  //TELEFONO              
                  if(!empty(trim(strip_tags($value->SERTT91_TELEFONO))))
                    if(strlen(trim(strip_tags($value->SERTT91_TELEFONO)))>15)
                      echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_TELEFONO)),0,15)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_TELEFONO))."'></i></td>";
                    else
                      echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_TELEFONO))."</td>";
                  else
                    echo "<td class='text-left'></td>";

                  //LOCALIDAD
                  if(!empty(trim(strip_tags($value->SERTT91_LOCALIDAD))))
                    if(strlen(trim(strip_tags($value->SERTT91_LOCALIDAD)))>20)
                      echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_LOCALIDAD)),0,20)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_LOCALIDAD))."'></i></td>";
                    else
                      echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_LOCALIDAD))."</td>";
                  else
                    echo "<td class='text-left'></td>";


                  //ESTADOS
                  $f_array = new FuncionesArray;
                  $class_estado = $f_array->buscarValor($allEstados,"1",$value->ESTADOS_DESCCI,"3");
                  echo "<td class='text-left'><span class='".$class_estado."'>".$value->ESTADOS_DESCCI."</span></td>";
                  

                  //OBSERVACIONES
                  if(!empty(trim(strip_tags($observaciones))))
                    if(strlen(trim(strip_tags($observaciones)))>25)
                      echo "<td class='text-left'>".substr(trim(strip_tags($observaciones)),0,25)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($observaciones))."'></i></td>";
                    else 
                      echo "<td class='text-left'>".trim(strip_tags($observaciones))."</td>";
                  else
                    echo "<td class='text-left'></td>";         
                  

                  echo "<td class='text-center'>
                          <a href='".$url_hist."' class='btn btn-default btn-xs'><b>Detalle</b></a>                      
                        </td>";                            

                echo "</tr>";

              }
            }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</div>      