<?php
	class FuncionesArray
	{
		public function agrupar($arrDatos, $campo)
        {
            $arrFiltro=[];
        
            foreach($arrDatos as $value)
            {
                if(isset($value[$campo]))
                    $index = array_search($value[$campo],$arrFiltro);
                else
                    $index = 0;
                
                if(!is_int($index))
                    $arrFiltro[] = $value[$campo];
            }
            
            return $arrFiltro;
        }

        public function select($arrDatos,$campo,$id)
        {
            $arrSelect=null;
            if(!empty($id))
            {
                foreach($arrDatos as $value)
                {
                    if($value[$campo]==$id)
                    {
                        $arrSelect = $value;
                        break;
                    }
                }
            }
            
            return $arrSelect;
        }     

        public function filtrar($arrDatos,$campo,$filtro)
        {   
            $arrListado = $arrDatos;
        
            
                $arrListado = null;
                foreach($arrDatos as $value)
                {
                    if(isset($value[$campo]))
                    {
                        if($value[$campo]==$filtro)
                        {
                            $arrListado[] = $value;
                        }
                    }
                }
            
            
            return $arrListado;
        }

        public function buscar($array,$campo_busqueda_array,$valor_buscado) {
            try {

                foreach ($array as $key => $val) {
                    if ($val[$campo_busqueda_array] === $valor_buscado) {
                        return $key;
                    }
                }
                return null;

            } catch (Exception $e) {
                return null;     
            }
        }

        public function buscarValor($array,$campo_busqueda_array,$valor_buscado,$campo_busqueda_retorno) {
            try {
                                
                foreach ($array as $key => $val) {

                    if ($val[$campo_busqueda_array] === $valor_buscado) {
                        return $val[$campo_busqueda_retorno];
                    }
                }
                return null;

            } catch (Exception $e) {
                return null;     
            }
        }

        public function convert_to_csv_($input_array, $output_file_name, $delimiter)
        {
            /*
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File Transfer');
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename={$output_file_name}");
            header("Expires: 0");
            header("Pragma: public");
            */

            $fh = @fopen( 'php://output', 'w' );

            $headerDisplayed = false;

            foreach ( $input_array as $data ) {                      
                /*
                if ( !$headerDisplayed ) {               
                    fputcsv($fh, array_keys($data));
                    $headerDisplayed = true;
                }
                */

                var_dump($data);
                //fputcsv($fh, $data);
            }              
            
            //fclose($fh);    
            //exit();          
        }

        public function convert_to_csv($input_array, $output_file_name, $delimiter)
        {            
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-Description: File Transfer');
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename={$output_file_name}");
            header("Expires: 0");
            header("Pragma: public");
            
            $fh = @fopen( 'php://output', 'w' );

            $headerDisplayed = false;

            foreach ( $input_array as $data ) {                      
                
                if ( !$headerDisplayed ) {               
                    fputcsv($fh, array_keys($data));
                    $headerDisplayed = true;
                }
                
                fputcsv($fh, $data);
            }              
            
            fclose($fh);    
            exit();          
        }

    }
?>