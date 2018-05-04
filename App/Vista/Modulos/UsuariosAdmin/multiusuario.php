<?php
  include_once PATH_NEGOCIO."Funciones/String/string.class.php";
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php";
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";	
  include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php"; 
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php"; 


  $url_add = PATH_VISTA.'Modulos/UsuariosAdmin/action_add_multiusuario.php';  
  $url_delete = PATH_VISTA.'Modulos/UsuariosAdmin/action_delete_multiusuario.php';  
  $url_volver = "?view=usuarioABM";

  $id = (isset($_GET["id"])?$_GET["id"]:"");

  $user=null;
  if(!empty($id)){
    $handler = new HandlerUsuarios;
    $user = $handler->selectById($id);
  }

  $handlerTU = new HandlerTipoUsuarios;
  $arrTipoUser = $handlerTU->selectTodos();

  $handlerSistema = new HandlerSistema;
  $arrEmpresa = $handlerSistema->selectAllEmpresa();
  $arrGerente = $handlerSistema->selectAllGerente();
  $arrCoordinador = $handlerSistema->selectAllCoordinador(null);
  $arrGestor = $handlerSistema->selectAllGestor(null);  
  $arrOperador = $handlerSistema->selectAllOperador();

  $arrEmpresaArray = $handlerSistema->selectAllEmpresaReturnArray();
