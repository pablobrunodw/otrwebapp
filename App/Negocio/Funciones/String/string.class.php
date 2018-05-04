<?php
	class StringUser{
		public static function emptyUser($value) 
		{
			if(strlen(trim($value))==0)
				return true;
			else
				return false;
		}
	}

?>