<?php        
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";     
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";     
  include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';     

  $guardar_importacion = PATH_VISTA.'Modulos/Importacion/action_guardar.php';   
  $delete_file = PATH_VISTA.'Modulos/Importacion/action_delete_importacion.php';   

  $view_detalle = "?view=importacion_detalle&importacion_id=";

  $handler = new HandlerImportacion;  
  $objTipoImpo = $handler->ConfiguracionByEmpresa($usuarioActivoSesion->getUserSistema());
  
  $arrImportacion =$handler->listarImportacionByEmpresa($usuarioActivoSesion->getUserSistema());  

  $handlerSist = new HandlerSistema; 
  $arrPlaza = $handlerSist->selectAllPlazas();

  $fechas= new Fechas;

?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Carga Simple
      <small>Carga de servicio simple</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Carga</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>
  
    <div class="row">      

      <div class="col-md-12">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Carga</h3>
            </div>        

            <form action="<?php echo $guardar_importacion; ?>" method="POST">

              <input type="hidden" name="fecha_importacion" value="<?php echo $fechas->FechaActual(); ?>">
              <input type="hidden" name="fecha_hora" value="<?php echo $fechas->FechaHoraActual(); ?>">
              <input type="hidden" name="tipo_importacion" value="3">
              <input type='hidden' name="id_empresa_sistema" value='<?php echo $usuarioActivoSesion->getUserSistema(); ?>'>
              <input type="hidden" name="plaza" value="-">
              <input type="hidden" name="rows" value="2">
              <input type="hidden" name="cols" value="21">
              <input type="hidden" name="forms" value="importacion_manual">

              <div class="box-body">                
                <div class='row'>
                                
                  <div class="col-md-6">
                    <label>FECHA VTA</label>                    
                    <input id='fecha' type='date' class='form-control' name='1_0' required="">
                  </div>
                  
                  <div class="col-md-6">
                    <label>FECHA VISITA</label>
                    <input id='fecha_visita' type='date' class='form-control' name='1_1' required="">
                  </div>
                  
                  <div class="col-md-6">
                    <label>TIPO DOC</label>
                    <select id='tipo_doc' class='form-control' name='1_2' required="">
                      <option value=""></option>
                      <option value="96">DNI</option>
                      <option value="80">CUIT</option>
                    </select>
                  </div>
                  
                  <div class="col-md-6">
                    <label>NRO DOC</label>
                    <input id='nro_doc' type='number' step='1' class='form-control' name='1_3' required="">
                  </div>
                  
                  <div class="col-md-6">
                    <label>APELLIDO</label>
                    <input id='apellido' type='text' maxlength='100' class='form-control' name='1_4' required="">
                  </div>
                  
                  <div class="col-md-6">
                    <label>NOMBRE</label>
                    <input id='nombre' type='text' maxlength='100' class='form-control' name='1_5' required="">
                  </div>
                  
                  <div class="col-md-3">
                    <label>CALLE</label>
                    <input id='calle' type='text' maxlength='100' class='form-control' name='1_6' required="">
                  </div>
                  
                  <div class="col-md-3">
                    <label>NUMERO</label>
                    <input id='numero' type='number' step='1' class='form-control' name='1_7' required="">
                  </div>
                  
                  <div class="col-md-3">
                    <label>PISO</label>
                    <input id='piso' type='number' step='1' class='form-control' name='1_8'>
                  </div>
                  
                  <div class="col-md-3">
                    <label>DPTO</label>
                    <input id='dpto' type='text' maxlength='2' class='form-control' name='1_9'>
                  </div>
                  
                  <div class="col-md-9">
                    <label>LOCALIDAD</label>
                    <input id='localidad' type='text' maxlength='100' class='form-control' name='1_10' required="">
                  </div>
                  
                  <div class="col-md-3">
                    <label>CODIGO POSTAL</label>
                    <input id='codigo_postal' type='number' step='1' min='1000' max='9999' required class='form-control' name='1_11' required="">
                  </div>
                  
                  <div class="col-md-6">
                    <label>TELEFONO</label>
                    <input id='telefono' type='text' maxlength='50' class='form-control' name='1_12' required="">
                  </div>

                  <div class="col-md-6">
                    <label>TELEFONO ALTERNATIVO</label>
                    <input id='telefono_alt' type='text' maxlength='50' class='form-control' name='1_13'>
                  </div> 
                  
                  <div class="col-md-6">
                    <label>EMAIL</label>
                    <input id='email' type='email' class='form-control' name='1_14'>
                  </div>

                  <!-- HORARIO -->
                  <input id='horario' type='hidden' name='1_15'>

                  <div class="col-md-3">
                    <label>HORA DESDE</label>
                    <input id='horario_desde' type='time' class='form-control' required="" name="horario_desde">
                  </div>                           

                  <div class="col-md-3">
                    <label>HORA HASTA</label>
                    <input id='horario_hasta' type='time' class='form-control' required="" name="horario_hasta">
                  </div>             

                  <div class="col-md-12">
                    <label>IMP RENDIR</label>
                    <input id='imp_rendir' type='text' maxlength='10' class='form-control' name='1_16'>
                  </div>

                  <div class="col-md-12">
                    <label>PRODUCTO</label>
                    <input id='producto' type='text' maxlength='150' class='form-control' name='1_17' required="">
                  </div>                           

                  <div class="col-md-12">
                    <label>REPROCESO</label>
                    <input id='reproceso' type='text' maxlength='10' class='form-control' name='1_18'>
                  </div>                           

                  <div class="col-md-12">
                    <label>OBSERVACION</label>
                    <input id='observacion' type='text' maxlength='150' class='form-control' name='1_19'>
                  </div>                           

                  <div class="col-md-12">
                    <label>DOCUMENTACION A PEDIR</label>
                    <input id='doc_a_pedir' type='text' maxlength='100' class='form-control' name='1_20'>
                  </div>

                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Guardar</button>
              </div>
            </form>                    

          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-list"></i>
              <h3 class="box-title">Importaciones realizadas</h3>          
            </div>
            
            <div class="box-body table-responsive">         
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                <thead>
                  <tr>       
                    <th class='text-center'>Fecha</th>                  
                    <th class='text-center'>Plaza</th>                  
                    <th class='text-center'>Estado</th>
                    <th class='text-center'>Enviados</th>
                    <th class='text-center'>Aprobados</th>
                    <th class='text-center'></th>
                    <th class='text-center'></th>
                  </tr>
                </thead>
                <tbody>
                  <?php                    

                    if(!empty($arrImportacion)){                      
                      foreach ($arrImportacion as $key => $value) {                                                                     
                        
                        $datos = $value->selectDetalle();
                        $countRegistros = count($datos);
                        $countAprobados = $value->countAprobados();

                        if($countRegistros==0 && $countAprobados==0) 
                          $importadoTT = "<span class='label label-info'>REVISION DE PLAZAS</span>";

                        if($countRegistros>0 && $countAprobados==0) 
                          $importadoTT = "<span class='label label-danger'>PENDIENTES</span>";
                            
                        if($countAprobados>0 && $countAprobados<$countRegistros) 
                          $importadoTT = "<span class='label label-warning'>REVISION DE FECHAS Y PLAZAS</span>";

                        if($countAprobados==$countRegistros && $countRegistros>0) 
                          $importadoTT = "<span class='label label-success'>APROBADO</span>";

                        $obj = $handlerSist->getPlazaByCordinador($value->getPlaza());
                        if(is_null($obj))
                          $nombre_plaza = "";
                        else
                          $nombre_plaza = $obj[0]->PLAZA;


                        echo "
                          <tr>
                            <td class='text-center'>".$value->getFecha()->format('d/m/Y')."</td>
                            <td class='text-center'>".$nombre_plaza."</td>
                            <td class='text-center'>".$importadoTT."</td>
                            <td class='text-center' style='font-size:15px;'><b>".$countRegistros."</b></td>                            
                            <td class='text-center' style='font-size:15px;'><b>".$countAprobados."</b></td>                            
                            <td class='text-center'>
                              <a href=".$view_detalle.$value->getId()." class='btn btn-default btn-xs'>Detalle</a>
                            </td>
                            <td class='text-center'>                              
                              <button                                                                           
                                type='button' 
                                class='btn btn-danger btn-xs' 
                                data-toggle='modal' 
                                data-target='#modalEliminar' 
                                onclick=btnEliminar(".$value->getId().")><i class='fa fa-trash'></i> Eliminar
                              </button>
                            </td>                            
                          </tr>";                                                
                        
                      }
                    }
                    else{
                      echo
                        "<tr>
                          <td colspan='4' class='text-center'><p><i>No se encontraron importaciones previas</i></p></td>
                        </tr>";
                    }                    
                  ?>
                </tbody>
              </table>
            </div>         
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal modal-danger fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Importación</h4>
      </div>

      <div class="modal-body">
          <div id="mensaje_eliminar">Se eliminará la importación del sistema</div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
        <a id="eliminarImportacion" href="#" class="btn btn-outline">Eliminar</a>
      </div>                                      
      
    </div>
  </div>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_importacion").addClass("active");
  });

  $('#date').datepicker({
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

  function btnEliminar(id_importacion)
  {
      var id= id_importacion;        
      
      link_delete = "<?php echo $delete_file; ?>";


      $("#eliminarImportacion").attr({'href': link_delete+'?id='+id_importacion});
  }

  $(document).ready(function() {
    $("#slt_plaza").select2({
        placeholder: "Seleccionar",                  
    });
  });  

</script>