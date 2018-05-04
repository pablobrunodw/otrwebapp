<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';
	include_once PATH_DATOS.'Entidades/importacion.class.php';

	class ImportacionTipo2
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_fecha;
		public function getFecha(){ return $this->_fecha; }
		public function setFecha($fecha){ $this->_fecha=$fecha;}

		private $_importacion;
		public function getImportacion(){ return $this->_importacion; }
		public function setImportacion($importacion){ $this->_importacion=$importacion; }

		private $_nroGestion;
		public function getNroGestion(){ return $this->_nroGestion; }
		public function setNroGestion($nroGestion){ $this->_nroGestion=$nroGestion; }

		private $_fechaEnvio;
		public function getFechaEnvio(){ return $this->_fechaEnvio; }
		public function setFechaEnvio($fechaEnvio){ $this->_fechaEnvio=$fechaEnvio; }

	    private $_nroSolicitudPNM;
	    public function getNroSolicitudPNM(){ return $this->_nroSolicitudPNM; }
		public function setNroSolicitudPNM($nroSolicitudPNM){ $this->_nroSolicitudPNM=$nroSolicitudPNM; }

	    private $_nroReceptoraPIN;
	   	public function getNroReceptoraPIN(){ return $this->_nroReceptoraPIN; }
		public function setNroReceptoraPIN($nroReceptoraPIN){ $this->_nroReceptoraPIN=$nroReceptoraPIN; }

	    private $_tipoSuscriptor;
	    public function getTipoSuscriptor(){ return $this->_tipoSuscriptor; }
		public function setTipoSuscriptor($tipoSuscriptor){ $this->_tipoSuscriptor=$tipoSuscriptor; }

	    private $_apellidoNombre;
	    public function getApellidoNombre(){ return $this->_apellidoNombre; }
		public function setApellidoNombre($apellidoNombre){ $this->_apellidoNombre=$apellidoNombre; }

	    private $_razonSocial;
	    public function getRazonSocial(){ return $this->_razonSocial; }
		public function setRazonSocial($razonSocial){ $this->_razonSocial=$razonSocial; }

	    private $_tipoDocumento;
	    public function getTipoDocumento(){ return $this->_tipoDocumento; }
		public function setTipoDocumento($tipoDocumento){ $this->_tipoDocumento=$tipoDocumento; }

	    private $_nroDocumento;
	    public function getNroDocumento(){ return $this->_nroDocumento; }
		public function setNroDocumento($nroDocumento){ $this->_nroDocumento=$nroDocumento; }

	    private $_apellidoNombreApoderado;
	    public function getApellidoNombreApoderado(){ return $this->_apellidoNombreApoderado; }
		public function setApellidoNombreApoderado($apellidoNombreApoderado){ $this->_apellidoNombreApoderado=$apellidoNombreApoderado; }

	    private $_tipoDocumentoApoderado;
	    public function getTipoDocumentoApoderado(){ return $this->_tipoDocumentoApoderado; }
		public function setTipoDocumentoApoderado($tipoDocumentoApoderado){ $this->_tipoDocumentoApoderado=$tipoDocumentoApoderado; }

	    private $_nroDocumentoApoderado;
	    public function getNroDocumentoApoderado(){ return $this->_nroDocumentoApoderado; }
		public function setNroDocumentoApoderado($nroDocumentoApoderado){ $this->_nroDocumentoApoderado=$nroDocumentoApoderado; }

	    private $_telefonoContacto;
	    public function getTelefonoContacto(){ return $this->_telefonoContacto; }
		public function setTelefonoContacto($telefonoContacto){ $this->_telefonoContacto=$telefonoContacto; }

	    private $_emailContacto;
	    public function getEmailContacto(){ return $this->_emailContacto; }
		public function setEmailContacto($emailContacto){ $this->_emailContacto=$emailContacto; }

	    private $_operadorDonador;
	    public function getOperadorDonador(){ return $this->_operadorDonador; }
		public function setOperadorDonador($operadorDonador){ $this->_operadorDonador=$operadorDonador; }

	    private $_modalidadContratacion;
	    public function getModalidadContratacion(){ return $this->_modalidadContratacion; }
		public function setModalidadContratacion($modalidadContratacion){ $this->_modalidadContratacion=$modalidadContratacion; }

	    private $_linea1;
	    public function getLinea1(){ return $this->_linea1; }
		public function setLinea1($linea1){ $this->_linea1=$linea1; }

	    private $_linea2;
	    public function getLinea2(){ return $this->_linea2; }
		public function setLinea2($linea2){ $this->_linea2=$linea2; }

	    private $_linea3;
	    public function getLinea3(){ return $this->_linea3; }
		public function setLinea3($linea3){ $this->_linea3=$linea3; }

	    private $_linea4;
	    public function getLinea4(){ return $this->_linea4; }
		public function setLinea4($linea4){ $this->_linea4=$linea4; }

	    private $_linea5;
	    public function getLinea5(){ return $this->_linea5; }
		public function setLinea5($linea5){ $this->_linea5=$linea5; }

	    private $_operadorReceptor;
	    public function getOperadorReceptor(){ return $this->_operadorReceptor; }
		public function setOperadorReceptor($operadorReceptor){ $this->_operadorReceptor=$operadorReceptor; }

	    private $_cantLineasPortar;
	    public function getCantLineasPortar(){ return $this->_cantLineasPortar; }
		public function setCantLineasPortar($cantLineasPortar){ $this->_cantLineasPortar=$cantLineasPortar; }

	    private $_fechaEstimadaPortacion;
	    public function getFechaEstimadaPortacion(){ return $this->_fechaEstimadaPortacion; }
		public function setFechaEstimadaPortacion($fechaEstimadaPortacion){ $this->_fechaEstimadaPortacion=$fechaEstimadaPortacion; }

	    private $_nroDocumentoPresolicitud;
	    public function getNroDocumentoPresolicitud(){ return $this->_nroDocumentoPresolicitud; }
		public function setNroDocumentoPresolicitud($nroDocumentoPresolicitud){ $this->_nroDocumentoPresolicitud=$nroDocumentoPresolicitud; }

	    private $_domicilioCompletoEnvio;
	    public function getDomicilioCompletoEnvio(){ return $this->_domicilioCompletoEnvio; }
		public function setDomicilioCompletoEnvio($domicilioCompletoEnvio){ $this->_domicilioCompletoEnvio=$domicilioCompletoEnvio; }

	    private $_codigoPostal;
	    public function getCodigoPostal(){ return $this->_codigoPostal; }
		public function setCodigoPostal($codigoPostal){ $this->_codigoPostal=$codigoPostal; }

	    private $_localidad;
	    public function getLocalidad(){ return $this->_localidad; }
		public function setLocalidad($localidad){ $this->_localidad=$localidad; }

	    private $_provincia;
	    public function getProvincia(){ return $this->_provincia; }
		public function setProvincia($provincia){ $this->_provincia=$provincia; }

	    private $_informacionAdicionalEnvio;
	    public function getInformacionAdicionalEnvio(){ return $this->_informacionAdicionalEnvio; }
		public function setInformacionAdicionalEnvio($informacionAdicionalEnvio){ $this->_informacionAdicionalEnvio=$informacionAdicionalEnvio; }

	    private $_horarioContactoDesde;
	    public function getHorarioContactoDesde(){ return $this->_horarioContactoDesde; }
		public function setHorarioContactoDesde($horarioContactoDesde){ $this->_horarioContactoDesde=$horarioContactoDesde; }

	    private $_horarioContactoHasta;
	    public function getHorarioContactoHasta(){ return $this->_horarioContactoHasta; }
		public function setHorarioContactoHasta($horarioContactoHasta){ $this->_horarioContactoHasta=$horarioContactoHasta; }

	    private $_horarioContactoDesdeOp2;
	    public function getHorarioContactoDesdeOp2(){ return $this->_horarioContactoDesdeOp2; }
		public function setHorarioContactoDesdeOp2($horarioContactoDesdeOp2){ $this->_horarioContactoDesdeOp2=$horarioContactoDesdeOp2; }

	    private $_horarioContactoHastaOp2;
	    public function getHorarioContactoHastaOp2(){ return $this->_horarioContactoHastaOp2; }
		public function setHorarioContactoHastaOp2($horarioContactoHastaOp2){ $this->_horarioContactoHastaOp2=$horarioContactoHastaOp2; }

	    private $_modoPago;
	    public function getModoPago(){ return $this->_modoPago; }
		public function setModoPago($modoPago){ $this->_modoPago=$modoPago; }

	    private $_cantSimcardsEntregar;
    	public function getCantSimcardsEntregar(){ return $this->_cantSimcardsEntregar; }
		public function setCantSimcardsEntregar($cantSimcardsEntregar){ $this->_cantSimcardsEntregar=$cantSimcardsEntregar; }

	    private $_cantLineas1;
    	public function getCantLineas1(){ return $this->_cantLineas1; }
		public function setCantLineas1($cantLineas1){ $this->_cantLineas1=$cantLineas1; }

	    private $_codPlan1;
    	public function getCodPlan1(){ return $this->_codPlan1; }
		public function setCodPlan1($codPlan1){ $this->_codPlan1=$codPlan1; }

	    private $_descripcionPlan1;
    	public function getDescripcionPlan1(){ return $this->_descripcionPlan1; }
		public function setDescripcionPlan1($descripcionPlan1){ $this->_descripcionPlan1=$descripcionPlan1; }

	    private $_precioPlan1;
    	public function getPrecioPlan1(){ return $this->_precioPlan1; }
		public function setPrecioPlan1($precioPlan1){ $this->_precioPlan1=$precioPlan1; }	    

	   	private $_cantLineas2;
    	public function getCantLineas2(){ return $this->_cantLineas2; }
		public function setCantLineas2($cantLineas2){ $this->_cantLineas2=$cantLineas2; }

	    private $_codPlan2;
    	public function getCodPlan2(){ return $this->_codPlan2; }
		public function setCodPlan2($codPlan2){ $this->_codPlan2=$codPlan2; }

	    private $_descripcionPlan2;
    	public function getDescripcionPlan2(){ return $this->_descripcionPlan2; }
		public function setDescripcionPlan2($descripcionPlan2){ $this->_descripcionPlan2=$descripcionPlan2; }

	    private $_precioPlan2;
    	public function getPrecioPlan2(){ return $this->_precioPlan2; }
		public function setPrecioPlan2($precioPlan2){ $this->_precioPlan2=$precioPlan2; }	

	   	private $_cantLineas3;
    	public function getCantLineas3(){ return $this->_cantLineas3; }
		public function setCantLineas3($cantLineas3){ $this->_cantLineas3=$cantLineas3; }

	    private $_codPlan3;
    	public function getCodPlan3(){ return $this->_codPlan3; }
		public function setCodPlan3($codPlan3){ $this->_codPlan3=$codPlan3; }

	    private $_descripcionPlan3;
    	public function getDescripcionPlan3(){ return $this->_descripcionPlan3; }
		public function setDescripcionPlan3($descripcionPlan3){ $this->_descripcionPlan3=$descripcionPlan3; }

	    private $_precioPlan3;
    	public function getPrecioPlan3(){ return $this->_precioPlan3; }
		public function setPrecioPlan3($precioPlan3){ $this->_precioPlan3=$precioPlan3; }	

   		private $_cantLineas4;
    	public function getCantLineas4(){ return $this->_cantLineas4; }
		public function setCantLineas4($cantLineas4){ $this->_cantLineas4=$cantLineas4; }

	    private $_codPlan4;
    	public function getCodPlan4(){ return $this->_codPlan4; }
		public function setCodPlan4($codPlan4){ $this->_codPlan4=$codPlan4; }

	    private $_descripcionPlan4;
    	public function getDescripcionPlan4(){ return $this->_descripcionPlan4; }
		public function setDescripcionPlan4($descripcionPlan4){ $this->_descripcionPlan4=$descripcionPlan4; }

	    private $_precioPlan4;
    	public function getPrecioPlan4(){ return $this->_precioPlan4; }
		public function setPrecioPlan4($precioPlan4){ $this->_precioPlan4=$precioPlan4; }	

	   	private $_cantLineas5;
    	public function getCantLineas5(){ return $this->_cantLineas5; }
		public function setCantLineas5($cantLineas5){ $this->_cantLineas5=$cantLineas5; }

	    private $_codPlan5;
    	public function getCodPlan5(){ return $this->_codPlan5; }
		public function setCodPlan5($codPlan5){ $this->_codPlan5=$codPlan5; }

	    private $_descripcionPlan5;
    	public function getDescripcionPlan5(){ return $this->_descripcionPlan5; }
		public function setDescripcionPlan5($descripcionPlan5){ $this->_descripcionPlan5=$descripcionPlan5; }

	    private $_precioPlan5;
    	public function getPrecioPlan5(){ return $this->_precioPlan5; }
		public function setPrecioPlan5($precioPlan5){ $this->_precioPlan5=$precioPlan5; }	

	    private $_emailEnviarDocGestionada;
    	public function getEmailEnviarDocGestionada(){ return $this->_emailEnviarDocGestionada; }
		public function setEmailEnviarDocGestionada($emailEnviarDocGestionada){ $this->_emailEnviarDocGestionada=$emailEnviarDocGestionada; }

	    private $_equipoVenta;
    	public function getEquipoVenta(){ return $this->_equipoVenta; }
		public function setEquipoVenta($equipoVenta){ $this->_equipoVenta=$equipoVenta; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		private $_fechaTT;
		public function getFechaTT(){ return $this->_fechaTT; }
		public function setFechaTT($fechaTT){ $this->_fechaTT=$fechaTT;}

		private $_numeroTT;
		public function getNumeroTT(){ return $this->_numeroTT; }
		public function setNumeroTT($numeroTT){ $this->_numeroTT=$numeroTT;}

		private $_clienteTT;
		public function getClienteTT(){ return $this->_clienteTT; }
		public function setClienteTT($clienteTT){ $this->_clienteTT=$clienteTT;}

		private $_longitudTT;
		public function getLongitudTT(){ return $this->_longitudTT; }
		public function setLongitudTT($longitudTT){ $this->_longitudTT=$longitudTT;}

		private $_latitudTT;
		public function getLatitudTT(){ return $this->_latitudTT; }
		public function setLatitudTT($latitudTT){ $this->_latitudTT=$latitudTT;}

		private $_sim1;
		public function getSim1(){ return $this->_sim1; }
		public function setSim1($sim1){ $this->_sim1=$sim1;}

		private $_sim2;
		public function getSim2(){ return $this->_sim2; }
		public function setSim2($sim2){ $this->_sim2=$sim2;}

		private $_sim3;
		public function getSim3(){ return $this->_sim3; }
		public function setSim3($sim3){ $this->_sim3=$sim3;}

		private $_sim4;
		public function getSim4(){ return $this->_sim4; }
		public function setSim4($sim4){ $this->_sim4=$sim4;}

		private $_sim5;
		public function getSim5(){ return $this->_sim5; }
		public function setSim5($sim5){ $this->_sim5=$sim5;}

		private $_plaza;
		public function getPlaza(){ return $this->_plaza; }
		public function setPlaza($plaza){ $this->_plaza=$plaza; }		

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setFecha('');
			$this->setImportacion(new Importacion);

			$this->setNroGestion('');
			$this->setFechaEnvio('');
			$this->setNroSolicitudPNM('');
			$this->setNroReceptoraPIN('');
			$this->setTipoSuscriptor('');
			$this->setApellidoNombre('');
			$this->setRazonSocial('');
			$this->setTipoDocumento('');
			$this->setNroDocumento('');    	   
			$this->setApellidoNombreApoderado('');
			$this->setTipoDocumentoApoderado('');
			$this->setNroDocumentoApoderado('');
			$this->setTelefonoContacto('');
			$this->setEmailContacto('');
			$this->setOperadorDonador('');
			$this->setModalidadContratacion('');
			$this->setLinea1('');
			$this->setLinea2('');
			$this->setLinea3('');
			$this->setLinea4('');
			$this->setLinea5('');
			$this->setOperadorReceptor('');
			$this->setCantLineasPortar('');
			$this->setFechaEstimadaPortacion('');
			$this->setNroDocumentoPresolicitud('');
			$this->setDomicilioCompletoEnvio('');
			$this->setCodigoPostal('');
			$this->setLocalidad('');
			$this->setProvincia('');
			$this->setInformacionAdicionalEnvio('');
			$this->setHorarioContactoDesde('');
			$this->setHorarioContactoHasta('');
			$this->setHorarioContactoDesdeOp2('');
			$this->setHorarioContactoHastaOp2('');
			$this->setModoPago('');
			$this->setCantSimcardsEntregar('');
			$this->setCantLineas1('');
		    $this->setCodPlan1('');
			$this->setDescripcionPlan1('');
			$this->setPrecioPlan1('');
			$this->setCantLineas2('');
			$this->setCodPlan2('');
			$this->setDescripcionPlan2('');
			$this->setPrecioPlan2('');
			$this->setCantLineas3('');
			$this->setCodPlan3('');
			$this->setDescripcionPlan3('');
			$this->setPrecioPlan3('');
			$this->setCantLineas4('');
			$this->setCodPlan4('');
			$this->setDescripcionPlan4('');
			$this->setPrecioPlan4('');
			$this->setCantLineas5('');
			$this->setCodPlan5('');
			$this->setDescripcionPlan5('');
			$this->setPrecioPlan5('');
	   		$this->setEmailEnviarDocGestionada('');
			$this->setEquipoVenta('');

			$this->setEstado(true);
			$this->setFechaTT('');
			$this->setNumeroTT(0);
			$this->setClienteTT(0);
			$this->setLongitudTT('');
			$this->setLatitudTT('');

			$this->setSim1('');
			$this->setSim2('');
			$this->setSim3('');
			$this->setSim4('');
			$this->setSim5('');

			$this->setPlaza('');
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getImportacion()))
					throw new Exception("Importación vacia");

				if(empty($this->getFecha()))
					throw new Exception("Fecha vacia");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");			

				# Query 			
				$query="INSERT INTO importacion_tipo2 (		        						
										id_importacion,
										fecha,	
										nro_gestion,
									    fecha_envio,
									    nro_solicitud_PNM,
									    nro_receptora_PIN,
									    tipo_suscriptor,
									    apellido_nombre,
									    razon_social,
									    tipo_documento,
									    nro_documento,
									    apellido_nombre_apoderado,
									    tipo_documento_apoderado,
									    nro_documento_apoderado,
									    telefono_contacto,
									    email_contacto,
									    operador_donador,
									    modalidad_contratacion,
									    linea1,
									    linea2,
									    linea3,
									    linea4,
									    linea5,
									    operador_receptor,
									    cant_lineas_portar,
									    fecha_estimada_portacion,
									    nro_documento_presolicitud,
									    domicilio_completo_envio,
									    codigo_postal,
									    localidad,
									    provincia,
									    informacion_adicional_envio,
									    horario_contacto_desde,
									    horario_contacto_hasta,
									    horario_contacto_desde_op2,
									    horario_contacto_hasta_op2,
									    modo_pago,
									    cant_simcards_entregar,
									    cant_lineas_1,
									    cod_plan_1,
									    descripcion_plan_1,
									    precio_plan_1,
									    cant_lineas_2,
									    cod_plan_2,
									    descripcion_plan_2,
									    precio_plan_2,
									    cant_lineas_3,
									    cod_plan_3,
									    descripcion_plan_3,
									    precio_plan_3,
									    cant_lineas_4,
									    cod_plan_4,
									    descripcion_plan_4,
									    precio_plan_4,
									    cant_lineas_5,
									    cod_plan_5,
									    descripcion_plan_5,
									    precio_plan_5,
									    email_enviar_doc_gestionada,
									    equipo_venta,
										cliente_tt,
										longitud_tt,
										latitud_tt,
										estado,
										sim1,
										sim2,
										sim3,
										sim4,
										sim5,
										plaza
	        			) VALUES (

										".$this->getImportacion().",
										'".$this->getFecha()."',
										'".$this->getNroGestion()."',
										'".$this->getFechaEnvio()."',
										'".$this->getNroSolicitudPNM()."',
										'".$this->getNroReceptoraPIN()."',
										'".$this->getTipoSuscriptor()."',
										'".$this->getApellidoNombre()."',
										'".$this->getRazonSocial()."',
										'".$this->getTipoDocumento()."',
										'".$this->getNroDocumento()."',
										'".$this->getApellidoNombreApoderado()."',
										'".$this->getTipoDocumentoApoderado()."',
										'".$this->getNroDocumentoApoderado()."',
										'".$this->getTelefonoContacto()."',
										'".$this->getEmailContacto()."',
										'".$this->getOperadorDonador()."',
										'".$this->getModalidadContratacion()."',
										'".$this->getLinea1()."',
										'".$this->getLinea2()."',
										'".$this->getLinea3()."',
										'".$this->getLinea4()."',
										'".$this->getLinea5()."',
										'".$this->getOperadorReceptor()."',
										'".$this->getCantLineasPortar()."',
										'".$this->getFechaEstimadaPortacion()."',
										'".$this->getNroDocumentoPresolicitud()."',
										'".$this->getDomicilioCompletoEnvio()."',
										'".$this->getCodigoPostal()."',
										'".$this->getLocalidad()."',
										'".$this->getProvincia()."',
										'".$this->getInformacionAdicionalEnvio()."',
										'".$this->getHorarioContactoDesde()."',
										'".$this->getHorarioContactoHasta()."',
										'".$this->getHorarioContactoDesdeOp2()."',
										'".$this->getHorarioContactoHastaOp2()."',
										'".$this->getModoPago()."',
										'".$this->getCantSimcardsEntregar()."',
										'".$this->getCantLineas1()."',
										'".$this->getCodPlan1()."',
										'".$this->getDescripcionPlan1()."',
										'".$this->getPrecioPlan1()."',
										'".$this->getCantLineas2()."',
										'".$this->getCodPlan2()."',
										'".$this->getDescripcionPlan2()."',
										'".$this->getPrecioPlan2()."',
										'".$this->getCantLineas3()."',
										'".$this->getCodPlan3()."',
										'".$this->getDescripcionPlan3()."',
										'".$this->getPrecioPlan3()."',
										'".$this->getCantLineas4()."',
										'".$this->getCodPlan4()."',
										'".$this->getDescripcionPlan4()."',
										'".$this->getPrecioPlan4()."',
										'".$this->getCantLineas5()."',
										'".$this->getCodPlan5()."',
										'".$this->getDescripcionPlan5()."',
										'".$this->getPrecioPlan5()."',
										'".$this->getEmailEnviarDocGestionada()."',
										'".$this->getEquipoVenta()."',
										".$this->getClienteTT().",
										'".$this->getLatitudTT()."',
										'".$this->getLongitudTT()."',
										'".$this->getEstado()."',
										'".$this->getSim1()."',
										'".$this->getSim2()."',
										'".$this->getSim3()."',
										'".$this->getSim4()."',
										'".$this->getSim5()."',
										'".$this->getPlaza()."'
	        			)";        
			
	        			//echo $query;
	        			//exit();

				# Ejecucion 					
				return SQL::insert($conexion,$query);
			
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}		
		}

		public function update($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Registro ed importación no identificado");

				if(empty($this->getImportacion()))
					throw new Exception("Importación vacia");

				if(empty($this->getFecha()))
					throw new Exception("Fecha vacia");
				
				
				# Query 			
				$query="UPDATE importacion_tipo2 SET
								id_importacion=".$this->getImportacion().",
								fecha='".$this->getFecha()."',
								nro_gestion=".$this->getNroGestion()."',
							    fecha_envio=".$this->getFechaEnvio()."',
							    nro_solicitud_PNM=".$this->getNroSolicitudPNM()."',
							    nro_receptora_PIN=".$this->getNroReceptoraPIN()."',
							    tipo_suscriptor=".$this->getTipoSuscriptor()."',
							    apellido_nombre=".$this->getApellidoNombre()."',
							    razon_social=".$this->getRazonSocial()."',
							    tipo_documento=".$this->getTipoDocumento()."',
							    nro_documento=".$this->getNroDocumento()."',
							    apellido_nombre_apoderado=".$this->getApellidoNombreApoderado()."',
							    tipo_documento_apoderado=".$this->getTipoDocumentoApoderado()."',
							    nro_documento_apoderado=".$this->getNroDocumentoApoderado()."',
							    telefono_contacto=".$this->getTelefonoContacto()."',
							    email_contacto=".$this->getEmailContacto()."',
							    operador_donador=".$this->getOperadorDonador()."',
							    modalidad_contratacion=".$this->getModalidadContratacion()."',
							    linea1=".$this->getLinea1()."',
							    linea2=".$this->getLinea2()."',
							    linea3=".$this->getLinea3()."',
							    linea4=".$this->getLinea4()."',
							    linea5=".$this->getLinea5()."',
							    operador_receptor=".$this->getOperadorReceptor()."',
							    cant_lineas_portar=".$this->getCantLineasPortar()."',
							    fecha_estimada_portacion=".$this->getFechaEstimadaPortacion()."',
							    nro_documento_presolicitud=".$this->getNroDocumentoPresolicitud()."',
							    domicilio_completo_envio=".$this->getDomicilioCompletoEnvio()."',
							    codigo_postal=".$this->getCodigoPostal()."',
							    localidad=".$this->getLocalidad()."',
							    provincia=".$this->getProvincia()."',
							    informacion_adicional_envio=".$this->getInformacionAdicionalEnvio()."',
							    horario_contacto_desde=".$this->getHorarioContactoDesde()."',
							    horario_contacto_hasta=".$this->getHorarioContactoHasta()."',
							    horario_contacto_desde_op2=".$this->getHorarioContactoDesdeOp2()."',
							    horario_contacto_hasta_op2=".$this->getHorarioContactoHastaOp2()."',
							    modo_pago=".$this->getModoPago()."',
							    cant_simcards_entregar=".$this->getCantSimcardsEntregar()."',
							    cant_lineas_1=".$this->getCantLineas1()."',
							    cod_plan_1=".$this->getCodPlan1()."',
							    descripcion_plan_1=".$this->getDescripcionPlan1()."',
							    precio_plan_1=".$this->getPrecioPlan1()."',
							    cant_lineas_2=".$this->getCantLineas2()."',
							    cod_plan_2=".$this->getCodPlan2()."',
							    descripcion_plan_2=".$this->getDescripcionPlan2()."',
							    precio_plan_2=".$this->getPrecioPlan2()."',
							    cant_lineas_3=".$this->getCantLineas3()."',
							    cod_plan_3=".$this->getCodPlan3()."',
							    descripcion_plan_3=".$this->getDescripcionPlan3()."',
							    precio_plan_3=".$this->getPrecioPlan3()."',
							    cant_lineas_4=".$this->getCantLineas4()."',	  
							    cod_plan_4=".$this->getCodPlan4()."',
							    descripcion_plan_4=".$this->getDescripcionPlan4()."',
							    precio_plan_4=".$this->getPrecioPlan4()."',
							    cant_lineas_5=".$this->getCantLineas5()."',
							    cod_plan_5=".$this->getCodPlan5()."',
							    descripcion_plan_5=".$this->getDescripcionPlan5()."',
							    precio_plan_5=".$this->getPrecioPlan5()."',		
							    email_enviar_doc_gestionada=".$this->getEmailEnviarDocGestionada()."',
							    equipo_venta=".$this->getEquipoVenta()."',								
								cliente_tt=".$this->getClienteTT().",
								latitud_tt='".$this->getLongitudTT()."',
								longitud_tt='".$this->getLatitudTT()."',
								estado='".$this->getEstado()."',		
								sim1='".$this->getSim1()."',	
								sim2='".$this->getSim2()."',	
								sim3='".$this->getSim3()."',	
								sim4='".$this->getSim4()."',	
								sim5='".$this->getSim5()."',
								plaza='".$this->getPlaza()."',
							WHERE id=".$this->getId();

				# Ejecucion 					
				return SQL::update($conexion,$query);	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}		
		}

		public function delete($conexion)
		{
			try {
				
				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Registro de importación no identificado");
			
				# Query 			
				$query="UPDATE importacion_tipo2 SET							
								estado='false'
							WHERE id=".$this->getId();

				# Ejecucion 	
				return SQL::delete($conexion,$query);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function select()
		{			
			try {
											
				# Query
				if(empty($this->getId()))
				{
					if(empty($this->getImportacion()))
						$query = "SELECT * FROM importacion_tipo2 WHERE estado='true'";
					else
						$query="SELECT * FROM importacion_tipo2 WHERE id_importacion=".$this->getImportacion()." AND estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del registro de importación");		

					$query="SELECT * FROM importacion_tipo2 WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new ImportacionTipo2);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}

		public function setPropiedadesBySelect($filas)
		{	
			if(empty($filas)){
				$this->cleanClass();
			}
			else{
				$this->setId($filas['id']);
				$this->setFecha($filas['fecha']);

				$this->setNroGestion($filas['nro_gestion']);
				$this->setFechaEnvio($filas['fecha_envio']);
				$this->setNroSolicitudPNM($filas['nro_solicitud_PNM']);
				$this->setNroReceptoraPIN($filas['nro_receptora_PIN']);
				$this->setTipoSuscriptor($filas['tipo_suscriptor']);
				$this->setApellidoNombre($filas['apellido_nombre']);
				$this->setRazonSocial($filas['razon_social']);
				$this->setTipoDocumento($filas['tipo_documento']);
				$this->setNroDocumento($filas['nro_documento']);   
				$this->setApellidoNombreApoderado($filas['apellido_nombre_apoderado']);
				$this->setTipoDocumentoApoderado($filas['tipo_documento_apoderado']);
				$this->setNroDocumentoApoderado($filas['nro_documento_apoderado']);
				$this->setTelefonoContacto($filas['telefono_contacto']);
				$this->setEmailContacto($filas['email_contacto']);
				$this->setOperadorDonador($filas['operador_donador']);
				$this->setModalidadContratacion($filas['modalidad_contratacion']);
				$this->setLinea1($filas['linea1']);
				$this->setLinea2($filas['linea2']);
				$this->setLinea3($filas['linea3']);
				$this->setLinea4($filas['linea4']);
				$this->setLinea5($filas['linea5']);
				$this->setOperadorReceptor($filas['operador_receptor']);
				$this->setCantLineasPortar($filas['cant_lineas_portar']);
				$this->setFechaEstimadaPortacion($filas['fecha_estimada_portacion']);
				$this->setNroDocumentoPresolicitud($filas['nro_documento_presolicitud']);
				$this->setDomicilioCompletoEnvio($filas['domicilio_completo_envio']);
				$this->setCodigoPostal($filas['codigo_postal']);
				$this->setLocalidad($filas['localidad']);
				$this->setProvincia($filas['provincia']);
				$this->setInformacionAdicionalEnvio($filas['informacion_adicional_envio']);
				$this->setHorarioContactoDesde($filas['horario_contacto_desde']);
				$this->setHorarioContactoHasta($filas['horario_contacto_hasta']);
				$this->setHorarioContactoDesdeOp2($filas['horario_contacto_desde_op2']);
				$this->setHorarioContactoHastaOp2($filas['horario_contacto_hasta_op2']);
				$this->setModoPago($filas['modo_pago']);
				$this->setCantSimcardsEntregar($filas['cant_simcards_entregar']);
				$this->setCantLineas1($filas['cant_lineas_1']);
			    $this->setCodPlan1($filas['cod_plan_1']);
				$this->setDescripcionPlan1($filas['descripcion_plan_1']);
				$this->setPrecioPlan1($filas['precio_plan_1']);
				$this->setCantLineas2($filas['cant_lineas_2']);
				$this->setCodPlan2($filas['cod_plan_2']);
				$this->setDescripcionPlan2($filas['descripcion_plan_2']);
				$this->setPrecioPlan2($filas['precio_plan_2']);
				$this->setCantLineas3($filas['cant_lineas_3']);
				$this->setCodPlan3($filas['cod_plan_3']);
				$this->setDescripcionPlan3($filas['descripcion_plan_3']);
				$this->setPrecioPlan3($filas['precio_plan_3']);
				$this->setCantLineas4($filas['cant_lineas_4']);
				$this->setCodPlan4($filas['cod_plan_4']);
				$this->setDescripcionPlan4($filas['descripcion_plan_4']);
				$this->setPrecioPlan4($filas['precio_plan_4']);
				$this->setCantLineas5($filas['cant_lineas_5']);
				$this->setCodPlan5($filas['cod_plan_5']);
				$this->setDescripcionPlan5($filas['descripcion_plan_5']);
				$this->setPrecioPlan5($filas['precio_plan_5']);
		   		$this->setEmailEnviarDocGestionada($filas['email_enviar_doc_gestionada']);
				$this->setEquipoVenta($filas['equipo_venta']);

				$this->setFechaTT($filas['fecha_tt']);
				$this->setNumeroTT($filas['numero_tt']);
				$this->setClienteTT($filas['cliente_tt']);
				$this->setLongitudTT($filas['longitud_tt']);
				$this->setLatitudTT($filas['latitud_tt']);
				$this->setEstado($filas['estado']);

				$this->setSim1($filas['sim1']);
				$this->setSim2($filas['sim2']);
				$this->setSim3($filas['sim3']);
				$this->setSim4($filas['sim4']);
				$this->setSim5($filas['sim5']);

				$this->setPlaza($filas['plaza']);

				$im = new Importacion;
				$im->setId($filas['id_importacion']);
				$im = $im->select();												
				$this->setImportacion($im);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setFecha('');
			$this->setImportacion(new Importacion);

			$this->setNroGestion('');
			$this->setFechaEnvio('');
			$this->setNroSolicitudPNM('');
			$this->setNroReceptoraPIN('');
			$this->setTipoSuscriptor('');
			$this->setApellidoNombre('');
			$this->setRazonSocial('');
			$this->setTipoDocumento('');
			$this->setNroDocumento('');    	   
			$this->setApellidoNombreApoderado('');
			$this->setTipoDocumentoApoderado('');
			$this->setNroDocumentoApoderado('');
			$this->setTelefonoContacto('');
			$this->setEmailContacto('');
			$this->setOperadorDonador('');
			$this->setModalidadContratacion('');
			$this->setLinea1('');
			$this->setLinea2('');
			$this->setLinea3('');
			$this->setLinea4('');
			$this->setLinea5('');
			$this->setOperadorReceptor('');
			$this->setCantLineasPortar('');
			$this->setFechaEstimadaPortacion('');
			$this->setNroDocumentoPresolicitud('');
			$this->setDomicilioCompletoEnvio('');
			$this->setCodigoPostal('');
			$this->setLocalidad('');
			$this->setProvincia('');
			$this->setInformacionAdicionalEnvio('');
			$this->setHorarioContactoDesde('');
			$this->setHorarioContactoHasta('');
			$this->setHorarioContactoDesdeOp2('');
			$this->setHorarioContactoHastaOp2('');
			$this->setModoPago('');
			$this->setCantSimcardsEntregar('');
			$this->setCantLineas1('');
		    $this->setCodPlan1('');
			$this->setDescripcionPlan1('');
			$this->setPrecioPlan1('');
			$this->setCantLineas2('');
			$this->setCodPlan2('');
			$this->setDescripcionPlan2('');
			$this->setPrecioPlan2('');
			$this->setCantLineas3('');
			$this->setCodPlan3('');
			$this->setDescripcionPlan3('');
			$this->setPrecioPlan3('');
			$this->setCantLineas4('');
			$this->setCodPlan4('');
			$this->setDescripcionPlan4('');
			$this->setPrecioPlan4('');
			$this->setCantLineas5('');
			$this->setCodPlan5('');
			$this->setDescripcionPlan5('');
			$this->setPrecioPlan5('');
	   		$this->setEmailEnviarDocGestionada('');
			$this->setEquipoVenta('');

			$this->setEstado(true);
			$this->setFechaTT('');
			$this->setNumeroTT(0);
			$this->setClienteTT(0);
			$this->setLongitudTT('');
			$this->setLatitudTT('');

			$this->setSim1('');			
			$this->setSim2('');
			$this->setSim3('');
			$this->setSim4('');
			$this->setSim5('');

			$this->setPlaza('');
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/


		function deleteByImportacion($conexion){
			try {
				
				# Validaciones 			
				if(empty($this->getImportacion()))
					throw new Exception("Importación no identificada");
			
				# Query 			
				$query="UPDATE importacion_tipo2 SET estado='false' WHERE id_importacion =".$this->getImportacion();

				# Ejecucion 	
				return SQL::delete($conexion,$query);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		function countAprobado($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro la importación");
					
				$query="SELECT * FROM importacion_tipo2 WHERE id_importacion=".$id." AND NOT numero_tt IS NULL";

				# Ejecucion 					
				$result = SQL::selectObject($query, new ImportacionTipo2);
						
				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}		
	}
?>