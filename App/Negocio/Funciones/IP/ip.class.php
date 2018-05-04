<?php
	class IP
	{
		function ObtenerIp()
		{			
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
				return $_SERVER['HTTP_CLIENT_IP'];
			
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			
			return $_SERVER['REMOTE_ADDR'];
		}

		function GeoIp($ip){
			$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));

			$data['latitud'] = $meta['geoplugin_latitude'];
			$data['longitud'] = $meta['geoplugin_longitude'];
			$data['ciudad'] = $meta['geoplugin_city'];
			$data['provincia'] = $meta['geoplugin_regionName'];
			$data['pais'] = $meta['geoplugin_countryName'];			

			return $data;
		}
	}
?>