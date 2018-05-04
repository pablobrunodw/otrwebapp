<?php
  include_once PATH_NEGOCIO."Guias/handlerguias.class.php";     
  include_once PATH_NEGOCIO."Sistema/handlerconsultascontrol.class.php";    
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";     
  include_once PATH_NEGOCIO."Parametros/handlerparametros.class.php";   
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";      
  include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php";  
 
  $user = $usuarioActivoSesion;
  $url_descargar = PATH_VISTA.'Modulos/Legajos/action_descargar_lote.php?carpeta='.$user->getEmail().'&usuario='; 
  $url_descargar_excel = PATH_VISTA.'Modulos/Legajos/action_descargar_excel.php?usuario_email='.$user->getEmail(); 
  $url_view = "?view=legajos_actualizar&usuario=";

  $dFecha = new Fechas;

  $fusuario= (isset($_GET["fusuario"])?$_GET["fusuario"]:'');
  
  $handlerUsuarios = new HandlerUsuarios;
  $arrUsuarios = $handlerUsuarios->selectByPerfil("GESTOR");

  $handler = new HandlerLegajos;  
  $consulta = $handler->seleccionarByFiltros($fusuario);
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Control de Legajos
      <small>Control de los legajos enviados</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Control de los legajos enviados</li>
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
                
                <div class="col-md-3">
                  <label>Gestores </label>                
                  <select id="slt_usuario" class="form-control" style="width: 100%" name="slt_usuario" onchange="crearHref()">
                    <option value=''></option>
                    <option value='0'>TODOS</option>
                    <?php
                      if(!empty($arrUsuarios))
                      {                     
                                        
                        foreach ($arrUsuarios as $key => $value) {                      

                          if($fusuario == $value->getId())
                            echo "<option value='".$value->getId()."' selected>".$value->getNombre()."</option>";
                          else
                            echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";                  
                            
                        }
                        
                      }
                    ?>
                  </select>
                </div>    
                         
                <div class='col-md-2 pull-right'>                
                  <label></label>                
                  <a class="btn btn-block btn-success" id="filtro_reporte" onclick="crearHref()"><i class='fa fa-filter'></i> Filtrar</a>
                </div>
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-12">
        <a href="<?php echo $url_descargar_excel;?>" class="pull-right btn btn-warning btn-xs"> 
          <i class="fa fa-download"></i> Descargar toda la información 
        </a>
      </div>
      <div class='col-md-12'>
        <div class="box">
          <div class="box-body table-responsive">                          
              <table class="table table-striped" id='tabla'>
                <thead>
                  <tr>
                    <th>USUARIO</th>                          
                    <th>ROL</th>                          
                    <th>NOMBRE</th>                          
                    <th>CUIL</th>   
                    <th>CATEGORIA</th>                                              
                    <th>HORAS</th>                                 
                    <th>OFICINA</th>   
                    <th>ADJUNTOS</th>                  
                    <th>ACCION</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      if(!empty($consulta)){                        
                        foreach ($consulta as $key => $value) {
                          echo "<tr>";
                          echo "<td>".$value->getUsuarioId()->getEmail()."</td>";
                          echo "<td>".$value->getUsuarioId()->getUsuarioPerfil()->getNombre()."</td>";
                          echo "<td>".$value->getUsuarioId()->getApellido()." ".$value->getUsuarioId()->getNombre()."</td>";
                          echo "<td>".$value->getCuit()."</td>";                          
                          echo "<td>".$value->getCategoria()."</td>";
                          echo "<td>".$value->getHoras()."</td>";
                          echo "<td>".$value->getOficina()."</td>";
                          echo "<td><a href='".$url_descargar.$value->getUsuarioId()->getId()."' class='btn btn-default btn-xs'><i class='fa fa-download'></i> Descargar</a></td>";                          
                          echo "<td><a href='".$url_view.$value->getUsuarioId()->getId()."' class='btn btn-primary btn-xs'>Ver y Actualizar</a></td>";
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


<script type="text/javascript"> 

  $(document).ready(function(){                
    $("#mnu_legajos").addClass("active");
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

  $(document).ready(function() {
    $("#slt_usuario").select2({
        placeholder: "Seleccionar un Usuario",                  
    });
  });
  
  
  crearHref();
  function crearHref()
  {
      f_usuario = $("#slt_usuario").val();   
      
      url_filtro_reporte="index.php?view=legajos_control";

      if(f_usuario!=undefined)
        if(f_usuario>0)
          url_filtro_reporte= url_filtro_reporte + "&fusuario="+f_usuario;

      $("#filtro_reporte").attr("href", url_filtro_reporte);
  } 

</script>