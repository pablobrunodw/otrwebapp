<?php
  //$arrCliente = $handler->selectAllEmpresaFiltro(null,null,null,null,null);

  //$arrCoordinador = $handler->selectAllPlazasFiltro();
  $arrCoordinador = $handler->selectAllPlazasArray();

  //$arrGestor = $handler->selectAllGestorFiltro(null,null,null,null,null);
  //$arrGerente = $handler->selectAllGerenteFiltro(null,null,null,null,null);
  //$arrOperador = $handler->selectAllOperadorFiltro(null,null,null,null,null);
  //$arrEquipoVenta = $handler->selectAllEquipoVenta(null,null,null,null,null);
?>

<div class='col-md-12 callout callout-warning'><b><i>Solo se filtraran aquellos servicios que posean toda su documentacion adjunta</i></b></div>

<div class="col-md-3" id='sandbox-container'>
  <label>Fecha Desde - Hasta </label>                
  <div class="input-daterange input-group" id="datepicker">
      <input type="text" class="input-sm form-control" onchange="crearHref()" id="start" name="start" value="<?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y'); ?>"/>
      <span class="input-group-addon">a</span>
      <input type="text" class="input-sm form-control" onchange="crearHref()" id="end" name="end" value="<?php echo $dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?>"/>
  </div>  
</div>

<div class="col-md-3">
  <label>Estados </label>                
  <select id="slt_estados" class="form-control" style="width: 100%" name="slt_estados" onchange="crearHref()">                    
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrEstados))
      {                        
        foreach ($arrEstados as $key => $value) {                                                  
          if($festado==$value[0])
            echo "<option value='".$value[0]."' selected>".$value[1]."</option>";
          else
            echo "<option value='".$value[0]."'>".$value[1]."</option>";
        }
      }                      
    ?>
  </select>
</div>

<div class="col-md-4">
  <label>Plazas </label>                
  <select id="slt_coordinador" class="form-control" style="width: 100%" name="slt_coordinador" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrCoordinador))
      {                        
        foreach ($arrCoordinador as $key => $value) {                                                  
          if($fcoordinador==$value['ALIAS'])
            echo "<option value='".trim($value['ALIAS'])."' selected>".$value['PLAZA']."</option>";
          else
            echo "<option value='".trim($value['ALIAS'])."'>".$value['PLAZA']."</option>";
        }
      }                      
    ?>
  </select>
</div>

<div class="col-md-3" style="display: none;">
  <label>Equipo de Ventas </label>                
  <select id="slt_equipoventa" class="form-control" style="width: 100%" name="slt_equipoventa" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrEquipoVenta))
      {                        
        foreach ($arrEquipoVenta as $key => $value) {                                                  
          if($fequipoventa==$value->TEPE91_EQUIPVTA)
            echo "<option value='".trim($value->TEPE91_EQUIPVTA)."' selected>".$value->TEPE91_EQUIPVTA."</option>";
          else
            echo "<option value='".trim($value->TEPE91_EQUIPVTA)."'>".$value->TEPE91_EQUIPVTA."</option>";
        }
      }                      
    ?>
  </select>
</div>

<div class='col-md-2'>   
  <a class="btn btn-block btn-xs btn-default" id="filtro_reporte" onclick="crearHref()"  style='margin-top: 30px;'>Todos</a>
</div>