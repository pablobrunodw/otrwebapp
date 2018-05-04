<?php        
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";     
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";     
  include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';     

  $subir_file = PATH_VISTA.'Modulos/Importacion/action_importar_file.php';   
  $delete_file = PATH_VISTA.'Modulos/Importacion/action_delete_importacion.php';   

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
      Importación de Servicios
      <small>Selección del tipo de importación</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Importación</li>
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
              <h3 class="box-title">Importación</h3>
            </div>        

            <form enctype="multipart/form-data" action="<?php echo $subir_file; ?>" method="POST">
              <input type="hidden" name="email" value="<?php echo $usuarioActivoSesion->getEmail(); ?>">
              <input type='hidden' name="tipo_importacion" value='<?php echo $objTipoImpo->getIdTipoImportacion()->getId(); ?>'>            
              <input type='hidden' name="id_empresa_sistema" value='<?php echo $usuarioActivoSesion->getUserSistema(); ?>'>            

              <div class="box-body">                
                <div class='row'>
                  <div class='col-md-3'>
                    <label for="exampleFecha">Fecha</label>
                    <div class="input-group date" id='date'>
                      <input type="text" class="form-control" name='fecha_importacion' value="<?php echo $fechas->FormatearFechas($fechas->FechaActual(),'Y-m-d','d/m/Y'); ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                  </div>  

                  
                  <?php 

                    if(!empty($objTipoImpo)){
                      if(!empty($objTipoImpo->getIdTipoImportacion()->getId()<>3)){
                   
                  ?>
                      <div class='col-md-3'>
                        <label for="examplePlaza">Plaza</label>
                        
                        <select id="slt_plaza" class="form-control" style="width: 100%" name="plaza">                              
                            <option value=''></option>
                            <option value='0'>TODAS</option>
                            <?php
                              if(!empty($arrPlaza))
                              {                        
                                foreach ($arrPlaza as $key => $value) {                                                                                  
                                    echo "<option value='".trim($value->ALIAS)."'>".$value->PLAZA."</option>";
                                }
                              }                      
                            ?>
                        </select>   
                      </div>                   
                   <?php 
                      }
                    } 
                  ?>
                  

                  <div class='col-md-6'>
                    <div class="form-group">
                      <label for="exampleInputFile">Archivo a Importar</label>
                      <input type="file" name="archivo" accept=".xls, .xlsx">
                      <p class="help-block">Seleccione un archivo en formato .xls o .xlsx</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Enviar fichero</button>
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
                    <th class='text-center'>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                    

                    if(!empty($arrImportacion)){                      
                      foreach ($arrImportacion as $key => $value) {                                                                     
                        
                        $datos = $value->selectDetalle();
                        $countRegistros = count($datos);
                        $countAprobados = $value->countAprobados();

                        if($countAprobados==0) 
                          $importadoTT = "<span class='label label-danger'>SIN APROBAR</span>";
                            
                        if($countAprobados>0 && $countAprobados<$countRegistros) 
                          $importadoTT = "<span class='label label-warning'>SINCRONIZANDO</span>";

                        if($countAprobados==$countRegistros) 
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
                              <button                                                                           
                                type='button' class='btn btn-default btn-xs' 
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