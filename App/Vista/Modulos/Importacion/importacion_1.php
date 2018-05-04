<?php        
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";          
  include_once PATH_NEGOCIO.'Funciones/Excel/PHPExcel/IOFactory.php';
  
  $nombre = (isset($_GET['excel'])? $_GET['excel']:'');
  $id_empresa_sistema = (isset($_GET['id_empresa_sistema'])? $_GET['id_empresa_sistema']:'');
  $fecha_importacion = (isset($_GET['fecha_importacion'])? $_GET['fecha_importacion']:'');
  $plaza = (isset($_GET['plaza'])? $_GET['plaza']:'');

  $action_guardar = PATH_VISTA.'Modulos/Importacion/action_guardar.php';   

  $handler = new HandlerImportacion;  
  $objTipoImportacion = $handler->TipoImportacionById(1);
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Importación de Servicios
      <small>Importación <?php echo $objTipoImportacion->getNombre(); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li>Importación</li>
      <li class="active"><?php echo $objTipoImportacion->getNombre(); ?></li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>
  
    <div class="row">

      <div class="col-md-12">
        <form method="POST" action="<?php echo $action_guardar; ?>">
        
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-file-excel-o"></i> Datos Excel</h3>
              <a data-toggle='modal' data-target='#modalGuardar' class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar</a>
            </div>
            
            <div class="box-body table-responsive" style="height:500px;">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>TIPO DOC</th>
                    <th>NRO DOC</th>
                    <th>APELLIDO</th>
                    <th>NOMBRE</th>
                    <th>CALLE</th>
                    <th>NUMERO</th>
                    <th>PISO</th>
                    <th>DEPTO</th>
                    <th>LOCALIDAD</th>
                    <th>COD POSTAL</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th>HORARIO</th>
                    <th>IMP. RENDIR</th>
                    <th>PRODUCTO</th>
                    <th>REPROCESO</th>
                    <th>OBSERVACION</th>
                    <th>DOC. PEDIR</th>                    
                  </tr>
                </thead>
                <tbody>                

                  <?php
                    
                    if(!empty($nombre)){

                      $path=PATH_ROOT.PATH_CLIENTE.$usuarioActivoSesion->getEmail()."/".$nombre;

                      $data = file_get_contents($path);
                      $data = json_decode($data, true);            
                      $i=0;

                      foreach($data as $key => $value) 
                      {

                        if(!empty($value[1]))
                        {

                          if($i>0){
                            echo "
                              <tr>
                                <td>".$i."</td>
                                <td><input id='tipo_doc' type='text' maxlength='10' class='form-control' style='width:200px;' name='".$i."_0' value='$value[0]'></td>
                                <td><input id='nro_doc' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_1' value='$value[1]'></td>
                                <td><input id='apellido' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_2' value='$value[2]'></td>
                                <td><input id='nombre' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_3' value='$value[3]'></td>
                                <td><input id='calle' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_4' value='$value[4]'></td>
                                <td><input id='numero' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_5' value='$value[5]'></td>
                                <td><input id='piso' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_6' value='$value[6]'></td>
                                <td><input id='dpto' type='text' maxlength='2' class='form-control' style='width:200px;' name='".$i."_7' value='$value[7]'></td>
                                <td><input id='localidad' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_8' value='$value[8]'></td>
                                <td><input id='codigo_postal' type='number' step='1' min='1000' max='9999' required class='form-control' style='width:200px;' name='".$i."_9' value='$value[9]'></td>
                                <td><input id='telefono' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_10' value='$value[10]'></td>                            
                                <td><input id='email' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_11' value='$value[11]'></td>                            
                                <td><input id='horario' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_12' value='$value[12]'></td>                            
                                <td><input id='imp_rendir' type='text' maxlength='10' class='form-control' style='width:200px;' name='".$i."_13' value='$value[13]'></td>                            
                                <td><input id='producto' type='text' maxlength='150' class='form-control' style='width:200px;' name='".$i."_14' value='$value[14]'></td>                            
                                <td><input id='reproceso' type='text' maxlength='10' class='form-control' style='width:200px;' name='".$i."_15' value='$value[15]'></td>                            
                                <td><input id='observacion' type='text' maxlength='150' class='form-control' style='width:250px;' name='".$i."_16' value='$value[16]'></td>                            
                                <td><input id='doc_a_pedir' type='text' maxlength='100' class='form-control' style='width:200px;' name='".$i."_17' value='$value[17]'></td>                                                            
                              </tr>";
                          }                       

                          //<td><input id='cobro_cliente' type='text' maxlength='10' class='form-control' style='width:200px;' name='".$i."_18' value='$value[18]'></td>                            
                          //<th>COBRO CLIENTE</th>  
                          
                          ++$i;

                        }
                      }
                    }
                    else
                    {
                      echo "
                        <div class='col-md-offset-3 col-md-6'>                
                          <div class='callout callout-warning'>
                            <h4><i class='icon fa fa-warning'></i> No se encontraron datos</h4>
                            Vuelva a cargar el archivo de excel
                          </div>
                        </div>";
                    }
                  ?> 

                </tbody>
              </table>                
            </div>                
          </div>
            
          <input type="hidden" name="fecha_importacion" value="<?php echo $fecha_importacion; ?>">
          <input type="hidden" name="tipo_importacion" value="<?php echo $objTipoImportacion->getId(); ?>">
          <input type="hidden" name="id_empresa_sistema" value="<?php echo $id_empresa_sistema; ?>">
          <input type="hidden" name="plaza" value="<?php echo $plaza; ?>">
          <input type="hidden" name="rows" value="<?php echo $i; ?>">
          <input type="hidden" name="cols" value="18">

          <div class="modal modal-success fade" id="modalGuardar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel">Guardar Importación</h4>
                </div>

                <div class="modal-body">
                    <div id="mensaje_eliminar">Se guardarán todos los registros de la grilla.</div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                  <button type="submit" name="submit" class="btn btn-outline pull-right"><i class="fa fa-save"></i> Guardar</button>                  
                </div>                                                      
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_importacion").addClass("active");
  });
</script>