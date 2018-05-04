<?php
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";     

  $url_action_eliminar = PATH_VISTA.'Modulos/Importacion/action_eliminar.php';

  $dFecha = new Fechas;

  $impo= (isset($_GET['importacion_id'])? $_GET['importacion_id']:'');  


  $handlerSist = new HandlerSistema; 

  // SETEAR OBJETO IMPORTACION
  $handler = new HandlerImportacion;
  $objImportacion = $handler->getImportacionById($impo);
  $arrDealle = $objImportacion->selectDetalle($impo);

  if(is_object($arrDealle))
    $arrDealle = array($arrDealle);

  $countRegistros = count($arrDealle);
  $countAprobados = $objImportacion->countAprobados();

  $importadoTT=0;
  if($countRegistros==0 && $countAprobados==0) 
    $importadoTT = "<span class='label label-info'>REVISION DE PLAZAS</span>";

  if($countRegistros>0 && $countAprobados==0) 
    $importadoTT = "<span class='label label-danger'>PENDIENTES</span>";
      
  if($countAprobados>0 && $countAprobados<$countRegistros) 
    $importadoTT = "<span class='label label-warning'>REVISION DE FECHAS Y PLAZAS</span>";

  if($countAprobados==$countRegistros && $countRegistros>0) 
    $importadoTT = "<span class='label label-success'>APROBADO</span>";

  $obj = $handlerSist->getPlazaByCordinador($objImportacion->getPlaza());
  if(is_null($obj))
    $nombre_plaza = "";
  else
    $nombre_plaza = $obj[0]->PLAZA;

?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Importaciones
      <small>Detalle de importaciones</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li>Importaciones</li>
      <li class="active">Detalle</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>


    <div class="row">

        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-list"></i>
              <h3 class="box-title">Importación</h3>          
            </div>
            
            <div class="box-body table-responsive">         
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                <thead>
                  <tr>       
                    <th class='text-center'>Fecha</th>                  
                    <th class='text-center'>Plaza</th>                  
                    <th class='text-center'>Estado</th>
                    <th class='text-center'>Enviados</th>
                    <th class='text-center'>Aprobados</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      echo "
                        <tr>
                          <td class='text-center'>".$objImportacion->getFecha()->format('d/m/Y')."</td>
                          <td class='text-center'>".$nombre_plaza."</td>
                          <td class='text-center'>".$importadoTT."</td>
                          <td class='text-center' style='font-size:15px;'><b>".$countRegistros."</b></td>                            
                          <td class='text-center' style='font-size:15px;'><b>".$countAprobados."</b></td>                                                      
                        </tr>"; 
                  ?>
                </tbody>
            </table>
          </div>         
        </div>
      </div>
      <div class='col-md-12'>
        <div class="box box-solid">
            <div class="box-header with-border">    
              <i class="fa fa-edit"></i>
              <h3 class="box-title">Detalle</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Fecha Visita</th>
                      <th>DNI</th>
                      <th>Nombre y Apellido</th>
                      <th>Direccion</th>
                      <th>CP</th>
                      <th>Localidad</th>                      
                      <th>Telefono</th>  
                      <th>Plaza</th>  
                      <th style="width: 3%;" class='text-center'></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrDealle))
                      {                             
                        foreach ($arrDealle as $key => $value) {
                        
                          echo "<tr>";
                            echo "<td>".$value->getProducto()."</td>";
                            echo "<td>".$value->getFecha()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getNroDoc()."</td>";
                            echo "<td>".$value->getNombre()." ".$value->getApellido()."</td>";
                            echo "<td>".$value->getDireccion()."</td>";                            
                            echo "<td>".$value->getCodPostal()."</td>";
                            echo "<td>".$value->getLocalidad()."</td>";
                            echo "<td>".$value->getTelefono()."</td>";
                            echo "<td>".$value->getPlaza()."</td>";
                            echo "<td class='text-center'>
                                    <a href='#' reg='".$value->getId()."_eliminar' data-toggle='modal' data-target='#modal-eliminar' class='btn btn-danger btn-xs' onclick='eliminar(".$value->getId().")'>
                                      <i class='fa fa-trash' data-toggle='tooltip' data-original-title='Eliminar registro'></i>
                                      Eliminar Registro
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

<div class="modal fade in" id="modal-eliminar">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?php echo $url_action_eliminar; ?>" method="post">
        <input type="hidden" name="impo" value="<?php echo $objImportacion->getId(); ?>">
        <input type="hidden" name="reg" id="id_eliminar">
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
</script>

<script type="text/javascript">
  function eliminar(id){
    document.getElementById("id_eliminar").value = id;
  }    
</script>