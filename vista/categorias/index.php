<script type="text/javascript">
    $(function(){
        $( "#buscar" ).focus();
        
        $( "#btn_buscar" ).click(function(){
            $.post('/sisjungla/categorias/buscador','descripcion='+$("#buscar").val()+'&filtro='+$("#filtro").val(),function(datos){
                HTML = '<table border="1" class="tabgrilla">'+
                        '<tr>'+
                            '<th>Codigo</th>'+
                            '<th>Descripcion</th>'+
                            '<th>Nro.de Elemento</th>'+
                            '<th>Acciones</th>'+
                        '</tr>';

                for(var i=0;i<datos.length;i++){
                    HTML = HTML + '<tr>';
                    HTML = HTML + '<td>'+datos[i].idcategoria+'</td>';
                    HTML = HTML + '<td>'+datos[i].descripcion+'</td>';
                    HTML = HTML + '<td>'+datos[i].nro_elemento+'</td>';
                    var editar='/sisjungla/categorias/editar/'+datos[i].idcategoria; 
                    var eliminar='/sisjungla/categorias/eliminar/'+datos[i].idcategoria;   
                    HTML = HTML + '<td> <a href="javascript:void(0)" onclick="editar(\''+editar+'\')"><img src="/sisjungla/lib/img/edit.png" class="imgfrm" /></a>';
                    HTML = HTML + '<a href="javascript:void(0)" onclick="eliminar(\''+eliminar+'\')"><img src="/sisjungla/lib/img/delete.png" class="imgfrm" /></a>';
                    HTML = HTML + '</td>';
                    HTML = HTML + '</tr>';
                }
                HTML = HTML + '</table>'
                $("#grilla").html(HTML);
                $(".tabgrilla").kendoGrid({
                    dataSource: {
                        pageSize: 5
                    },
                    pageable: true
                });
            },'json');
        });
        
    });
</script>
<?php if (isset($this->datos) && count($this->datos)) { ?>
<h3>Lista de Categorias</h3>
    <p>
        <select class="combo" id="filtro">
            <option value="0">Descripcion</option>
        </select>
        <input type="text" class="k-textbox" style="width: 50%" id="buscar">
        <button type="button" class="k-button" id="btn_buscar">Buscar</button>
        <a href="<?php echo BASE_URL?>categorias/nuevo" class="k-button">Nuevo</a>
    </p>
    <div id="grilla">
<table border="1" class="tabgrilla">
    <tr>
        <th><label>Codigo</label></th>
        <th><label>Descripcion</label></th>
        <th><label>Nro.de Elemento</label></th>
        <th><label>Acciones</label></th>
    </tr>
<?php for ($i = 0; $i < count($this->datos); $i++) { ?>
        <tr>
            <td class="tabtr"><?php echo $this->datos[$i]['idcategoria'] ?></td>
            <td><?php echo $this->datos[$i]['descripcion'] ?></td>
            <td><?php echo $this->datos[$i]['nro_elemento'] ?></td>
            <td class="tabtr" align="center">
            <a href="javascript:void(0)" onclick="editar('<?php echo BASE_URL?>categorias/editar/<?php echo $this->datos[$i]['idcategoria'] ?>')">
            <img src="<?php echo BASE_URL?>lib/img/edit.png" class="imgfrm" /></a>
            <a href="javascript:void(0)" onclick="eliminar('<?php echo BASE_URL?>categorias/eliminar/<?php echo $this->datos[$i]['idcategoria'] ?>')">
            <img src="<?php echo BASE_URL?>lib/img/delete.png" class="imgfrm" /></a></td>
        </tr>
    <?php } ?>

<?php } else { ?>
    <tr>
        <td><p>No hay categorias</p>
        <a href="<?php echo BASE_URL?>categorias/nuevo" class="k-button">Nuevo</a></td>
        </tr>
    <?php } ?>
</table>
    </div>