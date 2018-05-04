<?php
  include_once PATH_NEGOCIO."Modulos/handlerayuda.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         

  $handler = new HandlerAyuda;
  $arrDocumentos = $handler->selecionarDocumentosByPerfil($usuarioActivoSesion->getUsuarioPerfil()->getId());
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Ayuda
      <small>Documentación del aplicativo</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Ayuda</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>
  
    <div class="row">      
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Documentacón</h3>
          </div>                        
          <div class="box-body table-responsive"> 
            <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
              <thead>
                <tr>                  
                  <th>Clasificación</th>
                  <th>Documento</th>
                  <th>URL</th>
                </tr>
              </thead>
              <tbody>
                <?php            
                  if(!empty($arrDocumentos)){
                    foreach ($arrDocumentos as $key => $value) {                

                      if(!empty($value->getArchivo()))
                        $archivo = "<a href='".$value->getArchivo()."' target='_blank'>".$value->getNombre()."</a>";
                      else
                        $archivo = "";

                      if(!empty($value->getVideo()))
                        $url = "<a href='".$value->getVideo()."' target='_blank'>Abrir Link</a>";
                      else
                        $url = "";

                      echo "
                      <tr>
                        <td>".$value->getGrupo()->getNombre()."</td>
                        <td>".$archivo."</td>
                        <td>".$url."</td>
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
    $("#mnu_ayuda").addClass("active");
  });
</script>

<script type="text/javascript">   

    $('#tabla').DataTable({
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
   
</script>