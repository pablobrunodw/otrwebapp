<?php
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php";   

	$fechaing=(isset($_GET["fechaing"])?$_GET["fechaing"]:0);
	$nroing=(isset($_GET["nroing"])?$_GET["nroing"]:0);

  $fdesde=(isset($_GET["fdesde"])?$_GET["fdesde"]:date('Y-m-d', strtotime('-0 days')));
  $fhasta=(isset($_GET["fhasta"])?$_GET["fhasta"]:date('Y-m-d'));
  $festado=(isset($_GET["festado"])?$_GET["festado"]:0);
  $fequipoventa=(isset($_GET["fequipoventa"])?$_GET["fequipoventa"]:'');
  $fcliente=(isset($_GET["fcliente"])?$_GET["fcliente"]:'');
  $fgerente=(isset($_GET["fgerente"])?$_GET["fgerente"]:'');    
  $fcoordinador=(isset($_GET["fcoordinador"])?$_GET["fcoordinador"]:'');
  $fgestor=(isset($_GET["fgestor"])?$_GET["fgestor"]:'');
  $foperador=(isset($_GET["foperador"])?$_GET["foperador"]:'');
  $fdoc=(isset($_GET["fdoc"])?$_GET["fdoc"]:'');

  $filtros_listado = "&fdoc=".$fdoc."&fdesde=".$fdesde."&fhasta=".$fhasta."&festado=".$festado."&fequipoventa=".$fequipoventa."&fcliente=".$fcliente."&fgerente=".$fgerente."&fcoordinador=".$fcoordinador."&fgestor=".$fgestor."&foperador=".$foperador;      

	$handler = new HandlerSistema;
  $user = $usuarioActivoSesion;
  $servicio = $handler->selectUnServicio($fechaing,$nroing);
	$arrDatos = $handler->selectServiciosHistorico($fechaing,$nroing);
  $allEstados = $handler->selectAllEstados();

  if(empty($servicio)){
    echo "<script>javascript:history.back(1)</script>";
    return;
  }    
    
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Historial de Servicios
      <small>Historia del servicio seleccionado</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li>Servicios</li>
      <li class="active">Historia</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-3 col-xs-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <i class="fa fa-caret-right"></i>
            <h3 class="box-title">Servicio Seleccionado</h3>
          </div>
          <div class="box-body">
            <p>
              <?php 
                $f_array = new FuncionesArray;
                $class_estado = $f_array->buscarValor($allEstados,"1",$servicio[0]->ESTADOS_DESCCI,"2");

                echo "
                <b>Estado:</b> <span class='".$class_estado."' style='font-size:11px;'>".$servicio[0]->ESTADOS_DESCCI."</span><br><br>
                <b>Fecha:</b> ".$servicio[0]->SERTT11_FECSER->format('d/m/Y')."<br>
                <b>Numero:</b> ".$servicio[0]->SERTT12_NUMEING."<br>
                <b>Nombre:</b> ".$servicio[0]->SERTT91_NOMBRE."<br>
                <b>DNI:</b> ".$servicio[0]->SERTT31_PERNUMDOC."<br>
                <b>Telefono:</b> ".$servicio[0]->SERTT91_TELEFONO."<br> 
                <b>Localidad:</b> ".$servicio[0]->SERTT91_LOCALIDAD."<br>";
                
                if($user->getUsuarioPerfil()->getNombre()!="CLIENTE"){
                  echo "
                    <br><br>
                    <b>Cliente:</b> ".$servicio[0]->EMPTT21_ABREV."<br>                
                    <b>Coordinador:</b> ".$servicio[0]->SERTT91_COOALIAS."<br>             
                    <b>Gestor:</b> ".$servicio[0]->GESTOR21_ALIAS."<br>";

                
                    if($servicio[0]->SERTT91_OBSERV == $servicio[0]->SERTT91_OBRESPU)
                      $observaciones = $servicio[0]->SERTT91_OBSERV;
                    else
                      $observaciones = $servicio[0]->SERTT91_OBSERV."<br>".$servicio[0]->SERTT91_OBRESPU; 

                    $observaciones = $observaciones."<br>".$servicio[0]->SERTT91_OBSEENT;
              
                    echo "<br>";
                    echo "<b>Observaciones:</b> ".$observaciones;
                }
              ?>
            </p>
          </div>
          <div class="box-footer clearfix">
            
            <?php
              //$btn_volver = 'index.php?view=servicio&f_dd_dni='.$servicio[0]->SERTT31_PERNUMDOC.$filtros_listado;
              $btn_volver = 'index.php?view=servicio'.$filtros_listado;
              echo "<a href='".$btn_volver."' class='pull-left btn btn-default'>
                      <i class='fa fa-chevron-left'></i> Volver
                    </a>";
            ?>

          </div>
        </div>
      </div>  
	    <div class="col-md-9 col-xs-12">
        <div class="box">                
          <div class="box-header with-border">
            <i class="fa fa-history"></i>
            <h3 class="box-title">Historial servicio</h3>
          </div>
          <div class="box-body table-responsive">
            
            <table class="table table-striped table-bordered table-condensed" cellspacing="0" width="100%">
              <thead>        
                <tr>                   
                  <th style="width: 20%;">Fecha</th>              
                  <th style="width: 10%;">Estado</th> 
                  <th style="width: 70%;">Observaciones</th>
                </tr>
              </thead>
              <tbody>
                <?php    
                  if(!empty($arrDatos)){
                    foreach ($arrDatos as $key => $value) {        

                      $f_array = new FuncionesArray;
                      $class_estado = $f_array->buscarValor($allEstados,"1",$value->ESTADOS_DESCCI,"3");                      
                      $observaciones = $value->HSETT91_OBSERV."<br>".$value->HSETT91_OBRESPU."<br>".$value->HSETT91_OBSEENT ;
                      
                      echo "
                        <tr>                         
                          <td style=''>".$value->HSETT11_FECEST->format('d/m/Y H:i:s')."</td>";                                                                         
                        echo 
                          "<td class='text-left'><span class='".$class_estado."'>".$value->ESTADOS_DESCCI."</span></td>";

                      echo "                        
                          <td style=''>".$observaciones."</td>
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

  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_servicio").addClass("active");
  });

  $(document).ready(function() {
    $('#tabla').DataTable({
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