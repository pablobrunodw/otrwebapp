  <?php 
    include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";

    $countSinPlaza=0;
    $countSinImportar=0;

    $handlerNotificacionImportacion = new HandlerImportacion;
    $countSinPlaza = $handlerNotificacionImportacion->countSinPlaza();
    $countSinImportar = $handlerNotificacionImportacion->countSinImportar();

    $url_sinplaza = "?view=importaciones_sin_plaza";
    $url_sinimportar = "?view=importaciones_sin_importar";
  ?>

  <?php if($esCoordinador || $esSupervisor || $esGerencia){ ?>
    <li class="dropdown notifications-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="ion-archive"></i> 
        <span id="contador_noti_user" class="label" style="font-size:12px;"></span>

        <?php if(($countSinImportar + $countSinPlaza)>0){ ?>
          <span id="contador_noti_empresa" class="label label-danger" style="font-size:12px;">
            <?php echo ($countSinImportar + $countSinPlaza); ?>
          </span>
        <?php } ?>
      </a>
      <ul class="dropdown-menu">
        <li>
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
            <ul class="menu" style="overflow: auto; width: 100%; height: auto;">
              <li>
                <a href="<?php echo $url_sinplaza; ?>">
                  <b>Sin Plaza</b><span class="badge bg-navy pull-right">
                    <?php echo $countSinPlaza; ?>
                  </span>
                </a>
              </li>
              <li>
                <a href="<?php echo $url_sinimportar; ?>">
                  <b>Sin Sincronizar</b><span class="badge bg-navy pull-right">
                    <?php echo $countSinImportar; ?>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
  <?php } ?>