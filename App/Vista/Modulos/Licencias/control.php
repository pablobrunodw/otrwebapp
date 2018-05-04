<?php
  include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php";    
  include_once PATH_NEGOCIO."Sistema/handlerconsultascontrol.class.php";    
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         

  $dFecha = new Fechas;

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());    
  $fusuario= (isset($_GET["fusuario"])?$_GET["fusuario"]:'');

  $handler = new HandlerLicencias;  
  $arrLicencias = $handler->seleccionarByFiltros($fdesde,$fhasta,$fusuario);

  $handlerUsuarios = new HandlerUsuarios;
  $arrUsuarios = $handlerUsuarios->selectByPerfil("GESTOR");

  $url_action_aprobar = PATH_VISTA.'Modulos/Licencias/action_aprobar.php?id=';  
  $url_action_desaprobar = PATH_VISTA.'Modulos/Licencias/action_desaprobar.php?id=';  
  $url_action_imprimir = 'index.php?view=licencias_imprimir&id=';
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Licencias
      <small>Licencias solicitadas por el gestor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Licencias</li>
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
                  <label>Usuarios </label>                
                  <select id="slt_usuario" class="form-control" style="width: 100%" name="slt_usuario" onchange="crearHref()">
                    <option value=''></option>
                    <option value='0'>TODOS</option>
                    <?php
                      if(!empty($arrUsuarios))
                      {                     
                                        
                        foreach ($arrUsuarios as $key => $value) {                      

                          if($fusuario == $value->getId())
                            echo "<option value='".$value->getId()."' selected>".$value->getNombre()."</option>";
                          else
                            echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";                  
                            
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
              <i class="fa fa-certificate"></i>       
              <h3 class="box-title">Licencias</h3>   
            </div>
            <div class="box-body table-responsive">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>USUARIO</th>
                      <th>FECHA</th>
                      <th>TIPO LICENCIA</th>
                      <th>DESDE</th>
                      <th>HASTA</th>
                      <th>OBSERVACIONES</th>
                      <th>ADJUNTO 1</th>
                      <th>ADJUNTO 2</th>
                      <th>APROBADO</th>
                      <th style="width: 3%;" class='text-center'></th>
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrLicencias))
                      {
                        foreach ($arrLicencias as $key => $value) {
                          
                          if($value->getAprobado()==0)
                            $estado = "<span class='label label-danger'>NO APROBADO</span>";
                          else
                            $estado = "<span class='label label-success'>APROBADO</span>";

                          echo "<tr>";
                            echo "<td>".$value->getUsuarioId()->getApellido()." ".$value->getUsuarioId()->getNombre()."</td>";
                            echo "<td>".$value->getFecha()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getTipoLicenciasId()->getNombre()."</td>";
                            echo "<td>".$value->getFechaInicio()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getFechaFin()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getObservaciones()."</td>";

                            if(!empty($value->getAdjunto1()))
                              echo "<td><a href='".$value->getAdjunto1()."' target='_blank'>VER ADJUNTO</a></td>";
                            else
                              echo "<td></td>";

                            if(!empty($value->getAdjunto2()))
                              echo "<td><a href='".$value->getAdjunto2()."' target='_blank'>VER ADJUNTO</a></td>";
                            else
                              echo "<td></td>";

                            echo "<td>".$estado."</td>";

                            if(!$value->getAprobado()){
                              echo "<td class='text-center'>
                                      <a href='".$url_action_aprobar.$value->getId()."' class='btn btn-default btn-xs'>
                                        <i class='fa fa-send' data-toggle='tooltip' data-original-title='Aprobar Licencia'></i>
                                        Aprobar Licencia
                                      </a>
                                    </td>";
                            }
                            else
                            {
                              echo "<td class='text-center'>
                                    <a href='".$url_action_desaprobar.$value->getId()."' class='btn btn-danger btn-xs'>
                                      <i class='fa fa-times' data-toggle='tooltip' data-original-title='Desaprobar Licencia'></i>
                                      Desaprobar Licencia
                                    </a>
                                  </td>";                                  
                            } 

                            if($value->getAprobado()){
                              echo "<td class='text-center'>
                                      <a href='".$url_action_imprimir.$value->getId()."' class='btn btn-default btn-xs'>
                                        <i class='fa fa-print' data-toggle='tooltip' data-original-title='Imprimir'></i>
                                        Imprimir
                                      </a>
                                    </td>";
                            }                            
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

<div class="modal fade in" id="modal-nuevo">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_guardar_licencias; ?>" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
            <div class="row">             
              <div class="col-md-6">
                <label>Tipo Licencia</label>
                <select name="" class="form-control"></select>
              </div>              
              <div class="col-md-6">
                <label>Fecha Inicio</label>
                <input type="date" name="" class="form-control">
              </div>                               
              <div class="col-md-12">
                <label>Adjunto</label>
                <textarea class="form-control"></textarea>
              </div>  
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade in" id="modal-editar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_editar_tipo; ?>" method="post">
        <input type="hidden" name="id" id="id_tipo_edicion">
        <input type="hidden" name="estado" value="EDITAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Editar</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label>Fecha Hora</label>
              <input type="date" name="" class="form-control">
            </div>              
            <div class="col-md-2">
              <label>P. Venta</label>
              <input type="text" name="" class="form-control">
            </div>              
            <div class="col-md-4">
              <label>Numero</label>
              <input type="text" name="" class="form-control">
            </div>               
            <div class="col-md-6">
              <label>Razon Social</label>
              <input type="text" name="" class="form-control">
            </div>
            <div class="col-md-6">
              <label>CUIT</label>
              <input type="text" name="" class="form-control">
            </div>  
            <div class="col-md-6">
              <label>IIBB</label>
              <input type="text" name="" class="form-control">
            </div>       
            <div class="col-md-6">
              <label>Domicilio</label>
              <input type="text" name="" class="form-control">
            </div>  
            <div class="col-md-6">
              <label>Condición Fiscal</label>
              <select class="form-control">
                <option>RESPONSABLE INSCRIPTO</option>
                <option>MONOTRIBUTISTA</option>
                <option>EXCENTO</option>
                <option>CONSUMIDOR FINAL</option>
              </select>
            </div>                                                                   
            <div class="col-md-6">
              <label>Importe</label>
              <input type="text" name="" class="form-control">
            </div>   
            <div class="col-md-12">
              <label>Adjunto</label>
              <input type="file" name="" class="form-control">
            </div>  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

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

      f_usuario = $("#slt_usuario").val();     
      
      url_filtro_reporte="index.php?view=licencias_control&fdesde="+f_inicio+"&fhasta="+f_fin  

      if(f_usuario!=undefined)
        if(f_usuario>0)
          url_filtro_reporte= url_filtro_reporte + "&fusuario="+f_usuario;
      
      
      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 

  $(document).ready(function() {
        $('#tabla').DataTable({
          "dom": 'Bfrtip',
          "buttons": ['copy', 'csv', 'excel', 'print'],
          "iDisplayLength":100,
          "language": {
              "sProcessing":    "Procesando...",
              "sLengthMenu":    "Mostrar _MENU_ registros",
              "sZeroRecords":   "No se encontraron resultados",
              "sEmptyTable":    "Ningún dato disponible en esta tabla",
              "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":   "",
              "sSearch":        "Buscar:",
              "sUrl":           "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":    "Último",
                  "sNext":    "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
        });
    });
</script>