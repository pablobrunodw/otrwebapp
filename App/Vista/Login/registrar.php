<?php    
    $url = "index.php?view=panelcontrol";
    $url_login = "index.php?view=login";
    $url_recuperar = "index.php?view=login_recuperar";
    $url_action_registrar = PATH_VISTA.'Login/action_registrar.php';

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
    <link href=<?php echo PATH_VISTA.'assets/dist/css/AdminLTE.min.css'; ?> rel="stylesheet" type="text/css" />
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
  <body class="login-page" style="background: #FFFFFF;">
    <?php
      if(!PRODUCCION)
        echo "<span class='label label-danger'>SISTEMA DE DESARROLLO</span>";
    ?>

    <div class="login-box">
      <div class="login-logo">        
        <a href="index.php">          
          <img src=<?php echo PATH_VISTA."assets/dist/img/logo-otr.png";?> style="position: relative;bottom: 3px;width: 50%;" >
        </a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Registrarse</p>
        
        <?php include_once PATH_VISTA."error.php"; ?>
       
        <form action=<?php echo $url_action_registrar; ?> method="post">
          
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Apellido" name="apellido" id="apellido" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-8">    
              ¿Recordaste tu contraseña? <a href=<?php echo $url_login; ?>>Volver</a>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
            </div><!-- /.col -->
          </div>
        </form>                        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

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