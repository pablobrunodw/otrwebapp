<?php
  include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";     
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  


  $handler = new HandlerImportacion;  
  $arrImportacionSinPlaza = $handler->selecionarImportacionTipo1SinPlazaGroupCliente();

  $handlerSistema = new HandlerSistema;

  //var_dump($arrImportacion);
  //exit();

?>

<div class="col-md-6 nopadding">
  <div class="box box-solid">
    <div class="box-header with-border">
      <i class="fa fa-upload"></i>
      <h3 class="box-title">Importaciones Sin Plaza Asignadas.</h3>
    </div>
    <div class="box-body table-responsive no-padding">
      <table class="table table-striped table-bordered" id="tabla" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class='text-left'>Clientes</th>
            <th class='text-center'>Cantidad</th>
            <th class='text-center'></th>
          </tr>
        </thead>
        <tbody>
          <?php
            if(!empty($arrImportacionSinPlaza))
            {                    

              foreach ($arrImportacionSinPlaza as $key => $value) {                                   

                    $nombre_empresa = $handlerSistema->selectEmpresaById($value["EMPRESA"]);
                    $url_detalle_importaciones="?view=importaciones_sin_plaza&fcliente=".$nombre_empresa[0]->EMPTT11_CODIGO;

                echo "
                  <tr>
                    <td class='text-left'>".$nombre_empresa[0]->EMPTT21_NOMBREFA."</td>
                    <td class='text-center' style='style='font-size:18px;'>".$value["TOTAL"]."</td>
                    <td class='text-center'>
                      <a href='$url_detalle_importaciones' class='btn btn-default btn-xs'><b>Detalle</b></a>
                    </td>
                  </tr>
                ";
                
              }
            }                  
          ?>
        </tbody>
      </table>
    </div>
  </div>  
</div>