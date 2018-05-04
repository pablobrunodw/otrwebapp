<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/multiusuario.class.php';	
	include_once PATH_DATOS.'Entidades/usuario.class.php';
	include_once PATH_DATOS.'Entidades/tipousuario.class.php';
	include_once PATH_NEGOCIO.'Funciones/Archivo/archivo.class.php';

	class HandlerMultiusuarios{		
		public function insert ($usuario,$tipoUsuario,$idUserSistema,$aliasUserSistema){
			try {

				$m = new Multiusuario;
				$m->setUsuario($usuario);
				$m->setTipoUsuario($tipoUsuario);
				$m->setUserSistema($idUserSistema);
				$m->setAliasUserSistema($aliasUserSistema);				

				$m->insert(null);
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function delete ($id, $id_usuario){
			try {
				
				$m = new Multiusuario;
				$m->setId($id);
				$m->select();

				$arrMulti = $m->selectByUsuario($id_usuario);				

				if(count($arrMulti)==1){
					$u = new Usuario;									
					$u->setId($id_usuario);
					$u->select();

					$tu = new Tipousuario;
					$tu->setId(0);
					$tu->select();

					$u->setTipoUsuario($tu);
					$u->setUserSistema(0);
					$u->setAliasUserSistema("");

					$u->updateUserActivo(null);
				}

				$m->delete(null);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}
	}
?>	