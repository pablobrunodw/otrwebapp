<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	//include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";
	include_once PATH_NEGOCIO.'Funciones/Excel/PHPExcel.php';
	   	
	$email = (isset($_GET['usuario_email'])? $_GET['usuario_email']:'');    
    $fdesde=(isset($_GET["fdesde"])?$_GET["fdesde"]:date('Y-m-d', strtotime('-0 days')));
    $fhasta=(isset($_GET["fhasta"])?$_GET["fhasta"]:date('Y-m-d'));
    $festado=(isset($_GET["festado"])?$_GET["festado"]:0);
    $fequipoventa=(isset($_GET["fequipoventa"])?$_GET["fequipoventa"]:'');
    $fcliente=(isset($_GET["fcliente"])?$_GET["fcliente"]:'');    
    $fcoordinador=(isset($_GET["fcoordinador"])?$_GET["fcoordinador"]:'');

	$handler = new HandlerSistema;
	$servicios = $handler->selectServicios($fdesde,$fhasta,$festado,$fcliente,null,null,$fcoordinador,null,$fequipoventa);                      

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->setActiveSheetIndex(0);

	$rowCount = 1;
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "FECHA");
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "NUMERO");
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, "DNI");
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "NOMBRE ");
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "TELEFONO");
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "LOCALIDAD");

	$rowCount = 2;
	foreach ($servicios as $key => $value){
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->SERTT11_FECSER->format('d/m/Y'));
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->SERTT12_NUMEING);
	    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->SERTT31_PERNUMDOC);
	    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->SERTT91_NOMBRE);
	    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->SERTT91_TELEFONO);
	    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->SERTT91_LOCALIDAD);

	    $rowCount++;

	    $fechaing = $value->SERTT11_FECSER->format('Y-m-d');	    
	    $nroing = $value->SERTT12_NUMEING;	   
	    $detalle = $handler->selectServiciosHistorico($fechaing,$nroing);	  

	    if(!empty($detalle)){
		    foreach ($detalle as $key_detalle => $val_detalle) {
		    	$observaciones = $val_detalle->HSETT91_OBSERV." // ".$val_detalle->HSETT91_OBRESPU." // ".$val_detalle->HSETT91_OBSEENT;

		    	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $val_detalle->HSETT11_FECEST->format('d/m/Y H:i:s'));
		    	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $val_detalle->ESTADOS_DESCCI);
		    	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $observaciones);

		    	$rowCount++;
		    }
		}

		$rowCount++;
	    
	}

	$archivo_save=PATH_ROOT.PATH_CLIENTE.$email.'/listado_servicios.xlsx';
	$archivo_download=BASE_URL.PATH_CLIENTE.$email.'/listado_servicios.xlsx';
	
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save($archivo_save);

	header('Location: '.$archivo_download);
?>