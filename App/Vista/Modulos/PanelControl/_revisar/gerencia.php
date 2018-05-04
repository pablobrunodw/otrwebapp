<?php
    include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
?>
  
<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Resumen por plaza - (<span class="text-yellow">23.04.18 - 15:19</span>)
      <small>Resumen diario de toda la actividad</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>      
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

      <div class="content-fluid">
        <div class="row">
        <!-- Cantidades -->
          <div class="col-sm-6 col-md-4 col-lg-3">
            <a href="met_rosario.html">
              <div class="box box-solid">
                <div class="box-header with-border"><h3 class="box-title"><i class="ion-arrow-graph-up-right"> </i> ROSARIO</h3></div>
                <div class="box-body">
                  <h4>DIARIO</h4>
                  <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="ion-ios-paperplane"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">GESTIONES</span>
                      <span class="info-box-number">242</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 54.96%"></div>
                      </div>
                      <span class="progress-description">
                        <span class="pull-right">133 <small>Gestionadas</small></span>
                      </span>
                    </div>
                  </div>
                  <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion-ios-paperplane"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">EFECTIVIDAD</span>
                      <span class="info-box-number">71.46%</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 71.46%"></div>
                      </div>
                      <span class="progress-description">
                        95 <small>Cerrados</small><span class="pull-right">133 <small>Gestiones</small> </span>
                      </span>
                    </div>
                  </div>
                  <h4>MENSUAL</h4>
                  <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">EFECTIVIDAD</span>
                      <span class="info-box-number">65.80%</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 65.80%"></div>
                      </div>
                      <span class="progress-description">
                        2156 <small>Cerrados</small><span class="pull-right">3275 <small>Servicios</small> </span>
                      </span>
                    </div>
                  </div>
                  <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="ion-calculator"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">PUNTAJE</span>
                      <span class="info-box-number">66.64%</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 66.64%"></div>
                      </div>
                      <span class="progress-description">
                        <small>Enviados: </small>6014.6 <span class="pull-right"><small>Objetivo: </small>9025.0</span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
  </section>

  <section class="content-header">
    <h1>
      Resumen Mensual - (<span class="text-yellow">ABRIL 2018</span>)
      <small>Resumen diario de toda la actividad</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>      
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="content-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="ion-arrow-graph-up-right"></i> GESTIÓN.</h3>
            </div>
            <div class="box-body">
              <a href="#">
                <div class="info-box bg-green">
                  <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Efectividad</span>
                    <span class="info-box-number">76.73%</span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 76.73%"></div>
                    </div>
                    <span class="progress-description">
                      1106 <small>Gestiones</small> <span class="pull-right">867 <small>Cerradas</small></span>
                    </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="ion-arrow-graph-up-right"></i> SERVICIOS.</h3>
            </div>
            <div class="box-body">
              <a href="met_servicios.html">
                <div class="info-box bg-red">
                  <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Efectividad</span>
                    <span class="info-box-number">57.73%</span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 57.73%"></div>
                    </div>
                    <span class="progress-description">
                      1509 <small>Servicios</small> <span class="pull-right">871 <small>Cerrados</small></span>
                    </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="ion-calculator"></i> PUNTAJE.</h3>
            </div>
            <div class="box-body">
              <a href="#">
                <div class="info-box bg-red">
                  <span class="info-box-icon"><i class="ion-calculator"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Objetivo</span>
                    <span class="info-box-number">18.61%</span>
                    <div class="progress">
                      <div class="progress-bar" style="width: 18.61%"></div>
                    </div>
                    <span class="progress-description">
                      <small>Enviados: </small>1414.4 <span class="pull-right"><small>Objetivo: </small>7600</span>
                    </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  
</div>