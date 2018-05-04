<?php
  include_once PATH_NEGOCIO."Modulos/handlertickets.class.php";       
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";        

  $dFecha = new Fechas;

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());    
  $fusuario= (isset($_GET["fusuario"])?$_GET["fusuario"]:'');

  $handler = new HandlerTickets;  
  $consulta = $handler->seleccionarByFiltros($fdesde,$fhasta,$fusuario);

  $handlerUsuarios = new HandlerUsuarios;
  $arrUsuarios = $handlerUsuarios->selectByPerfil("GESTOR");

  $url_action_enviar = PATH_VISTA.'Modulos/Ticket/action_enviar.php?id=';  
  $url_action_noenviar = PATH_VISTA.'Modulos/Ticket/action_noenviar.php?id=';  
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Ticket
      <small>Gastos ocacionados por Gestor en los servicios</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ticket</li>
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
              <i class="fa fa-ticket"></i>  
              <h3 class="box-title">Ticket</h3>
            </div>
            <div class="box-body  table-responsive">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>USUARIO</th>
                      <th>FECHA HORA</th>
                      <th>DOCUMENTO</th>
                      <th>RAZON SOCIAL</th>
                      <th>CUIT</th>
                      <th>DOMICILIO</th>
                      <th>COND.FISCAL</th>
                      <th>CONCEPTO</th>
                      <th>IMPORTE</th>                      
                      <th>REINTEGRO</th>                      
                      <th>ALEDAÑOS</th>                      
                      <th>OPERACIONES</th>                      
                      <th>ENVIADO</th>
                      <th>APROBADO</th>
                      <th>ADJUNTO</th>                  
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($consulta))
                      {
                        foreach ($consulta as $key => $value) {

                          if($value->getEnviado())
                            $class_estilos_enviado = "<span class='label label-success'>ENVIADO</span>";
                          else
                            $class_estilos_enviado = "<span class='label label-danger'>NO ENVIADO</span>";

                          if($value->getAprobado())
                            $class_estilos_aprobado = "<span class='label label-success'>APROBADO</span>";
                          else
                            $class_estilos_aprobado = "<span class='label label-danger'>NO APROBADO</span>";

                          if($value->getAledanio())
                            $class_estilos_aledanio = "<span class='label label-success'>SI</span>";
                          else
                            $class_estilos_aledanio = "<span class='label label-danger'>NO</span>";                          

                          echo "<tr>";                            
                            echo "<td>".$value->getUsuarioId()->getApellido()." ".$value->getUsuarioId()->getNombre()."</td>";
                            echo "<td>".$value->getFechaHora()->format('d/m/Y h:s')."</td>";
                            echo "<td>".$value->getTipo()."   ".$value->getPuntoVenta()."-".$value->getNumero()."</td>";
                            echo "<td>".$value->getRazonSocial()."</td>";
                            echo "<td>".$value->getCuit()."</td>";
                            echo "<td>".$value->getDomicilio()."</td>";
                            echo "<td>".$value->getCondFiscal()."</td>";
                            echo "<td>".$value->getConcepto()."</td>";                            
                            echo "<td>$ ".round($value->getImporte(),2)."</td>";                          
                            echo "<td>$ ".round($value->getImporteReintegro(),2)."</td>";
                            echo "<td>".$class_estilos_aledanio."</td>";
                            echo "<td>".round($value->getCantOperaciones(),0)."</td>";                            
                            echo "<td>".$class_estilos_enviado."</td>";
                            echo "<td>".$class_estilos_aprobado."</td>";
                            echo "<td><a href='".$value->getAdjunto()."' target='_blank'>VER</a></td>";                       
                          
                            $countServicios = "0";
                            $estiloContServicios = "true";
                            if($value->getUsuarioId()->getUsuarioPerfil()->getNombre()=="GESTOR")
                            {                              
                              if($value->getUsuarioId()->getTipoUsuario()->getNombre()=="Gestor")
                              {
                                $handlerSistema = new HandlerSistema; 
                                $fFiltro = $value->getFechaHora()->format("Y-m-d"); 
                                $countServicios = $handlerSistema->selectCountServicios($fFiltro,$fFiltro,null,null,$value->getUsuarioId()->getUserSistema(),null,null,null)[0]->CANTIDAD_SERVICIOS;                                
                                $estiloContServicios = "true";
                              }
                              else
                              {
                                $countServicios = "0";
                                $estiloContServicios = "true";
                              }
                            }
                            else
                            {
                              $countServicios = "0";
                              $estiloContServicios = "true";
                            }
                            
                            if(!$value->getEnviado()){
                              echo "<td class='text-center'>
                                      <button 
                                        id='boton_enviar_".$value->getId()."'                                             
                                        type='button' 
                                        style='width:100%;'
                                        class='btn btn-default btn-xs' 
                                        data-toggle='modal' 
                                        data-target='#modal-enviar' 
                                        data-reintegro='".round($value->getImporteReintegro(),2)."' 
                                        data-aledanio='".$value->getAledanio()."' 
                                        data-cant_operaciones='".round($countServicios,2)."'     
                                        data-estilo_cant_operaciones='".$estiloContServicios."',                             
                                        onclick=btnEnviar(".$value->getId().")>
                                          <i class='fa fa-send' data-toggle='tooltip' data-original-title='Enviar registro'></i>
                                          Enviar
                                      </button>
                                    </td>";
                            }
                            else
                            {
                              echo "<td class='text-center'>
                                    <a href='".$url_action_noenviar.$value->getId()."' class='btn btn-danger btn-xs'>
                                      <i class='fa fa-times' data-toggle='tooltip' data-original-title='Deshace Envio'></i>
                                      Deshace Envio
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

<div class="modal fade in" id="modal-enviar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="formEnviar" action="<?php echo $url_action_enviar; ?>" method="post">
        <input type="hidden" name="id" id="id" value=""> 

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Enviar</h4>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="callout callout-info">
                  <h4>Envio de Ticket</h4>
                  <p id="mensaje_envio">Se enviará el ticket para aprobación.</p>
                </div>                
              </div>
              <div class="col-md-4">
                <label>Importe Reintegro</label>
                <input type="number" name="reintegro" class="form-control" step="0.01"  required="">
              </div>              
              <div class="col-md-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="aledanio" style="margin-top: 20px;"> Tiene Aledaño
                  </label>
                </div>
              </div>   
              <div class="col-md-4">
                <label>Cantidad Operaciones</label>
                <input id="input_cant_operaciones" type="number" name="operaciones" class="form-control" step="0.01"  required="">
              </div> 
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){                
    $("#mnu_tickets").addClass("active");
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

      f_usuario = $("#slt_usuario").val();     
      
      url_filtro_reporte="index.php?view=tickets_control&fdesde="+f_inicio+"&fhasta="+f_fin  

      if(f_usuario!=undefined)
        if(f_usuario>0)
          url_filtro_reporte= url_filtro_reporte + "&fusuario="+f_usuario;
      
      
      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 
</script>


<script type="text/javascript">
    function btnEnviar(id_registro)
    {
        var id= id_registro;        
    
        var elemento = document.querySelector('#boton_enviar_'+id);        
        formEnviar.id.value = id;   

        var reintegro= elemento.getAttribute('data-reintegro');     
        var aledanio = elemento.getAttribute('data-aledanio');     
        var cant_operaciones = elemento.getAttribute('data-cant_operaciones');     
        var estilo_cant_operaciones = elemento.getAttribute('data-estilo_cant_operaciones');     

        if(estilo_cant_operaciones=="true")
          $("#input_cant_operaciones").attr("readonly",true);        

        formEnviar.reintegro.value = reintegro;

        if(aledanio==true)
          formEnviar.aledanio.checked = true;
        else
          formEnviar.aledanio.checked = false;

        formEnviar.operaciones.value = cant_operaciones;   

        //var mensaje_envio="<p>Esta a punto de enviar el ticket<br>¿Desea Continuar?</p>";
        //document.getElementById('mensaje_envio').innerHTML = mensaje_envio;      
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