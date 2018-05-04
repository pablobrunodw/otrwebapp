<?php
  include_once PATH_NEGOCIO."Importacion/handlerplazacp.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";     

  $url_action_guardar_cp = PATH_VISTA.'Modulos/Importacion/action_cp_abm.php';
  $url_action_editar_cp = PATH_VISTA.'Modulos/Importacion/action_cp_abm.php';
  $url_action_eliminar_cp = PATH_VISTA.'Modulos/Importacion/action_cp_abm.php';

  $fplazas= (isset($_GET["fplazas"])?$_GET["fplazas"]:'');

  $handler = new HandlerPlazaCP;
  $arrCP = $handler->selecionarCpByPlaza($fplazas);

  $handlerSist = new HandlerSistema; 
  $arrPlaza = $handlerSist->selectAllPlazas();
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Codigo Postales
      <small>Asignación de Codigos Postales por plazas</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Codigos Postales</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>


    <div class="row">
      <div class='col-md-12'>
        <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-filter"></i>
              <h3 class="box-title">Filtros Disponibles</h3>
              <button type="button" class="btn btn-box-tool pull-right bg-red" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            <div class="box-body">
              <div class='row'>  

                <div class="col-md-3">
                  <label>Plazas </label>      

                  <select id="slt_plazas" class="form-control" style="width: 100%" name="slt_plazas" onchange="crearHref()"">            
                    <option value=''></option>
                    <option value='0'>TODAS</option>
                    <?php
                      if(!empty($arrPlaza))
                      {                        
                        foreach ($arrPlaza as $key => $value) {                                                                                  
                            
                          if($value->ALIAS == $fplazas)
                            echo "<option value='".trim($value->ALIAS)."' selected>".$value->PLAZA."</option>";
                          else
                            echo "<option value='".trim($value->ALIAS)."'>".$value->PLAZA."</option>";
                          
                        }
                      }                      
                    ?>                    
                  </select>
                </div>    
                
                <div class='col-md-3 col-md-offset-6'>                
                  <label></label>                
                  <a class="btn btn-block btn-success" id="filtro_reporte" onclick="crearHref()"><i class='fa fa-filter'></i> Filtrar</a>
                </div>
              </div>
            </div>
        </div>
      </div>  

      <div class='col-md-12'>
        <div class="box box-solid">
            <div class="box-header with-border">    
              <i class="fa fa-edit"></i>
              <h3 class="box-title">Codigos Postales</h3>
              <a href="#" class="btn btn-success pull-right" data-toggle='modal' data-target='#modal-nuevo'>
                  Nuevo
              </a>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>CP</th>
                      <th>Nombre</th>
                      <th>Plaza</th>
                      <th style="width: 3%;" class='text-center'></th>
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrCP))
                      {                             
                        foreach ($arrCP as $key => $value) {

                          echo "<tr>";
                            echo "<td>".$value->getCP()."</td>";
                            echo "<td>".$value->getCPNombre()."</td>";
                            echo "<td>".$handlerSist->getPlazaByCordinador($value->getPlaza())[0]->ALIAS."</td>";
                            echo "<td class='text-center'>
                                    <a href='#' id='".$value->getId()."_editar' data-cp='".$value->getCP()."' data-cpnombre='".$value->getCPNombre()."' data-plaza='".$value->getPlaza()."' class='btn btn-default btn-xs' data-toggle='modal' data-target='#modal-editar' onclick='cargarDatos(".$value->getId().")'>
                                      <i class='fa fa-edit' data-toggle='tooltip' data-original-title='Editar registro'></i>
                                      Editar
                                    </a>
                                  </td>";
                            echo "<td class='text-center'>
                                    <a href='#' id='".$value->getId()."_eliminar' data-toggle='modal' data-target='#modal-eliminar' class='btn btn-danger btn-xs' onclick='eliminar(".$value->getId().")'>
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

      <form action="<?php echo $url_action_guardar_cp; ?>" method="post">
        <input type="hidden" name="estado" value="NUEVO">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                  <label>CP</label>
                  <input type="text" name="cp" class="form-control">
                </div>              
                <div class="col-md-8">
                  <label>Nombre</label>
                  <input type="text" name="cp_nombre" class="form-control">
                </div>
                <div class="col-md-12">
                  <label>Plaza</label>
                  <select class="form-control" style="width: 100%" name="plaza" id="plaza_nuevo">                              
                      <option value=''></option>
                      <option value='0'>TODAS</option>
                      <?php
                        if(!empty($arrPlaza))
                        {                        
                          foreach ($arrPlaza as $key => $value) {                                                                                  
                              echo "<option value='".trim($value->ALIAS)."'>".$value->PLAZA."</option>";
                          }
                        }                      
                      ?>
                  </select>
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

      <form action="<?php echo $url_action_editar_cp; ?>" method="post">
        <input type="hidden" name="id" id="id_cp_editar">
        <input type="hidden" name="estado" value="EDITAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Editar</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                  <label>CP</label>
                  <input type="text" name="cp" class="form-control" id="cp_editar">
                </div>              
                <div class="col-md-8">
                  <label>Nombre</label>
                  <input type="text" name="cp_nombre" class="form-control" id="cpnombre_editar">
                </div>
                <div class="col-md-12">
                  <label>Plaza</label>                        
                  <select id="plaza_editar" class="form-control" style="width: 100%" name="plaza">                              
                      <option value=''></option>
                      <option value='0'>TODAS</option>
                      <?php
                        if(!empty($arrPlaza))
                        {                        
                          foreach ($arrPlaza as $key => $value) {                                                                                  
                              echo "<option value='".trim($value->ALIAS)."'>".$value->PLAZA."</option>";
                          }
                        }                      
                      ?>
                  </select>                                           
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

      <form action="<?php echo $url_action_eliminar_cp; ?>" method="post">
        <input type="hidden" name="id" id="id_cp_eliminar">
        <input type="hidden" name="estado" value="ELIMINAR">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">ELIMINAR</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <p>Se eliminará el regisro. ¿Desea continuar?</p>
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
    $("#mnu_importacion").addClass("active");
  }); 

  function cargarDatos(id){
    
    cp = document.getElementById(id+"_editar").getAttribute('data-cp');
    cpnombre = document.getElementById(id+"_editar").getAttribute('data-cpnombre');
    plaza = document.getElementById(id+"_editar").getAttribute('data-plaza');

    document.getElementById("id_cp_editar").value = id;
    document.getElementById("cp_editar").value = cp;
    document.getElementById("cpnombre_editar").value = cpnombre;
    $("#plaza_editar").val(plaza).trigger("change");
  }

  function eliminar(id){
    document.getElementById("id_cp_eliminar").value = id;
  }

  $(document).ready(function() {
    
    $("#plaza_nuevo").select2({
        placeholder: "Seleccionar",                  
    });
    $("#plaza_editar").select2({
        placeholder: "Seleccionar",                  
    });
    $("#slt_plazas").select2({
        placeholder: "Seleccionar",                  
    });
  });    
</script>

<script type="text/javascript">
  crearHref();
  function crearHref()
  {
      f_plazas = $("#slt_plazas").val();     
      
      url_filtro_reporte="index.php?view=cp_plaza";

      if(f_plazas!=undefined)
        url_filtro_reporte= url_filtro_reporte + "&fplazas="+f_plazas;
      
      
      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 
</script>