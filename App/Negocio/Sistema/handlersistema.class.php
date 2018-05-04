<?php
	
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionsistema.class.php';
	include_once PATH_DATOS.'BaseDatos/sqlsistema.class.php';
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';

	class HandlerSistema {

		public function selectServicios($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador, $equipovta){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER <=  '".$tmp."' AND ";
					}
				}

				$filtro_estado="";
				if(!empty($estado))								
					$filtro_estado = "SERTT91_ESTADO = ".$estado." AND ";
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$filtro_equipovta="";
				if(!empty($equipovta))								
					$filtro_equipovta = "TEPE91_EQUIPVTA = '".$equipovta."' AND ";


				$query = "SELECT
					SERTT11_FECSER, SERTT12_NUMEING, SERTT91_NOMBRE, SERTT91_DOMICILIO, 
					SERTT91_LOCALIDAD, SERTT91_ESTADO, SERTT91_OBSERV, SERTT91_OBSEENT, 
					SERTT91_VALSERV, SERTT91_CARGCLIE, SERTT91_CARSERV, SERTT31_PERTIPDOC, 
					SERTT31_PERNUMDOC, SERTT91_TELEFONO, SERTT91_HORARIO, SERTT91_COBROCLI, 
					SERTT91_OPERAD, SERTT91_LIQSN, SERTT91_AUDITADO, SERTT91_OBRESPU, 
					SERTT91_CODEMPRE, SERTT91_CODGESTOR, SERTT91_COOALIAS, SERTT91_GTEALIAS, 
					SERTT91_CUADRANTE, SERTT41_FECEST, SERTT91_IDOPORT,					
					GESTOR21_ALIAS, EMPTT21_NOMBRE, EMPTT21_ABREV, EMPTT21_NOMBREFA,
					CASE SERTT91_ESTADO
					  WHEN 1 THEN 'Pendiente' 
					  WHEN 2 THEN 'Despachado'  
					  WHEN 3 THEN 'Cerrado Parcial' 
					  WHEN 4 THEN 'Re Pactado' 
					  WHEN 5 THEN 'Re Llamar' 
					  WHEN 6 THEN 'Cerrado' 
					  WHEN 7 THEN 'Negativo' 
					  WHEN 8 THEN 'Cerrado en Problemas' 
					  WHEN 9 THEN 'Enviado' 
					  WHEN 10 THEN 'A Liquidar' 
					  WHEN 11 THEN 'Negativo B.O.' 
					  WHEN 12 THEN 'Cancelado' 
					  WHEN 13 THEN 'Problemas B.O.'
					  WHEN 14 THEN 'Liquidar C. Parcial' 
					  WHEN 15 THEN 'No Efectivas'					  
					END as ESTADOS_DESCCI, 
					SERTELPER.TEPE91_EQUIPVTA 
				FROM SERVTT
				INNER JOIN EMPRESASTT ON
					SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
				INNER JOIN GESTORESTT ON
					SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
				LEFT JOIN SERTELPER ON
					SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
				WHERE  				
					".$filtro_fdesde." 
					".$filtro_fhasta." 
					".$filtro_estado." 
					".$filtro_empresa." 
					".$filtro_gestor." 
					".$filtro_coordinador." 
					".$filtro_gerente." 
					".$filtro_operador." 
					".$filtro_equipovta." 
					SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
					SERTT91_CODGESTOR = GESTOR11_CODIGO					
				ORDER BY 
					SERTT11_FECSER, SERTT12_NUMEING DESC";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}		

		public function selectUnServicio($fecha,$nro){
			try {
				
				$f = new Fechas;

				$filtro_fecha="";
				if(!empty($fecha)){					
					$tmp = $f->FormatearFechas($fecha,"Y-m-d","Y-m-d");				
					$filtro_fecha = "SERTT11_FECSER = '".$tmp."' AND ";
				}					

				$filtro_numero="";
				if(!empty($nro))								
					$filtro_numero = "SERTT12_NUMEING = ".$nro." AND ";

					$query = "SELECT TOP 1000
					SERTT11_FECSER, SERTT12_NUMEING, SERTT91_NOMBRE, SERTT91_DOMICILIO, 
					SERTT91_LOCALIDAD, SERTT91_ESTADO, SERTT91_OBSERV, SERTT91_OBSEENT, 
					SERTT91_VALSERV, SERTT91_CARGCLIE, SERTT91_CARSERV, SERTT31_PERTIPDOC, 
					SERTT31_PERNUMDOC, SERTT91_TELEFONO, SERTT91_HORARIO, SERTT91_COBROCLI, 
					SERTT91_OPERAD, SERTT91_LIQSN, SERTT91_AUDITADO, SERTT91_OBRESPU, 
					SERTT91_CODEMPRE, SERTT91_CODGESTOR, SERTT91_COOALIAS, SERTT91_GTEALIAS, 
					SERTT91_CUADRANTE, SERTT41_FECEST, SERTT91_IDOPORT,					
					GESTOR21_ALIAS, EMPTT21_NOMBRE, EMPTT21_ABREV, EMPTT21_NOMBREFA,
					CASE SERTT91_ESTADO
					  WHEN 1 THEN 'Pendiente' 
					  WHEN 2 THEN 'Despachado'  
					  WHEN 3 THEN 'Cerrado Parcial' 
					  WHEN 4 THEN 'Re Pactado' 
					  WHEN 5 THEN 'Re Llamar' 
					  WHEN 6 THEN 'Cerrado' 
					  WHEN 7 THEN 'Negativo' 
					  WHEN 8 THEN 'Cerrado en Problemas' 
					  WHEN 9 THEN 'Enviado' 
					  WHEN 10 THEN 'A Liquidar' 
					  WHEN 11 THEN 'Negativo B.O.' 
					  WHEN 12 THEN 'Cancelado' 
					  WHEN 13 THEN 'Problemas B.O.'
					  WHEN 14 THEN 'Liquidar C. Parcial' 
					  WHEN 15 THEN 'No Efectivas'					  					  
					END as ESTADOS_DESCCI, 
					SERTELPER.TEPE91_EQUIPVTA 
				FROM SERVTT
				INNER JOIN EMPRESASTT ON
					SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
				INNER JOIN GESTORESTT ON
					SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
				LEFT JOIN SERTELPER ON
					SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
				WHERE  				
					".$filtro_fecha." 
					".$filtro_numero." 					
					SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
					SERTT91_CODGESTOR = GESTOR11_CODIGO 			
				ORDER BY 
					SERTT11_FECSER, SERTT12_NUMEING DESC";

					//echo $query;
					//exit;


				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}			
		}

		public function selectServiciosHistorico($fecha,$nro){
			try {
				
				$f = new Fechas;

				$filtro_fecha="";
				if(!empty($fecha)){					
					$tmp = $f->FormatearFechas($fecha,"Y-m-d","Y-m-d");				
					$filtro_fecha = "HSETT12_FECSER = '".$tmp."' AND ";
				}

				$filtro_nro="";
				if(!empty($nro))								
					$filtro_nro = "HSETT13_NUMEING = ".$nro;

				$query = "SELECT 
							HSETT11_FECEST, HSETT12_FECSER, HSETT13_NUMEING, HSETT31_PERTIPDOC, 
							HSETT31_PERNUMDOC, HSETT91_NOMBRE, HSETT91_DOMICILIO, HSETT91_LOCALIDAD, 
							HSETT91_HORARIO, HSETT91_TELEFONO, HSETT91_CODGESTOR, HSETT91_CODEMPRE, 							
							CASE HSETT91_ESTADO
							  	WHEN 1 THEN 'Pendiente' 
							  	WHEN 2 THEN 'Despachado'  
							  	WHEN 3 THEN 'Cerrado Parcial' 
							  	WHEN 4 THEN 'Re Pactado' 
							  	WHEN 5 THEN 'Re Llamar' 
							  	WHEN 6 THEN 'Cerrado' 
							  	WHEN 7 THEN 'Negativo' 
							  	WHEN 8 THEN 'Cerrado en Problemas' 
							  	WHEN 9 THEN 'Enviado' 
							  	WHEN 10 THEN 'A Liquidar' 
							  	WHEN 11 THEN 'Negativo B.O.' 
					  			WHEN 12 THEN 'Cancelado' 
					  			WHEN 13 THEN 'Problemas B.O.'
								WHEN 14 THEN 'Liquidar C. Parcial' 
								WHEN 15 THEN 'No Efectivas'					  					  			
							END as ESTADOS_DESCCI,
							HSETT41_FECEST, HSETT91_OBSERV, HSETT91_OBSEENT, 
							HSETT91_VALSERV, HSETT91_CARGCLIE, HSETT91_CARSERV, HSETT91_COBROCLI, 
							HSETT91_OPERAD, HSETT91_LIQSN, HSETT91_AUDITADO, HSETT91_OBRESPU 
						FROM HISTSERVTT 
						WHERE  							
							".$filtro_fecha." 
							".$filtro_nro." 
						ORDER BY HSETT11_FECEST DESC";
				
				//echo $query;
				//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;						

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function selectEmpresaById($id){
			try {
				
				$query = "SELECT * FROM EMPRESASTT WHERE EMPTT11_CODIGO=".$id;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectGestorById($id){
			try {
				
				$query = "SELECT * FROM GESTORESTT WHERE GESTOR11_CODIGO=".$id;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllEmpresaReturnArray(){
			try {
				
				$query = "SELECT * FROM EMPRESASTT ORDER BY EMPTT11_CODIGO ASC";

				$result = SQLsistema::selectArray($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllEmpresa(){
			try {
				
				$query = "SELECT * FROM EMPRESASTT ORDER BY EMPTT11_CODIGO ASC";

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllEmpresaArray(){
			try {
				
				$query = "SELECT * FROM EMPRESASTT ORDER BY EMPTT11_CODIGO ASC";

				$result = SQLsistema::selectArray($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllGerente(){
			try {
				
				$query = "SELECT *, GTE11_ALIAS AS SERTT91_GTEALIAS FROM Gerentes ORDER BY GTE11_ALIAS ASC";

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllCoordinador($gerente){
			try {
				
				if(empty($gerente))
					$query = "SELECT *, CORDI11_ALIAS AS SERTT91_COOALIAS FROM CORDITT ORDER BY CORDI11_ALIAS ASC";
				else
					$query = "SELECT *, CORDI11_ALIAS AS SERTT91_COOALIAS FROM CORDITT WHERE CORDI91_ALIGTE='".$gerente."' ORDER BY CORDI11_ALIAS ASC";

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllGestor($coordinador){
			try {
				
				if(empty($coordinador))
					$query = "SELECT GESTOR11_CODIGO, GESTOR21_ALIAS FROM GESTORESTT WHERE GESTOR91_HABILI = 'S' ORDER BY GESTOR91_ALICOO ASC";
				else 
					$query = "SELECT GESTOR11_CODIGO, GESTOR21_ALIAS FROM GESTORESTT WHERE GESTOR91_HABILI = 'S' AND GESTOR91_ALICOO='".$coordinador."' ORDER BY GESTOR91_ALICOO ASC";

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllGestorArray(){
			try {
								
				$query = "SELECT * FROM GESTORESTT";				

				$result = SQLsistema::selectArray($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllOperador(){
			try {
				
				$query = "SELECT * FROM OPERACAB";

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllPlazas(){
			try {

				$query = "SELECT CORDI11_ALIAS as PLAZA, CORDI11_ALIAS AS ALIAS
							FROM CORDITT 
							WHERE CORDITT.CORDI91_ALIGTE<>'' and (CORDI91_ALIGTE = 'ZARATE' OR CORDI91_ALIGTE = 'CORIA') ";
				//echo $query;
				//exit();

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectAllPlazasArray(){
			try {
				
				$query = "SELECT CORDI11_ALIAS as PLAZA, CORDI11_ALIAS AS ALIAS
							FROM CORDITT 
							WHERE CORDITT.CORDI91_ALIGTE<>'' and (CORDI91_ALIGTE = 'ZARATE' OR CORDI91_ALIGTE = 'CORIA') ";

				//echo $query;
				//exit();

				$result = SQLsistema::selectArray($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}
		public function selectAllEstados(){
			try {
					$arrEstados[0][0]=1;
					$arrEstados[0][1]="Pendiente";
					$arrEstados[0][2]="label label-warning";
					$arrEstados[0][3]="text-yellow";
					$arrEstados[0][4]="background:#f7ec65;";

					$arrEstados[1][0]=2;
					$arrEstados[1][1]="Despachado";
					$arrEstados[1][2]="label label-primary";
					$arrEstados[1][3]="text-blue";
					$arrEstados[1][4]="background:#00dc81;";

					$arrEstados[2][0]=3;
					$arrEstados[2][1]="Cerrado Parcial";
					$arrEstados[2][2]="label label-primary";
					$arrEstados[2][3]="text-blue";
					$arrEstados[2][4]="background:#b9edfd;";

					$arrEstados[3][0]=4;
					$arrEstados[3][1]="Re Pactado";
					$arrEstados[3][2]="label label-primary";
					$arrEstados[3][3]="text-blue";
					$arrEstados[3][4]="background:#a7e7c5;";

					$arrEstados[4][0]=5;
					$arrEstados[4][1]="Re Llamar";
					$arrEstados[4][2]="label label-primary";					
					$arrEstados[4][3]="text-blue";					
					$arrEstados[4][4]="background:#f4b74a;";

					$arrEstados[5][0]=6;
					$arrEstados[5][1]="Cerrado";
					$arrEstados[5][2]="label label-success";
					$arrEstados[5][3]="text-green";
					$arrEstados[5][4]="background:#94bcf6;";

					$arrEstados[6][0]=7;
					$arrEstados[6][1]="Negativo";
					$arrEstados[6][2]="label label-danger";
					$arrEstados[6][3]="text-red";
					$arrEstados[6][4]="background:#f77365;";

					$arrEstados[7][0]=8;
					$arrEstados[7][1]="Cerrado en Problemas";
					$arrEstados[7][2]="label label-danger";
					$arrEstados[7][3]="text-red";
					$arrEstados[7][4]="background:#ead1cc;";

					$arrEstados[8][0]=9;
					$arrEstados[8][1]="Enviado";
					$arrEstados[8][2]="label label-success";
					$arrEstados[8][3]="text-green";
					$arrEstados[8][4]="background:#c2d1ad;";

					$arrEstados[9][0]=10;
					$arrEstados[9][1]="A Liquidar";
					$arrEstados[9][2]="label label-success";				
					$arrEstados[9][3]="text-green";				
					$arrEstados[9][4]="background:#c2f9ad;";

					$arrEstados[10][0]=11;
					$arrEstados[10][1]="Negativo B.O.";
					$arrEstados[10][2]="label label-danger";
					$arrEstados[10][3]="text-red";
					$arrEstados[10][4]="background:#da70d6;";

					$arrEstados[11][0]=12;
					$arrEstados[11][1]="Cancelado";
					$arrEstados[11][2]="label label-danger";
					$arrEstados[11][3]="text-red";
					$arrEstados[11][4]="background:#fffff0;";

					$arrEstados[12][0]=13;
					$arrEstados[12][1]="Problemas B.O.";
					$arrEstados[12][2]="label label-danger";
					$arrEstados[12][3]="text-red";
					$arrEstados[12][4]="background:#dc3d00;";

					$arrEstados[13][0]=14;
					$arrEstados[13][1]="Liquidar C Parcial";
					$arrEstados[13][2]="label label-warning";
					$arrEstados[13][3]="text-yellow";
					$arrEstados[13][4]="background:#f7ec65;";

					$arrEstados[14][0]=15;
					$arrEstados[14][1]="No Efectivas";
					$arrEstados[14][2]="label label-danger";
					$arrEstados[14][3]="text-red";
					$arrEstados[14][4]="background:#dc3d00;";

					return $arrEstados;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function selectAllEquipoVenta($empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";				
				
				$query = "SELECT 
							SERTELPER.TEPE91_EQUIPVTA 
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  				
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_coordinador." 
							".$filtro_gerente." 
							".$filtro_operador." 
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO AND
							TEPE91_EQUIPVTA<>'' 
						GROUP BY 
							TEPE91_EQUIPVTA";

				$result = SQLsistema::selectObject($query);
						
				return $result;
 
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		public function selectAllEmpresaFiltro($empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";				
				
				$query = "SELECT 
							EMPTT11_CODIGO, EMPTT21_NOMBREFA 
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  				
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_coordinador." 
							".$filtro_gerente." 
							".$filtro_operador." 
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO 
						GROUP BY 
							EMPTT11_CODIGO, EMPTT21_NOMBREFA";

							//echo $query;
							//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;
 
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		public function selectAllGerenteFiltro($empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";				
				
				$query = "SELECT 
							SERTT91_GTEALIAS 
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  				
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_coordinador." 
							".$filtro_gerente." 
							".$filtro_operador." 
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO
						GROUP BY 
							SERTT91_GTEALIAS";

				$result = SQLsistema::selectObject($query);
						
				return $result;
 
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		public function selectAllCoordinadorFiltro($empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";				
				
				$query = "SELECT 
							SERTT91_COOALIAS 
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  				
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_coordinador." 
							".$filtro_gerente." 
							".$filtro_operador." 
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO
						GROUP BY 
							SERTT91_COOALIAS";

							//echo $query;
							//exit();

				$result = SQLsistema::selectObject($query);
						
				return $result;
 
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		public function selectAllGestorFiltro($empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";				
				
				$query = "SELECT 
							GESTOR11_CODIGO, GESTOR21_ALIAS 
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  				
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_coordinador." 
							".$filtro_gerente." 
							".$filtro_operador." 
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO 
						GROUP BY 
							GESTOR11_CODIGO, GESTOR21_ALIAS";

							//echo $query;
							//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;
 
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		public function selectAllOperadorFiltro($empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";				
				
				$query = "SELECT 
							SERTT91_OPERAD 
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  				
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_coordinador." 
							".$filtro_gerente." 
							".$filtro_operador." 
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO
						GROUP BY 
							SERTT91_OPERAD";

				$result = SQLsistema::selectObject($query);
						
				return $result;
 
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		public function selectGroupServiciosByEstados($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER <=  '".$tmp."' AND ";
					}
				}

				$filtro_estado="";
				if(!empty($estado))								
					$filtro_estado = "SERTT91_ESTADO = ".$estado." AND ";
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$query = "SELECT 
					CASE SERTT91_ESTADO
					  WHEN 1 THEN 'Pendiente' 
					  WHEN 2 THEN 'Despachado'  
					  WHEN 3 THEN 'Cerrado Parcial' 
					  WHEN 4 THEN 'Re Pactado' 
					  WHEN 5 THEN 'Re Llamar' 
					  WHEN 6 THEN 'Cerrado' 
					  WHEN 7 THEN 'Negativo' 
					  WHEN 8 THEN 'Cerrado en Problemas' 
					  WHEN 9 THEN 'Enviado' 
					  WHEN 10 THEN 'A Liquidar' 
					  WHEN 11 THEN 'Negativo B.O.' 
					  WHEN 12 THEN 'Cancelado' 
					  WHEN 13 THEN 'Problemas B.O.'
					  WHEN 14 THEN 'Liquidar C. Parcial' 
					  WHEN 15 THEN 'No Efectivas'					  					  
					END as ESTADOS_DESCCI,
					COUNT(*) AS CANTIDAD_SERVICIOS,
					SERTT91_ESTADO								
				FROM SERVTT
				INNER JOIN EMPRESASTT ON
					SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
				INNER JOIN GESTORESTT ON
					SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
				LEFT JOIN SERTELPER ON
					SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
				WHERE  				
					".$filtro_fdesde." 
					".$filtro_fhasta." 
					".$filtro_estado." 
					".$filtro_empresa." 
					".$filtro_gestor." 
					".$filtro_coordinador." 
					".$filtro_gerente." 
					".$filtro_operador." 
					SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
					SERTT91_CODGESTOR = GESTOR11_CODIGO 		
				GROUP BY 
					SERTT91_ESTADO
				ORDER BY 
					CANTIDAD_SERVICIOS DESC";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectGroupServiciosByEmpresa($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER <=  '".$tmp."' AND ";
					}
				}

				$filtro_estado="";
				if(!empty($estado))								
					$filtro_estado = "SERTT91_ESTADO = ".$estado." AND ";
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$query = "SELECT 
					EMPRESASTT.EMPTT11_CODIGO,
					EMPRESASTT.EMPTT21_ABREV,
					COUNT(*) AS CANTIDAD_SERVICIOS					
				FROM SERVTT
				INNER JOIN EMPRESASTT ON
					SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
				INNER JOIN GESTORESTT ON
					SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
				LEFT JOIN SERTELPER ON
					SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
				WHERE  				
					".$filtro_fdesde." 
					".$filtro_fhasta." 
					".$filtro_estado." 
					".$filtro_empresa." 
					".$filtro_gestor." 
					".$filtro_coordinador." 
					".$filtro_gerente." 
					".$filtro_operador." 
					SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
					SERTT91_CODGESTOR = GESTOR11_CODIGO 		
				GROUP BY 
					EMPRESASTT.EMPTT11_CODIGO,EMPRESASTT.EMPTT21_ABREV
				ORDER BY 
					CANTIDAD_SERVICIOS DESC";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectCountServicios($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER <=  '".$tmp."' AND ";
					}
				}

				$filtro_estado="";				
				if(!empty($estado)){
					switch ($estado) {
						case 100:
							$filtro_estado = "SERTT91_ESTADO > 2 AND ";
							break;
						case 200:
							$filtro_estado = "(SERTT91_ESTADO = 6 OR SERTT91_ESTADO = 9 OR SERTT91_ESTADO = 10) AND ";
							break;
						case 300:
							$filtro_estado = "(SERTT91_ESTADO = 3 OR SERTT91_ESTADO = 4 OR SERTT91_ESTADO = 5 OR SERTT91_ESTADO = 6 OR SERTT91_ESTADO = 7) AND ";
							break;
						default:
							$filtro_estado = "SERTT91_ESTADO = ".$estado." AND ";
							break;
					}						
				}					
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$query = "SELECT 
					COUNT(*) AS CANTIDAD_SERVICIOS										
				FROM SERVTT
				INNER JOIN EMPRESASTT ON
					SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
				INNER JOIN GESTORESTT ON
					SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
				LEFT JOIN SERTELPER ON
					SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
				WHERE  				
					".$filtro_fdesde." 
					".$filtro_fhasta." 
					".$filtro_estado." 
					".$filtro_empresa." 
					".$filtro_gestor." 
					".$filtro_coordinador." 
					".$filtro_gerente." 
					".$filtro_operador." 
					SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
					SERTT91_CODGESTOR = GESTOR11_CODIGO";
				
					//echo $query;				
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectCountServiciosGestion($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER <=  '".$tmp."' AND ";
					}
				}

				$filtro_estado="";				
				if(!empty($estado)){
					switch ($estado) {
						case 100:
							$filtro_estado = "SERTT91_ESTADO > 2 AND ";
							break;
						case 200:
							$filtro_estado = "(SERTT91_ESTADO = 6 OR SERTT91_ESTADO = 9 OR SERTT91_ESTADO = 10) AND ";
							break;
						case 300:
							$filtro_estado = "(SERTT91_ESTADO = 3 OR SERTT91_ESTADO = 4 OR SERTT91_ESTADO = 5 OR SERTT91_ESTADO = 6 OR SERTT91_ESTADO = 7) AND ";
							break;
						default:
							$filtro_estado = "SERTT91_ESTADO = ".$estado." AND ";
							break;
					}						
				}					
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$query = "SELECT COUNT(CANTIDAD_SERVICIOS) AS CANTIDAD_SERVICIOS
							FROM (
								SELECT SERTT91_CODEMPRE, COUNT(*) AS CANTIDAD_SERVICIOS 		
									FROM SERVTT
									INNER JOIN EMPRESASTT ON
										SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
									INNER JOIN GESTORESTT ON
										SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
									LEFT JOIN SERTELPER ON
										SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
									WHERE  				
										".$filtro_fdesde." 
										".$filtro_fhasta." 
										".$filtro_estado." 
										".$filtro_empresa." 
										".$filtro_gestor." 
										".$filtro_coordinador." 
										".$filtro_gerente." 
										".$filtro_operador." 
										SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
										SERTT91_CODGESTOR = GESTOR11_CODIGO
									GROUP BY SERTT91_CODEMPRE, SERTT31_PERNUMDOC) AS consulta";						

						//echo $query;				
						//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectUltimosServiciosHistorico($fdesde, $fhasta, $empresa, $gestor, $gerente, $coordinador, $operador){
			try {
				
				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "HSETT12_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "HSETT12_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "HSETT12_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "HSETT12_FECSER <= '".$tmp."' AND ";
					}
				}

				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$query = "SELECT TOP 10
							HSETT11_FECEST, HSETT12_FECSER, HSETT13_NUMEING, HSETT31_PERTIPDOC, 
							HSETT31_PERNUMDOC, HSETT91_NOMBRE, HSETT91_DOMICILIO, HSETT91_LOCALIDAD, 
							HSETT91_HORARIO, HSETT91_TELEFONO, HSETT91_CODGESTOR, HSETT91_CODEMPRE,		
							CASE HSETT91_ESTADO
							  	WHEN 1 THEN 'Pendiente' 
							  	WHEN 2 THEN 'Despachado'  
							  	WHEN 3 THEN 'Cerrado Parcial' 
							  	WHEN 4 THEN 'Re Pactado' 
							  	WHEN 5 THEN 'Re Llamar' 
							  	WHEN 6 THEN 'Cerrado' 
							  	WHEN 7 THEN 'Negativo' 
							  	WHEN 8 THEN 'Cerrado en Problemas' 
							  	WHEN 9 THEN 'Enviado' 
							  	WHEN 10 THEN 'A Liquidar' 
							  	WHEN 11 THEN 'Negativo B.O.' 
					  			WHEN 12 THEN 'Cancelado'
					  			WHEN 13 THEN 'Problemas B.O.'
								WHEN 14 THEN 'Liquidar C. Parcial' 
								WHEN 15 THEN 'No Efectivas'					  					  			
							END as ESTADOS_DESCCI,
							HSETT41_FECEST, HSETT91_OBSERV, HSETT91_OBSEENT, 
							HSETT91_VALSERV, HSETT91_CARGCLIE, HSETT91_CARSERV, HSETT91_COBROCLI, 
							HSETT91_OPERAD, HSETT91_LIQSN, HSETT91_AUDITADO, HSETT91_OBRESPU, 
							EMPTT21_ABREV, SERTT91_GTEALIAS, SERTT91_COOALIAS, GESTOR21_ALIAS, SERTT91_OPERAD
						FROM HISTSERVTT 
						INNER JOIN SERVTT ON
							SERVTT.SERTT11_FECSER = HISTSERVTT.HSETT12_FECSER AND
							SERVTT.SERTT12_NUMEING = HISTSERVTT.HSETT13_NUMEING 
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						LEFT JOIN SERTELPER ON
							SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
						WHERE  							
							".$filtro_fdesde." 
							".$filtro_fhasta." 
							".$filtro_empresa." 
							".$filtro_gestor." 
							".$filtro_operador." 
							".$filtro_coordinador."
							".$filtro_gerente."
							SERVTT.SERTT11_FECSER = HISTSERVTT.HSETT12_FECSER AND
							SERVTT.SERTT12_NUMEING = HISTSERVTT.HSETT13_NUMEING AND
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO AND 
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO		
						ORDER BY HSETT11_FECEST DESC";
				
				//echo $query;
				//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;						

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function selectCountFechasServicios($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT11_FECSER >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT11_FECSER <=  '".$tmp."' AND ";
					}
				}

				$filtro_estado="";
				if(!empty($estado))								
					$filtro_estado = "SERTT91_ESTADO = ".$estado." AND ";
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERTT91_OPERAD = '".$operador."' AND ";

				$query = "
					SELECT COUNT(*) AS CANTIDAD_DIAS FROM(
						SELECT SERTT11_FECSER					
							FROM SERVTT
							INNER JOIN EMPRESASTT ON
								SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
							INNER JOIN GESTORESTT ON
								SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
							LEFT JOIN SERTELPER ON
								SERVTT.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
							WHERE  				
								".$filtro_fdesde." 
								".$filtro_fhasta." 
								".$filtro_estado." 
								".$filtro_empresa." 
								".$filtro_gestor." 
								".$filtro_coordinador." 
								".$filtro_gerente." 
								".$filtro_operador." 
								SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
								SERTT91_CODGESTOR = GESTOR11_CODIGO 		
							GROUP BY 
								SERTT11_FECSER) AS CONSULTA";

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function getPlazaByCordinador($alias){
			try {
				
				$query = "SELECT CORDI11_ALIAS as PLAZA, CORDI11_ALIAS AS ALIAS
							FROM CORDITT 
							WHERE CORDITT.CORDI91_ALIGTE<>'' and (CORDI91_ALIGTE = 'ZARATE' OR CORDI91_ALIGTE = 'CORIA') AND 
								  CORDITT.CORDI11_ALIAS='".$alias."'";

				//echo $query;
				//exit();

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function getCoordinadorByPlaza($plaza){
			try {
				
				$query = "SELECT CORDI11_ALIAS as PLAZA, CORDI11_ALIAS AS ALIAS
							FROM CORDITT 
							WHERE CORDITT.CORDI91_ALIGTE<>'' and (CORDI91_ALIGTE = 'ZARATE' OR CORDI91_ALIGTE = 'CORIA') AND 
								  PERSONAS.PER21_APELLIDO='".$plaza."'";

				//echo $query;
				//exit();

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}
	}
	
?>