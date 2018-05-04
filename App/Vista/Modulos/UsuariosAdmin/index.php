      <?php        
        include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";        
        include_once PATH_NEGOCIO."Funciones/String/string.class.php";

        $url_add = "index.php?view=usuarioABM_add";
        $url_edit = "index.php?view=usuarioABM_edit&id=";
        $url_multiuser = "index.php?view=usuarioABM_multiuser&id=";

        $handler = new HandlerUsuarios;
        $arrUsuarios = $handler->selectTodos();
      ?>
      
      <div class="content-wrapper">      
        <section class="content-header">
          <h1>
            Usuarios
            <small>Gestión de todos los usuarios con acceso a la plataforma</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>        

        <section class="content">

          <?php include_once PATH_VISTA."error.php"; ?>
          <?php include_once PATH_VISTA."info.php"; ?>

          <div class="row">
            <div class="col-xs-12">
              
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Usuario del Sistema</h3>     
                  <a href=<?php echo $url_add; ?>><button class="btn btn-success pull-right">Nuevo Usuario</button></a>
                </div>                
              </div>

              <div class="box">                
                <div class="box-body table-responsive">
                  <table class="table table-striped table-bordered" id="tabla" cellspacing="0" width="100%">
                    <thead>        
                      <tr> 
                        <th style="width: 5%;">ID</th>
                        <th style="width: 10%;">Foto de Perfil</th>
                        <th style="width: 10%;">Nombre</th>
                        <th style="width: 10%;">Apellido</th>
                        <th style="width: 15%;">Email</th>                        
                        <th style="width: 15%;">Tipo Usuario</th>                        
                        <th style="width: 15%;">Usuario Asociado</th>                        
                        <th style="width: 10%;">Perfil</th>                        

                        <th style="width: 10%;">Edición</th>                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(!empty($arrUsuarios))
                        {
                          foreach ($arrUsuarios as $key => $value) {

                            $usuario = $value;

                            if(StringUser::emptyUser($usuario->getFotoPerfil()))
                              $foto_perfil = PATH_VISTA."assets/dist/img/sinlogo_usuario.png";
                            else
                              $foto_perfil = PATH_CLIENTE.$usuario->getFotoPerfil();                            

                            echo "
                              <tr>
                                <td style='text-align: center;'>".$usuario->getId()."</td>
                                <td style='text-align: center;'><img src='".$foto_perfil."' style='width: 50px;'></td>                                
                                <td>".$usuario->getNombre()."</td>
                                <td>".$usuario->getApellido()."</td>
                                <td>".$usuario->getEmail()."</td>";

                                if(is_object($usuario->getTipoUsuario())){
                                  echo "
                                    <td>".$usuario->getTipoUsuario()->getNombre()."</td>
                                    <td>".$usuario->getUserSistema()." - ".$usuario->getAliasUserSistema()."</td>";
                                }
                                else{
                                  echo "
                                    <td></td>
                                    <td></td>";                                  
                                }

                            echo "
                                <td>".$usuario->getUsuarioPerfil()->getNombre()."</td>
                                <td>
                                  <a href='".$url_edit.$usuario->getId()."' class='btn btn-primary'><i class='fa fa-edit'></i></a>                                  
                                  <a href='".$url_multiuser.$usuario->getId()."' class='btn btn-default'><i class='fa fa-users'></i></a>                                  
                                </td>
                              </tr>                      
                            ";
                          }
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
          $("#mnu_usuariosABM").addClass("active");
        });

        $(document).ready(function() {
            $('#tabla').DataTable({
              "lengthMenu": [[-1], ["Todos"]],
              "language": {
                  "sProcessing":    "Procesando...",
                  "sLengthMenu":    "Mostrar _MENU_ registros",
                  "sZeroRecords":   "No se encontraron resultados",
                  "sEmptyTable":    "Ningún dato disponible en esta tabla",
                  "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                  "sInfoPostFix":   "",
                  "sSearch":        "Buscar:",
                  "sUrl":           "",
                  "sInfoThousands":  ",",
                  "sLoadingRecords": "Cargando...",
                  "oPaginate": {
                      "sFirst":    "Primero",
                      "sLast":    "Último",
                      "sNext":    "Siguiente",
                      "sPrevious": "Anterior"
                  },
                  "oAria": {
                      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                  }
              }
            });
        });
      </script>

