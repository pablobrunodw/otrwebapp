<?php
    include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
    include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";  
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
    
    $dFecha = new Fechas;

    $handler = new HandlerSistema;
    $user = $usuarioActivoSesion;

    $handlerUF = new HandlerUploadFile;
    
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

    $f_dd_dni = (isset($_GET["f_dd_dni"])?$_GET["f_dd_dni"]:'');

    $url_detalle = "index.php?view=detalle_servicio";     
    $url_upload = "index.php?view=upload_file";    

    $arrEstados = $handler->selectAllEstados();    
    $allEstados = $handler->selectAllEstados();        
   
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Servicios
      <small>Consulta de todos los servicios vinculados</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Servicios</li>
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
              
              <div class='col-md-10'>
                
                <?php 
                  switch ($user->getUsuarioPerfil()->getNombre()) {
                    case 'CLIENTE':

                      if($fdoc=="si")
                          include_once "filtros_empresa_documentos.php";
                        else  
                          include_once "filtros_empresa.php";

                        break;
                    
                    case 'GESTOR':
                        include_once "filtros_gestor.php";

                      break;

                    case 'COORDINADOR':
                        include_once "filtros_coordinador.php";
                        
                      break;

                    case 'GERENCIA' || 'BACK OFFICE':
                        include_once "filtros_admin.php";
                        
                      break;                                            
                  }
                ?>

                 
              </div>

              <div class='col-md-2'>                
                  <label></label>                
                  <?php 
                    if($fdoc=="si")
                      echo "<a class='btn btn-block btn-success' id='filtro_reporte_documento' onclick='crearHrefDocumento()'><i class='fa fa-filter'></i> Filtrar</a>";
                    else
                      echo "<a class='btn btn-block btn-success' id='filtro_reporte' onclick='crearHref()'><i class='fa fa-filter'></i> Filtrar</a>";
                  ?>                  
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">

        <div class="box box-solid">
          <div class="box-header with-border">
            <i class="fa fa-list"></i>
            <h3 class="box-title">Servicios Encontrados</h3>          
          </div>
          
          <div class="box-body table-responsive">          

            <?php 
              switch ($user->getUsuarioPerfil()->getNombre()) {
                case 'CLIENTE':
                    
                    if($fdoc=="si"){
                      $arrDatos = $handlerUF->selectServiciosPublicados($fdesde,$fhasta,$festado,$user->getUserSistema(),null,null,$fcoordinador,null,$fequipoventa);                      
                      include_once "vista_empresa_documentos.php";
                    }
                    else{

                      $url_descargar_excel = PATH_VISTA.'Modulos/Servicio/action_descargar_excel.php?usuario_email='.trim($user->getEmail())
                                              ."&fdesde=".$fdesde
                                              ."&fhasta=".$fhasta
                                              ."&festado=".$festado
                                              ."&fcliente=".$user->getUserSistema()
                                              ."&fcoordinador=".$fcoordinador
                                              ."&fequipoventa=".$fequipoventa;
                      echo "
                        <div class='row' style='margin-bottom:10px;'>
                        <div class='col-md-12'>
                          <a href='".$url_descargar_excel."' class='pull-left btn btn-warning btn-xs'> 
                            <i class='fa fa-download'></i> Descargar toda la información con su detalle 
                          </a>
                          </div>
                        </div>";

                      $arrDatos = $handler->selectServicios($fdesde,$fhasta,$festado,$user->getUserSistema(),null,null,$fcoordinador,null,$fequipoventa);                      
                      include_once "vista_empresa.php";
                    }

                    break;
                
                case 'GESTOR':
                    $arrDatos = $handler->selectServicios($fdesde,$fhasta,$festado,$fcliente,$user->getUserSistema(),null,null,$foperador,$fequipoventa);
                    include_once "vista_gestor.php";

                  break;

                case 'COORDINADOR':
                    $arrDatos = $handler->selectServicios($fdesde,$fhasta,$festado,$fcliente,$fgestor,null,$user->getAliasUserSistema(),$foperador,$fequipoventa);
                    include_once "vista_coordinador.php";
                    
                  break;

                case 'GERENCIA' || 'BACK OFFICE':
                    $arrDatos = $handler->selectServicios($fdesde,$fhasta,$festado,$fcliente,$fgestor,$fgerente,$fcoordinador,$foperador,$fequipoventa);
                    include_once "vista_admin.php";
                    
                  break;                                            
              }
            ?>
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
    $("#slt_estados").select2({
        placeholder: "Seleccionar",                  
    });
  });

  $(document).ready(function() {
    $("#slt_equipoventa").select2({
        placeholder: "Seleccionar",                  
    });
  });

  $(document).ready(function() {
    $("#slt_cliente").select2({
        placeholder: "Seleccionar",                  
    });
  });

  $(document).ready(function() {
    $("#slt_gerente").select2({
        placeholder: "Seleccionar",                  
    }).on('change', function (e) { 
      filtrarReporte(); 
    });
  });

  $(document).ready(function() {
    $("#slt_coordinador").select2({
        placeholder: "Seleccionar",                  
    }).on('change', function (e) { 
      filtrarReporte(); 
    });
  });

  $(document).ready(function() {
    $("#slt_gestor").select2({
        placeholder: "Seleccionar",                  
    }).on('change', function (e) { 
      filtrarReporte(); 
    });
  });

  $(document).ready(function() {
    $("#slt_operador").select2({
        placeholder: "Seleccionar",                  
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


  //filtros todos los servicios
  crearHref();
  function crearHref()
  {
    aStart = $("#start").val().split('/');
    aEnd = $("#end").val().split('/');

    f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
    f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                      
    f_estado = $("#slt_estados").val();
    f_equipoventa = $("#slt_equipoventa").val();        
    f_cliente = $("#slt_cliente").val();     
    f_gerente = $("#slt_gerente").val();   
    f_coordinador = $("#slt_coordinador").val();   
    f_gestor = $("#slt_gestor").val();     
    f_operador = $("#slt_operador").val();     
    
    url_filtro_reporte="index.php?view=servicio&fdesde="+f_inicio+"&fhasta="+f_fin

    if(f_estado!=undefined)
      if(f_estado>0)          
        url_filtro_reporte= url_filtro_reporte + "&festado="+f_estado

    if(f_equipoventa!=undefined)
      if(f_equipoventa!='')
        url_filtro_reporte= url_filtro_reporte + "&fequipoventa="+f_equipoventa

    if(f_cliente!=undefined)
      if(f_cliente>0)
        url_filtro_reporte= url_filtro_reporte + "&fcliente="+f_cliente      

    if(f_gerente!=undefined)
      if(f_gerente!='')
        url_filtro_reporte= url_filtro_reporte + "&fgerente="+f_gerente

    if(f_coordinador!=undefined)
      if(f_coordinador!='')
        url_filtro_reporte= url_filtro_reporte + "&fcoordinador="+f_coordinador  

    if(f_gestor!=undefined)
      if(f_gestor>0)
        url_filtro_reporte= url_filtro_reporte + "&fgestor="+f_gestor   

    if(f_operador!=undefined)
      if(f_operador!='')
        url_filtro_reporte= url_filtro_reporte + "&foperador="+f_operador  

    $("#filtro_reporte").attr("href", url_filtro_reporte);

    document.cookie = "url-tmp-back="+url_filtro_reporte;
  } 

  function filtrarReporte()
  {
    crearHref();
    window.location = $("#filtro_reporte").attr("href");
  }


  //filtros de servicios solo con documentos adjuntos
  crearHrefDocumento();
  function crearHrefDocumento()
  {
    aStart = $("#start").val().split('/');
    aEnd = $("#end").val().split('/');

    f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
    f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                      
    f_estado = $("#slt_estados").val();
    f_equipoventa = $("#slt_equipoventa").val();        
    f_cliente = $("#slt_cliente").val();     
    f_gerente = $("#slt_gerente").val();   
    f_coordinador = $("#slt_coordinador").val();   
    f_gestor = $("#slt_gestor").val();     
    f_operador = $("#slt_operador").val();     
    
    url_filtro_reporte="index.php?view=servicio&fdoc=si&fdesde="+f_inicio+"&fhasta="+f_fin

    if(f_estado!=undefined)
      if(f_estado>0)          
        url_filtro_reporte= url_filtro_reporte + "&festado="+f_estado

    if(f_equipoventa!=undefined)
      if(f_equipoventa!='')
        url_filtro_reporte= url_filtro_reporte + "&fequipoventa="+f_equipoventa

    if(f_cliente!=undefined)
      if(f_cliente>0)
        url_filtro_reporte= url_filtro_reporte + "&fcliente="+f_cliente      

    if(f_gerente!=undefined)
      if(f_gerente!='')
        url_filtro_reporte= url_filtro_reporte + "&fgerente="+f_gerente

    if(f_coordinador!=undefined)
      if(f_coordinador!='')
        url_filtro_reporte= url_filtro_reporte + "&fcoordinador="+f_coordinador  

    if(f_gestor!=undefined)
      if(f_gestor>0)
        url_filtro_reporte= url_filtro_reporte + "&fgestor="+f_gestor   

    if(f_operador!=undefined)
      if(f_operador!='')
        url_filtro_reporte= url_filtro_reporte + "&foperador="+f_operador  

    $("#filtro_reporte_documento").attr("href", url_filtro_reporte);    
  } 

  function filtrarReporteDocumento()
  {
    crearHrefDocumento();
    window.location = $("#filtro_reporte_documento").attr("href");
  }

</script>