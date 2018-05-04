<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php";	
	//include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";
	include_once PATH_NEGOCIO.'Funciones/Excel/PHPExcel.php';

	$email = (isset($_GET['usuario_email'])? $_GET['usuario_email']:'');

	$handler = new HandlerLegajos;
	$legajos = $handler->seleccionarTodosLegajos();

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);

	$rowCount = 1;
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "ID");
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "NOMBRE");
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "CUIL");
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "NACIMIENTO");
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "DIRECCION");
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "CELULAR");
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, "TELEFONO");
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, "ESTADO CIVIL");
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, "HIJOS");
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, "VTO LICENCIAS");
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, "VTO VTV");
    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, "HORAS");
    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, "OFICINA");
    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, "CATEGORIA");	    
    $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, "NUMERO LEGAJO");	 


	$rowCount = 2;
	foreach ($legajos as $key => $value){
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->getId());
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->getNombre());
	    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->getCuit());
	    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->getNacimiento()->format('d/m/Y'));
	    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->getDireccion());
	    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->getCelular());
	    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->getTelefono());
	    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $value->getEstadoCivil());
	    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $value->getHijos());
	    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $value->getLicenciaVto()->format('d/m/Y'));
	    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $value->getVtvVto()->format('d/m/Y'));
	    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $value->getHoras());
	    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $value->getOficina());
	    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $value->getCategoria());	    
	    $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $value->getNumeroLegajo());	    

	    $rowCount++;
	}

	$archivo_save=PATH_ROOT.PATH_CLIENTE.$email.'/listado_legajos.xlsx';
	$archivo_download=BASE_URL.PATH_CLIENTE.$email.'/listado_legajos.xlsx';
	
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save($archivo_save);

	header('Location: '.$archivo_download);
?>