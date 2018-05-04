<?php
  include_once PATH_NEGOCIO."Guias/handlerguias.class.php";     
  include_once PATH_NEGOCIO."Sistema/handlerconsultascontrol.class.php";    
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";     
  include_once PATH_NEGOCIO."Parametros/handlerparametros.class.php";   
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";      

  $dFecha = new Fechas;

  $fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
  $fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());  
  
  $handler_sistema = new HandlerSistema;

  $handlerUsuarios = new HandlerUsuarios;
  
  $fusuario=0;

  $user = $usuarioActivoSesion;
  $fcliente=$user->getUserSistema();

  $handler = new HandlerGuias;  
  $consulta = $handler->seleccionarByFiltros($fdesde,$fhasta,$fusuario,$fcliente);

  $p_handler = new HandlerParametros;
  $hora_limite = $p_handler->seleccionarById(2)["valor_time"]->format('H:i:s');
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Control de Guías y Remitos
      <small>Control de los envíos de guia</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Control Guías y Remitos</li>
    </ol>
  </section>        
  
  <section class="content">
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
                <div class="col-md-3" id='sandbox-container'>
                    <label>Fecha Desde - Hasta </label>                
                    <div class="input-daterange input-group" id="datepicker">
                      <input type="text" class="input-sm form-control" onchange="crearHref()" id="start" name="start" value="<?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y'); ?>"/>
                      <span class="input-group-addon">a</span>
                      <input type="text" class="input-sm form-control" onchange="crearHref()" id="end" name="end" value="<?php echo $dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?>"/>
                    </div>
                </div>
                                                 
                <div class='col-md-2 pull-right'>                
                  <label></label>                
                  <a class="btn btn-block btn-success" id="filtro_reporte" onclick="crearHref()"><i class='fa fa-filter'></i> Filtrar</a>
                </div>
              </div>
            </div>
        </div>
      </div>

      <div class='col-md-12'>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"> Control de envíos guías- <?php echo "desde <b>".$dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')."</b> hasta <b>".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y')."</b>"; ?></h3>               
          </div>

          <div class="box-body table-responsive">
              <table class="table table-striped" id='tabla'>
                <thead>
                  <tr>
                    <th>FECHA</th>                          
                    <th>HORA</th>                    
                    <th>PLAZA</th>                                              
                    <th>GUIA</th>                                 
                    <th>OBSERVACIONES</th>   
                    <th>ESTADO</th>                                                           
                  </tr>
                </thead>
                <tbody>
                    <?php

                      if(!empty($consulta))
                      {               
                        foreach ($consulta as $key => $value) {      

                          

                          if($value->getFechaHora()->format('H:s:i')>$hora_limite)
                            $estado = "<span class='label label-danger'>TARDE</span>";
                          else
                            $estado = "<span class='label label-success'>A TIEMPO</span>";                            

                          echo "
                            <tr>
                              <td>".$value->getFechaHora()->format('d/m/Y')."</td>
                              <td>".$value->getFechaHora()->format('H:s:i')."</td>                                 
                              <td>".$value->getPlaza()."</td>                                                    
                              <td><a target='_blank' href='".$value->getUrlGuias()."'>Visualizar</a></td>                                                
                              <td>".$value->getObservaciones()."</td>
                              <td>".$estado."</td>                                        
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
    $("#mnu_guias_control_empresa").addClass("active");
  });

  $(document).ready(function() {
      $('#tabla').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['copy', 'csv', 'excel', 'print'],
        "iDisplayLength":100,
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

  $('#sandbox-container .input-daterange').datepicker({
      format: "dd/mm/yyyy",
      clearBtn: false,
      language: "es",
      keyboardNavigation: false,
      forceParse: false,
      autoclose: true,
      todayHighlight: true,                                                                        
      multidate: false,
      todayBtn: "linked",  
  });

  crearHref();
  function crearHref()
  {
      aStart = $("#start").val().split('/');
      aEnd = $("#end").val().split('/');

      f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
      f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                                 
  
      
      url_filtro_reporte="index.php?view=guias_control_empresa&fdesde="+f_inicio+"&fhasta="+f_fin                 

      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 

</script>