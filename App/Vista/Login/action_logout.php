<?php 
	include_once "../../Config/config.ini.php";

	$url = "../../../index.php?view=login";

	session_start([
      'cookie_lifetime' => 2592000,
      'gc_maxlifetime'  => 2592000,
    ]);
	session_destroy();

	header("Location: ".$url);
?>