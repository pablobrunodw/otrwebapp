<?php
  include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";

  $url_volver = "?view=roles";
  $url_update = PATH_VISTA.'Modulos/Roles/action_edit_roles.php'; 
  $id = (isset($_GET["id"])?$_GET["id"]:"");

  $handlerP = new HandlerPerfiles;
  $perfil = $handlerP->selectById($id);
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Roles
      <small>Edición del Rol</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li>Roles</li>
      <li class="active"><?php echo $perfil->getNombre(); ?></li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <?php
      //echo ($perfil->getModuloPanelBoolean()?'checked':'');
      //exit();
    ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-shield"></i>       
            <h3 class="box-title">Edición del Rol <?php echo $perfil->getNombre(); ?></h3>          
          </div>

          <form action=<?php echo $url_update; ?> method="post">
            <input type="hidden" name="id" value=<?php echo $perfil->getId();?>>       
            <input type="hidden" name="nombre" value=<?php echo $perfil->getNombre();?>>       

            <div class="box-body">
              <div class="row">

                <div class="col-md-3">
                  <div class="box box-primary">
                    <div class="box-header with-border">                         
                      <h3 class="box-title">Generales</h3>          
                    </div>
                    <div class="box-body">
                      <div class="row">

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_panel" <?php echo ($perfil->getModuloPanelBoolean()?'checked':''); ?>> <b>Panel</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_metricas" <?php echo ($perfil->getModuloMetricasBoolean()?'checked':''); ?>> <b>Metricas</b>
                        </div>                        

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_multiusuario" <?php echo ($perfil->getModuloMultiusuarioBoolean()?'checked':''); ?>> <b>Multiusuario</b>
                        </div>                        

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_ayuda" <?php echo ($perfil->getModuloAyudaBoolean()?'checked':''); ?>> <b>Ayuda</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_inbox" <?php echo ($perfil->getModuloInboxBoolean()?'checked':''); ?>> <b>Inbox</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_usuarios" <?php echo ($perfil->getModuloUsuariosBoolean()?'checked':''); ?>> <b>Usuarios</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_roles" <?php echo ($perfil->getModuloRolesBoolean()?'checked':''); ?>> <b>Roles</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_configuraciones" <?php echo ($perfil->getModuloConfiguracionBoolean()?'checked':''); ?>> <b>Configuracion</b>
                        </div>       
                
                        <div class="col-md-12">
                          <input type="checkbox" name="chk_perfil" <?php echo ($perfil->getModuloPerfilBoolean()?'checked':''); ?>> <b>Perfil</b>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="box box-primary">
                    <div class="box-header with-border">                         
                      <h3 class="box-title">Gestor</h3>          
                    </div>
                    <div class="box-body">
                      <div class="row">

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_legajos" <?php echo ($perfil->getModuloLegajosBoolean()?'checked':''); ?>> <b>Legajos</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_tickets" <?php echo ($perfil->getModuloTicketsBoolean()?'checked':''); ?>> <b>Tickets</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_licencias" <?php echo ($perfil->getModuloLicenciasBoolean()?'checked':''); ?>> <b>Licencias</b>
                        </div>
                  
                        <!--
                        <div class="col-md-12"> 
                          <input type="checkbox" name="chk_capacitaciones" <?php echo ($perfil->getModuloCapacitacionesBoolean()?'checked':''); ?>> <b>Capacitaciones</b>
                        </div>
                        -->
                        
                        <div class="col-md-12">
                          <input type="checkbox" name="chk_puntajes" <?php echo ($perfil->getModuloPuntajesBoolean()?'checked':''); ?>> <b>Puntajes</b>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="box box-primary">
                    <div class="box-header with-border">                         
                      <h3 class="box-title">Clientes</h3>          
                    </div>
                    <div class="box-body">
                      <div class="row">

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_servicios" <?php echo ($perfil->getModuloServiciosBoolean()?'checked':''); ?>> <b>Sevicios</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_upload" <?php echo ($perfil->getModuloUploadBoolean()?'checked':''); ?>> <b>Upload</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_importacion" <?php echo ($perfil->getModuloImportacionBoolean()?'checked':''); ?>> <b>Importacion</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_enviadas" <?php echo ($perfil->getModuloEnviadasBoolean()?'checked':''); ?>> <b>Enviadas</b>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="box box-primary">
                    <div class="box-header with-border">                         
                      <h3 class="box-title">Coordinador</h3>          
                    </div>
                    <div class="box-body">
                      <div class="row">

                        <div class="col-md-12">  
                          <input type="checkbox" name="chk_guias" <?php echo ($perfil->getModuloGuiasBoolean()?'checked':''); ?>> <b>Guias</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_inventario" <?php echo ($perfil->getModuloInventariosBoolean()?'checked':''); ?>> <b>Inventario</b>
                        </div>

                        <div class="col-md-12">
                          <input type="checkbox" name="chk_stock" <?php echo ($perfil->getModuloStockBoolean()?'checked':''); ?>> <b>Stock</b>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                
              </div>            
            </div>
            <div class="box-footer">
              <a href='<?php echo $url_volver; ?>' class="pull-left btn btn-default"><i class="fa fa-chevron-left"></i> Volver</a>
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar</button>                        
            </div> 

          </form>

        </div>
      </div>                
    </div> 
  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_roles").addClass("active");
  });
</script>