      <?php
        include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";
        
        $url_panelcontrol = "index.php?view=panelcontrol";
        $url_servicio = "index.php?view=servicio";
        $url_inbox = "index.php?view=inbox";
        $url_usuariosABM = "index.php?view=usuarioABM";  
        $url_cambiarUsuario = "index.php?view=cambiarUsuario";  
        $url_estadisticas = "index.php?view=estadisticas";
        $url_configuraciones = "index.php?view=configuraciones";
        $url_importacion = "index.php?view=importacion";
        $url_plaza_cp = "index.php?view=cp_plaza";
        $url_importacion_sin_plaza = "index.php?view=importaciones_sin_plaza";
        
        $url_ayuda = "index.php?view=ayuda";
        $url_grupo_ayuda = "index.php?view=grupo_ayuda";
        $url_documento_ayuda = "index.php?view=documento_ayuda";

        $url_legajos_carga = "index.php?view=legajos_carga";
        $url_legajos_control = "index.php?view=legajos_control";

        $url_tickets_carga = "index.php?view=tickets_carga";
        $url_tickets_control = "index.php?view=tickets_control";
        $url_tickets_aprobar = "index.php?view=tickets_aprobar";
        $url_tickets_conceptos = "index.php?view=tickets_conceptos";
        
        $url_licencias_carga = "index.php?view=licencias_carga";
        $url_licencias_control = "index.php?view=licencias_control";
        $url_tipo_licencias_abm = "index.php?view=tipo_licencias";
        
        $url_capacitaciones = "index.php?view=capacitaciones";
        
        $url_puntajes_gestor = "index.php?view=puntajes_gestor";
        $url_puntajes_general = "index.php?view=puntajes_general";

        $url_stock = "index.php?view=stock";
        $url_enviadas = "index.php?view=enviadas";
        $url_herramientas = "index.php?view=herramientas";
        $url_impresoras = "index.php?view=impresoras";
        $url_celulares = "index.php?view=celulares";
        $url_insumos = "index.php?view=insumos";
        $url_roles = "index.php?view=roles";        

        $url_exp_control = "index.php?view=exp_control";
        $url_exp_tipo_abm = "index.php?view=exp_tipo_abm";
        $url_exp_solicitud = "index.php?view=exp_solicitud";
        $url_exp_seguimiento = "index.php?view=exp_seguimiento";

        $url_guias_control = "index.php?view=guias_control";
        $url_guias_control_empresa = "index.php?view=guias_control_empresa";
        $url_guias_envios = "index.php?view=guias_envios";
        $url_guias_seguimiento = "index.php?view=guias_seguimiento";
        
        $handler = new HandlerUsuarios;
        $permiso = $handler->selectPerfil($usuarioActivoSesion->getId());                        
        $perfil =$usuarioActivoSesion->getUsuarioPerfil()->getId();
        
        $esAdmin = false;
        $esGerencia = false; 
        $esCliente = false;                            
        $esBO = false;                        
        $esCoordinador = false;                         
        $esGestor = false;
        $esIngresante = false;
        $esDesarrollo = false;

        switch ($permiso->getNombre()) {
          case "ADMINISTRADOR":
            $esAdmin = true;
            break;

          case "GERENCIA":
            $esGerencia = true;
            break;
          
          case "BACK OFFICE":
            $esBO = true;
            break;

          case "COORDINADOR":
            $esCoordinador = true;
            break;

          case "GESTOR":
            $esGestor = true;
            break;

          case "CLIENTE":
            $esCliente = true;
            break;   

          case "INGRESANTE":
            $esIngresante = true;
            break;   

          case "PRUEBA-DESA":
            $esDesarrollo = true;
            break;                                      
        }        


      ?>
      
      <aside class="main-sidebar">        
        <section class="sidebar">          
          <ul class="sidebar-menu">
                              
            <li class="header">ACCESOS</li>

            <?php
              if($permiso->getModuloPanelBoolean()){  
            ?>          
              <li class="treeview" id="mnu_panelcontrol">
                <a href=<?php echo $url_panelcontrol; ?>>
                  <i class="fa fa-dashboard"></i> <span>Panel de Control</span> </i>
                </a>              
              </li>   
            <?php 
              }
            ?>  

            <?php
              if($permiso->getModuloLegajosBoolean()){  
            ?>          
              <li class="treeview" id="mnu_legajos">
                <a href="#"><i class="fa fa-archive"></i> <span>Legajos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <?php if($esGestor || $esGerencia || $esBO || $esCoordinador || $esIngresante){ ?>
                    <li class="treeview" id="mnu_legajos_carga">
                      <a href=<?php echo $url_legajos_carga; ?>> 
                        <i class="fa fa-plus-square"></i> <span>Cargar</span> </i>
                      </a>              
                    </li>   
                  <?php } ?>

                  <?php if($esBO){ ?>
                    <li class="treeview" id="mnu_legajos_control">
                      <a href=<?php echo $url_legajos_control; ?>> 
                        <i class="fa fa-tasks"></i> <span>Control</span> </i>
                      </a>              
                    </li>   
                  <?php } ?> 
                </ul>
              </li>                 
            <?php 
              }
            ?>             

            <?php
              if($permiso->getModuloTicketsBoolean()){  
            ?>          
              <li class="treeview" id="mnu_tickets">
                <a href="#"><i class="fa fa-ticket"></i> <span>Tickets</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <?php if($esGestor || $esGerencia || $esBO || $esCoordinador || $esIngresante){ ?>           
                    <li class="treeview" id="mnu_tickets_carga">
                      <a href=<?php echo $url_tickets_carga; ?>> 
                        <i class="fa fa-plus-square"></i> <span>Cargar</span> </i>
                      </a>              
                    </li>   
                  <?php } ?>

                  <?php if($esCoordinador){ ?>   
                    <li class="treeview" id="mnu_tickets_control">
                      <a href=<?php echo $url_tickets_control; ?>> 
                        <i class="fa fa-tasks"></i> <span>Control</span> </i>
                      </a>              
                    </li>                      
                  <?php } ?>   

                  <?php if($esBO){ ?>   
                    <li class="treeview" id="mnu_tickets_aprobar">
                      <a href=<?php echo $url_tickets_aprobar; ?>> 
                        <i class="fa fa-check"></i> <span>Aprobar</span> </i>
                      </a>              
                    </li>                      
                  <?php } ?>    

                  
                  <?php if($esGerencia || $esBO || $esCoordinador){ ?>   
                    <li class="treeview" id="mnu_tickets_concepto">
                      <a href=<?php echo $url_tickets_conceptos; ?>> 
                        <i class="fa fa-edit"></i> <span>Conceptos</span> </i>
                      </a>              
                    </li>                      
                  <?php } ?>                                  
                </ul>
              </li>                               
            <?php 
              }
            ?>  

            <?php
              if($permiso->getModuloLicenciasBoolean()){    
            ?>
              <li class="treeview" id="mnu_licencias">
                <a href="#"><i class="fa fa-certificate"></i> <span>Licencias</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <?php if($esGestor || $esGerencia || $esBO || $esCoordinador || $esIngresante){ ?>
                    <li id="mnu_licencias_carga">
                      <a href=<?php echo $url_licencias_carga; ?>>
                        <i class="fa fa-plus-square"></i> <span>Generar</span>
                      </a>
                    </li>                  
                  <?php } ?>

                  <?php if($esBO || $esCoordinador){ ?>
                    <li id="mnu_licencias_control">
                      <a href=<?php echo $url_licencias_control; ?>>
                        <i class="fa fa-tasks"></i> <span>Control</span>
                      </a>
                    </li> 
                    <li id="mnu_tipo_licencias_abm">
                      <a href=<?php echo $url_tipo_licencias_abm; ?>>
                        <i class="fa fa-edit"></i> <span>Tipo Licencias</span>
                      </a>
                    </li>                                      
                  <?php } ?>

                </ul>
              </li>
            <?php 
              }
            ?>


            <?php
              if($permiso->getModuloCapacitacionesBoolean()){  
            ?>          
              <li class="treeview" id="mnu_capacitaciones">
                <a href=<?php echo $url_capacitaciones; ?>> 
                  <i class="fa fa-university"></i> <span>Capacitaciones</span> </i>
                </a>              
              </li>   
            <?php 
              }
            ?>  

            <?php
              if($permiso->getModuloPuntajesBoolean() && $esGestor){  
            ?>          
              <li class="treeview" id="mnu_puntajes">
                <a href=<?php echo $url_puntajes_gestor; ?>> 
                  <i class="fa fa-percent"></i> <span>Puntajes</span> </i>
                </a>              
              </li>   
            <?php 
              }elseif($permiso->getModuloPuntajesBoolean() && !$esGestor){
            ?>  
              <li class="treeview" id="mnu_puntajes">
                <a href=<?php echo $url_puntajes_general; ?>> 
                  <i class="fa fa-percent"></i> <span>Puntajes</span> </i>
                </a>              
              </li>
            <?php 
              }
            ?>  


            <?php
              if($permiso->getModuloServiciosBoolean()){
            ?>
              <li class="treeview" id="mnu_servicio">
                <a href=<?php echo $url_servicio; ?>>
                  <i class="fa fa-truck"></i> <span>Servicios</span> </i>
                </a>
              </li>
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloImportacionBoolean()){               
            ?>
              <li class="treeview" id="mnu_importacion">
                <a href="#"><i class="fa fa-upload"></i> <span>Importaciones</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                
                  <?php if($esCliente){ ?>
                    <li class="treeview" id="mnu_importacion">
                      <a href=<?php echo $url_importacion; ?>>
                        <i class="fa fa-file-excel-o"></i> <span>Importación por Lote</span> </i>
                      </a>              
                    </li>
                  <?php } ?>

                  <?php if($esGerencia || $esBO || $esCoordinador){ ?>            
                    <li class="treeview" id="mnu_importacion">
                      <a href=<?php echo $url_plaza_cp; ?>>
                        <i class="fa fa-map-pin"></i> <span>CP por Plaza</span> </i>
                      </a>              
                    </li>
                  <?php } ?>

                  <?php if($esGerencia || $esBO || $esCoordinador){ ?>            
                    <li class="treeview" id="mnu_importacion">
                      <a href=<?php echo $url_importacion_sin_plaza; ?>>
                        <i class="fa fa-plus-circle"></i> <span>Importacion sin Plaza</span> </i>
                      </a>              
                    </li>
                  <?php } ?>

                </ul>
              </li>
            <?php } ?>

            <?php
              if($permiso->getModuloInventariosBoolean()){    
            ?>
              <li class="treeview" id="mnu_expediciones">
                <a href="#"><i class="fa fa-check-square-o"></i> <span>Expediciones</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <?php if($esBO){ ?>
                    <li id="mnu_expediciones_control">
                      <a href=<?php echo $url_exp_control; ?>>
                        <i class="fa fa-tasks"></i> <span>Control</span>
                      </a>
                    </li>
                    <li id="mnu_expediciones_tipo_abm">
                      <a href=<?php echo $url_exp_tipo_abm; ?>>
                        <i class="fa fa-edit"></i> <span>Tipos</span>
                      </a>
                    </li>                    
                  <?php } ?>

                  <?php if($esCoordinador){ ?>
                    <li id="meu_expediciones_solicitud" >
                      <a href=<?php echo $url_exp_solicitud; ?>>
                        <i class="fa fa-plus"></i> <span>Soliitud</span>
                      </a>
                    </li>
                    <li id="mnu_expediciones_seguimiento">
                      <a href=<?php echo $url_exp_seguimiento; ?>>
                        <i class="fa fa-check"></i> <span>Seguimiento</span>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php 
              }
            ?>

            <?php if($permiso->getModuloGuiasBoolean()){ ?>
              <li class="treeview" id="mnu_guias">
                <a href="#"><i class="fa fa-bell "></i> <span>Guias y Remitos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <?php if($esBO){ ?>
                    <li id="mnu_guias_control">
                      <a href=<?php echo $url_guias_control; ?>>
                        <i class="fa fa-tasks"></i> <span>Control</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if($esCoordinador){ ?>  
                    <li id="mnu_guias_envio">
                      <a href=<?php echo $url_guias_envios; ?>>
                        <i class="fa fa-send"></i> <span>Envío</span>
                      </a>
                    </li>
                    <li id="mnu_guias_seguimiento">
                      <a href=<?php echo $url_guias_seguimiento; ?>>
                        <i class="fa fa-check"></i> <span>Seguimiento</span>
                      </a>
                    </li>
                  <?php } ?>

                  <?php if($esCliente){ ?>  
                    <li id="mnu_guias_control_empresa">
                      <a href=<?php echo $url_guias_control_empresa; ?>>
                        <i class="fa fa-tasks"></i> <span>Control</span>
                      </a>
                    </li>   
                  <?php } ?>

                </ul>
              </li>            
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloStockBoolean()){  
            ?>                        
              <li class="treeview" id="mnu_stock">
                <a href=<?php echo $url_stock; ?>>
                  <i class="fa fa-cubes"></i> <span>Stock</span> </i>
                </a>              
              </li>
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloEnviadasBoolean()){  
            ?>                        
              <li class="treeview" id="mnu_enviadas">
                <a href=<?php echo $url_enviadas; ?>>
                  <i class="fa fa-paper-plane"></i> <span>Enviadas</span> </i>
                </a>              
              </li>
            <?php 
              }
            ?>        

            <?php
              if($permiso->getModuloMetricasBoolean()){  
            ?>              
              <li class="treeview" id="mnu_estadisticas">
                <a href=<?php echo $url_estadisticas; ?>>
                  <i class="fa fa-area-chart"></i> <span>Estadisticas</span> </i>
                </a>              
              </li>
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloHerramientasBoolean()){  
            ?>              
              <li class="treeview" id="mnu_herramientas">
                <a href="#"><i class="fa fa-wrench"></i> <span>Herramientas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  
                    <li id="mnu_impresoras">
                      <a href=<?php echo $url_impresoras; ?>>
                        <i class="fa fa-book"></i> <span>Impresoras</span>
                      </a>
                    </li>
                    <li id="mnu_celulares">
                      <a href=<?php echo $url_celulares; ?>>
                        <i class="fa fa-edit"></i> <span>Celulares</span>
                      </a>
                    </li>
                  <li id="mnu_insumos">
                    <a href=<?php echo $url_insumos; ?>> 
                      <i class="fa fa-question"></i> <span>Insumos</span> </i>
                    </a>              
                  </li> 
                </ul>
              </li>
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloAyudaBoolean()){  
            ?>          
              <li class="treeview" id="mnu_ayuda">
                <a href="#"><i class="fa fa-support "></i> <span>Documentación</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <?php if($esGerencia){ ?>
                    <li id="mnu_documento_ayuda">
                      <a href=<?php echo $url_documento_ayuda; ?>>
                        <i class="fa fa-book"></i> <span>Documentos</span>
                      </a>
                    </li>
                    <li id="mnu_grupo_ayuda">
                      <a href=<?php echo $url_grupo_ayuda; ?>>
                        <i class="fa fa-edit"></i> <span>Grupos</span>
                      </a>
                    </li>                    
                  <?php } ?>

                  <li class="treeview" id="mnu_view_ayuda">
                    <a href=<?php echo $url_ayuda; ?>> 
                      <i class="fa fa-question"></i> <span>Ayuda</span> </i>
                    </a>              
                  </li> 
                </ul>
              </li>  
            <?php 
              }
            ?> 

            <?php
              if($permiso->getModuloInboxBoolean()){               
            ?>
              <li class="treeview" id="mnu_inbox">
                <a href=<?php echo $url_inbox; ?>>
                  <i class="fa fa-commenting"></i> <span>Contactar con OTR</span> </i>
                </a>              
              </li>                   
            <?php 
              }
            ?>     

            <?php
              if($permiso->getModuloMultiusuarioBoolean()){               
            ?>
              <li class="treeview" id="mnu_cambiarusuario">
                <a href=<?php echo $url_cambiarUsuario; ?>> 
                  <i class="fa fa-refresh"></i> <span>Cambiar Usuario</span> </i>
                </a>              
              </li>  
            <?php 
              }
            ?>     

            <?php              
              if($permiso->getModuloUsuariosBoolean() ||
                  $permiso->getModuloRolesBoolean() ||
                  $permiso->getModuloConfiguracionBoolean()){  
            ?>             
              <li class="header">ADMINISTRACION</li>
            <?php 
              }
            ?>     

            <?php              
              if($permiso->getModuloUsuariosBoolean()){  
            ?>             
              <li class="treeview" id="mnu_usuariosABM">
                <a href=<?php echo $url_usuariosABM; ?>>
                  <i class="fa fa-users"></i> <span>Usuarios</span> </i>
                </a>              
              </li>       
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloRolesBoolean()){  
            ?>                        
              <li class="treeview" id="mnu_roles">
                <a href=<?php echo $url_roles; ?>>
                  <i class="fa fa-shield"></i> <span>Roles</span> </i>
                </a>              
              </li>
            <?php 
              }
            ?>

            <?php
              if($permiso->getModuloConfiguracionBoolean()){  
            ?>                        
              <li class="treeview" id="mnu_configuraciones">
                <a href=<?php echo $url_configuraciones; ?>>
                  <i class="fa fa-cogs"></i> <span>Configuraciones</span> </i>
                </a>              
              </li>
            <?php 
              }
            ?>
          </ul>

        </section>        
      </aside>