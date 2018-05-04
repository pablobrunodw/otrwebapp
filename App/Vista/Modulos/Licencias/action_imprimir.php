<?php
  include_once "../../../Config/config.ini.php";  

  include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
  include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 

  $handler = new HandlerLicencias();
  $handlerLegajo = new HandlerLegajos();
  $f= new Fechas();

  $id = (isset($_GET["id"])?$_GET["id"]:'');

  $licencia = $handler->seleccionarLicenciasById($id);
  $legajo = $handlerLegajo->seleccionarLegajos($licencia->getUsuarioId()->getId());

  $url_action_imprimir = PATH_VISTA.'Modulos/Licencias/action_imprimir.php?id=';      
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Imprimir Licencia</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />       
  <!-- Ionicons -->
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
  <!-- Theme style -->
  <link href=<?php echo PATH_VISTA.'assets/dist/css/AdminLTE.min.css'; ?> rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-certificate"></i> Impresion de Licencias
            <small class="pull-right">Fecha: <?php echo $f->FormatearFechas($f->fechaActual(),'Y-m-d','d/m/Y'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-md-12 invoice-col pull-right">
          <b>
            Rosario, 
            <?php echo $f->Dias($f->FormatearFechas($f->fechaActual(),'Y-m-d','l')); ?>
            <?php echo $f->FormatearFechas($f->fechaActual(),'Y-m-d','d'); ?>
            de
            <?php echo $f->Mes($f->FormatearFechas($f->fechaActual(),'Y-m-d','m')); ?>
            de
            <?php echo $f->FormatearFechas($f->fechaActual(),'Y-m-d','Y'); ?>            
          </b>
        </div>

        <div class="col-sm-6 invoice-col pull-left">
          De
          <address>
            <strong>OTR Group</strong><br>
            by Commercial Group SRL<br>
            San Luis 912<br>
            Rosario, 2000, Santa Fe<br>
            <u>Telefono: </u> 0810 345 2683<br>
            <u>Email: </u> comercial@otrgroup.com.ar
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col pull-right">
          Para
          <address>
            <strong><?php echo $legajo->getNombre(); ?></strong><br>
            <u>CUIL: </u><?php echo $legajo->getCuit(); ?><br>
            <u>Numero Legajo: </u><?php echo $legajo->getNumeroLegajo(); ?><br>
            <u>Telefono: </u> <?php echo $legajo->getCelular(); ?><br>
            <u>Email: </u> <?php echo $legajo->getUsuarioId()->getEmail(); ?><br>
          </address>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-12 pull-left">
          <p>Por medio de la presente, notificamos que se le otorga la siguiente licencia</p>
        </div>
      </div>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Dias</th>
              <th>Licencia</th>
              <th>Desde</th>
              <th>Hasta</th>
              <th>Observaciones</th>
            </tr>
            </thead>

            <?php 
              $dif = $f->DiasDiferenciaFechas($licencia->getFechaInicio()->format("Y-m-d"),$licencia->getFechaFin()->format("Y-m-d"),"Y-m-d");
            ?>

            <tbody>
              <tr>            
                <td><?php echo $dif + 1; ?></td>
                <td><?php echo $licencia->getTipoLicenciasId()->getNombre();?></td>
                <td><?php echo $licencia->getFechaInicio()->format("Y-m-d"); ?></td>
                <td><?php echo $licencia->getFechaFin()->format("Y-m-d"); ?></td>
                <td><?php echo $licencia->getObservaciones(); ?></td>
              </tr>          
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row" style="margin-top: 300px;">
        <!-- accepted payments column -->
        <div class="col-xs-3">        
          <hr>
          <h4>FIRMA EMPLEADO</h4>
        </div>
        
        <div class="col-xs-3">
          <hr>
          <h4>FIRMA REFERENTE</h4>
        </div>

      </div>
      
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
