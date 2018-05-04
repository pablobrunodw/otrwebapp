  <?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";	
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';		
	
	$fecha = (isset($_POST['fecha_importacion'])? $_POST['fecha_importacion']:'');
	$tipo_importacion = (isset($_POST['tipo_importacion'])? $_POST['tipo_importacion']:'');
	$id_empresa_sistema = (isset($_POST['id_empresa_sistema'])? $_POST['id_empresa_sistema']:'');
	$plaza = (isset($_POST['plaza'])? $_POST['plaza']:'');
	$cols = (isset($_POST['cols'])? $_POST['cols']:'');
	$rows = (isset($_POST['rows'])? $_POST['rows']:'');

	$err = "../../../../index.php?view=importacion&err=";     		
	$info = "../../../../index.php?view=importacion&info=";     		

	try {
		for ($i = 1; $i < $rows; ++$i) {
						
			for ($j = 0; $j < $cols; ++ $j) {
				$tag = $i."_".$j;
				$data[$i][$j] = (isset($_POST[$tag])? $_POST[$tag]:'');						
			}											
		}		

		$handler = new handlerimportacion;    

		if($tipo_importacion==1)
        	$handler->guardarRegistrosTipo1($fecha,$id_empresa_sistema,$tipo_importacion,$plaza,$data);	

       	if($tipo_importacion==2)
       		$handler->guardarRegistrosTipo2($fecha,$id_empresa_sistema,$tipo_importacion,$plaza,$data);	

       	if($tipo_importacion==3)
       		$handler->guardarRegistrosTipo3($fecha,$id_empresa_sistema,$tipo_importacion,$plaza,$data);	

        $msj="Se guardaron todos los registros de la importación";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}

?>