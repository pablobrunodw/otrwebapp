<?php    
    $url = "index.php?view=panelcontrol";
    $url_login = "index.php?view=login";    
    $url_registrar = "index.php?view=login_registrar";    
    $url_action_recuperar = PATH_VISTA.'Login/action_recuperar.php';

    
    session_start([
      'cookie_lifetime' => 2592000,
      'gc_maxlifetime'  => 2592000,
    ]);
    if(isset($_SESSION["usuario"]) || isset($_SESSION["logueado"]) || isset($_SESSION["pass"]))
      header("Location: ".$url);  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>OTR Group</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href=<?php echo PATH_VISTA.'assets/bootstrap/css/bootstrap.min.css'; ?> rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href=<?php echo PATH_VISTA.'assets/dist/css/AdminLTE.css'; ?> rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href=<?php echo PATH_VISTA.'assets/plugins/iCheck/square/blue.css'; ?> rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href=<?php echo PATH_VISTA.'assets/dist/img/logo-otr.png'; ?>>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page" style="background: #FFFFFF; overflow:hidden">
    <?php
      if(!PRODUCCION)
        echo "<span class='label label-danger'>SISTEMA DE DESARROLLO</span>";
    ?>
    
      <div class="col-md-8 no-padding hidden-xs hidden-sm">
        
        <style type="text/css">
          #bljaIMGte{float:left;position:relative;}
          #bljaIMGte .bljaIMGtex {position:absolute;top:150px;left:0px;}
        </style>
        
        <div id="bljaIMGte">
          <img class='img-responsive' src="<?php echo PATH_VISTA.'assets/dist/img/fondo.jpg'; ?>" style='-webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%);'>
          <div class="bljaIMGtex" style="color:#fff; background-color: rgba(131, 23, 26, 0.50); padding: 30px;">
            <div class="row">
              <div class="col-md-12">
                <h1 style="text-align: left;"><b>Seguridad y trazabilidad en cada operación</b></h1>
              </div>

              <div class="col-md-12" style="margin-top: 20px; margin-left: 25px;">                
                <span style="font-size: 25px;"><i style="font-size: 30px;" class="fa fa-road"></i> Tracking de cada gestión en tiempo real</span>                
              </div>
                
              <div class="col-md-12" style="margin-top: 20px; margin-left: 25px;">                
                <span style="font-size: 25px;"><i style="font-size: 30px;" class="fa fa-camera"></i> Digitalización de documentos</span>                
              </div>              
                        
              <div class="col-md-12" style="margin-top: 20px; margin-left: 25px;">
                <span style="font-size: 25px;"><i style="font-size: 30px;" class="fa fa-upload"></i> Carga e importación de gestiones</span>                
              </div>    

              <div class="col-md-12" style="margin-top: 20px; margin-left: 25px;">
                <span style="font-size: 25px;"><i style="font-size: 30px;" class="fa fa-search-plus"></i> Búsqueda de gestiones históricas</span>
              </div> 

            </div>
          </div>
        </div>

      </div>
      <div class='col-md-4' style="height:90vh;">
        <?php include_once PATH_VISTA."error.php"; ?>
        <?php include_once PATH_VISTA."info.php"; ?>

        <div class="login-box" style="margin-top:190px;">
          <div class="login-logo" style="text-align: left;">        
            <a href="index.php">            
              <img src=<?php echo PATH_VISTA."assets/dist/img/logo-otr.png";?> style="position: relative;bottom: 3px;width: 50%;" >
            </a>
          </div><!-- /.login-logo -->
          <div class="login-box-body no-padding">        
            <!--<p class="login-box-msg">Iniciar sección</p>-->
            
            <form action=<?php echo $url_action_recuperar; ?> method="post">
              <div class="form-group has-feedback">
                <input type="text" class="form-control input-lg" placeholder="Email" name="email" id="email" required/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8">    
                  <p style='font-size: 15px;'> ¿Recordaste tu contraseña? <a href=<?php echo $url_login; ?>>Volver</a></p>
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat btn-lg">Enviar</button>
                </div><!-- /.col -->
              </div>
            </form> 


          </div><!-- /.login-box-body -->

          <!--¿Todavía no tenés una cuenta? <a href=<?php echo $url_registrar; ?>>Registrate</a>-->
          
        </div><!-- /.login-box -->      

        
        <footer style="position: absolute; display: block; bottom: 0; height: 3em">          
          <div class="row">
            <div class="col-md-12"> 
              <hr style="margin-right: 15px;">           
              <div class="col-md-8">
                <p style="font-size: 12px;">
                  Unidad de negocio desarrollada por<br> 
                  <a href='http://commgroup.com.ar' target="_blank">
                    Commercial Group
                  </a>
                </p>
              </div>
              <div class="col-md-4">
                <a href='http://commgroup.com.ar' target="_blank">
                  <img src='http://commgroup.com.ar/images/logos/transparente.png' class="img-responsive pull-right" style="margin-right: 15px;">
                </a>
              </div>
            </div>   
          </div>     
        </footer>  

      </div>  

    <!-- jQuery 2.1.3 -->
    <script src=<?php echo PATH_VISTA.'assets/plugins/jQuery/jQuery-2.1.3.min.js'; ?>></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src=<?php echo PATH_VISTA.'assets/bootstrap/js/bootstrap.min.js'; ?> type="text/javascript"></script>
    <!-- iCheck -->
    <script src=<?php echo PATH_VISTA.'assets/plugins/iCheck/icheck.min.js'; ?> type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>