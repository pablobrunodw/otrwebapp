<?php
  include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php";       
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         

  $url_action_guardar_licencias = PATH_VISTA.'Modulos/Licencias/action_guardar.php';
  $url_action_editar_licencias = PATH_VISTA.'Modulos/Licencias/action_editar.php';  
  $url_action_eliminar = PATH_VISTA.'Modulos/Licencias/action_eliminar.php?id=';

  $url_action_adjuntar1 = PATH_VISTA.'Modulos/Licencias/action_adjuntar1.php';
  $url_action_adjuntar2 = PATH_VISTA.'Modulos/Licencias/action_adjuntar2.php';

  $user = $usuarioActivoSesion;

  $handler = new HandlerLicencias; 
  $arrLicencias = $handler->seleccionarLicencias($user->getId());
  $arrTipoLicencias = $handler->selecionarTipos();

?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Licencias
      <small>Licencias solicitadas por el gestor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Licencias</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>


    <div class="row">
      <div class='col-md-12'>
        <div class="box box-solid">
            <div class="box-header with-border">    
              <i class="fa fa-certificate"></i>       
              <h3 class="box-title">Licencias</h3>   
              <a href="#" class="btn btn-success pull-right" data-toggle='modal' data-target='#modal-nuevo'>
                  Nuevo
              </a>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>FECHA</th>
                      <th>TIPO LICENCIA</th>
                      <th>DESDE</th>
                      <th>HASTA</th>
                      <th>OBSERVACIONES</th>
                      <th>ADJUNTO 1</th>
                      <th>ADJUNTO 2</th>
                      <th>APROBADO</th>
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrLicencias))
                      {
                        foreach ($arrLicencias as $key => $value) {
                          
                          if($value->getAprobado()==0)
                            $estado = "<span class='label label-danger'>NO APROBADO</span>";
                          else
                            $estado = "<span class='label label-success'>APROBADO</span>";

                          echo "<tr>";
                            echo "<td>".$value->getFecha()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getTipoLicenciasId()->getNombre()."</td>";
                            echo "<td>".$value->getFechaInicio()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getFechaFin()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getObservaciones()."</td>";

                            if(!empty($value->getAdjunto1()))
                              echo "<td><a href='".$value->getAdjunto1()."' target='_blank'>VER ADJUNTO</a></td>";
                            else
                              echo "<td class='text-center'>
                                      <button 
                                        id='boton_adjunto1_".$value->getId()."'                                             
                                        type='button' 
                                        style='width:100%;'
                                        class='btn btn-default btn-xs' 
                                        data-toggle='modal' 
                                        data-target='#modal-adjuntar1'                                         
                                        onclick=btnAdjuntar1(".$value->getId().")>
                                          <i class='fa fa-paperclip' data-toggle='tooltip' data-original-title='Adjuntar'></i>
                                          Adjuntar
                                      </button>
                                    </td>";                         

                            if(!empty($value->getAdjunto2()))
                              echo "<td><a href='".$value->getAdjunto2()."' target='_blank'>VER ADJUNTO</a></td>";
                            else
                                echo "<td class='text-center'>
                                      <button 
                                        id='boton_adjunto2_".$value->getId()."'                                             
                                        type='button' 
                                        style='width:100%;'
                                        class='btn btn-default btn-xs' 
                                        data-toggle='modal' 
                                        data-target='#modal-adjuntar2'                                         
                                        onclick=btnAdjuntar2(".$value->getId().")>
                                          <i class='fa fa-paperclip' data-toggle='tooltip' data-original-title='Adjuntar'></i>
                                          Adjuntar
                                      </button>
                                    </td>"; 

                            echo "<td>".$estado."</td>";
                            if(!$value->getAprobado()){                              
                              echo "<td class='text-center'>
                                    <a href='".$url_action_eliminar.$value->getId()."' class='btn btn-danger btn-xs'>
                                      <i class='fa fa-trash' data-toggle='tooltip' data-original-title='Eliminar'></i>
                                      Eliminar
                                    </a>
                                  </td>";
                            }
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

      <form action="<?php echo $url_action_guardar_licencias; ?>" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuevo</h4>
        </div>
        <div class="modal-body">
            <div class="row">             
              <div class="col-md-12">
                <label>Tipo Licencia</label>
                <select name="tipo_licencia" class='form-control' required="">
                  <?php                  
                    if(!empty($arrTipoLicencias)){                    
                        foreach ($arrTipoLicencias as $key => $value) {
                          echo "<option value=".$value->getId().">".$value->getNombre()."</option>";
                        }                  
                    }                  
                  ?>
                </select>
              </div>              
              <div class="col-md-6">
                <label>Fecha Desde</label>
                <input type="date" name="fecha_desde" class="form-control" required="">
              </div>                               
              <div class="col-md-6">
                <label>Fecha Hasta</label>
                <input type="date" name="fecha_hasta" class="form-control" required="">
              </div>   

              <div class="col-md-6">
                <label>Adjunto 1</label>
                <input type="file" name="adjunto1" class="form-control">
              </div>  
              <div class="col-md-6">
                <label>Adjunto 2</label>
                <input type="file" name="adjunto2" class="form-control">
              </div>                              

              <div class="col-md-12">
                <label>Observaciones</label>
                <textarea class="form-control" required=""></textarea>
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

<div class="modal fade in" id="modal-adjuntar1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="formAdjuntar1" action="<?php echo $url_action_adjuntar1; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value=""> 
        <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Adjuntar</h4>
        </div>
        <div class="modal-body">
            <div class="row">

              <div class="col-md-6">
                <label>Adjunto 1</label>
                <input type="file" name="adjunto1" class="form-control">
              </div>  

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Adjuntar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="modal fade in" id="modal-adjuntar2">
  <div class="modal-dialog">
    <div class="modal-content">

      <form id="formAdjuntar2" action="<?php echo $url_action_adjuntar2; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value=""> 
        <input type="hidden" name="usuario" value="<?php echo $user->getId(); ?>">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Adjuntar</h4>
        </div>
        <div class="modal-body">
            <div class="row">

              <div class="col-md-6">
                <label>Adjunto 2</label>
                <input type="file" name="adjunto2" class="form-control">
              </div>  

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Adjuntar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){                
    $("#mnu_licencias_abm").addClass("active");
  });

  function cargarDatos(id){
    
    grupo = document.getElementById(id+"_editar").getAttribute('data-grupo');
    nombre = document.getElementById(id+"_editar").getAttribute('data-nombre');

    document.getElementById("id_tipo_edicion").value = id;
    document.getElementById("grupo_tipo_edicion").value = grupo;
    document.getElementById("nombre_tipo_edicion").value = nombre;
  }
</script>
<script type="text/javascript">
  function btnAdjuntar1(id_registro)
  {
      var id= id_registro;        
  
      var elemento = document.querySelector('#boton_adjuntar1_'+id);        
      formAdjuntar1.id.value = id;   
  }
  function btnAdjuntar2(id_registro)
  {
      var id= id_registro;        
  
      var elemento = document.querySelector('#boton_adjuntar2_'+id);        
      formAdjuntar2.id.value = id;   
  }
</script>