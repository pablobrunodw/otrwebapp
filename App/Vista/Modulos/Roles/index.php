<?php
  include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";

  $user = $usuarioActivoSesion;

  $handlerP = new HandlerPerfiles;
  $arrPerfiles = $handlerP->selectTodos();

?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Roles
      <small>Configuracion de los tipos de usuarios de la empresa</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Roles</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-shield"></i>       
            <h3 class="box-title">Roles</h3>          
          </div>
          <div class="box-body table-responsive">
            <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Panel</th>            
                    <th>Legajos</th>                  
                    <th>Tickets</th>                  
                    <th>Licencias</th>                  
                    <!--<th>Capacitaciones</th>-->                  
                    <th>Guias</th>                  
                    <th>Inventario</th>                  
                    <th>Stock</th>                  
                    <th>Importacion</th>                                      
                    <th>Sevicios</th>                  
                    <th>Upload</th>                  
                    <th>Enviadas</th>                  
                    <th>Metricas</th>                  
                    <th>Puntajes</th>                  
                    <th>Ayuda</th>                  
                    <th>Inbox</th>                  
                    <th>Multiusuario</th> 
                    <th>Perfil</th>                  
                    <th>Usuarios</th>                  
                    <th>Roles</th>                                                          
                    <th>Configuracion</th>                                                                
                    <th>Accion</th>            
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($arrPerfiles as $key => $value) {

                    $url_edit="index.php?view=roles_edit&id=".$value->getId();

                    $mLegajo = ($value->getModuloLegajosBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mTicket = ($value->getModuloTicketsBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mLicencia = ($value->getModuloLicenciasBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    //$mCapacitaciones = ($value->getModuloCapacitacionesBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mGuias = ($value->getModuloGuiasBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mInventarios = ($value->getModuloInventariosBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mStock = ($value->getModuloStockBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mImportacion = ($value->getModuloImportacionBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mEnviadas = ($value->getModuloEnviadasBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mMetricas = ($value->getModuloMetricasBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mPuntajes = ($value->getModuloPuntajesBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mUsuarios = ($value->getModuloUsuariosBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mRoles = ($value->getModuloRolesBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mServicios = ($value->getModuloServiciosBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mUpload = ($value->getModuloUploadBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mPerfil = ($value->getModuloPerfilBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mConfiguraciones = ($value->getModuloConfiguracionBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mAyuda = ($value->getModuloAyudaBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mInbox = ($value->getModuloInboxBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mPanel = ($value->getModuloPanelBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");
                    $mMultiusuario = ($value->getModuloMultiusuarioBoolean()?"<span class='label label-success'>SI</span>":"<span class='label label-danger'>NO</span>");

                    echo "<tr>";
                    echo "<td class='text-left'>".$value->getNombre()."</td>";
                    echo "<td class='text-center'>".$mPanel."</td>";
                    echo "<td class='text-center'>".$mLegajo."</td>";
                    echo "<td class='text-center'>".$mTicket."</td>";
                    echo "<td class='text-center'>".$mLicencia."</td>";
                    //echo "<td class='text-center'>".$mCapacitaciones."</td>";
                    echo "<td class='text-center'>".$mGuias."</td>";
                    echo "<td class='text-center'>".$mInventarios."</td>";
                    echo "<td class='text-center'>".$mStock."</td>";
                    echo "<td class='text-center'>".$mImportacion."</td>";
                    echo "<td class='text-center'>".$mServicios."</td>";
                    echo "<td class='text-center'>".$mUpload."</td>";
                    echo "<td class='text-center'>".$mEnviadas."</td>";
                    echo "<td class='text-center'>".$mMetricas."</td>";
                    echo "<td class='text-center'>".$mPuntajes."</td>";
                    echo "<td class='text-center'>".$mAyuda."</td>";
                    echo "<td class='text-center'>".$mInbox."</td>";
                    echo "<td class='text-center'>".$mMultiusuario."</td>";
                    echo "<td class='text-center'>".$mPerfil."</td>";
                    echo "<td class='text-center'>".$mUsuarios."</td>";
                    echo "<td class='text-center'>".$mRoles."</td>";
                    echo "<td class='text-center'>".$mConfiguraciones."</td>";
                    echo "<td class='text-center'><a href='".$url_edit."' class='btn btn-default btn-xs'>Editar</a></td>";
                    echo "</tr>";
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

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_roles").addClass("active");
  });
</script>