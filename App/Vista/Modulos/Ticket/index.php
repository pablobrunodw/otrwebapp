<?php
  include_once PATH_NEGOCIO."Modulos/handlertickets.class.php";       
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";        

  $dFecha = new Fechas;

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());    
  $fusuario= $usuarioActivoSesion->getId();

  $handler = new HandlerTickets;  
  $consulta = $handler->seleccionarByFiltros($fdesde,$fhasta,$fusuario);

  $arrConceptos = $handler->selecionarConceptos();

  $url_action_guardar = PATH_VISTA.'Modulos/Ticket/action_guardar.php';
  $url_action_eliminar = PATH_VISTA.'Modulos/Ticket/action_eliminar.php?id=';
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

                <div class='col-md-3 col-md-offset-6'>                
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
              <a href="#" class="btn btn-success pull-right" data-toggle='modal' data-target='#modal-nuevo'>
                  Nuevo
              </a>
            </div>
            <div class="box-body table-responsive">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>FECHA HORA</th>
                      <th>DOCUMENTO</th>
                      <th>RAZON SOCIAL</th>
                      <th>CUIT</th>                      
                      <th>DOMICILIO</th>
                      <th>COND.FISCAL</th>
                      <th>CONCEPTO</th>
                      <th>IMPORTE</th>                      
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

                          echo "<tr>";                            
                            echo "<td>".$value->getFechaHora()->format('d/m/Y H:i')."</td>";
                            echo "<td>".$value->getTipo()."   ".$value->getPuntoVenta()."-".$value->getNumero()."</td>";
                            echo "<td>".$value->getRazonSocial()."</td>";
                            echo "<td>".$value->getCuit()."</td>";                            
                            echo "<td>".$value->getDomicilio()."</td>";
                            echo "<td>".$value->getCondFiscal()."</td>";
                            echo "<td>".$value->getConcepto()."</td>";                          
                            echo "<td>$ ".round($value->getImporte(),2)."</td>";                          
                            echo "<td>".$class_estilos_enviado."</td>";
                            echo "<td>".$class_estilos_aprobado."</td>";
                            echo "<td><a href='".$value->getAdjunto()."' target='_blank'>VER</a></td>";
                            echo "<td class='text-center'>
                                    <a href='".$url_action_eliminar.$value->getId()."' class='btn btn-danger btn-xs'>
                                      <i class='fa fa-trash' data-toggle='tooltip' data-original-title='Eliminar registro'></i>
                                      Eliminar
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

<div class="modal fade in" id="modal-nuevo">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_guardar; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="usuario" value="<?php echo $fusuario; ?>">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-5">
                <label>Fecha Hora</label>
                <input type="datetime-local" name="fecha_hora" class="form-control" required="">
              </div>                            
              <div class="col-md-3">
                <label>Tipo Comprobante</label>
                <select class="form-control" name="tipo"  required="">
                  <option value="FACTURA B">FACTURA B</option>
                  <option value="TICKET FACTURA">TICKET FACTURA</option>                  
                </select>
              </div>
              <div class="col-md-2">
                <label>Punto Vta</label>
                <input type="number" name="punto_venta" class="form-control"  required="">
              </div>              
              <div class="col-md-2">
                <label>Numero</label>
                <input type="number" name="numero" class="form-control"  required="">
              </div>               
              <div class="col-md-6">
                <label>Razon Social</label>
                <input type="text" name="razon_social" class="form-control"  required="">
              </div>
              <div class="col-md-6">
                <label>CUIT</label>
                <input type="text" name="cuit" class="form-control"  required="">
              </div>  
              <div class="col-md-6">
                <label>Domicilio</label>
                <input type="text" name="domicilio" class="form-control"  required="">
              </div>  
              <div class="col-md-6">
                <label>Condición Fiscal</label>
                <select class="form-control" name="condicion_fiscal"  required="">
                  <option value="RESPONSABLE INSCRIPTO">RESPONSABLE INSCRIPTO</option>
                  <option value="MONOTRIBUTISTA">MONOTRIBUTISTA</option>
                  <option value="EXCENTO">EXCENTO</option>
                  <option value="CONSUMIDOR FINAL">CONSUMIDOR FINAL</option>
                </select>
              </div>  

              <div class="col-md-6">
                <label>Concepto</label>
                <select class="form-control" name="concepto" required="">
                  <option value=""></option>     
                  <?php if(!empty($arrConceptos)) { ?>
                    <?php foreach ($arrConceptos as $key => $value) { ?>
                      <option value="<?php echo $value->getNombre(); ?>"><?php echo $value->getNombre(); ?></option>
                    <?php } ?>                  
                  <?php } ?>
                </select>
              </div>           

              <div class="col-md-6">
                <label>Importe</label>
                <input type="number" name="importe" class="form-control" step="0.01"  required="">
              </div>   
              <div class="col-md-12">
                <label>Adjunto</label>
                <input type="file" name="adjunto" class="form-control"  required="">
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

      //f_usuario = $("#slt_usuario").val();     
      
      url_filtro_reporte="index.php?view=tickets_carga&fdesde="+f_inicio+"&fhasta="+f_fin  

      /*if(f_usuario!=undefined)
        if(f_usuario>0)
          url_filtro_reporte= url_filtro_reporte + "&fusuario="+f_usuario;
      */
      
      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 
</script>