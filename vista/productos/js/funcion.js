    $(function(){
        $(".tabgrilla").kendoGrid({
            dataSource: {
                pageSize: 5
            },
            pageable: true,
            columns: [{field:"Codigo", width:8},
                {field:"Descripcion", width:15},
                {field:"TipoProducto", width:15},
                {field:"Stock", width:8},
                {field:"UnidadMedida", width:15},
                {field:"Ubicacion", width:10},
                {field:"Acciones", width:10}]
        });
        $( "#buscar" ).focus();
        
        function buscar(){
            $.post('/sisjungla/productos/buscador','cadena='+$("#buscar").val()+'&filtro='+$("#filtro").val(),function(datos){
                HTML = '<table border="1" class="tabgrilla">'+
                        '<tr>'+
                            '<th>Codigo</th>'+
                            '<th>Descripcion</th>'+
                            '<th>Tipo de Producto</th>'+
                            '<th>Stock</th>'+
                            '<th>Unidad de Medida</th>'+
                            '<th>Ubicacion</th>'+
                            '<th>Acciones</th>'+
                        '</tr>';

                for(var i=0;i<datos.length;i++){
                    HTML = HTML + '<tr>';
                    HTML = HTML + '<td>'+datos[i].idproducto+'</td>';
                    HTML = HTML + '<td>'+(datos[i].descripcion)+'</td>';
                    HTML = HTML + '<td>'+datos[i].tipo+'</td>';
                    HTML = HTML + '<td>'+datos[i].stock+'</td>';
                    HTML = HTML + '<td>'+datos[i].um+'</td>';
                    HTML = HTML + '<td>'+datos[i].ubicacion+'</td>';
                    var editar='/sisjungla/productos/editar/'+datos[i].idproducto; 
                    var eliminar='/sisjungla/productos/eliminar/'+datos[i].idproducto;   
                    HTML = HTML + '<td> <a href="javascript:void(0)" onclick="editar(\''+editar+'\')" class="imgedit"></a>';
                    HTML = HTML + '<a href="javascript:void(0)" onclick="eliminar(\''+eliminar+'\')" class="imgdelete"></a>';
                    HTML = HTML + '<a href="javascript:void(0)" class="imgview"></a>';
                    HTML = HTML + '</td>';
                    HTML = HTML + '</tr>';
                }
                HTML = HTML + '</table>'
                $("#grilla").html(HTML);
                $(".tabgrilla").kendoGrid({
                    dataSource: {
                        pageSize: 5
                    },
                    pageable: true,
                    columns: [{field:"Codigo", width:8},
                        {field:"Descripcion", width:15},
                        {field:"TipoProducto", width:15},
                        {field:"Stock", width:8},
                        {field:"UnidadMedida", width:15},
                        {field:"Ubicacion", width:10},
                        {field:"Acciones", width:10}]
                });
            },'json');
        }
        $("#buscar").keypress(function(event){
           if(event.which == 13){
               buscar();
           } 
        });
        
        $("#btn_buscar").click(function(){
            buscar();
            $("#buscar").focus();
        });
        
    });