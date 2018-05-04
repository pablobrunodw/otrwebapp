<?php
  include_once PATH_NEGOCIO."Modulos/handlerayuda.class.php";     
  include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         

  $url_action_guardar_documentos= PATH_VISTA.'Modulos/Ayuda/action_documentos.php';
  $url_action_editar_documentos = PATH_VISTA.'Modulos/Ayuda/action_documentos.php';
  $url_action_eliminar_documentos = PATH_VISTA.'Modulos/Ayuda/action_documentos.php';

  $handler = new HandlerAyuda;
  $hanlderPerfiles = new HandlerPerfiles;

  $arrDocumentos = $handler->selecionarDocumentos();
  $arrGrupos = $handler->selecionarGrupos();
  $arrRoles = $hanlderPerfiles->selectTodos();
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Documentos 
      <small>Agregar, modificar y eliminar documentos</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Documentos</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>


    <div class="row">
      <div class='col-md-12'>
        <div class="box box-solid">
            <div class="box-header with-border">    
              <i class="fa fa-edit"></i>
              <h3 class="box-title">Documentos</h3>
              <a href="#" class="btn btn-success pull-right" data-toggle='modal' data-target='#modal-nuevo'>
                  Nuevo
              </a>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Grupo</th>
                      <th>Nombre</th>
                      <th>Roles</th>
                      <th>Archivo</th>
                      <th>Link</th>
                      <th style="width: 10%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrDocumentos))
                      {                             
                        foreach ($arrDocumentos as $key => $value) {

                          if(!empty($value->getVideo()))
                            $link = "<a href='".$value->getVideo()."' class='btn btn-primary btn-xs' target='_blank'>Abrir Link</a>";
                          else
                            $link = "";

                          if(!empty($value->getArchivo()))
                            $doc = "<a href='".$value->getArchivo()."' class='btn btn-success btn-xs' target='_blank'>Abrir Documento</a>";
                          else
                            $doc = "";

                          echo "<tr>";
                            echo "<td>".$value->getId()."</td>";
                            echo "<td>".$value->getGrupo()->getNombre()."</td>";
                            echo "<td>".$value->getNombre()."</td>";
                            echo "<td>".$value->getNombreRoles()."</td>";                          
                            echo "<td>".$doc."</td>";
                            echo "<td>".$link."</td>";
                            echo "<td class='text-center'>
                                    <a href='#' id='".$value->getId()."_editar' 
                                      data-nombre='".$value->getNombre()."' 
                                      data-grupo='".$value->getGrupo()->getId()."' 
                                      data-roles='".$value->getRoles()."' 
                                      data-url='".$value->getVideo()."' 
                                      data-archivo='".$value->getArchivo()."' 
                                      class='btn btn-default btn-xs' data-toggle='modal' data-target='#modal-editar' onclick='cargarDatos(".$value->getId().")'>
                                      <i class='fa fa-edit' data-toggle='tooltip' data-original-title='Editar registro'></i>
                                      Editar
                                    </a>
                                    <a href='#' id='".$value->getId()."_eliminar' 
                                      data-nombre='".$value->getNombre()."' 
                                      class='btn btn-danger btn-xs' data-toggle='modal' data-target='#modal-eliminar' onclick='cargarDatosEliminar(".$value->getId().")'>
                                      <i class='fa fa-trash' data-toggle='tooltip' data-original-title='Eliminar registro'></i>
                                      Eliminar
                                    </a>

                                  </td>";
                          echo "</tr>";
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

<div class="modal fade in" id="modal-nuevo">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_guardar_documentos; ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-6">    
                <label>Grupo</label>               
                <select class="form-control" name="slt_grupo" id="slt_grupo" style="width: 100%">    
                  <option value=""></option>                  
                  <?php
                    if(!empty($arrGrupos)){
                      foreach ($arrGrupos as $key => $value) {
                        echo "<option value=".$value->getId().">".$value->getNombre()."</option>";
                      }
                    }                        
                  ?>  
                </select>
              </div>

              <div class="col-md-6">    
                <label>Roles</label>               
                <select class="form-control" name="slt_roles[]" id="slt_roles" style="width: 100%" multiple="multiple">    
                  <option value=""></option>                  
                  <?php
                    if(!empty($arrRoles)){
                      foreach ($arrRoles as $key => $value) {
                        echo "<option value=".$value->getId().">".$value->getNombre()."</option>";
                      }
                    }                        
                  ?>  
                </select>
              </div>

              <div class="col-md-12">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control">
              </div> 

              <div class="col-md-12">
                <label>URL</label>
                <input type="url" name="url" class="form-control">
              </div> 

              <div class="col-md-12">
                <label>Adjunto</label>
                <input type="file" name="adjunto" class="form-control">
              </div>  
                                                              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade in" id="modal-editar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_editar_documentos; ?>" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="id" id="id_editar">
        <input type="hidden" name="estado" value="EDITAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Editar</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">    
              <label>Grupo</label>               
              <select class="form-control" name="slt_grupo" id="slt_grupo_editar" style="width: 100%">    
                <option value=""></option>                  
                <?php
                  if(!empty($arrGrupos)){
                    foreach ($arrGrupos as $key => $value) {
                      echo "<option value=".$value->getId().">".$value->getNombre()."</option>";
                    }
                  }                        
                ?>  
              </select>
            </div>

            <div class="col-md-6">    
              <label>Roles</label>               
              <select class="form-control" name="slt_roles[]" id="slt_roles_editar" style="width: 100%" multiple="multiple">    
                <option value=""></option>                  
                <?php
                  if(!empty($arrRoles)){
                    foreach ($arrRoles as $key => $value) {
                      echo "<option value=".$value->getId().">".$value->getNombre()."</option>";
                    }
                  }                        
                ?>  
              </select>
            </div>

            <div class="col-md-12">
              <label>Nombre</label>
              <input type="text" name="nombre" id="nombre_editar" class="form-control">
            </div> 

            <div class="col-md-12">
              <label>URL</label>
              <input type="url" name="url" id="url_editar" class="form-control">
            </div> 

            <div class="col-md-12" id="documento_editar"> 
              <label>Adjunto</label>
              <input type="file" name="adjunto" class="form-control">
            </div> 
            
            <div class="col-md-12" id="link_documento_editar" style="margin-top: 50px;">
              <label>Adjunto</label><br>
              <a href="" target="_blank">Abrir Documento</a>
              <a onclick="eliminarDoc()" class="btn btn-danger btn-xs">
                <i class="fa fa-times-circle"></i> Quitar
              </a>
            </div> 

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade in" id="modal-eliminar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_eliminar_documentos; ?>" method="post">
        <input type="hidden" name="id" id="id_eliminar">
        <input type="hidden" name="estado" value="ELIMINAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">ELIMINAR</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <h4 id="nombre_documento_eliminar"></h6>
              <p>¿Desea eliminar el registro?</p>        
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){                
    $("#mnu_ayuda").addClass("active");
  });  

  function cargarDatos(id){
    
    nombre = document.getElementById(id+"_editar").getAttribute('data-nombre');
    url = document.getElementById(id+"_editar").getAttribute('data-url');
    grupo = document.getElementById(id+"_editar").getAttribute('data-grupo');
    roles = document.getElementById(id+"_editar").getAttribute('data-roles');
    archivo = document.getElementById(id+"_editar").getAttribute('data-archivo');

    document.getElementById("id_editar").value = id;
    document.getElementById("nombre_editar").value = nombre;
    document.getElementById("url_editar").value = url;

    if(archivo!=""){
      $("#link_documento_editar").attr('href',archivo);
      $("#link_documento_editar").show();
      $("#documento_editar").hide();
    }else{
      $("#link_documento_editar").hide();
      $("#documento_editar").show();
    }


    $("#slt_grupo_editar").select2({
        placeholder: "Seleccionar",                  
    }).select2('val', grupo);

    var valores= roles.split('|');  
    arr = $.grep(valores,function(n){
      return(n);
    });    
    $("#slt_roles_editar").select2({
        placeholder: "Seleccionar",                  
    }).select2('val', arr);
  }

  function eliminarDoc(){       
      $("#link_documento_editar").hide();
      $("#documento_editar").show();
  }

  function cargarDatosEliminar(id){
    document.getElementById("id_eliminar").value = id;
    nombre = document.getElementById(id+"_eliminar").getAttribute('data-nombre');

    $("#nombre_documento_eliminar").text(nombre);
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#slt_roles").select2({
        placeholder: "Seleccionar",                  
    });
  });  

  $(document).ready(function() {
    $("#slt_grupo").select2({
        placeholder: "Seleccionar",                  
    });
  });    

  $(document).ready(function() {
    $("#slt_roles_editar").select2({
        placeholder: "Seleccionar",                  
    });
  });  

  $(document).ready(function() {
    $("#slt_grupo_editar").select2({
        placeholder: "Seleccionar",                  
    });
  });     
</script>