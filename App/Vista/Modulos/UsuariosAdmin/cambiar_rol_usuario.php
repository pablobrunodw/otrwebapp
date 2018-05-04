<?php
  include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";

  $url_cambiar=PATH_VISTA.'Modulos/UsuariosAdmin/action_cambiar_rol_usuario.php'; 

  $handlerP = new HandlerPerfiles;
  $arrPerfiles = $handlerP->selectTodosNoAdmin();
?>

<div class="content-wrapper">      
  <section class="content">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="box box-primary" style="margin-top: 100px;">
          <div class="box-header">
            <h3 class="box-title">Seleccione un Perfil</h3>
          </div>          
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <label>Perfil</label>    

                <form action="<?php echo $url_cambiar ?>" method="post">

                  <input type="hidden" name="usuario" value="<?php echo $usuarioActivoSesion->getId(); ?>">
                  <select id="slt_perfil" class="form-control" style="width: 100%" name="slt_perfil" required="" onchange="this.form.submit()">                    
                    <option></option>
                    <?php
                      if(!empty($arrPerfiles))
                      {                        
                        foreach ($arrPerfiles as $key => $value) {
                         
                          if($usuarioActivoSesion->getUsuarioPerfil()->getId()==$value->getId())
                            echo "<option value='".$value->getId()."' selected>".$value->getNombre()."</option>";
                          else
                            echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                        }
                      }                      
                    ?>                      
                  </select> 

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
  </section>
</div>

<script type="text/javascript">    
  $(document).ready(function(){                
    $("#mnu_cambiorol").addClass("active");
  });
</script>