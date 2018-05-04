<?php
  $url_panelcontrol = "index.php?view=panelcontrol";
?>
<div class="content-wrapper" style="min-height: 1068px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Acceso Denegado
    </h1>    
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="error-page">
      <h2 class="headline text-red"><i class="fa fa-lock"></i></h2>
      <div class="error-content">
        <h3><i class="fa fa-warning text-red"></i> No tiene permisos para ingresar en esta sección.</h3>
        <p>
          Comuniquese con el soporte técnico para resolver este problema.
          Para continuar trabajando vuelva al <a href=<?php echo $url_panelcontrol; ?>>Panel de Control</a>.
        </p>        
      </div>
    </div><!-- /.error-page -->

  </section><!-- /.content -->
</div>