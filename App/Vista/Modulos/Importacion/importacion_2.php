<?php        
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";          
  include_once PATH_NEGOCIO.'Funciones/Excel/PHPExcel/IOFactory.php';

  $nombre = (isset($_GET['excel'])? $_GET['excel']:'');
  $id_empresa_sistema = (isset($_GET['id_empresa_sistema'])? $_GET['id_empresa_sistema']:'');
  $fecha_importacion = (isset($_GET['fecha_importacion'])? $_GET['fecha_importacion']:'');
  $plaza = (isset($_GET['plaza'])? $_GET['plaza']:'');

  $action_guardar = PATH_VISTA.'Modulos/Importacion/action_guardar.php';   

  $handler = new HandlerImportacion;  
  $objTipoImportacion = $handler->TipoImportacionById(2);
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
                    <th>NRO GESTION</th>
                    <th>FECHA ENVIO</th>
                    <th>NRO SOLICITUD PNM</th>
                    <th>NRO LINEA RECEPTORA PIN</th>
                    <th>TIPO SUSCRIPTOR</th>
                    <th>APELLIDO Y NOMBRE</th>
                    <th>RAZON SOCIAL</th>
                    <th>TIPO DOCUMENTO</th>
                    <th>NRO DOCUMENTO</th>
                    <th>APELLIDO Y NOMBRE APODERADO</th>
                    <th>TIPO DOC. APODERADO</th>
                    <th>NRO DOC. APODERADO</th>
                    <th>TELEFONO CONTACTO</th>
                    <th>EMAIL CONTACTO</th>
                    <th>OPERADOR DONADOR</th>
                    <th>MODALIDAD CONTRATACION</th>
                    <th>LINEA 1</th>
                    <th>LINEA 2</th>
                    <th>LINEA 3</th>
                    <th>LINEA 4</th>
                    <th>LINEA 5</th>
                    <th>OPERADOR RECEPTOR</th>
                    <th>CANT. LINEAS PORTABILIDAD</th>
                    <th>FECHA ESTIMADA PORTACION</th>
                    <th>NRO DOC. PRESOLICITUD</th>
                    <th>DOMICILIO COMPLETO ENVIO</th>
                    <th>CODIGO POSTAL</th>
                    <th>LOCALIDAD</th>
                    <th>PROVINCIA</th>
                    <th>INFO. ADICIONAL ENVIO</th>
                    <th>HORARIO CONTACTO DESDE</th>
                    <th>HORARIO CONTACTO HASTA</th>
                    <th>HORARIO CONTACTO DESDE OP2</th>
                    <th>HORARIO CONTACTO HASTA OP2</th>
                    <th>MODO PAGO</th>
                    <th>CANT SIMCARDS ENTREGAR</th>
                    <th>CANT. LINEA 1</th>
                    <th>COD PLAN 1</th>
                    <th>DESCRP. PLAN 1</th>
                    <th>PRECIO PLAN 1</th>
                    <th>CANT. LINEA 2</th>
                    <th>COD PLAN 2</th>
                    <th>DESCRP. PLAN 2</th>
                    <th>PRECIO PLAN 2</th>
                    <th>CANT. LINEA 3</th>
                    <th>COD PLAN 3</th>
                    <th>DESCRP. PLAN 3</th>
                    <th>PRECIO PLAN 3</th>
                    <th>CANT. LINEA 4</th>
                    <th>COD PLAN 4</th>
                    <th>DESCRP. PLAN 4</th>
                    <th>PRECIO PLAN 4</th>
                    <th>CANT. LINEA 5</th>
                    <th>COD PLAN 5</th>
                    <th>DESCRP. PLAN 5</th>
                    <th>PRECIO PLAN 5</th>
                    <th>EMAIL ENVIAR DOC GESTIONADA</th>
                    <th>EQUIPO VENTA</th>

                    <th>SIM1</th>
                    <th>SIM2</th>
                    <th>SIM3</th>
                    <th>SIM4</th>
                    <th>SIM5</th>
                    
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
                        if(!empty($value[8]))
                        {

                          if($i>0){
                            
                            $campo_1="";
                            if(!empty($value[1])){                     
                                $timestamp = PHPExcel_Shared_Date::ExcelToPHP($value[1]+1);
                                $campo_1 = date("Y-m-d",$timestamp);
                            }
                            else
                            {
                                $campo_1 = "";
                            }
                            
                            $campo_23="";
                            if(!empty($value[23])){                     
                                $timestamp = PHPExcel_Shared_Date::ExcelToPHP($value[23]+1);
                                $campo_23 = date("Y-m-d",$timestamp);
                            }
                            else{
                               $campo_23 = ""; 
                            }
                            
                            $campo_30="";
                            if(!empty($value[30])){                                                     
                                if(!is_string($value[30])){
                                    $timestamp_30 =  PHPExcel_Shared_Date::ExcelToPHP($value[30]);
                                    $h_30 = str_pad(date("h",$timestamp_30)+3,2,'0',STR_PAD_LEFT);
                                    $m_30 = date("i",$timestamp_30);
                                    $campo_30 = $h_30.":".$m_30;
                                }    
                                else{
                                    $campo_30 = $value[30];
                                }                                                        
                            }
                            else{
                                $campo_30 = "";  
                            }                            

                            $campo_31="";
                            if(!empty($value[31])){                     
                                if(!is_string($value[31])){
                                    $timestamp_31 =  PHPExcel_Shared_Date::ExcelToPHP($value[31]);
                                    $h_31 = str_pad(date("h",$timestamp_31)+3,2,'0',STR_PAD_LEFT);
                                    $m_31 = date("i",$timestamp_31);
                                    $campo_31 = $h_31.":".$m_31;
                                
                                }    
                                else{
                                   $campo_31 = $value[31];
                                }                                                        
                            }
                            else{
                                $campo_31 = "";  
                            }
                            
                            $campo_32="";
                            if(!empty($value[32])){                     
                                if(!is_string($value[32])){
                                    $timestamp_32 =  PHPExcel_Shared_Date::ExcelToPHP($value[32]);
                                    $h_32 = str_pad(date("h",$timestamp_32)+3,2,'0',STR_PAD_LEFT);
                                    $m_32 = date("i",$timestamp_32);
                                    $campo_32 = $h_32.":".$m_32;
                                
                                }    
                                else{
                                   $campo_32 = $value[32];
                                }
                            }
                            else{
                                $campo_32 = "";  
                            }

                            $campo_33="";
                            if(!empty($value[33])){                     
                                if(!is_string($value[33])){
                                    $timestamp_33 =  PHPExcel_Shared_Date::ExcelToPHP($value[33]);
                                    $h_33 = str_pad(date("h",$timestamp_33)+3,2,'0',STR_PAD_LEFT);
                                    $m_33 = date("i",$timestamp_33);
                                    $campo_33 = $h_33.":".$m_33;
                                
                                }    
                                else{
                                   $campo_33 = $value[33];
                                }
                            }
                            else{
                                $campo_33 = "";  
                            }

                            echo "
                              <tr>
                                <td>".$i."</td>                              
                                <td><input id='nro_gestion' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_0' value='$value[0]'></td>
                                <td><input id='fecha_envio' type='date' format='d/m/Y' class='form-control' style='width:150px;' name='".$i."_1' value='$campo_1'></td>
                                <td><input id='nro_solicitud' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_2' value='$value[2]'></td>
                                <td><input id='pin' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_3' value='$value[3]'></td>
                                <td><input id='tipo_suscriptor' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_4' value='$value[4]'></td>                              
                                <td><input id='apellido_nombre' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_5' value='$value[5]'></td>
                                <td><input id='razon_social' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_6' value='$value[6]'></td>                              
                                <td><input id='tipo_doc' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_7' value='$value[7]'></td>
                                <td><input id='nro_doc' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_8' value='$value[8]'></td>                              
                                <td><input id='apellido_nombre_apoderado' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_9' value='$value[9]'></td>
                                <td><input id='tipo_doc_apoderado' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_10' value='$value[10]'></td>   

                                <td><input id='tipo_doc_apoderado' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_11' value='$value[11]'></td>                            
                                <td><input id='telefono' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_12' value='$value[12]'></td>                            
                                <td><input id='email' type='email' maxlength='50' class='form-control' style='width:150px;' name='".$i."_13' value='$value[13]'></td>                            
                                <td><input id='operador_donador' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_14' value='$value[14]'></td>                            
                                <td><input id='modalidad_contratacion' type='text' maxlength='50' class='form-control' style='width:150px;' name='".$i."_15' value='$value[15]'></td>                            
                                <td><input id='linea1' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_16' value='$value[16]'></td>                            
                                <td><input id='linea2' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_17' value='$value[17]'></td>                            
                                <td><input id='linea3' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_18' value='$value[18]'></td> 
                                <td><input id='linea4' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_19' value='$value[19]'></td>
                                <td><input id='linea5' type='number' step='1' class='form-control' style='width:150px;' name='".$i."_20' value='$value[20]'></td>

                                <td><input id='operador_receptor' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_21' value='$value[21]'></td>                            
                                <td><input id='cant_lineas_portabilidad' step='1' type='number' class='form-control' style='width:200px;' name='".$i."_22' value='$value[22]'></td>                            
                                <td><input id='fecha_portacion' type='date' class='form-control' style='width:200px;' name='".$i."_23' value='$campo_23'></td>                            
                                <td><input id='nro_presolicitud' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_24' value='$value[24]'></td>                            
                                <td><input id='domicilio' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_25' value='$value[25]'></td>                            
                                <td><input id='codigo_postal' type='number' step='1' min='1000' max='9999' required class='form-control' style='width:200px;' name='".$i."_26' value='$value[26]'></td>                            
                                <td><input id='localidad' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_27' value='$value[27]'></td>                            
                                <td><input id='provincia' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_28' value='$value[28]'></td> 
                                <td><input id='info_adicional' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_29' value='$value[29]'></td>
                                <td><input id='hora_contacto_desde' type='text' maxlength='5' placeholder='hh:mm' class='form-control' style='width:200px;' name='".$i."_30' value='$campo_30'></td>  

                                <td><input id='hora_contacto_hasta' type='text' maxlength='5' placeholder='hh:mm' class='form-control' style='width:200px;' name='".$i."_31' value='$campo_31'></td>                            
                                <td><input id='hora_contacto_op2_desde' type='text' maxlength='5' placeholder='hh:mm' class='form-control' style='width:200px;' name='".$i."_32' value='$campo_32'></td>                            
                                <td><input id='hora_contacto_op2_hasta' type='text' maxlength='5' placeholder='hh:mm' class='form-control' style='width:200px;' name='".$i."_33' value='$campo_33'></td>                            
                                <td><input id='modo_pago' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_34' value='$value[34]'></td>                            
                                <td><input id='cant_simcard' type='number' step='1'  class='form-control' style='width:200px;' name='".$i."_35' value='$value[35]'></td>                            
                                <td><input id='cant_linea1' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_36' value='$value[36]'></td>                            
                                <td><input id='codigo_linea1' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_37' value='$value[37]'></td>                            
                                <td><input id='descripcion_linea1' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_38' value='$value[38]'></td> 
                                <td><input id='precio_linea1' type='number' step='0.01' class='form-control' style='width:200px;' name='".$i."_39' value='$value[39]'></td>
                                <td><input id='cant_linea2' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_40' value='$value[40]'></td>

                                <td><input id='codigo_linea2' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_41' value='$value[41]'></td>                            
                                <td><input id='descripcion_linea2' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_42' value='$value[42]'></td>                            
                                <td><input id='precio_linea2' type='number' step='0.01' class='form-control' style='width:200px;' name='".$i."_43' value='$value[43]'></td>                            
                                <td><input id='cant_linea3' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_44' value='$value[44]'></td>                            
                                <td><input id='codigo_linea3' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_45' value='$value[45]'></td>                            
                                <td><input id='descripcion_linea3' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_46' value='$value[46]'></td>                            
                                <td><input id='precio_linea3' type='number' step='0.01' class='form-control' style='width:200px;' name='".$i."_47' value='$value[47]'></td>                            
                                <td><input id='cant_linea4' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_48' value='$value[48]'></td> 
                                <td><input id='codigo_linea4' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_49' value='$value[49]'></td>
                                <td><input id='descripcion_linea4' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_50' value='$value[50]'></td>

                                <td><input id='precio_linea4' type='number' step='0.01' class='form-control' style='width:200px;' name='".$i."_51' value='$value[51]'></td>                            
                                <td><input id='cant_linea5' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_52' value='$value[52]'></td>                            
                                <td><input id='codigo_linea5' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_53' value='$value[53]'></td>                            
                                <td><input id='descripcion_linea5' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_54' value='$value[54]'></td>                            
                                <td><input id='precio_linea5' type='number' step='0.01' class='form-control' style='width:200px;' name='".$i."_55' value='$value[55]'></td>                            
                                <td><input id='email_enviar_doc' type='email' maxlength='50' class='form-control' style='width:200px;' name='".$i."_56' value='$value[56]'></td>                            
                                <td><input id='equipo_venta' type='text' maxlength='50' class='form-control' style='width:200px;' name='".$i."_57' value='$value[57]'></td>                                                          

                                <td><input id='sim1' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_58' value='$value[58]'></td>                                                          
                                <td><input id='sim2' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_59' value='$value[59]'></td>                                                          
                                <td><input id='sim3' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_60' value='$value[60]'></td>                                                          
                                <td><input id='sim4' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_61' value='$value[61]'></td>                                                          
                                <td><input id='sim5' type='number' step='1' class='form-control' style='width:200px;' name='".$i."_62' value='$value[62]'></td>                                                          

                              </tr>";
                          }                       

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
          <input type="hidden" name="cols" value="63">

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