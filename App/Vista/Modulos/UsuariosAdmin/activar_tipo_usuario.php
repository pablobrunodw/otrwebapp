<?php
  $url_activar=PATH_VISTA.'Modulos/UsuariosAdmin/action_activar_tipo_usuario.php'; 
?>

<div class="content-wrapper">      
  <section class="content">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="box box-primary" style="margin-top: 100px;">
          <div class="box-header">
            <h3 class="box-title">Seleccione un Usuario</h3>
          </div>          
          <div class="box-body no-padding">
            <table class="table table-condensed">
              <tbody>
                <tr>
                  <th>Tipo</th>
                  <th>Nombre</th>
                  <th style="text-align: center;">Acción</th>                
                </tr>                
                
                <?php
                  $mu = $usuarioActivoSesion->getMultiusuario();
                  
                  if(count($mu)==1)
                    $mu = array($mu);

                  if(!empty($mu))
                  {
                    foreach ($mu as $key => $value) {
                        
                      echo"
                        <tr>
                          <td>".$value->getTipoUsuario()->getNombre()."</td>
                          <td>".$value->getAliasUserSistema()."</td>
                          <td>
                            <button 
                              id='boton_activar_".$value->getId()."'                                             
                              type='button' 
                              style='width:100%;'
                              class='btn btn-primary btn-xs' 
                              data-toggle='modal' 
                              data-target='#modalActivar' 
                              data-nombre='".$value->getAliasUserSistema()."' 
                              data-tipoUsuario='".$value->getTipoUsuario()->getId()."' 
                              data-idUsuarioSistema='".$value->getUserSistema()."' 
                              data-aliasUsuarioSistema='".$value->getAliasUserSistema()."' 
                              onclick=btnActivar(".$value->getId().")>Activar</button>
                          </td>
                        </tr>";
                    }
                  }
                ?>                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4"></div>
  </section>
</div>



<script type="text/javascript">
    function btnActivar(id_registro)
    {
        var id= id_registro;        
    
        var elemento = document.querySelector('#boton_activar_'+id);        
        formActivar.id.value = id;   

        var nombre= elemento.getAttribute('data-nombre');     
        var tipo_usuario = elemento.getAttribute('data-tipoUsuario');     
        var id_usuario_sistema = elemento.getAttribute('data-idUsuarioSistema');     
        var alias_usuario_sistema = elemento.getAttribute('data-aliasUsuarioSistema');  

        formActivar.tipo_usuario.value = tipo_usuario;
        formActivar.id_usuario_sistema.value = id_usuario_sistema;
        formActivar.alias_usuario_sistema.value = alias_usuario_sistema;   

        var mensaje_activar="<p>Esta a punto de activar el usuario <b>["+nombre+"]</b><br>¿Desea Continuar?</p>";
        document.getElementById('mensaje_activar').innerHTML = mensaje_activar;      
    }

  </script>

  <div class="modal modal-primary fade" id="modalActivar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">Activar Registro</h4>
        </div>

        <form name="formActivar" id="form" method="post" action=<?php echo $url_activar; ?>>            
          <div class="modal-body">
              <div id="mensaje_activar">Se Activará el usuario seleccionado</div>
              <input type="hidden" name="usuario" value="<?php echo $usuarioActivoSesion->getId(); ?>">
              <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="">            
              <input type="hidden" name="id_usuario_sistema" id="id_usuario_sistema" value="">            
              <input type="hidden" name="alias_usuario_sistema" id="alias_usuario_sistema" value="">            
              <input type="hidden" name="id" id="id" value="">   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
            <input  type="submit" name="submit" value="Activar" class="btn btn-outline">
          </div>                                      
        </form>

      </div>
    </div>
  </div>

  <script type="text/javascript">    
    $(document).ready(function(){                
      $("#mnu_cambiarusuario").addClass("active");
    });
  </script>