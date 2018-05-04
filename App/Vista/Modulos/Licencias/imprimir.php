<?php
  include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
  include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php"; 
  include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 

  $handler = new HandlerLicencias();
  $handlerLegajo = new HandlerLegajos();
  $f= new Fechas();

  $id = (isset($_GET["id"])?$_GET["id"]:'');

  $licencia = $handler->seleccionarLicenciasById($id);
  $legajo = $handlerLegajo->seleccionarLegajos($licencia->getUsuarioId()->getId());

  $url_action_imprimir = PATH_VISTA.'Modulos/Licencias/action_imprimir.php?id='.$id;  
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Licencias
      <small>Licencias solicitadas por el gestor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li>Licencias</li>
      <li class="active">Impresión</li>
    </ol>
  </section>        

  <section class="content">

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
        <div class="col-sm-4 invoice-col">
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
        <div class="col-sm-4 invoice-col">
          Para
          <address>
            <strong><?php echo $legajo->getNombre(); ?></strong><br>
            <u>CUIL: </u><?php echo $legajo->getCuit(); ?><br>
            <u>Numero Legajo: </u><?php echo $legajo->getNumeroLegajo(); ?><br>
            <u>Telefono: </u> <?php echo $legajo->getCelular(); ?><br>
            <u>Email: </u> <?php echo $legajo->getUsuarioId()->getEmail(); ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
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

        <div class="col-md-12">
          <p>Por medio de la presente, notificamos que se le otorga la siguiente licencia</p>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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

      <div class="row" style="margin-top: 100px;">
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


      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo $url_action_imprimir; ?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Imprimir</a>        
        </div>
      </div>
    </section>
  </section>
</div>
