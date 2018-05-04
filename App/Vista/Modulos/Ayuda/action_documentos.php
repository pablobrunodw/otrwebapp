<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerayuda.class.php"; 
	
	$hanlder = new HandlerAyuda();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$nombre = (isset($_POST["nombre"])?$_POST["nombre"]:'');
	$grupo = (isset($_POST["slt_grupo"])?$_POST["slt_grupo"]:'');
	$url =  (isset($_POST["url"])?$_POST["url"]:'');
	$roles = (isset($_POST["slt_roles"])?$_POST["slt_roles"]:'');
	$adjunto = (isset($_FILES["adjunto"])?$_FILES["adjunto"]:'');	

	$valores ="";
	if(!empty($roles)){
		foreach ($roles as $key => $value) {
			$valores = $valores.$value."|";
		}
	}
	$roles=$valores;

	$err = "../../../../index.php?view=documento_ayuda&err=";     		
	$info = "../../../../index.php?view=documento_ayuda&info=";     		

	try {
		if($estado=="ELIMINAR"){
			$hanlder->eliminarDocumentosABM($id);
			$msj="El documento se eliminó con éxito.";			
		}
		else{
			$hanlder->guardarDocumentosABM($id,$nombre,$grupo,$url,$roles,$adjunto,$estado);
			$msj="El documento se guardo con éxito.";			
		}
		

		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>