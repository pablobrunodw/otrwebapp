<?php
    include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
?>
  
<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Resúmen operativo diario  - (<span class="text-yellow">09.04.2018 - 12:35</span>)
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

        <div class="col-xs-12">
          <!--PESTAÑAS-->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Plazas</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Productos</a></li>
            </ul>

            <div class="tab-content col-xs-12 no-padding">
              <div class="tab-pane active" id="tab_1">
                <!--PLAZA-->
                <div class="cpanel">
                  <div class="box no-border">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="ion-stats-bars"> </i> ROSARIO</h3>
                    </div>
                    <div class="box-body no-padding">
                      <div class="box-group" id="accordion">
                        <!--GESTIONES-->
                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#ROSARIO-collapse1">
                                <div class="info-box bg-aqua">
                                  <span class="info-box-icon"><i class="ion-ios-paperplane"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Total Gestiones</span>
                                    <span class="info-box-number">50</span>

                                    <div class="progress">
                                      <div class="progress-bar" style="width: 22%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                      Gestionadas: 22%
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="ROSARIO-collapse1" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">ESTOS LINKS LLEVAN AL LISTADO DE GESTIONES DEL DÍA</a></li>
                                  <li><a href="#">Despachadas <span class="pull-right badge bg-blue">39</span></a></li>
                                  <li><a href="#">Repactadas <span class="pull-right badge bg-aqua">2</span></a></li>
                                  <li><a href="#">Rellamar <span class="pull-right badge bg-orange">1</span></a></li>
                                  <li><a href="#">Cerrado Parc. <span class="pull-right badge bg-yellow">1</span></a></li>
                                  <li><a href="#">Cerrado <span class="pull-right badge bg-green">4</span></a></li>
                                  <li><a href="#">Negativas <span class="pull-right badge bg-red-active">1</span></a></li>
                                  <li><a href="#">Canceladas <span class="pull-right badge bg-red">2</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--EFECTIVIDAD-->
                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#ROSARIO-collapse2">
                                <div class="info-box bg-green">
                                  <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Efectividad</span>
                                    <span class="info-box-number">76.73%</span>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: 76.73%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="ROSARIO-collapse2" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">LLEVA AL DETALLE DE LO QUE TIENE PARA EL DÍA CADA GESTOR</a></li>
                                  <li><a href="#">Gestor 01 <span class="pull-right badge bg-red">25%</span></a></li>
                                  <li><a href="#">Gestor 02 <span class="pull-right badge bg-yellow">56%</span></a></li>
                                  <li><a href="#">Gestor 03 <span class="pull-right badge bg-green">85%</span></a></li>
                                  <li><a href="#">Gestor 04 <span class="pull-right badge bg-yellow">66%</span></a></li>
                                  <li><a href="#">Gestor 05 <span class="pull-right badge bg-red">15%</span></a></li>
                                  <li><a href="#">Gestor 06<span class="pull-right badge bg-green">76%</span></a></li>
                                  <li><a href="#">Gestor 07 <span class="pull-right badge bg-red">2%</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--POR VENCER-->
                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#ROSARIO-collapse3">
                                <div class="info-box bg-yellow">
                                  <span class="info-box-icon"><i class="ion-alert-circled"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Próx. Vencimientos</span>
                                    <span class="info-box-number">10</span>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: 20%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                    20% del total
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="ROSARIO-collapse3" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">ESTOS LINKS LLEVAN A LAS QUE SE ESTAN X VENCER QUE TENGA EL GESTOR</a></li>
                                  <li><a href="#">Gestor 01 <span class="pull-right">3 op</span></a></li>
                                  <li><a href="#">Gestor 04 <span class="pull-right">3 op</span></a></li>
                                  <li><a href="#">Gestor 05 <span class="pull-right">1 op</span></a></li>
                                  <li><a href="#">Gestor 06<span class="pull-right">2 op</span></a></li>
                                  <li><a href="#">Gestor 07 <span class="pull-right">1 op</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--VENCIDAS-->
                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#ROSARIO-collapse4">
                                <div class="info-box bg-red">
                                  <span class="info-box-icon"><i class="ion-ios-timer-outline"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Gestiones vencidas</span>
                                    <span class="info-box-number">7</span>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: 14%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                    14% del total
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="ROSARIO-collapse4" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">ESTOS LINKS LLEVAN A LAS VENCIDAS QUE TENGA EL GESTOR</a></li>
                                  <li><a href="#">Gestor 01 <span class="pull-right">1 op</span></a></li>
                                  <li><a href="#">Gestor 02 <span class="pull-right">2 op</span></a></li>
                                  <li><a href="#">Gestor 04 <span class="pull-right">1 op</span></a></li>
                                  <li><a href="#">Gestor 06<span class="pull-right">2 op</span></a></li>
                                  <li><a href="#">Gestor 07 <span class="pull-right">1 op</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="tab-pane" id="tab_2"> 
                <div class="cpanel">
                  <div class="box no-border">
                    <div class="box-header with-border">
                    <h3 class="box-title"><i class="ion-stats-bars"> </i> COMAFI_RS</h3>
                    </div>
                    <div class="box-body no-padding">
                      <div class="box-group" id="accordion">
                        <div class="col-md-3 col-sm-6"> 
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#COMAFI_RS-collapse1">
                                <div class="info-box bg-aqua">
                                  <span class="info-box-icon"><i class="ion-ios-paperplane"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Total Gestiones</span>
                                    <span class="info-box-number">50</span>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: 22%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                      Gestionadas: 22%
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="COMAFI_RS-collapse1" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">Despachadas <span class="pull-right badge bg-blue">39</span></a></li>
                                  <li><a href="#">Repactadas <span class="pull-right badge bg-aqua">2</span></a></li>
                                  <li><a href="#">Rellamar <span class="pull-right badge bg-orange">1</span></a></li>
                                  <li><a href="#">Cerrado Parc. <span class="pull-right badge bg-yellow">1</span></a></li>
                                  <li><a href="#">Cerrado <span class="pull-right badge bg-green">4</span></a></li>
                                  <li><a href="#">Negativas <span class="pull-right badge bg-red-active">1</span></a></li>
                                  <li><a href="#">Canceladas <span class="pull-right badge bg-red">2</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div> 

                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#COMAFI_RS-collapse2">
                                <div class="info-box bg-yellow">
                                  <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Efectividad</span>
                                    <span class="info-box-number">53.15%</span>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: 53.15%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="COMAFI_RS-collapse2" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">Plaza 01 <span class="pull-right badge bg-red">25%</span></a></li>
                                  <li><a href="#">Plaza 02 <span class="pull-right badge bg-yellow">56%</span></a></li>
                                  <li><a href="#">Plaza 03 <span class="pull-right badge bg-green">85%</span></a></li>
                                  <li><a href="#">Plaza 04 <span class="pull-right badge bg-yellow">66%</span></a></li>
                                  <li><a href="#">Plaza 05 <span class="pull-right badge bg-red">15%</span></a></li>
                                  <li><a href="#">Plaza 06<span class="pull-right badge bg-green">76%</span></a></li>
                                  <li><a href="#">Plaza 07 <span class="pull-right badge bg-red">2%</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#COMAFI_RS-collapse3">
                                <div class="info-box bg-yellow">
                                  <span class="info-box-icon"><i class="ion-alert-circled"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Próx. Vencimientos</span>
                                    <span class="info-box-number">10</span>

                                    <div class="progress">
                                      <div class="progress-bar" style="width: 20%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                      20% del total
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="COMAFI_RS-collapse3" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">Plaza 02 - Gestor 01 <span class="pull-right">3 op</span></a></li>
                                  <li><a href="#">Plaza 01 - Gestor 04 <span class="pull-right">3 op</span></a></li>
                                  <li><a href="#">Plaza 02 - Gestor 05 <span class="pull-right">1 op</span></a></li>
                                  <li><a href="#">Plaza 03 - Gestor 06<span class="pull-right">2 op</span></a></li>
                                  <li><a href="#">Plaza 05 - Gestor 07 <span class="pull-right">1 op</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                          <div class="panel box no-border">
                            <div class="box-header no-padding">
                              <a data-toggle="collapse" data-parent="#accordion" href="#COMAFI_RS-collapse4">
                                <div class="info-box bg-red">
                                  <span class="info-box-icon"><i class="ion-ios-timer-outline"></i></span>
                                  <div class="info-box-content">
                                    <span class="info-box-text">Gestiones vencidas</span>
                                    <span class="info-box-number">3</span>
                                    <div class="progress">
                                      <div class="progress-bar" style="width: 6%"></div>
                                    </div>
                                    <span class="progress-description pull-right">
                                      6% del total
                                    </span>
                                  </div>
                                </div>
                              </a>
                            </div>
                            <div id="COMAFI_RS-collapse4" class="panel-collapse collapse">
                              <div class="box-body no-padding">
                                <ul class="nav nav-stacked">
                                  <li><a href="#">Plaza 03 - Gestor 01 <span class="pull-right">1 op</span></a></li>
                                  <li><a href="#">Plaza 01 - Gestor 02 <span class="pull-right">2 op</span></a></li>
                                  <li><a href="#">Plaza 05 - Gestor 04 <span class="pull-right">1 op</span></a></li>
                                  <li><a href="#">Plaza 02 - Gestor 06 <span class="pull-right">2 op</span></a></li>
                                  <li><a href="#">Plaza 04 - Gestor 07 <span class="pull-right">1 op</span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
        
      </div>      
    </div>    
  </section>

  <section class="content">
    <div class="content-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="ion-ios-paperplane"></i> Visor de Servicios Gestionados.</h3>
            </div>
            <div class="box-body no-padding">
              <div class="box-group" id="accordion2">
                <div class="panel box no-border no-margin">
                  <div class="box-header with-border no-padding">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapse5">
                      <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="ion-ios-paperplane"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Gestionado</span>
                          <span class="info-box-number">22%</span>
                          <div class="progress">
                            <div class="progress-bar" style="width: 22%"></div>
                          </div>
                          <span class="progress-description">
                            <small>Total: </small>150 <span class="pull-right"><small>Gestionadas: </small>33</span>
                          </span>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div id="collapse5" class="panel-collapse collapse">
                    <div class="box-body no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="#">Despachadas <span class="pull-right badge bg-blue">39</span></a></li>
                        <li><a href="#">Repactadas <span class="pull-right badge bg-aqua">2</span></a></li>
                        <li><a href="#">Rellamar <span class="pull-right badge bg-orange">1</span></a></li>
                        <li><a href="#">Cerrado Parc. <span class="pull-right badge bg-yellow">1</span></a></li>
                        <li><a href="#">Cerrado <span class="pull-right badge bg-green">4</span></a></li>
                        <li><a href="#">Negativas <span class="pull-right badge bg-red-active">1</span></a></li>
                        <li><a href="#">Canceladas <span class="pull-right badge bg-red">2</span></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="ion-arrow-graph-up-right"> </i> Efectividad de cierre.</h3>
            </div>
            <div class="box-body no-padding">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Efectividad</span>
                  <span class="info-box-number">59.55%</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 59.55%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <div class="box-body no-padding">
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
            <div class="box-body no-padding">
              <a href="#">
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
            <div class="box-body no-padding">
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