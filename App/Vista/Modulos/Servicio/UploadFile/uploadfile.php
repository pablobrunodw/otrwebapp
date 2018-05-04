<?php	  
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
  include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";  
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 

  $url_upload = PATH_VISTA.'Modulos/Servicio/UploadFile/action_uploadfile.php';    

  $url_publicar = PATH_VISTA.'Modulos/Servicio/UploadFile/action_publicar.php';    
  $url_despublicar = PATH_VISTA.'Modulos/Servicio/UploadFile/action_despublicar.php';    


	$fechaing=(isset($_GET["fechaing"])?$_GET["fechaing"]:0);
	$nroing=(isset($_GET["nroing"])?$_GET["nroing"]:0);

	$handler = new HandlerSistema;
  $user = $usuarioActivoSesion;
  $servicio = $handler->selectUnServicio($fechaing,$nroing);	
  $allEstados = $handler->selectAllEstados();

  $handlerUF = new HandlerUploadFile;
  $allCategoria = $handlerUF->selectCategoriasByEmpresa($servicio[0]->SERTT91_CODEMPRE);

  if(empty($servicio)){
    echo "<script>javascript:history.back(1)</script>";
    return;
  }
    
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Cargar Archivos
      <small>Carga de archivos por cada servicio</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li>Servicios</li>
      <li class="active">Carga de Archivos</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-3 hidden-xs">
        <div class="box box-solid">
          <div class="box-header with-border">
            <i class="fa fa-caret-right"></i>
            <h3 class="box-title">Servicio Seleccionado</h3>            
          </div>
          <div class="box-body">
            <p>
              <?php               
                $f_array = new FuncionesArray;
                $class_estado = $f_array->buscarValor($allEstados,"1",$servicio[0]->ESTADOS_DESCCI,"2");

                $vform_dni = $servicio[0]->SERTT31_PERNUMDOC;
                $vform_servicio_fecha = $servicio[0]->SERTT11_FECSER->format('dmY')."_".$servicio[0]->SERTT12_NUMEING;
                //$vform_empresa = $servicio[0]->EMPTT11_CODIGO;

                echo "
                <b>".$servicio[0]->EMPTT21_NOMBREFA."</b><hr>
                <b>Estado:</b> <span class='".$class_estado."' style='font-size:11px;'>".$servicio[0]->ESTADOS_DESCCI."</span><br><br>
                <b>Fecha:</b> ".$servicio[0]->SERTT11_FECSER->format('d/m/Y')."<br>
                <b>Numero:</b> ".$servicio[0]->SERTT12_NUMEING."<br>
                <b>Nombre:</b> ".$servicio[0]->SERTT91_NOMBRE."<br>
                <b>DNI:</b> ".$servicio[0]->SERTT31_PERNUMDOC."<br>
                <b>Telefono:</b> ".$servicio[0]->SERTT91_TELEFONO."<br> 
                <b>Localidad:</b> ".$servicio[0]->SERTT91_LOCALIDAD."<br>";
                
                
                if($user->getUsuarioPerfil()->getNombre()!="CLIENTE"){
                  echo "
                    <br>
                    <b>Cliente:</b> ".$servicio[0]->EMPTT21_ABREV."<br>        
                    <b>Gerente:</b> ".$servicio[0]->SERTT91_GTEALIAS."<br>             
                    <b>Coordinador:</b> ".$servicio[0]->SERTT91_COOALIAS."<br>             
                    <b>Gestor:</b> ".$servicio[0]->GESTOR21_ALIAS."<br>";

                  
                    if($servicio[0]->SERTT91_OBSERV == $servicio[0]->SERTT91_OBRESPU)
                      $observaciones = $servicio[0]->SERTT91_OBSERV;
                    else
                      $observaciones = $servicio[0]->SERTT91_OBSERV."<br>".$servicio[0]->SERTT91_OBRESPU; 

                    $observaciones = $observaciones."<br>".$servicio[0]->SERTT91_OBSEENT ;

                    echo "<br>";
                    echo "<b>Observaciones:</b> ".$observaciones;
                }
                                               
              ?>
            </p>
          </div>
          <div class="box-footer clearfix">
            <?php
              if(isset($_COOKIE["url-tmp-back"])){                
            ?>
                <a class="pull-left btn btn-default" href="<?php echo $_COOKIE["url-tmp-back"]; ?>"><i class="fa fa-chevron-left"></i> Volver</a>
            <?php
              }else{
            ?>
                <a class="pull-left btn btn-default" href="javascript:history.back(1)"><i class="fa fa-chevron-left"></i> Volver</a>
            <?php
              }
            ?>      
          </div>
        </div>
      </div>  
	    <div class="col-md-9 col-xs-12">
        <div class="box">                
          <div class="box-header with-border">
            <i class="fa fa-upload"></i>
            <h3 class="box-title">Tipo de documentos</h3>
            <?php
              $estaPublicado = $handlerUF->estaPublicado($fechaing,$nroing);                          

              if($esAdmin || $esGerencia || $esBO)
                $is_user_admin = "";
              else
                $is_user_admin = "display:none;";

              if ($estaPublicado)
                echo "<a class='btn btn-warning btn-xs pull-right' style='".$is_user_admin."' href='#' data-toggle='modal' data-target='#modalDespublicar'><i class='fa fa-close'></i> Despublicar</a>";
              else
                echo "<a class='btn btn-primary btn-xs pull-right' style='".$is_user_admin."' href='#' data-toggle='modal' data-target='#modalPublicar'><i class='fa fa-check'></i> Publicar</a>";
                
            ?>
            
          </div>
          <div class="box-body table-responsive">
            
            <form action=<?php echo $url_upload; ?> method="post" enctype="multipart/form-data">            
              <input type='hidden' name="field_DNI" value='<?php echo $vform_dni; ?>'>
              <input type='hidden' name="field_FECHA_SERVICIO" value='<?php echo $vform_servicio_fecha; ?>'>              
              <input type='hidden' name="field_FECHA" value='<?php echo $fechaing; ?>'>
              <input type='hidden' name="field_NUMERO" value='<?php echo $nroing; ?>'>              
              <!--<input type='hidden' name="field_EMPRESA" value='<?php echo $vform_empresa; ?>'>-->

              <table class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                <thead>        
                  <tr>                   
                    <th style="width: 20%;">TIPO DOCUMENTO</th>              
                    <th style="width: 10%;">ACCION</th> 
                    <th style="width: 60%;">DOCUMENTACION</th>
                    <th style="width: 10%;">ESTADO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php    

                    if(!empty($allCategoria)){
                      foreach ($allCategoria as $key => $value) {           

                        $result = $handlerUF->selectCategoriaByServicio($fechaing,$nroing,$value->getCategoria());                        

                        if(!empty($result)){
                          $path_file = "Visualizar (".$result->getExtencion().")";
                          $link_file = BASE_URL.PATH_UPLOADFILE.$result->getRuta();
                          $estado = "<span class='label label-success'>SUBIDO</span>";

                          echo "
                            <tr>                         
                              <td>".$value->getCategoria()."</td>
                              <td>
                                  <div class='checkbox' style='margin-top:0px; margin-bottom:0px;'>
                                    <label>
                                      <input type='checkbox' name='eliminar_".$value->getCategoria()."' id='chk_".$value->getCategoria()."' onclick=eliminar('".$value->getCategoria()."')>
                                        Eliminar
                                    </label>
                                  </div>
                                  <input type='hidden' name='idArchivo_".$value->getCategoria()."' value='".$result->getId()."'>
                                  <input type='hidden' name='ruta_".$value->getCategoria()."' value='".$result->getRuta()."'>
                              </td>
                              <td><a href='".$link_file."' target='_blank' id='link_".$value->getCategoria()."'>".$path_file."</a></td>
                              <td>".$estado."</td>
                            </tr>";

                        }else{
                          $path_file = "";
                          $link_file = "";
                          $estado = "<span class='label label-danger'>VACIO</span>";

                          echo "
                            <tr>                         
                              <td>".$value->getCategoria()."</td>
                              <td>
                                <input type='file' id='".$value->getCategoria()."' name='".$value->getCategoria()."' accept='.jpg, .png, .gif, .pdf, .xls, .xlsx, .doc, .docx, .txt'>
                                <input type='hidden' name='eliminar_".$value->getCategoria()."' value='false'>
                                <input type='hidden' name='idArchivo_".$value->getCategoria()."' value='0'>
                                <input type='hidden' name='ruta_".$value->getCategoria()."' value=''>
                              </td>
                              <td><a href='".$link_file."' target='_blank'>".$path_file."</a></td>
                              <td>".$estado."</td>
                            </tr>";
                        }
                        
                      }
                    }
                            
                  ?>                        
                </tbody>
              </table>             

              <?php
                $estaPublicado = $handlerUF->estaPublicado($fechaing,$nroing);                          

                if ($estaPublicado)                
                  echo "<input type='submit' class='btn btn-default pull-right' disabled='disabled' value='Guardar'>";
                else
                  echo "<input type='submit' class='btn btn-default pull-right' value='Guardar'>";

              ?>
              
            </form>

        	</div>             
      	</div>
    	</div>
    </div>

  </section>
