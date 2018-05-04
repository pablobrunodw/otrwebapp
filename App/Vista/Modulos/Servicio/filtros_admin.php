<?php
  //$arrCliente = $handler->selectAllEmpresaFiltro(null,null,null,null,null);
  //$arrGerente = $handler->selectAllGerenteFiltro(null,null,null,null,null);
  //$arrCoordinador = $handler->selectAllCoordinadorFiltro(null,null,null,null,null);
  //$arrGestor = $handler->selectAllGestorFiltro(null,null,null,null,null);  
  //$arrOperador = $handler->selectAllOperadorFiltro(null,null,null,null,null);
  //$arrEquipoVenta = $handler->selectAllEquipoVenta(null,null,null,null,null);

  $arrCliente = $handler->selectAllEmpresa();
  $arrGerente = $handler->selectAllGerente();
  $arrCoordinador = $handler->selectAllCoordinador($fgerente);
  $arrGestor = $handler->selectAllGestor($fcoordinador);    
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

<div class="col-md-3">
  <label>Gerente </label>                
  <select id="slt_gerente" class="form-control" style="width: 100%" name="slt_gerente" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrGerente))
      {                        
        foreach ($arrGerente as $key => $value) {                                                  
          if($fgerente==$value->SERTT91_GTEALIAS)
            echo "<option value='".trim($value->SERTT91_GTEALIAS)."' selected>".$value->SERTT91_GTEALIAS."</option>";
          else
            echo "<option value='".trim($value->SERTT91_GTEALIAS)."'>".$value->SERTT91_GTEALIAS."</option>";
        }
      }                      
    ?>
  </select>
</div>

<div class="col-md-3">
  <label>Coordinador </label>                
  <select id="slt_coordinador" class="form-control" style="width: 100%" name="slt_coordinador" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrCoordinador))
      {                        
        foreach ($arrCoordinador as $key => $value) {                                                  
          if($fcoordinador==$value->SERTT91_COOALIAS)
            echo "<option value='".trim($value->SERTT91_COOALIAS)."' selected>".$value->SERTT91_COOALIAS."</option>";
          else
            echo "<option value='".trim($value->SERTT91_COOALIAS)."'>".$value->SERTT91_COOALIAS."</option>";
        }
      }                      
    ?>
  </select>
</div>

<div class="col-md-3">
  <label>Gestor </label>                
  <select id="slt_gestor" class="form-control" style="width: 100%" name="slt_gestor" onchange="crearHref()">                              
    <option value=''></option>
    <option value='0'>TODOS</option>
    <?php
      if(!empty($arrGestor))
      {                        
        foreach ($arrGestor as $key => $value) {                                                  
          if($fgestor==$value->GESTOR11_CODIGO)
            echo "<option value='".trim($value->GESTOR11_CODIGO)."' selected>".$value->GESTOR21_ALIAS."</option>";
          else
            echo "<option value='".trim($value->GESTOR11_CODIGO)."'>".$value->GESTOR21_ALIAS."</option>";
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