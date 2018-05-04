<?php
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";     

  $url_action_asignar = PATH_VISTA.'Modulos/Importacion/action_cp_sinplaza.php';
  $url_action_eliminar = PATH_VISTA.'Modulos/Importacion/action_cp_sinplaza.php';

  $dFecha = new Fechas;

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());    
  $fcliente= (isset($_GET["fcliente"])?$_GET["fcliente"]:'');

  $handler = new HandlerImportacion;
  $arrImpoSinPlaza = $handler->selecionarImportacionTipo1SinPlaza($fdesde,$fhasta,$fcliente);

  $handlerSist = new HandlerSistema; 
  $arrCliente = $handlerSist->selectAllEmpresa();
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Importaciones sin plazas
      <small>Importaciones realizadas por los clientes sin plazas asignadas</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Importaciones sin Plaza</li>
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
                <div class="col-md-3" id='sandbox-container'>
                    <label>Fecha Desde - Hasta </label>                
                    <div class="input-daterange input-group" id="datepicker">
                      <input type="text" class="input-sm form-control" onchange="crearHref()" id="start" name="start" value="<?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y'); ?>"/>
                      <span class="input-group-addon">a</span>
                      <input type="text" class="input-sm form-control" onchange="crearHref()" id="end" name="end" value="<?php echo $dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?>"/>
                    </div>
                </div>
                <div class="col-md-3">
                  <label>Clientes </label>      
                  <select id="slt_cliente" class="form-control" style="width: 100%" name="slt_cliente" onchange="crearHref()">                              
                    <option value=''></option>
                    <option value='0'>TODOS</option>
                    <?php
                      if(!empty($arrCliente))
                      {                        
                        foreach ($arrCliente as $key => $value) {                                                  
                          if($fcliente==$value->EMPTT11_CODIGO)
                            echo "<option value='".trim($value->EMPTT11_CODIGO)."' selected>".$value->EMPTT21_NOMBREFA."</option>";
                          else
                            echo "<option value='".trim($value->EMPTT11_CODIGO)."'>".$value->EMPTT21_NOMBREFA."</option>";
                        }
                      }                      
                    ?>
                  </select>
                </div>    
                
                <div class='col-md-3 col-md-offset-3'>                
                  <label></label>                
                  <a class="btn btn-block btn-success" id="filtro_reporte" onclick="crearHref()"><i class='fa fa-filter'></i> Filtrar</a>
                </div>
              </div>
            </div>
        </div>
      </div>  

      <div class='col-md-12'>
        <div class="box box-solid">
            <div class="box-header with-border">    
              <i class="fa fa-edit"></i>
              <h3 class="box-title">Importaciones</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Fecha Visita</th>
                      <th>CP</th>
                      <th>Localidad</th>                      
                      <th style="width: 3%;" class='text-center'></th>
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrImpoSinPlaza))
                      {                             
                        foreach ($arrImpoSinPlaza as $key => $value) {
                        
                          echo "<tr>";
                            echo "<td>".$handlerSist->selectEmpresaById($value->getClienteTT())[0]->EMPTT21_NOMBREFA."</td>";
                            echo "<td>".$value->getFecha()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getCodPostal()."</td>";
                            echo "<td>".$value->getLocalidad()."</td>";
                            echo "<td class='text-center'>
                                    <a href='#' id='".$value->getId()."_asignar' class='btn btn-default btn-xs' data-toggle='modal' data-target='#modal-asignar' onclick='asignar(".$value->getId().")'>
                                      <i class='fa fa-hand-lizard-o' data-toggle='tooltip' data-original-title='Asignar registro'></i>
                                      Asignar Plaza
                                    </a>
                                  </td>";
                            echo "<td class='text-center'>
                                    <a href='#' id='".$value->getId()."_eliminar' data-toggle='modal' data-target='#modal-eliminar' class='btn btn-danger btn-xs' onclick='eliminar(".$value->getId().")'>
                                      <i class='fa fa-trash' data-toggle='tooltip' data-original-title='Eliminar registro'></i>
                                      Eliminar Registro
                                    </a>
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
    </div>
  </section>
</div>

<div class="modal fade in" id="modal-asignar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_asignar; ?>" method="post">
        <input type="hidden" name="id" id="id_asignar">
        <input type="hidden" name="estado" value="ASIGNAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">ASIGNAR PLAZA</h4>
        </div>
        <div class="modal-body">
            <p>Se reasignara la plaza al registro. ¿Desea continuar?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Asignar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade in" id="modal-eliminar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_eliminar; ?>" method="post">
        <input type="hidden" name="id" id="id_eliminar">
        <input type="hidden" name="estado" value="ELIMINAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">ELIMINAR</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <p>Se eliminará el regisro. ¿Desea continuar?</p>
                </div>                              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>

    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){                
    $("#mnu_importacion").addClass("active");
  }); 

  $(document).ready(function() {    
    $("#slt_cliente").select2({
        placeholder: "Seleccionar",                  
    });
  });    
</script>

<script type="text/javascript"> 
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
</script>

<script type="text/javascript">
  crearHref();
  function crearHref()
  {
      aStart = $("#start").val().split('/');
      aEnd = $("#end").val().split('/');

      f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
      f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                                 

      f_cliente = $("#slt_cliente").val();     
      
      url_filtro_reporte="index.php?view=importaciones_sin_plaza&fdesde="+f_inicio+"&fhasta="+f_fin  

      if(f_cliente!=undefined)
        if(f_cliente>0)
          url_filtro_reporte= url_filtro_reporte + "&fcliente="+f_cliente;
      
      
      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 
  function asignar(id){
    document.getElementById("id_asignar").value = id;
  }
  function eliminar(id){
    document.getElementById("id_eliminar").value = id;
  }    
</script>