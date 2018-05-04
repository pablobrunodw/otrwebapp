<?php
  include_once PATH_NEGOCIO."Sistema/handlerconsultas.class.php";  
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 

  include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php"; 
    
  $dFecha = new Fechas;

  $handlerSist = new HandlerSistema; 

  $handler = new HandlerSistema;
  $arrGestor = $handler->selectAllGestorFiltro(null,null,null,null,null);  

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());      
  $fgestor=(isset($_GET["fgestor"])?$_GET["fgestor"]:'');

  $handler =  new HandlerConsultas;
  $consulta = $handler->consultaPuntajes($fdesde, $fhasta, $fgestor);
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Puntajes
      <small>Puntajes de los gestores</small>
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

                <div class="col-md-3">
                  <label>Gestor </label>                
                  <select id="slt_gestor" class="form-control" style="width: 100%" name="slt_gestor" onchange="crearHref()">                              
                    <option value=''></option>
                    <option value='0'>TODOS</option>
                    <?php
                      if(!empty($arrGestor))
                      {                        
                        foreach ($arrGestor as $key => $value) {                                                  
                          if($fgestor==$value->GESTOR11_CODIGO)
                            echo "<option value='".trim($value->GESTOR11_CODIGO)."' selected>".$value->GESTOR21_ALIAS."</option>";
                          else
                            echo "<option value='".trim($value->GESTOR11_CODIGO)."'>".$value->GESTOR21_ALIAS."</option>";
                        }
                      }                      
                    ?>
                  </select>
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
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-percent"></i>       
            <h3 class="box-title">Puntajes</h3>          
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped table-condensed" id='tabla'>
              <thead>
                <tr>                  
                  <th>GESTOR</th>
                  <th>COORDINADOR</th>
                  <th>PLAZA</th>
                  <th>OBJETIVO</th>
                  <th>FECHA</th>                  
                  <th>EMPRESA</th>                  
                  <th>TOTAL SERVICIOS</th>                 
                  <th>CERRADAS</th>
                  <th>EFECTIVDAD</th>                 
                  <th>PUNTAJE</th>                                                                                   
                  <th>ENVIADAS</th>     
                  <th>PUNTAJE</th>     
                </tr>
              </thead>
              <tbody>
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
                        $objetivo = $handlerP->buscarObjetivo($value->COD_GESTOR);                        
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

                        if(!empty($value->NOM_COORDINADOR))
                          $objPlaza = $handlerSist->getPlazaByCordinador($value->NOM_COORDINADOR);
                        else
                          $objPlaza = "";

                        if(! is_null($objPlaza))
                          $plaza = $objPlaza[0]->PLAZA;   
                        else
                          $plaza = "" ;

                        echo "
                        <tr>                          
                          <td>".$value->NOM_GESTOR."</td>
                          <td>".$value->NOM_COORDINADOR."</td>
                          <td>".$plaza."</td>                          
                          <td style='background:#00800080;'>".$objetivo."</td>
                          <td>".$value->FECHA->format('d M')."</td>                            
                          <td>".$value->NOM_EMPRESA."</td>      
                          <td style='background:#ff000080;'>".$value->TOTAL_SERVICIOS."</td>
                          <td style='background:#0000ff80;'>".$value->CERRADO."</td>
                          <td style='background:#0000ff80;'>".$efectividad." %</td>
                          <td style='background:#0000ff80;'>".$puntaje_cerrados."</td>                          
                          <td style='background:#ffa50080;'>".$value->ENVIADO."</td>                          
                          <td style='background:#ffa50080;'>".$puntaje_enviadas."</td>                          
                        </tr>";


                        $total_servicios = $total_servicios + $value->TOTAL_SERVICIOS;
                        $total_servicios_cerrados = $total_servicios_cerrados + $value->CERRADO;
                        $total_puntajes_cerrados = $total_puntajes_cerrados + $puntaje_cerrados;                        

                        $total_servicios_enviadas = $total_servicios_enviadas + $value->ENVIADO;
                        $total_puntajes_enviadas = $total_puntajes_enviadas + $puntaje_enviadas;                        
                      }
                    }

                    if(!empty($total_servicios))
                      $total_efectividad = round($total_servicios_cerrados/$total_servicios,2)*100;
                    else
                      $total_efectividad = 0;                    
                  ?>
                  <tr style="font-weight: bold;">

                    <td style="background: #9e9e9e; font-size: 17px; color: white;" >TOTAL</td>
                    <td style="background: #008000; font-size: 17px; color: white;"><?php echo $objetivo; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="background: #ff0000; font-size: 17px; color: white;"><?php echo $total_servicios; ?></td>
                    <td style="background: #0000ff; font-size: 17px; color: white;"><?php echo $total_servicios_cerrados; ?></td>
                    <td style="background: #0000ff; font-size: 17px; color: white;"><?php echo $total_efectividad; ?> %</td>
                    <td style="background: #0000ff; font-size: 17px; color: white;"><?php echo $total_puntajes_cerrados; ?></td>
                    <td style="background: #ffa500; font-size: 17px; color: white;"><?php echo $total_servicios_enviadas; ?></td>
                    <td style="background: #ffa500; font-size: 17px; color: white;"><?php echo $total_puntajes_enviadas; ?></td>                                        
                  </tr>          

              </tbody>
            </table>
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

  $(document).ready(function() {
    $("#slt_gestor").select2({
        placeholder: "Seleccionar un Gestor",                  
    }); 
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
      f_gestor = $("#slt_gestor").val();     
      
      url_filtro_reporte="index.php?view=puntajes_general_detalle&fdesde="+f_inicio+"&fhasta="+f_fin

      if(f_gestor!=undefined)
        if(f_gestor>0)
          url_filtro_reporte= url_filtro_reporte + "&fgestor="+f_gestor   

      $("#filtro_reporte").attr("href", url_filtro_reporte);
  }     
</script>