<?php
  $user = $usuarioActivoSesion;

  $url_action_enviar = PATH_VISTA.'Modulos/Inbox/action_enviar.php';
?>

<div class="content-wrapper">  
  <section class="content-header">
    <h1>
      Contacto con OTR Group
      <small>Comunicación directa con un responsable</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Inbox</li>
    </ol>
  </section>        
  
  <section class="content">

    <?php include_once PATH_VISTA."error.php"; ?>
    <?php include_once PATH_VISTA."info.php"; ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">   
            <i class="fa fa-inbox"></i>       
            <h3 class="box-title">Enviar Mensaje</h3>          
          </div>
          <div class="box-body">
            <form method="post" action="<?php echo $url_action_enviar; ?>">
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre Remitente</label>            
                    <input type="text" class="form-control" name="nombreremitente" readonly value="<?php echo $user->getNombre().' '.$user->getApellido(); ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email Remitente</label>            
                    <input type="email" class="form-control" name="emailremitente" readonly value="<?php echo $user->getEmail(); ?>">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Asunto</label>                         
                    <input type="text" class="form-control" name="asunto" placeholder="Asunto">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Mensaje</label>            
                    <textarea class="form-control" name="mensaje" style="height: 200px;" placeholder="Escribinos tu consulta"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Enviar Consulta</button>            
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
  $(document).ready(function(){                
    $("#mnu_inbox").addClass("active");
  });
</script>