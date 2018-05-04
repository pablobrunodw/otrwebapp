<?php
	
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionsistema.class.php';
	include_once PATH_DATOS.'BaseDatos/sqlsistema.class.php';
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';	

	class HandlerConsultas {

		public function consultaReTrabajo($fdesde, $fhasta, $estado, $empresa, $gerente, $coordinador, $gestor, $operador){
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
					$filtro_estado = "SERVTT.SERTT91_ESTADO = ".$estado." AND ";
				
				$filtro_empresa="";
				if(!empty($empresa))								
					$filtro_empresa = "SERVTT.SERTT91_CODEMPRE = ".$empresa." AND ";

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERVTT.SERTT91_CODGESTOR = ".$gestor." AND ";

				$filtro_coordinador="";
				if(!empty($coordinador))								
					$filtro_coordinador = "SERVTT.SERTT91_COOALIAS = '".$coordinador."' AND ";
				
				$filtro_gerente="";
				if(!empty($gerente))								
					$filtro_gerente = "SERVTT.SERTT91_GTEALIAS = '".$gerente."' AND ";

				$filtro_operador="";
				if(!empty($operador))								
					$filtro_operador = "SERVTT.SERTT91_OPERAD = '".$operador."' AND ";
				
				$filtro_estado_1 = "(SERVTT.SERTT91_ESTADO=3 OR SERVTT.SERTT91_ESTADO=6 OR SERVTT.SERTT91_ESTADO=5 OR SERVTT.SERTT91_ESTADO=4 OR SERVTT.SERTT91_ESTADO=7 OR SERVTT.SERTT91_ESTADO=8 OR SERVTT.SERTT91_ESTADO=9 OR SERVTT.SERTT91_ESTADO=10 OR SERVTT.SERTT91_ESTADO=11 OR SERVTT.SERTT91_ESTADO=13 OR SERVTT.SERTT91_ESTADO=12) ";				
				//SERTT91_ESTADO=3 OR SERTT91_ESTADO=6 OR SERTT91_ESTADO=5 OR SERTT91_ESTADO=4 OR SERTT91_ESTADO=7 OR SERTT91_ESTADO=8 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10 OR SERTT91_ESTADO=11 OR SERTT91_ESTADO=13 OR SERTT91_ESTADO=12

				//if(empty($filtro_estado))
				//	$filtro_estado_2 = "(SERVTT.SERTT91_ESTADO = 3 OR SERVTT.SERTT91_ESTADO = 4 OR SERVTT.SERTT91_ESTADO = 5 OR SERVTT.SERTT91_ESTADO = 6 OR SERVTT.SERTT91_ESTADO = 7 OR SERVTT.SERTT91_ESTADO = 12) AND ";								

				//else
				//	$filtro_estado_2 = "";				

				// --- AGRUPADO POR CLIENTES
				$query = "SELECT CODEMPRE, EMPRESA, 
									SUM(CASE WHEN VISITAS=1 THEN 1 ELSE 0 END) AS UNO,
									SUM(CASE WHEN VISITAS=2 THEN 1 ELSE 0  END) AS DOS,
									SUM(CASE WHEN VISITAS=3 THEN 1 ELSE 0 END) AS TRES,
									SUM(CASE WHEN VISITAS>3 THEN 1 ELSE 0 END) AS MASDETRES,
									COUNT(*) AS TOTAL
							FROM (
								SELECT SERVTT.SERTT91_CODEMPRE AS CODEMPRE, 
										EMPTT21_NOMBREFA AS EMPRESA, 
									   SERVTT.SERTT31_PERNUMDOC AS DOCUMENTO, 
									   COUNT(SERVTT.SERTT31_PERNUMDOC) AS VISITAS
									FROM (
										SELECT * 
											FROM SERVTT 
											WHERE 
												".$filtro_fdesde." 
												".$filtro_fhasta."
												".$filtro_estado_1." ) AS CONSULTA										
										INNER JOIN SERVTT ON
											CONSULTA.SERTT31_PERNUMDOC = SERVTT.SERTT31_PERNUMDOC
										INNER JOIN EMPRESASTT ON
											CONSULTA.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 					
										INNER JOIN GESTORESTT ON
											CONSULTA.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
										LEFT JOIN SERTELPER ON
											CONSULTA.SERTT91_IDOPORT=SERTELPER.TEPE11_NROGEST
									WHERE 									 
										".$filtro_empresa." 
										".$filtro_estado."										
										".$filtro_gestor." 
										".$filtro_coordinador." 
										".$filtro_gerente." 
										".$filtro_operador." 
										SERVTT.SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
										SERVTT.SERTT91_CODGESTOR = GESTOR11_CODIGO 
									GROUP BY SERVTT.SERTT91_CODEMPRE, EMPTT21_NOMBREFA, SERVTT.SERTT31_PERNUMDOC) AS CONSULTA1
							GROUP BY CODEMPRE, EMPRESA
							ORDER BY TOTAL DESC";

					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function consultaCierreByLocalidad($fdesde, $fhasta){
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
											
				$filtro_estado = "(SERTT91_ESTADO = 6 OR SERTT91_ESTADO = 9 OR SERTT91_ESTADO = 10) AND ";				

				// --- AGRUPADO POR LOCALIDAD
				$query = "SELECT *
							FROM (
								SELECT SERTT91_COOALIAS AS LOCALIDAD, COUNT(*) AS CERRADOS
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
										SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
										SERTT91_CODGESTOR = GESTOR11_CODIGO 
									GROUP BY SERTT91_COOALIAS) AS CONSULTA							
							ORDER BY CERRADOS DESC";

					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function consultaCierreTotal($fdesde, $fhasta){
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
											
				$filtro_estado = "(SERTT91_ESTADO = 6 OR SERTT91_ESTADO = 9 OR SERTT91_ESTADO = 10) AND ";				
				
				$query = "SELECT COUNT(*) AS CERRADOS
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

		public function consultaComparativa($fdesde, $fhasta, $estado, $empresa, $gerente, $coordinador, $gestor, $operador, $niveles){
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

				$campo_nivel = "EMPTT21_NOMBREFA";
				if(!empty($niveles)){
					switch ($niveles) {
						case 'EMPRESAS':
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
						
						case 'GERENTES':
							$campo_nivel = "SERTT91_GTEALIAS";
							break;
						
						case 'COORDINADORES':
							$campo_nivel = "SERTT91_COOALIAS";
							break;
						
						case 'GESTORES':
							$campo_nivel = "GESTOR21_ALIAS";
							break;

						default:
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
					}
				}
						

				$query = "SELECT $campo_nivel as NOMBRE,							
							SUM(CASE WHEN SERTT91_ESTADO=3 THEN 1 ELSE 0 END) AS CERRADO_PARCIAL,
							SUM(CASE WHEN SERTT91_ESTADO=6 THEN 1 ELSE 0 END) AS CERRADO,
							SUM(CASE WHEN SERTT91_ESTADO=5 THEN 1 ELSE 0 END) AS RE_LLAMAR,
							SUM(CASE WHEN SERTT91_ESTADO=4 THEN 1 ELSE 0 END) AS RE_PACTADO,												
							SUM(CASE WHEN SERTT91_ESTADO=7 THEN 1 ELSE 0 END) AS NEGATIVO,
							SUM(CASE WHEN SERTT91_ESTADO=8 THEN 1 ELSE 0 END) AS PROBLEMAS,
							SUM(CASE WHEN SERTT91_ESTADO=9 THEN 1 ELSE 0 END) AS ENVIADO,
							SUM(CASE WHEN SERTT91_ESTADO=10 THEN 1 ELSE 0 END) AS A_LIQUIDAR,
							SUM(CASE WHEN SERTT91_ESTADO=11 THEN 1 ELSE 0 END) AS NEGATIVO_BO,							
							SUM(CASE WHEN SERTT91_ESTADO=13 THEN 1 ELSE 0 END) AS PROBLEMAS_BO,			
							SUM(CASE WHEN SERTT91_ESTADO=12 THEN 1 ELSE 0 END) AS CANCELADO,
							SUM(CASE WHEN SERTT91_ESTADO=14 THEN 1 ELSE 0 END) AS LIQUIDAR_C_PARCIAL,			
							SUM(CASE WHEN SERTT91_ESTADO=15 THEN 1 ELSE 0 END) AS NO_EFECTIVAS,
							SUM(CASE WHEN SERTT91_ESTADO=3 OR SERTT91_ESTADO=6 OR SERTT91_ESTADO=5 OR SERTT91_ESTADO=4 OR SERTT91_ESTADO=7 OR SERTT91_ESTADO=8 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10 OR SERTT91_ESTADO=11 OR SERTT91_ESTADO=13 OR SERTT91_ESTADO=14 OR SERTT91_ESTADO=15 THEN 1 ELSE 0 END) AS TOTAL,							
							SUM(CASE WHEN SERTT91_ESTADO=6 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10 THEN 1 ELSE 0 END) AS TOTAL_PARCIAL
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
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
							$campo_nivel
						ORDER BY 
							$campo_nivel";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function consultaCronologica($fdesde, $fhasta, $estado, $empresa, $gerente, $coordinador, $gestor, $operador, $niveles){
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

				$campo_nivel = "EMPTT21_NOMBREFA";
				if(!empty($niveles)){
					switch ($niveles) {
						case 'EMPRESAS':
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
						
						case 'GERENTES':
							$campo_nivel = "SERTT91_GTEALIAS";
							break;
						
						case 'COORDINADORES':
							$campo_nivel = "SERTT91_COOALIAS";
							break;
						
						case 'GESTORES':
							$campo_nivel = "GESTOR21_ALIAS";
							break;

						default:
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
					}
				}
						

				$query = "SELECT $campo_nivel as NOMBRE, SERTT11_FECSER as FECHA,							
							SUM(CASE WHEN SERTT91_ESTADO=3 THEN 1 ELSE 0 END) AS CERRADO_PARCIAL,
							SUM(CASE WHEN SERTT91_ESTADO=6 THEN 1 ELSE 0 END) AS CERRADO,
							SUM(CASE WHEN SERTT91_ESTADO=5 THEN 1 ELSE 0 END) AS RE_LLAMAR,
							SUM(CASE WHEN SERTT91_ESTADO=4 THEN 1 ELSE 0 END) AS RE_PACTADO,												
							SUM(CASE WHEN SERTT91_ESTADO=7 THEN 1 ELSE 0 END) AS NEGATIVO,
							SUM(CASE WHEN SERTT91_ESTADO=8 THEN 1 ELSE 0 END) AS PROBLEMAS,
							SUM(CASE WHEN SERTT91_ESTADO=9 THEN 1 ELSE 0 END) AS ENVIADO,
							SUM(CASE WHEN SERTT91_ESTADO=10 THEN 1 ELSE 0 END) AS A_LIQUIDAR,
							SUM(CASE WHEN SERTT91_ESTADO=11 THEN 1 ELSE 0 END) AS NEGATIVO_BO,							
							SUM(CASE WHEN SERTT91_ESTADO=13 THEN 1 ELSE 0 END) AS PROBLEMAS_BO,			
							SUM(CASE WHEN SERTT91_ESTADO=12 THEN 1 ELSE 0 END) AS CANCELADO,
							SUM(CASE WHEN SERTT91_ESTADO=14 THEN 1 ELSE 0 END) AS LIQUIDAR_C_PARCIAL,			
							SUM(CASE WHEN SERTT91_ESTADO=15 THEN 1 ELSE 0 END) AS NO_EFECTIVAS,							
							SUM(CASE WHEN SERTT91_ESTADO=3 OR SERTT91_ESTADO=6 OR SERTT91_ESTADO=5 OR SERTT91_ESTADO=4 OR 
										  SERTT91_ESTADO=7 OR SERTT91_ESTADO=8 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10 OR
										  SERTT91_ESTADO=11 OR SERTT91_ESTADO=13 OR SERTT91_ESTADO=14 OR SERTT91_ESTADO=15 THEN 1 ELSE 0 END) AS TOTAL,							
							SUM(CASE WHEN SERTT91_ESTADO=6 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10 THEN 1 ELSE 0 END) AS TOTAL_PARCIAL
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
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
							$campo_nivel, SERTT11_FECSER
						ORDER BY 
							$campo_nivel, SERTT11_FECSER";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function consultaSubEstados($fdesde, $fhasta, $estado, $empresa, $gerente, $coordinador, $gestor, $operador, $niveles){
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

				$campo_nivel = "EMPTT21_NOMBREFA";
				if(!empty($niveles)){
					switch ($niveles) {
						case 'EMPRESAS':
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
						
						case 'GERENTES':
							$campo_nivel = "SERTT91_GTEALIAS";
							break;
						
						case 'COORDINADORES':
							$campo_nivel = "SERTT91_COOALIAS";
							break;
						
						case 'GESTORES':
							$campo_nivel = "GESTOR21_ALIAS";
							break;

						default:
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
					}
				}

				$query = "SELECT $campo_nivel as NOMBRE,
								 HSETT91_ESTADO as ESTADO,
								 HSETT91_SUBESTADO as SUBESTADO,
								 COUNT(HSETT91_SUBESTADO) AS CANTIDAD							  	
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
						GROUP BY 
							$campo_nivel, HSETT91_ESTADO, HSETT91_SUBESTADO 
						ORDER BY 
							$campo_nivel, HSETT91_ESTADO, HSETT91_SUBESTADO DESC";
				
				//echo $query;
				//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;						

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function consultaGeneralServicios($fdesde, $fhasta, $estado, $empresa, $gerente, $coordinador, $gestor, $operador, $niveles){
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

				$campo_nivel = "EMPTT21_NOMBREFA";
				if(!empty($niveles)){
					switch ($niveles) {
						case 'EMPRESAS':
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
						
						case 'GERENTES':
							$campo_nivel = "SERTT91_GTEALIAS";
							break;
						
						case 'COORDINADORES':
							$campo_nivel = "SERTT91_COOALIAS";
							break;
						
						case 'GESTORES':
							$campo_nivel = "GESTOR21_ALIAS";
							break;

						default:
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
					}
				}												

				$query = "SELECT $campo_nivel as NOMBRE,							
							COUNT(*) AS TOTAL_SERVICIOS,
							SUM(CASE WHEN SERTT91_ESTADO=6 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10  THEN 1 ELSE 0 END) AS TOTAL_SERVICIOS_CERRADOS 
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
							$campo_nivel
						ORDER BY 
							$campo_nivel";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function consultaGeneralGestiones($fdesde, $fhasta, $estado, $empresa, $gerente, $coordinador, $gestor, $operador, $niveles){
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

				$campo_nivel = "EMPTT21_NOMBREFA";
				if(!empty($niveles)){
					switch ($niveles) {
						case 'EMPRESAS':
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
						
						case 'GERENTES':
							$campo_nivel = "SERTT91_GTEALIAS";
							break;
						
						case 'COORDINADORES':
							$campo_nivel = "SERTT91_COOALIAS";
							break;
						
						case 'GESTORES':
							$campo_nivel = "GESTOR21_ALIAS";
							break;

						default:
							$campo_nivel = "EMPTT21_NOMBREFA";
							break;
					}
				}												

				$query = "SELECT NOMBRE, COUNT(TOTAL_SERVICIOS) AS TOTAL_SERVICIOS, SUM(TOTAL_SERVICIOS_CERRADOS) AS TOTAL_SERVICIOS_CERRADOS
							FROM(	
								SELECT 
									$campo_nivel as NOMBRE,
									EMPTT21_NOMBREFA,
									COUNT(1) AS TOTAL_SERVICIOS,
									SUM(CASE WHEN SERTT91_ESTADO=6 OR SERTT91_ESTADO=9 OR SERTT91_ESTADO=10  THEN 1 ELSE 0 END) AS TOTAL_SERVICIOS_CERRADOS 
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
								GROUP BY EMPTT21_NOMBREFA, SERTT31_PERNUMDOC, $campo_nivel) AS CONSULTA
						GROUP BY NOMBRE							
						ORDER BY NOMBRE";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function consultaPuntajes($fdesde, $fhasta, $gestor){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT41_FECEST='".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT41_FECEST='".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "SERTT41_FECEST>='".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "SERTT41_FECEST<='".$tmp."' AND ";
					}
				}				

				$filtro_gestor="";
				if(!empty($gestor))								
					$filtro_gestor = "SERTT91_CODGESTOR=".$gestor." AND ";				


				$query = "SELECT GESTORESTT.GESTOR11_CODIGO as COD_GESTOR, 
								GESTOR21_ALIAS as NOM_GESTOR, 
								CONVERT(DATE,SERTT41_FECEST) as FECHA, 
								SERVTT.SERTT91_CODEMPRE as COD_EMPRESA,
								EMPRESASTT.EMPTT21_NOMBRE as NOM_EMPRESA,								
								SUM(CASE WHEN SERTT91_ESTADO=6 THEN 1 ELSE 0 END) AS CERRADO,							
								SUM(CASE WHEN SERTT91_ESTADO=9 THEN 1 ELSE 0 END) AS ENVIADO,
								SUM(1) AS TOTAL_SERVICIOS														
						FROM SERVTT
						INNER JOIN EMPRESASTT ON
							SERVTT.SERTT91_CODEMPRE = EMPRESASTT.EMPTT11_CODIGO 
						INNER JOIN GESTORESTT ON
							SERVTT.SERTT91_CODGESTOR = GESTORESTT.GESTOR11_CODIGO 	
						WHERE  				
							".$filtro_fdesde." 
							".$filtro_fhasta." 							
							".$filtro_gestor." 							
							SERTT91_CODEMPRE = EMPTT11_CODIGO AND 
							SERTT91_CODGESTOR = GESTOR11_CODIGO					
						GROUP BY 
							GESTOR11_CODIGO, GESTOR21_ALIAS, SERTT91_CODEMPRE, EMPTT21_NOMBRE, CONVERT(DATE,SERTT41_FECEST)
						ORDER BY 
							GESTOR11_CODIGO, GESTOR21_ALIAS, SERTT91_CODEMPRE, EMPTT21_NOMBRE, CONVERT(DATE,SERTT41_FECEST)";
				
					//echo $query;
					//exit;

				$result = SQLsistema::selectObject($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}	
	
	}
?>
