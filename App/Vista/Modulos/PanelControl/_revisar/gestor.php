<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Panel de control de Coordinador</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/table.min.css">

<!-- Estilos -->
<style>
.box-title {width: 100%;}
.cpanel {padding: 0;}
.info-box {margin-bottom: 0;}
.stackable td::before{content: attr(data-th);font-weight: bold; color: #a1a1a1;display: inline;font-size: 12px;text-transform: uppercase; margin-right: 10px;}
.stackable td {padding-left: 10px;}
@media (min-width: 768px) {
	.cpanel {padding: inherit;}
	.stackable td::before{display: none;}
  	.stackable td {padding-left: 0px;}
}
</style>
</head>
<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-black sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">

			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>


			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">

			<!-- search form -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="/index.html"><i class="fa fa-circle-o"></i> Supervisor</a></li>
							<li><a href="/gestor.html"><i class="fa fa-circle-o"></i> Gestor</a></li>
							<li><a href="/coord.html"><i class="fa fa-circle-o"></i> Coordinador</a></li>
							<li><a href="/gerencia.html"><i class="fa fa-circle-o"></i> Gerencia</a></li>
						</ul>
					</li>

				</ul>
			</section>
		<!-- /.sidebar -->
		</aside>

		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
		<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Resumen Diario - (<span class="text-yellow">09.04.18 - 12:30</span>)
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				</ol>
			</section>

			<section class="content">
				<div class="content-fluid">
					<div class="row">
					<!-- Cantidades -->
						<div class="col-md-4 col-lg-3">
							<div class="box box-solid">
								<div class="box-header with-border"><h3 class="box-title"><i class="ion-arrow-graph-up-right"> </i> Gestiones</h3></div>
								<div class="box-body no-padding">
									<div class="info-box bg-aqua">
										<span class="info-box-icon"><i class="ion-ios-paperplane"></i></span>

										<div class="info-box-content">
											<span class="info-box-text">GESTIONES</span>
											<span class="info-box-number">50</span>

											<div class="progress">
												<div class="progress-bar" style="width: 22%"></div>
											</div>
											<span class="progress-description">
												<span class="pull-right">22% <small>Gestionadas</small></span>
											</span>

										</div>

									</div>
									
								</div>
							</div>
						
						<!-- Fin Cantidades -->

						<!-- =============================================== -->

						<!-- Efectividad -->
							<div class="box box-solid">
								<div class="box-header"><h3 class="box-title"><i class="ion-speedometer"> </i> Performance</h3></div>
								<div class="box-body no-padding">
									<div class="box-group" id="accordion2">
										<div class="panel box no-border no-margin">
											<div class="box-header with-border no-padding">
												<div class="info-box bg-green">
													<span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>

													<div class="info-box-content">
														<span class="info-box-text">Efectividad</span>
														<span class="info-box-number">76.73%</span>

														<div class="progress">
															<div class="progress-bar" style="width: 76.73%"></div>
														</div>
														<span class="progress-description">

														</span>

													</div>

												</div>
											</div>
											<div id="collapse5" class="">
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
						<!-- Fin Efectividad -->

						<!-- =============================================== -->

						<!-- Vencimientos -->
						<div class="col-md-8 col-lg-9">
							<div class="box box-solid">
								<div class="box-header"><h3 class="box-title"><i class="ion-ios-timer-outline"> </i> Por Vencer</h3></div>
								<div class="box-body no-padding">
									<div class="col-xs-12 text-center with-border" style="color: #777 !important;">
										<h3 class="text-yellow"><i class="fa fa-exclamation-triangle"></i> <span class="text-black"> 10 <small>gestiones próximas a vencerse</small></span></h3>
									</div>
									<div class="col-xs-12 no-padding">
										<table class="ui stackable table">
											<thead class="hidden-xs hidden-sm">
												<tr>
													<th>Nombre</th>
													<th>DNI</th>
													<th>Dirección</th>
													<th>Localidad</th>
													<th>Teléfono</th>
													<th>Horario</th>
													<th>Empresa</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="zoiper: 0341155313338">0341155313338</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="box box-solid">
								<div class="box-header"><h3 class="box-title"><i class="ion-ios-timer-outline"> </i> Vencidas</h3></div>
								<div class="box-body no-padding">
									<div class="col-xs-12 text-center with-border" style="color: #777 !important;">
										<h3 class="text-red"><i class="fa fa-exclamation-circle"></i> <span class="text-black"> 7<small>gestiones vencidas</small></span></h3>
									</div>
									<div class="col-xs-12 no-padding">
										<table class="ui stackable table">
											<thead class="hidden-xs">
												<tr>
													<th>Nombre</th>
													<th>DNI</th>
													<th>Dirección</th>
													<th>Localidad</th>
													<th>Teléfono</th>
													<th>Horario</th>
													<th>Empresa</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
												<tr>
													<td data-th="Nombre:">NOMBRE Y APELLIDO</td>
													<td data-th="DNI:">111111111</td>
													<td data-th="Dirección:">Su casa 2576 piso 3 dpto 5</td>
													<td data-th="Localidad:">Su ciudad / pueblo</td>
													<td data-th="Teléfono:"><a href="tel: 3415555555">3415555555</a></td>
													<td data-th="Horario:">09:00 a 20:00</td>
													<td data-th="Empresa:">FRANCE</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					<!-- Fin vencidas -->

					<!-- =============================================== -->
					</div>
				</div>
			</section>

			<section class="content-header">
				<h1>
					Resumen Mensual - (<span class="text-yellow">ABRIL 2018</span>)
				</h1>
			</section>
			<section class="content">
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
		<!-- /.content -->
		</div>
	<!-- /.content-wrapper -->


	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="/dist/js/demo.js"></script>
</body>
</html>
