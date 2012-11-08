<form method="post" action="<?php if(isset ($this->action))echo $this->action ?>" id="frm" >
    <input type="hidden" name="guardar" id="guardar" value="1"/>
    <table width="50%" align="center" class="tabForm">
        <caption><h3><?php echo $this->titulo ?></h3></caption>
        <tr>
            <td><label>Codigo:</label></td>
            <td><input type="text" class="k-textbox" readonly="readonly" name="codigo" id="codigo"
                       value="<?php if(isset ($this->datos[0]['idpromocion']))echo $this->datos[0]['idpromocion']?>"/></td>
        </tr>
        <tr>
            <td><label>Descripcion:</label></td>
            <td><input type="text" class="k-textbox" placeholder="Ingrese promocion" required name="descripcion" onkeypress="return soloLetras(event)"
                       id="descripcion" value="<?php if(isset ($this->datos[0]['descripcion']))echo $this->datos[0]['descripcion']?>" /></td>
        </tr>
        <tr>
            <td><label>Descuento:</label></td>
            <td><input type="text" class="k-textbox" placeholder="Ingrese descuento" required name="descuento" onkeypress="return dosDecimales(event, this)"
                       id="descuento" value="<?php if(isset ($this->datos[0]['descuento']))echo $this->datos[0]['descuento']?>" /></td>
        </tr>
        <tr>
            <td><label>Fecha de Inicio:</label></td>
            <td><input class="datepicker" readonly="readonly" placeholder="Seleccione fecha" required name="fecha_inicio"
                       id="fechaini" value="<?php if(isset ($this->datos[0]['fecha_inicio'])){
                               $fecha=$this->datos[0]['fecha_inicio'];
                               echo substr($fecha,8,2).'-'.substr($fecha,5,2).'-'.substr($fecha,0,4);}?>"/></td>
        </tr>
        <tr>
            <td><label>Fecha de Finalizacion:</label></td>
            <td><input class="datepicker" readonly="readonly" placeholder="Seleccione fecha" required name="fecha_final"
                       id="fechafin" value="<?php if(isset ($this->datos[0]['fecha_final'])){
                               $fecha=$this->datos[0]['fecha_final'];
                               echo substr($fecha,8,2).'-'.substr($fecha,5,2).'-'.substr($fecha,0,4);}?>"/></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <p><button type="submit" class="k-button save" id="saveform">Guardar</button>
                <a href="<?php echo BASE_URL ?>promociones" class="k-button">Cancelar</a></p>
            </td>
        </tr>
    </table>
</form>