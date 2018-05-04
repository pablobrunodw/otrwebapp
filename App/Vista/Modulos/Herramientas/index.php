<?php
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";
  include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php";

  $dFecha = new Fechas;

  $handler = new HandlerSistema;

    $user = $usuarioActivoSesion;
  $arrCoordinador = $handler->selectAllPlazasArray();

  $url_impresoras = "index.php?view=impresoras";
  $url_celulares = "index.php?view=celulares";
  $url_insumos = "index.php?view=insumos";

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

 // $url_action_enviar = PATH_VISTA.'Modulos/Inbox/action_enviar.php';
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Herramientas
      <small>ABM de herramientas </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Rotativos</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-wrench"></i>       
            <h3 class="box-title">Herramientas</h3>          
          </div>
          <div class="box-body">
            <div class="col-md-4">
              <label>Plazas </label>

                <select id="slt_coordinador" class="form-control" style="width: 100%" name="slt_coordinador" onchange="crearHref()">                              
                  <option value='0'>TODOS</option>
                  <?php
                  if(!empty($arrCoordinador))
                  {                        
                  foreach ($arrCoordinador as $key => $value) {                                                  
                  if($fcoordinador==$value['PLAZA'])
                  echo "<option value='".trim($value['PLAZA'])."' selected>".$value['PLAZA']."</option>";
                  else
                  echo "<option value='".trim($value['PLAZA'])."'>".$value['PLAZA']."</option>";
                  }
                  } 
                  ?>
                </select>
              </div>
          </div>
        </div>
      </div>                
    </div>

  </section>
</div>

<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_herramientas").addClass("active");
  });
</script>