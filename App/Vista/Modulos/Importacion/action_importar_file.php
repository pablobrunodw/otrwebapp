  <?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";			
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';		

	$fecha = (isset($_POST['fecha_importacion'])? $_POST['fecha_importacion']:'');
	$tipo_importacion = (isset($_POST['tipo_importacion'])? $_POST['tipo_importacion']:'');
	$id_empresa_sistema = (isset($_POST['id_empresa_sistema'])? $_POST['id_empresa_sistema']:'');
	$plaza = "-";
	$email = (isset($_POST['email'])? $_POST['email']:'');
	$archivo = (isset($_FILES['archivo'])? $_FILES['archivo']:'');

	$err = "../../../../index.php?view=importacion&err=";     		
	$info = "../../../../index.php?view=importacion&info=";     		

	try {

		//conversion de fechas
		$f = new Fechas;
		$fecha = $f->FormatearFechas($fecha,'d/m/Y','Y-m-d');

		$url_view = "";

		if($tipo_importacion == 1)
			$url_view = "../../../../index.php?view=importacion_1&id_empresa_sistema=".$id_empresa_sistema."&fecha_importacion=".$fecha."&plaza=".$plaza."&excel=";

		if($tipo_importacion == 2)
			$url_view = "../../../../index.php?view=importacion_2&id_empresa_sistema=".$id_empresa_sistema."&fecha_importacion=".$fecha."&plaza=".$plaza."&excel=";  

		if($tipo_importacion == 3)
			$url_view = "../../../../index.php?view=importacion_3&id_empresa_sistema=".$id_empresa_sistema."&fecha_importacion=".$fecha."&plaza=".$plaza."&excel=";

		$handler = new handlerimportacion;        
        $result = $handler->cargarExcel($archivo,$email,$id_empresa_sistema,$fecha,$plaza);	

		header("Location: ".$url_view.$result);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}

?>