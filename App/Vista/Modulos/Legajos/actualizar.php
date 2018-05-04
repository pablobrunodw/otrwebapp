<?php
  include_once PATH_NEGOCIO."Modulos/handlerLegajos.class.php";     
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 

  $user = $usuarioActivoSesion;

  $usuario_filtro = (isset($_GET["usuario"])?$_GET["usuario"]:"");

  $handler = new HandlerLegajos;
  $dFecha = new Fechas;

  $legajo = $handler->seleccionarLegajos($usuario_filtro);

  if(is_null($legajo))
  {
    $handler->crearLegajo($user->getId());
    $legajo = $handler->seleccionarLegajos($usuario_filtro);
  }

  $url_action_guardar = PATH_VISTA.'Modulos/Legajos/action_guardar.php';
  $url_action_rechazar = PATH_VISTA.'Modulos/Legajos/action_rechazar.php';

  $pestania = (isset($_GET["pestania"])?$_GET["pestania"]:'');  

  $solapa_1_active = "";
  $solapa_2_active = "";
  $solapa_3_active = "";
  $solapa_4_active = "";
  $solapa_5_active = "";
  $solapa_6_active = "";

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

    case 6:
      $solapa_6_active = "active";
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


      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">   
              <i class="fa fa-archive"></i>       
              <h3 class="box-title">Legajos</h3>          
            </div>
            <div class="box-body">

              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="<?php echo $solapa_1_active; ?>"><a href="#tab_1" data-toggle="tab">Información Personal</a></li>                
                  <li class="<?php echo $solapa_2_active; ?>"><a href="#tab_2" data-toggle="tab">Documentación Personal</a></li>
                  <li class="<?php echo $solapa_3_active; ?>"><a href="#tab_3" data-toggle="tab">Documentación Vehiculo</a></li>
                  <li class="<?php echo $solapa_4_active; ?>"><a href="#tab_4" data-toggle="tab">Documentación Vehiculo [NO EXCLUYENTE]</a></li>
                  <li class="<?php echo $solapa_5_active; ?>"><a href="#tab_5" data-toggle="tab">Vencimientos</a></li>

                  <?php
                    if($esBO){
                  ?>
                  <li class="<?php echo $solapa_6_active; ?>"><a href="#tab_6" data-toggle="tab">Información generada por OTR GROUP</a></li>
                  <?php
                    }
                  ?>

                </ul>
              </div>
              <div class="tab-content">

                <div class="tab-pane <?php echo $solapa_1_active; ?>" id="tab_1">                 
                  
                    <div class="row">   
                      <div class="col-md-3">
                        <label>Nombre Completo</label><br>
                        <?php echo trim($legajo->getNombre()); ?>
                      </div>
                      
                      <div class="col-md-3">
                        <label>N° de CUIL</label><br>
                        <?php echo trim($legajo->getCuit()); ?>
                      </div>                  
                    
                      <div class="col-md-3">                      
                        <label>Fecha de Nacimiento</label><br>
                        <?php if($legajo->getNacimiento()->format('Y-m-d')=='1900-01-01'){ ?>
                          <span class="label label-danger">NO CARGADO</span>                                           
                        <?php }else
                          { 
                            echo $legajo->getNacimiento()->format('d/m/Y');
                          } 
                        ?>
                      </div>
                      
                      <div class="col-md-3">
                        <label>Domicilio, Localidad, Provincial, CP</label><br>
                        <?php echo trim($legajo->getDireccion()); ?>
                      </div>   
                    </div>

                    <br>

                    <div class="row">   
                      <div class="col-md-3">
                        <label>Telefono Celular</label><br>
                        <?php echo trim($legajo->getCelular()); ?>
                      </div> 

                      <div class="col-md-3">
                        <label>Telefono Fijo o Telefono Alternativo</label><br>
                        <?php echo trim($legajo->getTelefono()); ?>
                      </div> 
                    
                      <div class="col-md-3">
                        <label>Estado Civil</label><br>
                        <?php echo trim($legajo->getEstadoCivil()); ?>
                      </div>
                      
                      <div class="col-md-3">
                        <label>Hijos / Cantidad / Edad</label><br>
                        <?php echo trim($legajo->getHijos()); ?>
                      </div>
                    </div>
                </div>     

                <div class="tab-pane <?php echo $solapa_2_active; ?>" id="tab_2"> 
                  
                    <div class="row">
                      <div class="col-md-3">
                        <label>Fotocopia DNI (Frente y Dorso)</label><br>
                        <?php if(empty(trim($legajo->getDniAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span>                        
                        <?php }else{ ?>
                          <a id="a_dni" href="<?php echo trim($legajo->getDniAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>  
                      
                      <div class="col-md-3">
                        <label>Constancia de CUIL</label><br>
                        <?php if(empty(trim($legajo->getCuitAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                          
                          <a id="a_cuit" href="<?php echo trim($legajo->getCuitAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>

                      <div class="col-md-3">
                        <label>Curriculum Vitae</label><br>
                        <?php if(empty(trim($legajo->getCvAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                          
                          <a id="a_cv" href="<?php echo trim($legajo->getCvAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>          
                                    
                      <div class="col-md-3">
                        <label>Comprobante CBU</label><br>
                        <?php if(empty(trim($legajo->getCbuAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>
                          <a id="a_cbu" href="<?php echo trim($legajo->getCbuAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>   
                    </div>        
                </div>                    
                <div class="tab-pane <?php echo $solapa_3_active; ?>" id="tab_3"> 
                  
                    <div class="row">
                      <div class="col-md-3">
                        <label>Licencia de Conducir (Frente)</label><br>
                        <?php if(empty(trim($legajo->getLicenciaAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                          
                          <a id="a_licencia" href="<?php echo trim($legajo->getLicenciaAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>

                      </div> 
                      <div class="col-md-3">
                        <label>Licencia de Conducir (Dorso)</label><br>
                        <?php if(empty(trim($legajo->getLicenciaAdjuntoDorso()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                          
                          <a id="a_licencia_dorso" href="<?php echo trim($legajo->getLicenciaAdjuntoDorso()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>

                      </div> 
                    </div>
                    <div class="row">                      
                      <div class="col-md-3">
                        <label>Titulo o Tarjeta Autorizante (Frente)</label><br>
                        <?php if(empty(trim($legajo->getTituloAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                         
                          <a id="a_titulo" href="<?php echo trim($legajo->getTituloAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>                       
                      <div class="col-md-3">
                        <label>Titulo o Tarjeta Autorizante (Dorso)</label><br>
                        <?php if(empty(trim($legajo->getTituloAdjuntoDorso()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                         
                          <a id="a_titulo_dorso" href="<?php echo trim($legajo->getTituloAdjuntoDorso()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>   
                    </div>
                    <div class="row">                    
                      <div class="col-md-3">
                        <label>Seguro: Poliza o Recibo</label><br>
                        <?php if(empty(trim($legajo->getSeguroAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                          
                          <a id="a_seguro" href="<?php echo trim($legajo->getSeguroAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>                    
                    </div>

                    <br>

                    <div class="row">
                      <div class="col-md-3">
                        <label>Ultimo Mantenimiento</label><br>
                        <?php if(empty(trim($legajo->getMantenimientoAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                         
                          <a id="a_mantenimiento" href="<?php echo trim($legajo->getMantenimientoAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>   

                      <div class="col-md-3">
                        <label>Cantidad de KM real del auto</label><br>
                        <?php if(empty(trim($legajo->getKmrealAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>
                          <a id="a_kmreal" href="<?php echo trim($legajo->getKmrealAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>  
                    </div>

                    <br>

                    <div class="row">                 
                      <div class="col-md-3">
                        <label>Tarjeta GNC (si tiene GNC)</label><br>
                        <?php if(empty(trim($legajo->getGncAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>                          
                          <a id="a_gnc" href="<?php echo trim($legajo->getGncAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>  
                      
                      <div class="col-md-3">
                        <label>Prueba Hidraulica (si tiene GNC)</label><br>
                        <?php if(empty(trim($legajo->getHidraulicaAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>
                          <a id="a_hidraulica" href="<?php echo trim($legajo->getHidraulicaAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>     
                    </div>                              
                </div>              
                <div class="tab-pane <?php echo $solapa_4_active; ?>" id="tab_4">                
                    <div class="row">
                      <div class="col-md-6">
                        <label>Patente</label><br>
                        <?php if(empty(trim($legajo->getPatenteAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>
                          <a id="a_patente" href="<?php echo trim($legajo->getPatenteAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>  
                        <?php } ?>
                      </div>
                      <div class="col-md-6">
                        <label>VTV</label><br>
                        <?php if(empty(trim($legajo->getVtvAdjunto()))) { ?>
                          <span class="label label-danger">NO CARGADO</span> 
                        <?php }else{ ?>
                          <a id="a_vtv" href="<?php echo trim($legajo->getVtvAdjunto()); ?>" target="_blank"> 
                            <i class="fa fa-file"></i> 
                            VER DOCUMENTO ADJUNTO
                          </a>
                        <?php } ?>
                      </div>                                                            
                    </div>
                    
                </div>

                <div class="tab-pane <?php echo $solapa_5_active; ?>" id="tab_5">                  
                    <div class="row">
                      <div class="col-md-6">                        
                        <label>Vencimiento licencia de conducir</label><br>
                        <?php if($legajo->getLicenciaVto()->format('Y-m-d')=='1900-01-01'){ ?>
                          <span class="label label-danger">NO CARGADO</span>                                           
                        <?php }else
                          { 
                            echo $legajo->getLicenciaVto()->format('d/m/Y');
                          } 
                        ?>
                      </div>
                      <div class="col-md-6">                        
                        <label>Vencimiento vtv</label><br>
                        <?php if($legajo->getVtvVto()->format('Y-m-d')=='1900-01-01'){ ?>
                          <span class="label label-danger">NO CARGADO</span>                                           
                        <?php }else
                          { 
                            echo $legajo->getVtvVto()->format('d/m/Y');
                          } 
                        ?>
                      </div>                                                                                
                    </div>                                      
                  </form>  
                </div>
                <?php
                  if($esBO){
                ?>
                  
                <div class="tab-pane <?php echo $solapa_6_active; ?>" id="tab_6">
                  <form action="<?php echo $url_action_guardar; ?>" method="post">      
                    <input type="hidden" name="etapa_legajo" value="6">   
                    <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">   
                    <input type="hidden" name="usuario" value="<?php echo $legajo->getUsuarioId()->getId(); ?>">                
                    
                    <div class="row">   
                      <div class="col-md-3">
                        <label>Numero Legajo</label>                        
                        <input type="number" name="numero_legajo" value="<?php echo trim($legajo->getNumeroLegajo()); ?>" class="form-control" required="">
                      </div>

                      <div class="col-md-3">
                        <label>Categoria</label>                        
                        <input type="text" name="categoria" value="<?php echo trim($legajo->getCategoria()); ?>" class="form-control" required="">
                      </div>
                      
                      <div class="col-md-3">
                        <label>Cantidad de Horas</label>
                        <input type="number" name="horas" value="<?php echo trim($legajo->getHoras()); ?>" class="form-control" required="">
                      </div>
                       
                      <div class="col-md-3">
                        <label>Domicilio Oficina</label>
                        <input type="text" name="oficina" value="<?php echo trim($legajo->getOficina()); ?>" class="form-control" required="">
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

                <?php
                  }
                ?>
              </div>
              
            </div>
          </div>
        </div>                
      </div>

      <div class="row">
        <div class="col-md-12">
          <form action="<?php echo $url_action_rechazar; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $legajo->getId(); ?>">
            <input type="submit" name="submit" class="btn btn-danger" value="Rechazar">
          </form>
        </div>
      </div>

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