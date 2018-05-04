<?php
  include_once PATH_NEGOCIO."Funciones/String/string.class.php";
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";	
  include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";   

  $url_add = PATH_VISTA.'Modulos/UsuariosAdmin/action_add_usuario.php';    

  $handlerTU = new HandlerTipoUsuarios;
  $arrTipoUser = $handlerTU->selectTodos();

  $handlerSistema = new HandlerSistema;
  $arrEmpresa = $handlerSistema->selectAllEmpresa();
  $arrGerente = $handlerSistema->selectAllGerente();
  $arrGestor = $handlerSistema->selectAllGestor(null);
  $arrCoordinador = $handlerSistema->selectAllCoordinador(null);
  $arrOperador = $handlerSistema->selectAllOperador();

  $handlerP = new HandlerPerfiles;
  $arrPerfiles = $handlerP->selectTodosNoAdmin();
?>

  <div class="content-wrapper">    
    <section class="content-header">
      <h1>
        Usuario
        <small>Nuevo </small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Inicio</li>
        <li>Usuario</li>
        <li class="active">Nuevo</li>
      </ol>
    </section>            
    <section class="content">

	    <?php include_once PATH_VISTA."error.php"; ?>
      <?php include_once PATH_VISTA."info.php"; ?>

  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Nuevo Usuario</h3>
        </div>        
        <form action=<?php echo $url_add; ?> method="post" enctype="multipart/form-data">          
          <div class="box-body">          
            <div class="form-group">

              <div class="row">

                <div class="col-md-6">
                  <div class="col-md-6">              
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value=''>
                  </div>
                
                  <div class="col-md-6">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido" value=''>
                  </div>

                  <div class="col-md-6" style="margin-top: 20px;">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa un email" value=''>
                  </div>

                  <div class="col-md-6" style="margin-top: 20px;">
                    <label for="passwords">Contraseña</label>
                    <input type="password" class="form-control" id="passwords" name="password" placeholder="Ingresa la contraseña" value=''>
                  </div>

                  <div class="col-md-12" style="margin-top: 20px;">  
                    <label>Perfil</label>                          
                    <select id="slt_perfil" class="form-control" style="width: 100%" name="slt_perfil" required="">                    
                      <option></option>
                      <?php
                        if(!empty($arrPerfiles))
                        {                        
                          foreach ($arrPerfiles as $key => $value) {
                            echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                          }
                        }                      
                      ?>                      
                    </select>                  
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="col-md-3">
                    <?php                                                
                      $foto_perfil = PATH_VISTA."assets/dist/img/sinlogo_usuario.png";
                    ?>
                    <img id="foto_view" src=<?php echo $foto_perfil; ?> style="width: 100%;">
                  </div>
                  <div class="col-md-9">                    
                    <label for="foto">Foto Perfil</label>
                    <input type="file" id="foto" name="foto" accept=".jpg, .png, .gif">                
                    <p class="help-block">Selecciona una imagen de perfil</p>
                  </div>
                </div>

              </div>                             
            </div>                                                  
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-success pull-right">
              <i class="fa fa-save"></i> 
              Guardar
            </button>            
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

    $(document).ready(function() {
      $("#slt_tipoUsuario").select2({
          placeholder: "Seleccionar un Tipo de Usuario",                  
      });

      $("#slt_empresa").select2({
          placeholder: "Seleccionar Empresa",                  
      });

      $("#slt_gerente").select2({
          placeholder: "Seleccionar Gerente",                  
      });

      $("#slt_gestor").select2({
          placeholder: "Seleccionar Gestor",                  
      });

      $("#slt_coordinador").select2({
          placeholder: "Seleccionar Coordinador",                  
      });

      $("#slt_operador").select2({
          placeholder: "Seleccionar Operador",                  
      });                     
    });


    $("#parent_slt_empresa").hide();
    $("#parent_slt_gerente").hide();
    $("#parent_slt_gestor").hide();
    $("#parent_slt_coordinador").hide();
    $("#parent_slt_operador").hide();

    function mostrarSelector(option){
      
      switch(option.value) {
        case "1":
          $("#parent_slt_empresa").show();
          $("#parent_slt_gerente").hide();
          $("#parent_slt_gestor").hide();
          $("#parent_slt_coordinador").hide();
          $("#parent_slt_operador").hide();
          break;
        case "2":
          $("#parent_slt_empresa").hide();
          $("#parent_slt_gerente").show();
          $("#parent_slt_gestor").hide();
          $("#parent_slt_coordinador").hide();
          $("#parent_slt_operador").hide();
          break;
        case "3":
          $("#parent_slt_empresa").hide();
          $("#parent_slt_gerente").hide();
          $("#parent_slt_gestor").show();
          $("#parent_slt_coordinador").hide();
          $("#parent_slt_operador").hide();
          break;
        case "4":
          $("#parent_slt_empresa").hide();
          $("#parent_slt_gerente").hide();
          $("#parent_slt_gestor").hide();
          $("#parent_slt_coordinador").show();
          $("#parent_slt_operador").hide();
          break;
        case "5":
          $("#parent_slt_empresa").hide();
          $("#parent_slt_gerente").hide();
          $("#parent_slt_gestor").hide();
          $("#parent_slt_coordinador").hide();
          $("#parent_slt_operador").show();
          break;
      }    
    }

  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#slt_perfil").select2({
          placeholder: "Seleccionar",                  
      });
    });    
  </script>