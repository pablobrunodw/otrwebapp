<?php
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";	
	include_once PATH_NEGOCIO."AccesoSistema/accesosistema.class.php";	

	$url_logout = PATH_VISTA."Login/action_logout.php";	

	//###########################################
	//   Validacion de la sesion del usuario
	//###########################################	

	session_start([
	    'cookie_lifetime' => 2592000,
	    'gc_maxlifetime'  => 2592000,
	]);
    if(!isset($_SESSION["usuario"]) || !isset($_SESSION["logueado"]) || !isset($_SESSION["pass"]))
        header("Location: ".$url_logout);     

	//########################################################################################################################
	//   Registro el login del usuario en cada peticion
	//########################################################################################################################

    $acceso = new AccesoSistema;
    $acceso->registrarLoginLog($_SESSION["usuario"]);

	//########################################################################################################################
	//   Seteo un objeto Usuario (usuario activo) para que este disponible en toda la aplicacion. Proviene de la $_SESSION
	//########################################################################################################################
    
    $handler = new HandlerUsuarios;
    $usuarioActivoSesion = $handler->selectById($_SESSION["usuario"]);    
	
	//##################################
	//   Instancio la clase de permisos
	//##################################	
	$permiso=$handler->selectPerfil($usuarioActivoSesion->getId());
	$perfil =$usuarioActivoSesion->getUsuarioPerfil()->getId();

	if(is_null($usuarioActivoSesion->getTipoUsuario()))
		$tipo_usuario = $usuarioActivoSesion->getTipoUsuario()->getId();
	else
		$tipo_usuario = 0;

	$include="";

	//############################
	//   Ruteo de la aplicacion
	//############################

    if(isset($_GET["view"]))
        $view=$_GET["view"];
    else
        $view="";

	include_once "head.php";
	include_once "header.php";
	include_once "siderbar.php";

	switch ($view) {

		  /*###############*/
		 /* PANEL CONTROL */
		/*###############*/		
		case 'panelcontrol':			
			if($permiso->getModuloPanelBoolean() && $esCliente)	
				$include = 'Modulos/PanelControl/cliente.php';			
			elseif ($permiso->getModuloPanelBoolean() && $esGestor)
				$include = 'Modulos/PanelControl/cliente.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esCoordinador)	
				$include = 'Modulos/PanelControl/coordinador.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esGerencia)
				$include = 'Modulos/PanelControl/gerencia.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esBO)
				$include = 'Modulos/PanelControl/bo.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esIngresante)
				$include = 'Modulos/PanelControl/ingresante.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esDesarrollo)
				$include = 'Modulos/PanelControl/desarrollo.php';		
			break;

		  /*###########*/
		 /* SERVICIOS */
		/*###########*/
		case 'servicio':				
			if($permiso->getModuloServiciosBoolean())
				$include = 'Modulos/Servicio/index.php';			
			break;

		case 'detalle_servicio':				
			if($permiso->getModuloServiciosBoolean())
				$include = 'Modulos/Servicio/detalle.php';			
			break;

		case 'upload_file':	
			if($permiso->getModuloUploadBoolean())		
				$include = 'Modulos/Servicio/UploadFile/uploadfile.php';
			
			break;

		  /*#######*/
		 /* INBOX */
		/*#######*/
		case 'inbox':				
			if($permiso->getModuloInboxBoolean())
				$include = 'Modulos/Inbox/index.php';			
			break;

		  /*############*/
		 /* INVENTARIO */
		/*############*/
		case 'exp_control':				
			if($permiso->getModuloInventariosBoolean() && $esBO)
				$include = 'Modulos/Expediciones/control.php';			
			break;

		case 'exp_tipo_abm':				
			if($permiso->getModuloInventariosBoolean() && $esBO)
				$include = 'Modulos/Expediciones/tipo_abm.php';			
			break;

		case 'exp_solicitud':				
			if($permiso->getModuloInventariosBoolean() && $esCoordinador)
				$include = 'Modulos/Expediciones/solicitud.php';			
			break;

		case 'exp_seguimiento':				
			if($permiso->getModuloInventariosBoolean() && $esCoordinador)
				$include = 'Modulos/Expediciones/seguimiento.php';			
			break;			

		  /*#######*/
		 /* GUIAS */
		/*#######*/
		case 'guias_control':				
			if($permiso->getModuloGuiasBoolean() && $esBO)
				$include = 'Modulos/Guias/control.php';			
			break;

		case 'guias_control_empresa':				
			if($permiso->getModuloGuiasBoolean() && $esCliente)
				$include = 'Modulos/Guias/control_empresa.php';			
			break;

		case 'guias_envios':				
			if($permiso->getModuloGuiasBoolean() && $esCoordinador)
				$include = 'Modulos/Guias/envios.php';			
			break;

		case 'guias_seguimiento':				
			if($permiso->getModuloGuiasBoolean() && $esCoordinador)
				$include = 'Modulos/Guias/seguimiento.php';			
			break;		

		  /*########*/
		 /* PERFIL */
		/*########*/
		case 'perfil_usuario':
			if($permiso->getModuloPerfilBoolean())
				$include = 'Modulos/UsuariosPerfil/index.php';
			break;

		case 'password_usuario':
			if($permiso->getModuloPerfilBoolean())
				$include = 'Modulos/UsuariosPerfil/change_password.php';
			break;

		  /*##############*/
		 /* MULTIUSUARIO */
		/*##############*/
		case 'cambiarUsuario':			
			if($permiso->getModuloMultiusuarioBoolean())
				$include = 'Modulos/UsuariosAdmin/activar_tipo_usuario.php';
			break;			

		  /*##############*/
		 /* USUARIOS ABM */
		/*##############*/
		case 'usuarioABM':
			if($permiso->getModuloUsuariosBoolean())
				$include = 'Modulos/UsuariosAdmin/index.php';
			break;

		case 'usuarioABM_edit':
			if($permiso->getModuloUsuariosBoolean())
				$include = 'Modulos/UsuariosAdmin/edit_usuario.php';
			break;

		case 'usuarioABM_add':
			if($permiso->getModuloUsuariosBoolean())
				$include = 'Modulos/UsuariosAdmin/add_usuario.php';
			break;

		case 'usuarioABM_multiuser':
			if($permiso->getModuloUsuariosBoolean())
				$include = 'Modulos/UsuariosAdmin/multiusuario.php';
			break;

		  /*#############*/
		 /* IMPORTACION */
		/*#############*/
		case 'importacion':
			if($permiso->getModuloImportacionBoolean() && $esCliente){
				if(is_object($usuarioActivoSesion->getTipoUsuario())){
					if($usuarioActivoSesion->getTipoUsuario()->getId()==1)
						$include = 'Modulos/Importacion/index.php';
				}
			}
			break;

		case 'importacion_1':
			if($permiso->getModuloImportacionBoolean() && $esCliente){
				if(is_object($usuarioActivoSesion->getTipoUsuario())){
					if($usuarioActivoSesion->getTipoUsuario()->getId()==1)
						$include = 'Modulos/Importacion/importacion_1.php';
				}
			}
			break;

		case 'importacion_2':
			if($permiso->getModuloImportacionBoolean() && $esCliente){
				if(is_object($usuarioActivoSesion->getTipoUsuario())){
					if($usuarioActivoSesion->getTipoUsuario()->getId()==1)
						$include = 'Modulos/Importacion/importacion_2.php';
				}
			}
			break;

		case 'importacion_3':
			if($permiso->getModuloImportacionBoolean() && $esCliente){
				if(is_object($usuarioActivoSesion->getTipoUsuario())){
					if($usuarioActivoSesion->getTipoUsuario()->getId()==1)
						$include = 'Modulos/Importacion/importacion_3.php';
				}
			}
			break;

		case 'cp_plaza':
			if($permiso->getModuloImportacionBoolean() && ($esGerencia || $esBO || $esCoordinador)){								
				$include = 'Modulos/Importacion/cp_abm.php';				
			}
			break;

		case 'importaciones_sin_plaza':
			if($permiso->getModuloImportacionBoolean() && ($esGerencia || $esBO || $esCoordinador)){								
				$include = 'Modulos/Importacion/importacion_sin_plaza.php';				
			}
			break;

		  /*##########*/
		 /* METRICAS */
		/*##########*/
		case 'estadisticas':
			if($permiso->getModuloMetricasBoolean())
				$include = 'Modulos/Estadisticas/index.php';
			break;

		  /*###############*/
		 /* CONFIGURACION */
		/*###############*/
		case 'configuraciones':
			if($permiso->getModuloConfiguracionBoolean())
				$include = 'Modulos/Configuraciones/index.php';
			break;

		  /*#######*/
		 /* AYUDA */
		/*#######*/
		case 'ayuda':			
			if($permiso->getModuloAyudaBoolean())
				$include = 'Modulos/Ayuda/index.php';
			break;

		case 'grupo_ayuda':				
			if($permiso->getModuloAyudaBoolean() && $esGerencia)
				$include = 'Modulos/Ayuda/grupo.php';			
			break;

		case 'documento_ayuda':		
			if($permiso->getModuloAyudaBoolean() && $esGerencia)
				$include = 'Modulos/Ayuda/documentos.php';			
			break;

		  /*#########*/
		 /* LEGAJOS */
		/*#########*/
		case 'legajos_carga':			
			if($permiso->getModuloLegajosBoolean()  && ($esGestor || $esGerencia || $esBO || $esCoordinador || $esIngresante))
				$include = 'Modulos/Legajos/carga.php';
			break;		

		case 'legajos_control':			
			if($permiso->getModuloLegajosBoolean() && $esBO)
				$include = 'Modulos/Legajos/control.php';
			break;	

		case 'legajos_actualizar':			
			if($permiso->getModuloLegajosBoolean() && $esBO)
				$include = 'Modulos/Legajos/actualizar.php';
			break;	

		  /*########*/
		 /* TICKET */
		/*########*/
		case 'tickets_carga':			
			if($permiso->getModuloTicketsBoolean() && ($esGestor || $esGerencia || $esBO || $esCoordinador || $esIngresante))
				$include = 'Modulos/Ticket/index.php';
			break;	

		case 'tickets_control':			
			if($permiso->getModuloTicketsBoolean() && $esCoordinador)
				$include = 'Modulos/Ticket/control.php';
			break;	

		case 'tickets_aprobar':			
			if($permiso->getModuloTicketsBoolean() && $esBO)
				$include = 'Modulos/Ticket/aprobar.php';
			break;	

		case 'tickets_conceptos':			
			if($permiso->getModuloTicketsBoolean() && ($esGerencia || $esBO || $esCoordinador))
				$include = 'Modulos/Ticket/conceptos_abm.php';
			break;	

		  /*###########*/
		 /* LICENCIAS */
		/*###########*/
		case 'licencias_carga':			
			if($permiso->getModuloLicenciasBoolean() && ($esGestor || $esGerencia || $esBO || $esCoordinador || $esIngresante))
				$include = 'Modulos/Licencias/generar.php';
			break;	

		case 'licencias_control':			
			if($permiso->getModuloLicenciasBoolean() && ($esBO || $esCoordinador))
				$include = 'Modulos/Licencias/control.php';
			break;	

		case 'licencias_imprimir':			
			if($permiso->getModuloLicenciasBoolean() && ($esBO || $esCoordinador))
				$include = 'Modulos/Licencias/imprimir.php';
			break;	

		case 'tipo_licencias':				
			if($permiso->getModuloLicenciasBoolean()  && ($esBO || $esCoordinador))
				$include = 'Modulos/Licencias/tipo_licencias.php';			
			break;

		  /*################*/
		 /* CAPACITACIONES */
		/*################*/
		case 'capacitaciones':			
			if($permiso->getModuloCapacitacionesBoolean())
				$include = 'Modulos/Capacitaciones/index.php';
			break;	

		  /*################*/
		 /* PUNTAJES */
		/*################*/
		case 'puntajes_gestor':			
			if($permiso->getModuloPuntajesBoolean() && $esGestor)
				$include = 'Modulos/Puntajes/view_gestor.php';
			break;	

		case 'puntajes_gestor_detalle':	
			if($permiso->getModuloPuntajesBoolean() && $esGestor)
				$include = 'Modulos/Puntajes/view_gestor_detalle.php';
			break;	

		case 'puntajes_general':			
			if($permiso->getModuloPuntajesBoolean() && !$esGestor)
				$include = 'Modulos/Puntajes/view_general.php';
			break;	

	      /*########*/
		 /* UPLOAD */
		/*########*/
		case 'upload_file':			
			if($permiso->getModuloUploadBoolean())
				$include = 'Modulos/UploadFile/uploadfile.php';		
			break;

	      /*#######*/
		 /* STOCK */
		/*#######*/
		case 'stock':			
			if($permiso->getModuloStockBoolean())
				$include = 'Modulos/Stock/index.php';		
			break;

	      /*##########*/
		 /* ENVIADAS */
		/*##########*/
		case 'enviadas':			
			if($permiso->getModuloEnviadasBoolean())
				$include = 'Modulos/Enviadas/index.php';		
			break;

		  /*##############*/
		 /* HERRAMIENTAS */
		/*##############*/
		case 'herramientas':			
			if($permiso->getModuloHerramientasBoolean())
				$include = 'Modulos/Herramientas/index.php';		
			break;

		  /*##############*/
		 /* HERRAMIENTAS */
		/*##############*/
		case 'impresoras':			
			if($permiso->getModuloHerramientasBoolean())
				$include = 'Modulos/Herramientas/Impresoras/index.php';		
			break;
		  /*##############*/
		 /* HERRAMIENTAS */
		/*##############*/
		case 'celulares':			
			if($permiso->getModuloHerramientasBoolean())
				$include = 'Modulos/Herramientas/Celulares/index.php';		
			break;
		  /*##############*/
		 /* HERRAMIENTAS */
		/*##############*/
		case 'insumos':			
			if($permiso->getModuloHerramientasBoolean())
				$include = 'Modulos/Herramientas/Insumos/index.php';		
			break;


	      /*##########*/
		 /* ROLES */
		/*##########*/
		case 'roles':			
			if($permiso->getModuloRolesBoolean())
				$include = 'Modulos/Roles/index.php';		
			break;

		case 'roles_edit':
			if($permiso->getModuloRolesBoolean())
				$include = 'Modulos/Roles/edit_roles.php';		
			break;		

		default:
			if($permiso->getModuloPanelBoolean() && $esCliente)	
				$include = 'Modulos/PanelControl/cliente.php';			
			elseif ($permiso->getModuloPanelBoolean() && $esGestor)
				$include = 'Modulos/PanelControl/cliente.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esCoordinador)	
				$include = 'Modulos/PanelControl/coordinador.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esGerencia)
				$include = 'Modulos/PanelControl/gerencia.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esBO)
				$include = 'Modulos/PanelControl/bo.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esIngresante)
				$include = 'Modulos/PanelControl/ingresante.php';		
			elseif ($permiso->getModuloPanelBoolean() && $esDesarrollo)
				$include = 'Modulos/PanelControl/desarrollo.php';		
			break;		
	}	

	if($usuarioActivoSesion->getUsuarioPerfil()->getNombre()=="GESTOR" || 
		$usuarioActivoSesion->getUsuarioPerfil()->getNombre()=="CLIENTE" || 
		$usuarioActivoSesion->getUsuarioPerfil()->getNombre()=="COORDINADOR" )
		if(!is_object($usuarioActivoSesion->getTipoUsuario()))
			$include = 'Modulos/UsuariosAdmin/activar_tipo_usuario.php';

	if(empty($include))
		include_once 'errorpermisos.php';
	else		
		include_once $include;	

	include_once "footer.php";
?>