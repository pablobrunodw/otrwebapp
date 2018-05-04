<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Panel de control de Coordinador</title>
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
					Servicios - (<span class="text-yellow">ABRIL 2018</span>)
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				</ol>
			</section>
			
			<section class="content" style="min-height: auto;">
				<div class="content-fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><i class="ion-stats-bars"></i> Diario</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body text-center">
									<div class="col-xs-4 border-right">
										<h5>Promedio</h5>
										<h3 class="text-yellow">62.90%</h3>
									</div>
									<div class="col-xs-4 border-right">
										<h5>Máximo</h5>
										<h3 class="text-green">72.18%</h3>
									</div>
									<div class="col-xs-4">
										<h5>Mínimo</h5>
										<h3 class="text-red">49.76%</h3>
									</div>
									<canvas id="performance_chart" class="col-xs-12 chart"></canvas>
									<div class="col-xs-6 border-right">
										<h5>Cerradas</h5>
										<h3 class="text-blue">4267</h3>
									</div>
									<div class="col-xs-6">
										<h5>Total</h5>
										<h3 class="text-blue">6754</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><i class="ion-stats-bars"></i> Últimos 6 meses</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body text-center">
									<div class="col-xs-4 border-right">
										<h5>Promedio</h5>
										<h3 class="text-yellow">61.46%</h3>
									</div>
									<div class="col-xs-4 border-right">
										<h5>Máximo</h5>
										<h3 class="text-yellow">64.80%</h3>
									</div>
									<div class="col-xs-4">
										<h5>Mínimo</h5>
										<h3 class="text-red">57.63%</h3>
									</div>
									<canvas id="anual_chart" class="col-xs-12 chart"></canvas>
									<div class="col-xs-6 border-right">
										<h5>Cerradas</h5>
										<h3 class="text-blue">28392</h3>
									</div>
									<div class="col-xs-6">
										<h5>Total</h5>
										<h3 class="text-blue">46302</h3>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="box box-solid">
								<div class="box-header with-border">
									<h3 class="box-title"><i class="ion-stats-bars"></i> BANCO DE SANTA FE</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
										<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
									</div>
								</div>
								<div class="box-body text-center">
									<div class="col-xs-4 border-right">
										<h5>Promedio</h5>
										<h3 class="text-yellow">69.53%</h3>
									</div>
									<div class="col-xs-4 border-right">
										<h5>Máximo</h5>
										<h3 class="text-green">80.00%</h3>
									</div>
									<div class="col-xs-4">
										<h5>Mínimo</h5>
										<h3 class="text-red">58.00%</h3>
									</div>
									<canvas id="budget_month_chart" class="col-xs-12 chart"></canvas>
									<div class="col-xs-6 border-right">
										<h5>Cerradas</h5>
										<h3 class="text-light-blue">2143</h3>
									</div>
									<div class="col-xs-6">
										<h5>Total</h5>
										<h3 class="text-blue">3060</h3>
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
		var config_perf = {
			type: 'line',
			data: {
				labels: ['03/04','04/04','05/04','06/04','07/04','09/04','10/04','11/04','12/04','13/04','14/04','16/04','17/04','18/04','19/04','20/04'],
				datasets: [{
					label: 'Efectividad',
					data: [49.76,62.50,65.72,61.33,62.68,55.56,61.40,63.11,69.81,68.16,67.40,57.55,58.70,67.37,72.18,60.72],
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



		var config_anual = {
			type: 'line',
			data: {
				labels: ['Oct-17','Nov-17','Dic-17','Ene-18','Feb-18','Mar-18',],
				datasets: [{
					label: 'Efectividad',
					data: [64.80,63.81,59.52,63.03,57.63,59.98],
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

		var config_BSF = {
			type: 'line',
			data: {
				labels: ['03/04','04/04','05/04','06/04','07/04','09/04','10/04','11/04','12/04','13/04','14/04','16/04','17/04','18/04','19/04','20/04'],
				datasets: [{
					label: 'Efectividad',
					data: [58.00,71.69,69.19,70.21,66.09,71.18,76.92,65.92,80.00,74.44,68.42,60.08,67.37,69.55,72.40,71.00],
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
						ticks:{
							stepSize:3,
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
			var ctx_perf = document.getElementById('performance_chart').getContext('2d');
			window.myLine_perf = new Chart(ctx_perf, config_perf);
			var ctx_anual = document.getElementById('anual_chart').getContext('2d');
			window.myLine_anual = new Chart(ctx_anual, config_anual);
			var ctx_BSF = document.getElementById('budget_month_chart').getContext('2d');
			window.myLine_BSF = new Chart(ctx_BSF, config_BSF);
			
		};
	</script>



</body>
</html>
