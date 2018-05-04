<?php
  //$arrCliente = $handler->selectAllEmpresaFiltro(null,$user->getUserSistema(),null,null,null);
  //$arrCoordinador = $handler->selectAllCoordinadorFiltro(null,null,null,null,null);
  //$arrGestor = $handler->selectAllGestorFiltro(null,null,null,null,null);
  //$arrGerente = $handler->selectAllGerenteFiltro(null,null,null,null,null);
  //$arrOperador = $handler->selectAllOperadorFiltro(null,$user->getUserSistema(),null,null,null);
  //$arrEquipoVenta = $handler->selectAllEquipoVenta(null,null,null,null,null);

  $arrCliente = $handler->selectAllEmpresa();
  //$arrCoordinador = $handler->selectAllCoordinadorFiltro(null,null,null,null,null);
  //$arrGestor = $handler->selectAllGestorFiltro(null,null,null,null,null);
  //$arrGerente = $handler->selectAllGerenteFiltro(null,null,null,null,null);
  //$arrOperador = $handler->selectAllOperadorFiltro(null,$user->getUserSistema(),null,null,null);
  //$arrEquipoVenta = $handler->selectAllEquipoVenta(null,null,null,null,null);
?>

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

<div class="col-md-6">
  <label>Clientes </label>                
  <select id="slt_cliente" class="form-control" style="width: 100%" name="slt_cliente" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrCliente))
      {                        
        foreach ($arrCliente as $key => $value) {                                                  
          if($fcliente==$value->EMPTT11_CODIGO)
            echo "<option value='".trim($value->EMPTT11_CODIGO)."' selected>".$value->EMPTT21_NOMBREFA."</option>";
          else
            echo "<option value='".trim($value->EMPTT11_CODIGO)."'>".$value->EMPTT21_NOMBREFA."</option>";
        }
      }                      
    ?>
  </select>
</div>

<div class="col-md-3" style="display: none;">
  <label>Operador </label>                
  <select id="slt_operador" class="form-control" style="width: 100%" name="slt_operador" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrOperador))
      {                        
        foreach ($arrOperador as $key => $value) {                                                  
          if($foperador==$value->SERTT91_OPERAD)
            echo "<option value='".trim($value->SERTT91_OPERAD)."' selected>".$value->SERTT91_OPERAD."</option>";
          else
            echo "<option value='".trim($value->SERTT91_OPERAD)."'>".$value->SERTT91_OPERAD."</option>";
        }
      }                      
    ?>
  </select>
</div>