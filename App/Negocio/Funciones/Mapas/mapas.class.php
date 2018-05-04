<?php
	class Mapas{

		public static function getLatLong($address) 
		{
			$url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".urlencode($address);
			$lat_long = get_object_vars(json_decode(file_get_contents($url)));	

			$medidas["latitud"]='';
			$medidas["longitud"]='';

			if(isset($lat_long['results'][0])){
				$medidas["latitud"] = $lat_long['results'][0]->geometry->location->lat; 
				$medidas["longitud"] = $lat_long['results'][0]->geometry->location->lng;				
			}

			return $medidas;
		}

	}

?>