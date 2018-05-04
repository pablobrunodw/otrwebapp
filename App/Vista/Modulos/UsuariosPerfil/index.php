<?php
  include_once PATH_NEGOCIO."Funciones/String/string.class.php";

	$url_action_update_perfil = PATH_VISTA.'Modulos/UsuariosPerfil/action_update_perfil.php';
  $url_password = "index.php?view=password_usuario";  
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
        <li class="active">Perfil</li>
      </ol>
    </section>        
    <!-- Main content -->
    <section class="content">

	    <?php include_once PATH_VISTA."error.php"; ?>
      <?php include_once PATH_VISTA."info.php"; ?>

  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Información personal</h3>
        </div>        
        <form action=<?php echo $url_action_update_perfil; ?> method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value=<?php echo $usuarioActivoSesion->getId();?>>          

          <div class="box-body">          
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="col-md-3">
                    <?php                        
                        if(StringUser::emptyUser($usuarioActivoSesion->getFotoPerfil()))
                          $foto_perfil = PATH_VISTA."assets/dist/img/sinlogo_usuario.png";                          
                        else
                          $foto_perfil = PATH_CLIENTE.$usuarioActivoSesion->getFotoPerfil();
                          
                    ?>
                    <img id="foto_view" src=<?php echo $foto_perfil; ?> style="width: 100%;">
                  </div>
                  <div class="col-md-9">                    
                    <label for="foto">Foto Perfil</label>
                    <input type="file" id="foto" name="foto" accept=".jpg, .png, .gif">                
                    <p class="help-block">Selecciona una imagen de perfil</p>
                  </div>
                </div>
                
                <div class="col-md-3">              
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value='<?php echo $usuarioActivoSesion->getNombre(); ?>'>
                </div>
              
                <div class="col-md-3">
                  <label for="apellido">Apellido</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido" value='<?php echo $usuarioActivoSesion->getApellido(); ?>'>
                </div>              
              
            </div>                      
                              
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right">
              <i class="fa fa-save"></i> 
              Guardar
            </button>
            <a class="btn btn-default" href=<?php echo $url_password;?>>
              <i class="fa fa-lock"></i> Cambiar Contraseña
            </a>          
          </div>          
        </form>
      </div>      
    </section>
  </div>

  <script type="text/javascript">
    function mostrarImagen(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
         $('#foto_view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
     
    $("#foto").change(function(){
      mostrarImagen(this);
    });
  </script>