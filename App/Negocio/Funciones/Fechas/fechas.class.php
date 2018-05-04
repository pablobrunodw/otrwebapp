<?php
	class Fechas
	{
		function FechaHoraActual()
		{	
			$time=time();
			return date("Y-m-d H:i:s", $time);			
		}

		function FechaActual()
		{
			$time=time();
			return date("Y-m-d", $time);
		}


		function DiasDiferenciaFechas($inicial,$final,$formato)
		{
			$datetime1 = DateTime::createFromFormat($formato,$inicial);
			$datetime2 = DateTime::createFromFormat($formato,$final);
			$interval = $datetime1->diff($datetime2);
			return $interval->format('%a');
		}

		function HorasDiferenciaFechas($fecha_comparacion)
		{	
			$t=time();

			$time_created = $fecha_comparacion;			
			$timediff=$t-$time_created;
			
			return $timediff;			
		}

		function FormatearFechas($fecha,$formato_entrada,$formato_salida)
		{
			$date = DateTime::createFromFormat($formato_entrada, $fecha);
			$fecha_format= $date->format($formato_salida);
			
			return $fecha_format; 			
		}

		function Mes($id){
			switch ($id) {
				case 1:
					return "Enero";
					break;
				case 2:
					return "Febrero";
					break;
				case 3:
					return "Marzo";
					break;
				case 4:
					return "Abril";
					break;
				case 5:
					return "Mayo";
					break;
				case 6:
					return "Junio";
					break;
				case 7:
					return "Julio";
					break;
				case 8:
					return "Agosto";
					break;																																		
				case 9:
					return "Septiembre";
					break;
				case 10:
					return "Octubre";
					break;
				case 11:
					return "Noviembre";
					break;
				case 12:
					return "Diciembre";
					break;																																							
			}
		}

		function Dias($dia){

			switch ($dia) {
				case 'Monday':
					return "Lunes";
					break;		
				case 'Tuesday':
					return "Martes";
					break;	
				case 'Wednesday':
					return "Miércoles";
					break;	
				case 'Thursday':
					return "Jueves";
					break;	
				case 'Friday':
					return "Viernes";
					break;	
				case 'Saturday':
					return "Sábado";
					break;			
				case 'Sunday':
					return "Domingo";
					break;																														
			}
		}
	}
?>