</div>

<div class="modal modal-primary fade" id="modalPublicar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Publicar Servicio</h4>
      </div>

      <form name="formPublicar" id="form" method="post" action=<?php echo $url_publicar; ?>>              
        <div class="modal-body">
            <div>
              Se publicará el servicio seleccionado.<br>
              La documentación estará disponible para la descarga por parte del cliente.
            </div>
            <input type="hidden" name="fecha" value="<?php echo $fechaing; ?>">            
            <input type="hidden" name="servicio" value="<?php echo $nroing; ?>">            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
          <input  type="submit" name="submit" value="Publicar" class="btn btn-outline">
        </div>                                      
      </form>

    </div>
  </div>
</div>

<div class="modal modal-warning fade" id="modalDespublicar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Despublicar Servicio</h4>
      </div>

      <form name="formDespublicar" id="form" method="post" action=<?php echo $url_despublicar; ?>>              
        <div class="modal-body">
            <div>
              Se despublicará el servicio seleccionado.<br>
              La documentación ya no estará disponible para la descarga por parte del cliente.
            </div>
            <input type="hidden" name="fecha" value="<?php echo $fechaing; ?>">            
            <input type="hidden" name="servicio" value="<?php echo $nroing; ?>">            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
          <input  type="submit" name="submit" value="Despublicar" class="btn btn-outline">
        </div>                                      
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_upload").addClass("active");
  });

  function eliminar(tipo_doc){            

    if(document.getElementById("chk_"+tipo_doc).checked()==true)
    {
      $("#link_"+tipo_doc).css({"text-decoration":"line-through","color":"red"});
    }
    else{
      $("#link_"+tipo_doc).css({"text-decoration":"","color":""});      
    }    
  }
</script>