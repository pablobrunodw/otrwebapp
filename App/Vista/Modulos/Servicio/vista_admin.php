<table class="table table-striped table-condensed" id="tabla" cellspacing="0" width="100%">
  <thead>
    <tr>       
      <th class='text-center'>Fecha</th>
      <th class='text-center'>Nro</th>
      <!--<th class='text-left'>ID.Oport.</th>  -->
      <!--<th class='text-left'>E.Vtas</th>  -->
      <th class='text-left'>DNI</th>            
      <th class='text-left'>Nombre</th>      
      <th class='text-left'>Telefono</th>      
      <th class='text-left'>Localidad</th>      
      <th class='text-left'>Estado</th>  
      <th class='text-left'>Empresa</th>        
      <th class='text-left'>Gerentes</th>       
      <th class='text-left'>Coordinador</th>        
      <th class='text-left'>Gestor</th>  
      <th class='text-left'>Observaciones</th>    
      <!--<th class='text-left'>Oper</th> -->   
      <th style="width: 3%;" class='text-center'></th>
      <th style="width: 5%;" class='text-center'></th>
    </tr>
  </thead>

  <tbody>
    <?php    
      if(!empty($arrDatos)){
        foreach ($arrDatos as $key => $value) {                    

          if($value->SERTT91_OBSERV == $value->SERTT91_OBRESPU)
            $observaciones = $value->SERTT91_OBSERV;
          else
            $observaciones = $value->SERTT91_OBSERV."<br>".$value->SERTT91_OBRESPU; 

          $observaciones = $observaciones."<br>".$value->SERTT91_OBSEENT ;

          $filtros_listado = "&fdoc=".$fdoc."&fdesde=".$fdesde."&fhasta=".$fhasta."&festado=".$festado."&fequipoventa=".$fequipoventa."&fcliente=".$fcliente."&fgerente=".$fgerente."&fcoordinador=".$fcoordinador."&fgestor=".$fgestor."&foperador=".$foperador;      
          $url_hist = $url_detalle."&fechaing=".$value->SERTT11_FECSER->format('Y-m-d')."&nroing=".$value->SERTT12_NUMEING.$filtros_listado;
          $url_uploadfile = $url_upload."&fechaing=".$value->SERTT11_FECSER->format('Y-m-d')."&nroing=".$value->SERTT12_NUMEING;
          
          echo "<tr>";

              //FECHA
              echo "<td class='text-center'>".$value->SERTT11_FECSER->format('d/m/Y')."</td>";              

              //NUMERO
              echo "<td class='text-center'>".$value->SERTT12_NUMEING."</td>";

              //ID OPORTUNIDAD
              /*echo "<td class='text-left'>".$value->SERTT91_IDOPORT."</td>";*/


              //EQUIPO DE VENTAS
              /*if(!empty(trim(strip_tags($value->TEPE91_EQUIPVTA))))
                if(strlen(trim(strip_tags($value->TEPE91_EQUIPVTA)))>5)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->TEPE91_EQUIPVTA)),0,5)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->TEPE91_EQUIPVTA))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->TEPE91_EQUIPVTA))."</td>";
              else
                echo "<td class='text-left'></td>";*/


              //DNI              
              echo "<td class='text-left'>".$value->SERTT31_PERNUMDOC."</td>";              

              //NOMBRE
              if(!empty(trim(strip_tags($value->SERTT91_NOMBRE))))
                if(strlen(trim(strip_tags($value->SERTT91_NOMBRE)))>7)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_NOMBRE)),0,7)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_NOMBRE))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_NOMBRE))."</td>";
              else
                echo "<td class='text-left'></td>";

              //TELEFONO              
              if(!empty(trim(strip_tags($value->SERTT91_TELEFONO))))
                if(strlen(trim(strip_tags($value->SERTT91_TELEFONO)))>10)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_TELEFONO)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_TELEFONO))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_TELEFONO))."</td>";
              else
                echo "<td class='text-left'></td>";

              //LOCALIDAD
              if(!empty(trim(strip_tags($value->SERTT91_LOCALIDAD))))
                if(strlen(trim(strip_tags($value->SERTT91_LOCALIDAD)))>10)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_LOCALIDAD)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_LOCALIDAD))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_LOCALIDAD))."</td>";
              else
                echo "<td class='text-left'></td>";


              //ESTADOS
              $f_array = new FuncionesArray;
              $class_estado = $f_array->buscarValor($allEstados,"1",$value->ESTADOS_DESCCI,"3");
              echo "<td class='text-left'><span class='".$class_estado."'>".$value->ESTADOS_DESCCI."</span></td>";

              //EMPRESA
              echo "<td class='text-left'>".$value->EMPTT21_ABREV."</td>";              


              //GERENTE
              if(!empty(trim(strip_tags($value->SERTT91_GTEALIAS))))
                if(strlen(trim(strip_tags($value->SERTT91_GTEALIAS)))>10)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_GTEALIAS)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_GTEALIAS))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_GTEALIAS))."</td>";
              else
                echo "<td class='text-left'></td>";

              //COORDINADOR
              if(!empty(trim(strip_tags($value->SERTT91_COOALIAS))))
                if(strlen(trim(strip_tags($value->SERTT91_COOALIAS)))>10)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_COOALIAS)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_COOALIAS))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_COOALIAS))."</td>";
              else
                echo "<td class='text-left'></td>";

              //GESTOR
              if(!empty(trim(strip_tags($value->GESTOR21_ALIAS))))
                if(strlen(trim(strip_tags($value->GESTOR21_ALIAS)))>10)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->GESTOR21_ALIAS)),0,10)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->GESTOR21_ALIAS))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->GESTOR21_ALIAS))."</td>";
              else
                echo "<td class='text-left'></td>";
              
              //OBSERVACIONES
              if(!empty(trim(strip_tags($observaciones))))
                if(strlen(trim(strip_tags($observaciones)))>15)
                  echo "<td class='text-left'>".substr(trim(strip_tags($observaciones)),0,15)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($observaciones))."'></i></td>";
                else 
                  echo "<td class='text-left'>".trim(strip_tags($observaciones))."</td>";
              else
                echo "<td class='text-left'></td>";      

              //OPERADOR
              /*
              if(!empty(trim(strip_tags($value->SERTT91_OPERAD))))
                if(strlen(trim(strip_tags($value->SERTT91_OPERAD)))>7)
                  echo "<td class='text-left'>".substr(trim(strip_tags($value->SERTT91_OPERAD)),0,7)."... <i class='fa fa-search-plus pull-right' data-toggle='tooltip' title='' data-original-title='".trim(strip_tags($value->SERTT91_OPERAD))."'></i></td>";
                else
                  echo "<td class='text-left'>".trim(strip_tags($value->SERTT91_OPERAD))."</td>";
              else
                echo "<td class='text-left'></td>";
              */            
              
              $adjuntosCompletos = $handlerUF->adjuntosCompletos($value->SERTT11_FECSER->format('Y-m-d'),$value->SERTT12_NUMEING,$value->SERTT91_CODEMPRE);
              $estaPublicado = $handlerUF->estaPublicado($value->SERTT11_FECSER->format('Y-m-d'),$value->SERTT12_NUMEING);

              if(!$estaPublicado)
              {
                //SET BOTON SEGUN ADJUNTOS              
                if($adjuntosCompletos==-1){
                  $class_boton = "";
                  $class_font = "";
                  $class_title = "";
                  $class_display = "display:none;";
                }

                if($adjuntosCompletos==0){
                  $class_boton = "btn btn-default";
                  $class_font = "fa fa-upload";
                  $class_title = "Cargar documentos adjuntos";
                  $class_display = "";
                }

                if($adjuntosCompletos==1){
                  $class_boton = "btn btn-primary";
                  $class_font = "fa fa-upload";
                  $class_title = "Agregar mas documentos adjuntos";
                  $class_display = "";
                }

                //SET BOTON SEGUN ESTADO 
                if($value->SERTT91_ESTADO>2)
                  $class_display = "";
                else
                  $class_display = "display:none;";

              }
              else{
                  $class_boton = "btn btn-success";
                  $class_font = "fa fa-archive";
                  $class_title = "Documentos adjuntos publicados";
                  $class_display = "";
              }

              echo "<td class='text-center'>
                      <a href='".$url_uploadfile."' class='".$class_boton." btn-xs' style='".$class_display."'><i class='".$class_font."' data-toggle='tooltip' data-original-title='".$class_title."'></i></a>
                    </td>
                    <td class='text-center'>
                      <a href='".$url_hist."' class='btn btn-default btn-xs'><b>Detalle</b></a>                      
                    </td>";

            echo "</tr>";
        }
      }
              
    ?>                        
  </tbody>
</table> 

<script type="text/javascript">   

  $(document).ready(function() {
    $('#tabla').DataTable({
      "dom": 'Bfrtip',
      "buttons": ['copy', 'csv', 'excel', 'print'],
      "iDisplayLength":100,
      "oSearch": {"sSearch": "<?php echo $f_dd_dni; ?>"},
      "language": {
          "sProcessing":    "Procesando...",
          "sLengthMenu":    "Mostrar _MENU_ registros",
          "sZeroRecords":   "No se encontraron resultados",
          "sEmptyTable":    "Ningún dato disponible en esta tabla",
          "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":   "",
          "sSearch":        "Buscar:",
          "sUrl":           "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst":    "Primero",
              "sLast":    "Último",
              "sNext":    "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }                                
    });
  });       
</script>
