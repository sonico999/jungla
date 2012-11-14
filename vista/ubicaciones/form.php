<form method="post" action="<?php if(isset ($this->action))echo $this->action ?>" id="frm">
    <input type="hidden" name="guardar" id="guardar" value="1"/>
    <table width="50%" align="center">
        <caption><h3><?php echo $this->titulo ?></h3></caption>
        <tr>
            <td><label>Codigo:</label></td>
            <td><input type="text" class="k-textbox" readonly="readonly" name="codigo" id="codigo"
                       value="<?php if(isset ($this->datos[0]['idubicacion']))echo $this->datos[0]['idubicacion']?>"/></td>
        </tr>
        <tr>
            <td><label>Descripcion:</label></td>
            <td><input type="text" class="k-textbox" placeholder="Ingrese ubicacion" required name="descripcion"
                       id="descripcion" value="<?php if(isset ($this->datos[0]['descripcion']))echo $this->datos[0]['descripcion']?>"/></td>
        </tr>
        <tr>
            <td><label for="almacen">Almacen:</label></td>
            <td>
                <select class="combo" placeholder="Seleccione..." required name="almacen" id="almacen">
                    <option></option>
                    <?php for($i=0;$i<count($this->datosAlmacen);$i++){ ?>
                        <?php if( $this->datos[0]['idalmacen'] == $this->datosAlmacen[$i]['idalmacen'] ){ ?>
                    <option value="<?php echo $this->datosAlmacen[$i]['idalmacen'] ?>" selected="selected"><?php echo $this->datosAlmacen[$i]['descripcion'] ?></option>
                        <?php } else { ?>
                    <option value="<?php echo $this->datosAlmacen[$i]['idalmacen'] ?>"><?php echo $this->datosAlmacen[$i]['descripcion'] ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <span class="k-invalid-msg" data-for="almacen"></span>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <p><button type="submit" class="k-button" id="saveform">Guardar</button>
                <a href="<?php echo BASE_URL ?>ubicaciones" class="k-button cancel">Cancelar</a></p>
            </td>
        </tr>
    </table>
</form>