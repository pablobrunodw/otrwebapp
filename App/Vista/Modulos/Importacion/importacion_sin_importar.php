<?php
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";     
  
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
  include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";         
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";     

  $url_action_asignar = PATH_VISTA.'Modulos/Importacion/action_cp_sinplaza.php';
  $url_action_eliminar = PATH_VISTA.'Modulos/Importacion/action_cp_sinplaza.php';

  $dFecha = new Fechas;
   
  $fcliente= (isset($_GET["fcliente"])?$_GET["fcliente"]:'');

  $handler = new HandlerImportacion;
  $arrImpoSinImportar = $handler->selecionarImportacionesSinImportarByCliente($fcliente);

  $handlerSist = new HandlerSistema; 
  $arrCliente = $handlerSist->selectAllEmpresa();
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Importaciones que no se cargaron al T&T
      <small>Importaciones realizadas por los clientes sin subirse al T&T</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Importaciones sin subirse</li>
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
                  <label>Clientes </label>      
                  <select id="slt_cliente" class="form-control" style="width: 100%" name="slt_cliente" onchange="crearHref()">                              
                    <option value=''></option>
                    <option value='0'>TODOS</option>
                    <?php
                      if(!empty($arrCliente))
                      {                        
                        foreach ($arrCliente as $key => $value) {                                                  
                          if($fcliente==$value->EMPTT11_CODIGO)
                            echo "<option value='".trim($value->EMPTT11_CODIGO)."' selected>".$value->EMPTT21_NOMBREFA."</option>";
                          else
                            echo "<option value='".trim($value->EMPTT11_CODIGO)."'>".$value->EMPTT21_NOMBREFA."</option>";
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
              <h3 class="box-title">Importaciones</h3>
            </div>
            <div class="box-body">
              <table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Producto</th>
                      <th>Fecha Visita</th>
                      <th>DNI</th>
                      <th>Nombre y Apellido</th>
                      <th>Direccion</th>
                      <th>CP</th>
                      <th>Localidad</th>                      
                      <th>Telefono</th>  
                      <th>Plaza</th>                       
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($arrImpoSinImportar))
                      {                             
                        foreach ($arrImpoSinImportar as $key => $value) {
                          
                          if(!empty($value->getPlaza()))
                            $objPlaza = $handlerSist->getPlazaByCordinador($value->getPlaza());
                          else
                            $objPlaza = "";

                          if(! is_null($objPlaza))
                            $plaza = $objPlaza[0]->PLAZA;   
                          else
                            $plaza = "" ;

                          echo "<tr>";
                            echo "<td>".$handlerSist->selectEmpresaById($value->getClienteTT())[0]->EMPTT21_NOMBREFA."</td>";
                            echo "<td>".$value->getProducto()."</td>";
                            echo "<td>".$value->getFecha()->format('d/m/Y')."</td>";
                            echo "<td>".$value->getNroDoc()."</td>";
                            echo "<td>".$value->getNombre()." ".$value->getApellido()."</td>";
                            echo "<td>".$value->getDireccion()."</td>";                            
                            echo "<td>".$value->getCodPostal()."</td>";
                            echo "<td>".$value->getLocalidad()."</td>";
                            echo "<td>".$value->getTelefono()."</td>";                        
                            echo "<td>".$plaza."</td>";   
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
    $("#mnu_importacion").addClass("active");
  }); 

  $(document).ready(function() {    
    $("#slt_cliente").select2({
        placeholder: "Seleccionar",                  
    });
  });    
</script>

<script type="text/javascript">
  crearHref();
  function crearHref()
  {
      
      f_cliente = $("#slt_cliente").val();     
      
      url_filtro_reporte="index.php?view=importaciones_sin_importar";  

      if(f_cliente!=undefined)
        if(f_cliente>0)
          url_filtro_reporte= url_filtro_reporte + "&fcliente="+f_cliente;
      
      
      $("#filtro_reporte").attr("href", url_filtro_reporte);
  }    
</script>