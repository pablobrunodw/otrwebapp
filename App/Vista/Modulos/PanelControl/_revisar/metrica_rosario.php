<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Métricas Rosario</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="http://desa.otrgroup.com.ar/App/Vista/assets/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="http://desa.otrgroup.com.ar/App/Vista/assets/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
 folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="http://desa.otrgroup.com.ar/App/Vista/assets/dist/css/skins/_all-skins.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- Estilos -->
<style>
.box-title {width: 100%;}
.cpanel {padding: 0;}
/*.info-box {margin-bottom: 0;}*/
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
			<section class="content-header">
				<h1>
					Plaza Rosario - <small>Evolución - (<span class="text-yellow">ABRIL 2018</span>)</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				</ol>
			</section>
			
			<section class="content" style="min-height: auto;">
				<div class="content-fluid">
					<div class="row">
						<div class="col-md-4">
							<div class="box box-solid">
								<div class="box-header with-border"><h3 class="box-title"><i class="ion-pound"> </i> Valores al 24-04-2018</h3></div>
								<div class="box-body">
									
									<div class="info-box bg-yellow">
										<span class="info-box-icon"><i class="ion-arrow-graph-up-right"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">EFECTIVIDAD</span>
											<span class="info-box-number">65.03%</span>

											<div class="progress">
												<div class="progress-bar" style="width: 65.03%"></div>
											</div>
											<span class="progress-description">
												2308 <small>Cerrados</small><span class="pull-right">3549 <small>Servicios</small> </span>
											</span>
										</div>
									</div>
									<div class="info-box bg-red">
										<span class="info-box-icon"><i class="ion-calculator"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">ENVIADOS</span>
											<span class="info-box-number">7041.4</span>

											<div class="progress">
												<div class="progress-bar" style="width: 78.02%"></div>
											</div>
											<span class="progress-description">
												<span class="pull-right"><small>Objetivo: </small>9025.0</span>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><i class="ion-ios-pulse-strong"></i> <span class="text-yellow">01-04-2018 - 23-04-2018</span></h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body text-center chart">
									<div class="col-xs-4 border-right">
										<h5>Promedio</h5>
										<h3 class="text-yellow">67.78%</h3>
									</div>
									<div class="col-xs-4 border-right">
										<h5>Máximo</h5>
										<h3 class="text-green">77.72%</h3>
									</div>
									<div class="col-xs-4">
										<h5>Mínimo</h5>
										<h3 class="text-red">54.39%</h3>
									</div>
									<canvas id="rosario_chart"></canvas>
									<div class="col-xs-6 border-right">
										<h5>Cerradas</h5>
										<h3 class="text-blue">2237</h3>
									</div>
									<div class="col-xs-6">
										<h5>Total</h5>
										<h3 class="text-blue">3272</h3>
									</div>
								</div>
							</div>
						</div>
						<div class=" col-sm-6 col-md-4">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><i class="ion-ios-pulse-strong"></i> Ultimos 6 meses</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body text-center">
									<div class="col-xs-4 border-right">
										<h5>Promedio</h5>
										<h3 class="text-yellow">66.92%</h3>
									</div>
									<div class="col-xs-4 border-right">
										<h5>Máximo</h5>
										<h3 class="text-green">72.46%</h3>
									</div>
									<div class="col-xs-4">
										<h5>Mínimo</h5>
										<h3 class="text-yellow">62.12%</h3>
									</div>
									<canvas id="rosario_6m_chart"></canvas>
									<div class="col-xs-6 border-right">
										<h5>Cerradas</h5>
										<h3 class="text-blue">12606</h3>
									</div>
									<div class="col-xs-6">
										<h5>Total</h5>
										<h3 class="text-blue">18758</h3>
									</div>
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
	<!-- FastClick -->
	<script src="/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="/dist/js/demo.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
	<script src="https://rawgit.com/chartjs/chartjs-plugin-annotation/master/chartjs-plugin-annotation.js"></script>
	<script>
		var config_rosario = {
			type: 'line',
			data: {
				labels: ['03/04','04/04','05/04','06/04','07/04','09/04','10/04','11/04','12/04','13/04','14/04','16/04','17/04','18/04','19/04','20/04','21/04','23/04'],
				datasets: [{
					label: 'Efectividad',
					data: [54.39,66.45,68.89,69.41,61.21,67.42,75.00,60.68,76.92,77.72,70.80,58.52,65.67,66.80,72.41,68.10,65.63,74.06],
					fill: false,
					borderColor: 'cornflowerblue',
					backgroundColor: 'cornflowerblue',
					borderWidth: 2,
					lineTension: 0,
					pointRadius: 1,
				}]
			},
			options: {
				responsive: true,
				legend: {display:false},
				title: {
					display: false,
				},
				scales: {
					xAxes:[{
						gridLines: {
							display: false,
						},
						
					}],
					yAxes:[{
						ticks: {
							min: 30,
							max: 90,
							stepSize: 10
						}
						
					}]
				},
				tooltips: {
					xPadding:20,
					yPadding:20,
				},
				annotation: {
					annotations: [{
						type: 'line',
						mode: 'horizontal',
						scaleID: 'y-axis-0',
						value: 70,
						borderColor: 'darkgreen',
						borderWidth: 1,
						label: {
							enabled: false,
							content: 'Test label'
							}
						},
						{
						type: 'line',
						mode: 'horizontal',
						scaleID: 'y-axis-0',
						value: 60,
						borderColor: 'red',
						borderWidth: 1,
						label: {
							enabled: false,
							content: 'Test label'
							}
						}
					],
				},
			}
		};


		var config_rosario6m = {
			type: 'line',
			data: {
				labels: ['Oct-17','Nov-17','Dic-17','Ene-18','Feb-18','Mar-18'],
				datasets: [{
					label: 'Efectividad',
					data: [68.35,65.39,62.12,67.40,65.80,72.46],
					fill: false,
					borderColor: 'cornflowerblue',
					backgroundColor: 'cornflowerblue',
					borderWidth: 2,
					lineTension: 0,
					pointRadius: 1,
				}]
			},
			options: {
				responsive: true,
				legend: {display:false},
				title: {
					display: false,
				},
				scales: {
					xAxes:[{
						gridLines: {
							display: false,
						},
						
					}],
					yAxes:[{
						ticks: {
							min: 30,
							max: 90,
							stepSize: 10
						}
						
					}]
				},
				tooltips: {
					xPadding:20,
					yPadding:20,
				},
				annotation: {
					annotations: [{
						type: 'line',
						mode: 'horizontal',
						scaleID: 'y-axis-0',
						value: 70,
						borderColor: 'darkgreen',
						borderWidth: 1,
						label: {
							enabled: false,
							content: 'Test label'
							}
						},
						{
						type: 'line',
						mode: 'horizontal',
						scaleID: 'y-axis-0',
						value: 60,
						borderColor: 'red',
						borderWidth: 1,
						label: {
							enabled: false,
							content: 'Test label'
							}
						}
					],
				},
			}
		};


		window.onload = function() {
			var ctx_rosario = document.getElementById('rosario_chart').getContext('2d');
			window.myLine_rosario = new Chart(ctx_rosario, config_rosario);
			var ctx_rosario6m = document.getElementById('rosario_6m_chart').getContext('2d');
			window.myLine_rosario6m = new Chart(ctx_rosario6m, config_rosario6m);
			
		};
	</script>



</body>
</html>
