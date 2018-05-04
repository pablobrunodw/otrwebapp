<?php
  include_once PATH_NEGOCIO."Guias/handlerguias.class.php";     
  include_once PATH_NEGOCIO."Sistema/handlersistema.class.php"; 

  $url_action_enviar = PATH_VISTA.'Modulos/Guias/action_enviar_guias.php';
  $handler = new HandlerGuias;  

  $handlerSistema = new HandlerSistema;
  $arrEmpresa = $handlerSistema->selectAllEmpresa();

  $user = $usuarioActivoSesion;
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Envío
      <small>Realizar un envío de guía y remito</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Envío Guía</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-send"></i>       
            <h3 class="box-title">Envío de Guía y Remito</h3>          
          </div>
          <div class="box-body">

              <form action="<?php echo $url_action_enviar; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $user->getId(); ?>" name="usuario">

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Guía</label>
                      <input type="file" name="imagen" placeholder="Guias" class="form-control" accept='.jpg, .png, .gif'>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Empresa</label>
                      <div id="parent_slt_empresa">
                        <select id="slt_empresa" class="form-control" style="width: 100%" name="slt_empresas[]" multiple="multiple">                    
                          <option value="0">OTR GROUP</option>
                          <?php
                            if(!empty($arrEmpresa))
                            {                        
                              foreach ($arrEmpresa as $key => $value) {                                                  
                                echo "<option value='".$value->EMPTT11_CODIGO."'>".$value->EMPTT21_NOMBREFA."</option>";
                              }
                            }                      
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Observaciones</label>            
                      <input type="tex" name="observaciones" placeholder="Observaciones" class="form-control">
                    </div>
                  </div>             

                  <div class="col-md-1">
                    <div class="form-group" style="margin-top: 25px;">
                      <button type="submit" class="btn btn-primary pull-right">Enviar Guía</button>            
                    </div>
                  </div>
                </div>

              </form>

          </div>          
        </div>
      </div>        
    </div>     

  </section>
 </div>

<script type="text/javascript">        

  $(document).ready(function() {
    $('#slt_empresa').select2();

    $("#mnu_guias_envio").addClass("active");
  });   
</script>