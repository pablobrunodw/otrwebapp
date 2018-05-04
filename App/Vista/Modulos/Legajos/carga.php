<?php
  include_once PATH_NEGOCIO."Modulos/handlerLegajos.class.php";     
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 

  $user = $usuarioActivoSesion;

  $handler = new HandlerLegajos;
  $dFecha = new Fechas;

  $legajo = $handler->seleccionarLegajos($user->getId());

  if(is_null($legajo))
  {
    $handler->crearLegajo($user->getId());
    $legajo = $handler->seleccionarLegajos($user->getId());
  }

  $url_action_guardar = PATH_VISTA.'Modulos/Legajos/action_guardar.php';
  $url_action_enviar = PATH_VISTA.'Modulos/Legajos/action_enviar.php';

  $pestania = (isset($_GET["pestania"])?$_GET["pestania"]:'');  

  $solapa_1_active = "";
  $solapa_2_active = "";
  $solapa_3_active = "";
  $solapa_4_active = "";
  $solapa_5_active = "";

  switch ($pestania) {
    case 1:
      $solapa_1_active = "active";
      break;
    
    case 2:
      $solapa_2_active = "active";
      break;
    
    case 3:
      $solapa_3_active = "active";
      break;
    
    case 4:
      $solapa_4_active = "active";
      break;
    
    case 5:
      $solapa_5_active = "active";
      break;

    default:
      $solapa_1_active = "active";
      break;
  }
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Legajos
      <small>Docuemntación propia del gestor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Legajos</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <?php if($legajo->getEnviado()==0){ ?>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">   
              <i class="fa fa-archive"></i>       
              <h3 class="box-title">Legajos</h3>          
            </div>
            <div class="box-body">

              <div class="callout callout-warning">
                <h4>Declaración Jurada</h4>
                <p>Dejo constancia que los datos cargados mediante este portal web lo son en carácter de declaración jurada. Asimismo me comprometo a notificar/modificar los datos por cualquier cambio futuro en un plazo de cuarenta y ocho horas (48), por el medio que sea necesario, consintiendo que de omitir tal notificación se tengan tendrán por válidos a todos los efectos legales las comunicaciones efectuadas al domicilio antes consignado</p>
              </div>

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="<?php echo $solapa_1_active; ?>"><a href="#tab_1" data-toggle="tab">Información Personal</a></li>                
                  <li class="<?php echo $solapa_2_active; ?>"><a href="#tab_2" data-toggle="tab">Documentación Personal</a></li>
                  <li class="<?php echo $solapa_3_active; ?>"><a href="#tab_3" data-toggle="tab">Documentación Vehiculo</a></li>
                  <li class="<?php echo $solapa_4_active; ?>"><a href="#tab_4" data-toggle="tab">Documentación Vehiculo [NO EXCLUYENTE]</a></li>
                  <li class="<?php echo $solapa_5_active; ?>"><a href="#tab_5" data-toggle="tab">Vencimientos</a></li>
                </ul>
              </div>
              <div class="tab-content">

                <div class="tab-pane <?php echo $solapa_1_active; ?>" id="tab_1">                 
                  <form action="<?php echo $url_action_guardar; ?>" method="post" enctype="multipart/form-data">      
                    <input type="hidden" name="etapa_legajo" value="1">   
                    <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">   
                    <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>"> 

                    <div class="row">   
                      <div class="col-md-3">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre" value="<?php echo trim($legajo->getNombre()); ?>" placeholder="Como figura en el DNI" class="form-control" required="">
                      </div>
                      
                      <div class="col-md-3">
                        <label>N° de CUIL</label>
                        <input type="text" name="cuit" value="<?php echo trim($legajo->getCuit()); ?>" placeholder="EJ.: 20-33921549-9" class="form-control" required="">
                      </div>                  
                    
                      <div class="col-md-3">                      
                        <label>Fecha de Nacimiento</label>
                        <?php if($legajo->getNacimiento()->format('Y-m-d')=='1900-01-01'){ ?>                      
                          <input type="date" name="nacimiento" class="form-control" required="">
                        <?php }else{ ?>
                          <input type="date" name="nacimiento" value="<?php echo $legajo->getNacimiento()->format('Y-m-d'); ?>" class="form-control" required="">
                        <?php } ?>
                      </div>
                      
                      <div class="col-md-3">
                        <label>Domicilio, Localidad, Provincial, CP</label>
                        <input type="text" value="<?php echo trim($legajo->getDireccion()); ?>" name="direccion" class="form-control" required="">
                      </div>   
                    </div>

                    <br>

                    <div class="row">   
                      <div class="col-md-3">
                        <label>Telefono Celular</label>
                        <input type="text" value="<?php echo trim($legajo->getCelular()); ?>" name="celular" placeholder="EJ.: 0341 156856621 - MI TELEFONO" class="form-control" required="">
                      </div> 

                      <div class="col-md-3">
                        <label>Telefono Fijo o Telefono Alternativo</label>
                        <input type="text" value="<?php echo trim($legajo->getTelefono()); ?>" name="telefono" placeholder="EJ.: 0341 4265875 - CASA DE MIS PADRES" class="form-control"  required="">
                      </div> 
                    
                      <div class="col-md-3">
                        <label>Estado Civil</label>
                        <select name="estado_civil" class="form-control" required="">                          
                          <option value=""></option>
                          <option value="Soltero" <?php echo (trim($legajo->getEstadoCivil())=="Soltero"?"selected":"") ?>>Soltero</option>
                          <option value="Casado" <?php echo (trim($legajo->getEstadoCivil())=="Casado"?"selected":"") ?>>Casado</option>
                          <option value="Viudo" <?php echo (trim($legajo->getEstadoCivil())=="Viudo"?"selected":"") ?>>Viudo</option>
                          <option value="Divorciado" <?php echo (trim($legajo->getEstadoCivil())=="Divorciado"?"selected":"") ?>>Divorciado</option>
                          <option value="Union Libre" <?php echo (trim($legajo->getEstadoCivil())=="Union Libre"?"selected":"") ?>>Unión Libre</option>
                        </select>                        
                      </div>
                      
                      <div class="col-md-3">
                        <label>Hijos / Cantidad / Edad</label>
                        <textarea name="hijos" class="form-control" required=""><?php echo trim($legajo->getHijos()); ?></textarea>
                      </div>
                    </div>

                    <br>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-primary pull-right" value="Guardar">
                      </div>
                    </div>
                  </form>
                </div>     

                <div class="tab-pane <?php echo $solapa_2_active; ?>" id="tab_2"> 
                  <form action="<?php echo $url_action_guardar; ?>" method="post" enctype="multipart/form-data">      
                    <input type="hidden" name="etapa_legajo" value="2">   
                    <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">   
                    <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>"> 

                    <div class="row">
                      <div class="col-md-3">
                        <label>Fotocopia DNI (Frente y Dorso)</label>
                        <?php if(empty(trim($legajo->getDniAdjunto()))) { ?>
                          <input id="i_dni" type="file" name="dni_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_dni" type="hidden" name="dni_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_dni" href="<?php echo trim($legajo->getDniAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_dni" href="#" onclick="eliminar('dni')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>  
                      
                      <div class="col-md-3">
                        <label>Constancia de CUIL</label>
                        <?php if(empty(trim($legajo->getCuitAdjunto()))) { ?>
                          <input id="i_cuit" type="file" name="cuit_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_cuit" type="hidden" name="cuit_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_cuit" href="<?php echo trim($legajo->getCuitAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_cuit" href="#" onclick="eliminar('cuit')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>

                      <div class="col-md-3">
                        <label>Curriculum Vitae</label>
                        <?php if(empty(trim($legajo->getCvAdjunto()))) { ?>
                          <input id="i_cv" type="file" name="cv_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_cv" type="hidden" name="cv_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_cv" href="<?php echo trim($legajo->getCvAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_cv" href="#" onclick="eliminar('cv')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>          
                                    
                      <div class="col-md-3">
                        <label>Comprobante CBU</label>
                        <?php if(empty(trim($legajo->getCbuAdjunto()))) { ?>
                          <input id="i_cbu" type="file" name="cbu_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_cbu" type="hidden" name="cbu_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_cbu" href="<?php echo trim($legajo->getCbuAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_cbu" href="#" onclick="eliminar('cbu')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>   
                    </div>

                    <br>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-primary pull-right" value="Guardar">
                      </div>
                    </div>                  
                  </form>                
                </div>                    
                <div class="tab-pane <?php echo $solapa_3_active; ?>" id="tab_3"> 
                  <form action="<?php echo $url_action_guardar; ?>" method="post" enctype="multipart/form-data">      
                    <input type="hidden" name="etapa_legajo" value="3">   
                    <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">   
                    <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">  
                    
                    <div class="row">
                      <div class="col-md-3">
                        <label>Licencia de Conducir (Frente)</label>
                        <?php if(empty(trim($legajo->getLicenciaAdjunto()))) { ?>
                          <input id="i_licencia" type="file" name="licencia_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_licencia" type="hidden" name="licencia_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_licencia" href="<?php echo trim($legajo->getLicenciaAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_licencia" href="#" onclick="eliminar('licencia')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div> 
                      <div class="col-md-3">
                        <label>Licencia de Conducir (Dorso)</label>
                        <?php if(empty(trim($legajo->getLicenciaAdjuntoDorso()))) { ?>
                          <input id="i_licencia_dorso" type="file" name="licencia_adjunto_dorso" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_licencia_dorso" type="hidden" name="licencia_adjunto_dorso" class="form-control" required="">
                          <br>
                          <a id="a_licencia_dorso" href="<?php echo trim($legajo->getLicenciaAdjuntoDorso()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_licencia_dorso" href="#" onclick="eliminar('licencia_dorso')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Titulo o Tarjeta Autorizante (Frente)</label>
                        <?php if(empty(trim($legajo->getTituloAdjunto()))) { ?>
                          <input id="i_titulo" type="file" name="titulo_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_titulo" type="hidden" name="titulo_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_titulo" href="<?php echo trim($legajo->getTituloAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_titulo" href="#" onclick="eliminar('titulo')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>                       

                      <div class="col-md-3">
                        <label>Titulo o Tarjeta Autorizante (Dorso)</label>
                        <?php if(empty(trim($legajo->getTituloAdjuntoDorso()))) { ?>
                          <input id="i_titulo_dorso" type="file" name="titulo_adjunto_dorso" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_titulo_dorso" type="hidden" name="titulo_adjunto_dorso" class="form-control" required="">
                          <br>
                          <a id="a_titulo_dorso" href="<?php echo trim($legajo->getTituloAdjuntoDorso()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_titulo_dorso" href="#" onclick="eliminar('titulo_dorso')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label>Seguro: Poliza o Recibo</label>
                        <?php if(empty(trim($legajo->getSeguroAdjunto()))) { ?>
                          <input id="i_seguro" type="file" name="seguro_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_seguro" type="hidden" name="seguro_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_seguro" href="<?php echo trim($legajo->getSeguroAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_seguro" href="#" onclick="eliminar('seguro')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>                    
                    </div>

                    <br>

                    <div class="row">
                      <div class="col-md-3">
                        <label>Ultimo Mantenimiento</label>
                        <?php if(empty(trim($legajo->getMantenimientoAdjunto()))) { ?>
                          <input id="i_mantenimiento" type="file" name="mantenimiento_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_mantenimiento" type="hidden" name="mantenimiento_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_mantenimiento" href="<?php echo trim($legajo->getMantenimientoAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_mantenimiento" href="#" onclick="eliminar('mantenimiento')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>   

                      <div class="col-md-3">
                        <label>Cantidad de KM real del auto</label>
                        <?php if(empty(trim($legajo->getKmrealAdjunto()))) { ?>
                          <input id="i_kmreal" type="file" name="kmreal_adjunto" class="form-control" required="">                        
                        <?php }else{ ?>
                          <input id="i_kmreal" type="hidden" name="kmreal_adjunto" class="form-control" required="">
                          <br>
                          <a id="a_kmreal" href="<?php echo trim($legajo->getKmrealAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_kmreal" href="#" onclick="eliminar('kmreal')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>  
                    </div>

                    <br>

                    <div class="row">                 
                      <div class="col-md-3">
                        <label>Tarjeta GNC (si tiene GNC)</label>
                        <?php if(empty(trim($legajo->getGncAdjunto()))) { ?>
                          <input id="i_gnc" type="file" name="gnc_adjunto" class="form-control">                        
                        <?php }else{ ?>
                          <input id="i_gnc" type="hidden" name="gnc_adjunto" class="form-control">
                          <br>
                          <a id="a_gnc" href="<?php echo trim($legajo->getGncAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_gnc" href="#" onclick="eliminar('gnc')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>  
                      
                      <div class="col-md-3">
                        <label>Prueba Hidraulica (si tiene GNC)</label>
                        <?php if(empty(trim($legajo->getHidraulicaAdjunto()))) { ?>
                          <input id="i_hidraulica" type="file" name="hidraulica_adjunto" class="form-control">                        
                        <?php }else{ ?>
                          <input id="i_hidraulica" type="hidden" name="hidraulica_adjunto" class="form-control">
                          <br>
                          <a id="a_hidraulica" href="<?php echo trim($legajo->getHidraulicaAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_hidraulica" href="#" onclick="eliminar('hidraulica')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>     
                    </div>
                    
                    <br>
                    
                    <div class="row">
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-primary pull-right" value="Guardar">
                      </div>
                    </div>
                  </form>                
                </div>              
                <div class="tab-pane <?php echo $solapa_4_active; ?>" id="tab_4">
                  <form action="<?php echo $url_action_guardar; ?>" method="post" enctype="multipart/form-data">      
                    <input type="hidden" name="etapa_legajo" value="4">   
                    <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">   
                    <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">  

                    <div class="row">
                      <div class="col-md-6">
                        <label>Patente</label>
                        <?php if(empty(trim($legajo->getPatenteAdjunto()))) { ?>
                          <input id="i_patente" type="file" name="patente_adjunto" class="form-control">                        
                        <?php }else{ ?>
                          <input id="i_patente" type="hidden" name="patente_adjunto" class="form-control">
                          <br>
                          <a id="a_patente" href="<?php echo trim($legajo->getPatenteAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_patente" href="#" onclick="eliminar('patente')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>
                      <div class="col-md-6">
                        <label>VTV</label>
                        <?php if(empty(trim($legajo->getVtvAdjunto()))) { ?>
                          <input id="i_vtv" type="file" name="vtv_adjunto" class="form-control">                        
                        <?php }else{ ?>
                          <input id="i_vtv" type="hidden" name="vtv_adjunto" class="form-control">
                          <br>
                          <a id="a_vtv" href="<?php echo trim($legajo->getVtvAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                          <a id="b_vtv" href="#" onclick="eliminar('vtv')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Borrar</a>
                        <?php } ?>
                      </div>                                                            
                    </div>
                    
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-primary pull-right" value="Guardar">
                      </div>
                    </div>
                  </form>  
                </div>

                <div class="tab-pane <?php echo $solapa_5_active; ?>" id="tab_5">
                  <form action="<?php echo $url_action_guardar; ?>" method="post" enctype="multipart/form-data">      
                    <input type="hidden" name="etapa_legajo" value="5">   
                    <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">   
                    <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">  

                    <div class="row">
                      <div class="col-md-6">                        
                        <label>Vencimiento licencia de conducir</label>
                        <?php if($legajo->getLicenciaVto()->format('Y-m-d')=='1900-01-01'){ ?>
                          <input type="date" name="licencia_vto" class="form-control">                                           
                        <?php }else{ ?>
                          <input type="date" name="licencia_vto" class="form-control" value="<?php echo $legajo->getLicenciaVto()->format('Y-m-d'); ?>">                                                                 
                        <?php } ?>
                      </div>
                      <div class="col-md-6">                        
                        <label>Vencimiento vtv</label>
                        <?php if($legajo->getVtvVto()->format('Y-m-d')=='1900-01-01'){ ?>
                          <input type="date" name="vtv_vto" class="form-control">                      
                        <?php }else{ ?>
                          <input type="date" name="vtv_vto" class="form-control" value="<?php echo $legajo->getVtvVto()->format('Y-m-d'); ?>">                      
                        <?php } ?>
                      </div>                                                                                
                    </div>
                    
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <input type="submit" class="btn btn-primary pull-right" value="Guardar">
                      </div>
                    </div>
                  </form>  
                </div>
                
              </div>
              
            </div>
          </div>
        </div>                
      </div>

      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo $url_action_enviar; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">
            <input type="submit" name="submit" class="btn btn-success" value="Enviar Información">
          </form>
        </div>
      </div>

    <?php }else{ ?>

      <div class="row">
        <div class="col-md-12">

          <div class="callout callout-info">
            <h4>Información Enviada</h4>
            <p>Toda la información generada esta siendo procesada por el equipo de OTR Group.</p>
          </div> 

        </div>
      </div>

    <?php } ?>

  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_legajos").addClass("active");
  });
</script>
<script type="text/javascript">
  function eliminar(tipo){
    $("#a_"+tipo).hide();
    $("#b_"+tipo).hide();
    $("#i_"+tipo).attr('type', 'file');
  }
</script>