?>

  <div class="content-wrapper">    
    <section class="content-header">
      <h1>
        Multiusuario
        <small>Edición </small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Inicio</li>
        <li>Usuario</li>
        <li class="active">Multiusuario</li>
      </ol>
    </section>            
    <section class="content">

	    <?php include_once PATH_VISTA."error.php"; ?>
      <?php include_once PATH_VISTA."info.php"; ?>

  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Multiusuario</h3>
        </div>        
                  
          <div class="box-body">          
            <div class="form-group">

              <div class="row">
                <div class="col-md-3">  
                  <div class="col-md-12" style="margin-bottom: 10px;">
                    <div class="col-md-4">
                      <?php                        
                          if(StringUser::emptyUser($user->getFotoPerfil()))
                            $foto_perfil = PATH_VISTA."assets/dist/img/sinlogo_usuario.png";                          
                          else
                            $foto_perfil = PATH_CLIENTE.$user->getFotoPerfil();
                            
                      ?>
                      <img id="foto_view" src=<?php echo $foto_perfil; ?> style="width: 100px;">
                    </div>          
                    <div class="col-md-8">                    
                      <div class="col-md-12">                    
                        <?php 
                          if($user->getUsuarioPerfil()->getId()==1)
                            $inputAdmin = "Administrador";
                          else
                            $inputAdmin = "Usuario";
                        ?>                                  
                        <span class="label bg-primary"><?php echo $inputAdmin; ?></span>                                        
                      </div>                                    
                      <div class="col-md-12">                                  
                        <h4><?php echo $user->getNombre()." ".$user->getApellido(); ?></h4>                      
                      </div>                                                      
                    </div>  
                  </div>
                  <div clas="col-md-12" style="text-align: center;">
                    <b>Usuario activo:</b>
                    <?php 
                      if(is_object($user->getTipoUsuario()))
                        echo "<span class='text-blue' style='padding: 3px;'><b>".$user->getTipoUsuario()->getNombre()." - ".$user->getAliasUserSistema()."</b></span>";                                                                                       
                    ?>
                  </div>         
                </div>
                                        
                         
                <div class="col-md-9">

                  <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <i class="fa fa-users"></i>
                        <h3 class="box-title">Multiusuarios</h3>
                      </div>
                      
                      <div class="box-body">   
                        <form action="<?php echo $url_add; ?>" method="post">   
                          <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">
                          <div class="col-md-5">
                            <label for="tipousuario">Tipo Usuario</label>                  
                            <select id="slt_tipoUsuario" class="form-control" style="width: 100%" name="slt_tipousuario" onchange="mostrarSelector(this.options[this.selectedIndex])">                    
                              <option></option>
                              <?php
                                if(!empty($arrTipoUser))
                                {                        
                                  foreach ($arrTipoUser as $key => $value) {
                                    echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";
                                  }
                                }                      
                              ?>
                            </select>
                          </div>              
                          <div class="col-md-5">
                            <label for="apellido">Usuario Sistema</label>

                            <div id="parent_slt_empresa">
                              <select id="slt_empresa" class="form-control" style="width: 100%" name="slt_empresa">                    
                                <option></option>
                                <?php
                                  if(!empty($arrEmpresa))
                                  {                        
                                    foreach ($arrEmpresa as $key => $value) {                                                  
                                      echo "<option value='".$value->EMPTT11_CODIGO."'>".$value->EMPTT21_NOMBREFA."</option>";
                                    }
                                  }                      
                                ?>
                              </select>
                            </div>

                            <div id="parent_slt_gerente">
                              <select id="slt_gerente" class="form-control" style="width: 100%" name="slt_gerente">                    
                                <option></option>
                                <?php
                                  if(!empty($arrGerente))
                                  {                        
                                    foreach ($arrGerente as $key => $value) {                                                  
                                      echo "<option value='".$value->GTE11_ALIAS."'>".$value->GTE11_ALIAS."</option>";
                                    }
                                  }                      
                                ?>
                              </select>
                            </div>

                            <div id="parent_slt_gestor">
                              <select id="slt_gestor" class="form-control" style="width: 100%" name="slt_gestor"> 
                                <option></option>
                                <?php
                                  if(!empty($arrGestor))
                                  {                        
                                    foreach ($arrGestor as $key => $value) {                                                  
                                      echo "<option value='".$value->GESTOR11_CODIGO."'>".$value->GESTOR21_ALIAS."</option>";
                                    }
                                  }                      
                                ?>
                              </select>
                            </div>

                            <div id="parent_slt_coordinador">
                              <select id="slt_coordinador" class="form-control" style="width: 100%" name="slt_coordinador">                    
                                <option></option>
                                <?php
                                  if(!empty($arrCoordinador))
                                  {                        
                                    foreach ($arrCoordinador as $key => $value) {                                                  
                                      echo "<option value='".$value->CORDI11_ALIAS."'>".$value->CORDI11_ALIAS."</option>";
                                    }
                                  }                      
                                ?>
                              </select>
                            </div>
                            
                            <div id="parent_slt_operador">
                              <select id="slt_operador" class="form-control" style="width: 100%" name="slt_operador">
                                <option></option>
                                <?php
                                  if(!empty($arrOperador))
                                  {                        
                                    foreach ($arrOperador as $key => $value) {                                                  
                                      echo "<option value='".$value->OPERA11_ALIAS."'>".$value->OPERA11_ALIAS."</option>";
                                    }
                                  }                      
                                ?>
                              </select>
                            </div>
                          </div> 
                          <div class="col-md-2">                        
                            <input type="submit" class="btn btn-primary" style="margin-top: 20px;" value="Agregar">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="box box-success">
                      <div class="box-header">
                        <h3 class="box-title">Usuarios asignados</h3>
                      </div>
                      
                      <div class="box-body no-padding">
                        <table class="table table-striped">
                          <tbody>
                            <tr>                              
                              <th>Estado</th>                            
                              <th>Tipo</th>
                              <th>ID</th>
                              <th>Alias</th>
                              <th>Acción</th>
                            </tr>
                            <?php
                                $mu = $user->getMultiusuario();                               
                                
                                if(count($mu)==1)
                                  $mu = array($mu);

                                if(!empty($mu))
                                {
                                  foreach($mu as $key => $value) {

                                    $classActivo="bg-yellow";
                                    $strActivo="Inactivo";

                                    if(is_object($user->getTipoUsuario())){
                                      if(($value->getTipoUsuario()->getNombre()==$user->getTipoUsuario()->getNombre()) && 
                                        ($value->getUserSistema()==$user->getUserSistema()) &&
                                        ($value->getAliasUserSistema()==$user->getAliasUserSistema())){

                                        $classActivo="bg-green";
                                        $strActivo="Activo";
                                      }
                                    }
                                    
                                    if($value->getTipoUsuario()->getId()==1){                                      
                                      $fa = new FuncionesArray;                                    
                                      $nomFantacia = $fa->select($arrEmpresaArray,"EMPTT11_CODIGO",$value->getUserSistema());
                                      $nomFantacia = $nomFantacia["EMPTT21_NOMBREFA"]. " - ";
                                    }else{
                                      $nomFantacia = "";
                                    }

                                    echo "
                                      <tr>
                                        <td><span class='badge ".$classActivo."'>".$strActivo."</span></td>
                                        <td>".$value->getTipoUsuario()->getNombre()."</td>                              
                                        <td>".$value->getUserSistema()."</td>                              
                                        <td>".$nomFantacia.$value->getAliasUserSistema()."</td>
                                        <td>
                                          <button 
                                            id='boton_eliminar_".$value->getId()."'                                             
                                            type='button' class='btn btn-danger btn-xs' 
                                            data-toggle='modal' 
                                            data-target='#modalEliminar' 
                                            onclick=btnEliminar(".$value->getId().")>Quitar</button>
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
                </div>                             
              </div>

            </div>                                                  
          </div>

          <div class="box-footer">
            <a href='<?php echo $url_volver; ?>' class="pull-left btn btn-default"><i class="fa fa-chevron-left"></i> Volver</a>
          </div>          
        
      </div>      
      
    </section>
  </div>

<div class="modal modal-danger fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
      </div>

      <form name="formEliminar" id="form" method="post" action=<?php echo $url_delete; ?>>
        
      
        <div class="modal-body">
            <div id="mensaje_eliminar">Se eliminará el registro seleccionado</div>
            <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">            
            <input type="hidden" name="id" id="id" value="">   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
          <input  type="submit" name="submit" value="Eliminar" class="btn btn-outline">
        </div>                                      
      </form>

    </div>
  </div>
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

    function btnEliminar(id_registro)
    {
        var id= id_registro;        
    
        var elemento = document.querySelector('#boton_eliminar_'+id);        
        formEliminar.id.value = id;            
    }

        $(document).ready(function(){                
          $("#mnu_usuariosABM").addClass("active");
        });

  </script>

