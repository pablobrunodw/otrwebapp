<?php
  include_once PATH_NEGOCIO."Modulos/handlerayuda.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         

  $url_action_guardar_grupo = PATH_VISTA.'Modulos/Ayuda/action_grupo.php';
  $url_action_editar_grupo = PATH_VISTA.'Modulos/Ayuda/action_grupo.php';

  $handler = new HandlerAyuda;
  $arrGrupo = $handler->selecionarGrupos();

?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Grupos de ayuda
      <small>Agregar, modificar y eliminar los grupo de ayuda</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Grupos de Ayuda</li>
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
              <h3 class="box-title">Grupo de Ayuda</h3>
              <a href="#" class="btn btn-success pull-right" data-toggle='modal' data-target='#modal-nuevo'>
                  Nuevo
              </a>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrGrupo))
                      {                             
                        foreach ($arrGrupo as $key => $value) {

                          echo "<tr>";
                            echo "<td>".$value->getId()."</td>";
                            echo "<td>".$value->getNombre()."</td>";
                            echo "<td class='text-center'>
                                    <a href='#' id='".$value->getId()."_editar' data-nombre='".$value->getNombre()."' class='btn btn-default btn-xs' data-toggle='modal' data-target='#modal-editar' onclick='cargarDatos(".$value->getId().")'>
                                      <i class='fa fa-edit' data-toggle='tooltip' data-original-title='Editar registro'></i>
                                      Editar
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

      <form action="<?php echo $url_action_guardar_grupo; ?>" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control">
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

      <form action="<?php echo $url_action_editar_grupo; ?>" method="post">
        <input type="hidden" name="id" id="id_grupo_edicion">
        <input type="hidden" name="estado" value="EDITAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Editar</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control" id="nombre_edicion">
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

<script type="text/javascript">
  $(document).ready(function(){                
    $("#mnu_ayuda").addClass("active");
  });  

  function cargarDatos(id){
    
    nombre = document.getElementById(id+"_editar").getAttribute('data-nombre');

    document.getElementById("id_grupo_edicion").value = id;
    document.getElementById("nombre_edicion").value = nombre;
  }
</script>
