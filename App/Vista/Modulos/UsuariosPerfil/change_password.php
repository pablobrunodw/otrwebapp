<?php
  $url_action_update_password = PATH_VISTA.'Modulos/UsuariosPerfil/action_update_password.php';

  $url_perfil = "index.php?view=perfil_usuario";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil
        <small>Actualiza la información de tu cuenta</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Inicio</li>
        <li>Perfil</li>
        <li class="active">Contraseña</li>
      </ol>
    </section>        
    <!-- Main content -->
    <section class="content">

      <?php include_once PATH_VISTA."error.php"; ?>
      <?php include_once PATH_VISTA."info.php"; ?>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Modificar contraseña</h3>
        </div>        
        <form action=<?php echo $url_action_update_password; ?> method="post"> 
          <input type="hidden" name="id" value=<?php echo $usuarioActivoSesion->getId();?>>          
          
          <div class="box-body">          
            <div class="form-group">
              <div class="row">                                  
                <div class="col-md-6">
                  <div class="callout callout-info">
                    <h4>A tener en cuenta!</h4>
                    <p>Escriba su nueva contraseña.<br>No puede usar una contraseña en blanco.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="password">Nueva contraseña</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu nueva contraseña">                
                </div>
              </div>
            </div>   
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right">
              Cambiar contraseña
            </button>
            <a class="btn btn-default" href=<?php echo $url_perfil;?>>
              <i class="fa fa-user"></i> Actualizar mi perfil
            </a>
          </div>
        </form>      
      </div>
      
    </section>
  </div>