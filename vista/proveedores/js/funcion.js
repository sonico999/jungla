    $(function(){
        $(".tabgrilla").kendoGrid({
                    dataSource: {
                        pageSize: 5
                    },
                    pageable: true,
                    columns: [{field:"Codigo", width:6},
                        {field:"RazonSocial", width:10},
                        {field:"Representante", width:10},
                        {field:"RUC", width:10},
                        {field:"Direccion", width:10},
                        {field:"Telefono", width:10},
                        {field:"Email", width:10},
                        {field:"Acciones", width:8}]
                });
        $( "#buscar" ).focus();
        
        function buscar(){
            $.post('/sisjungla/proveedores/buscador','cadena='+$("#buscar").val()+'&filtro='+$("#filtro").val(),function(datos){
                HTML = '<table border="1" class="tabgrilla">'+
                        '<tr>'+
                            '<th>Codigo</th>'+
                            '<th>Razon Social</th>'+
                            '<th>Representante</th>'+
                            '<th>RUC</th>'+
                            '<th>Direccion</th>'+
                            '<th>Telefono</th>'+
                            '<th>Email</th>'+
                            '<th>Acciones</th>'+
                        '</tr>';

                for(var i=0;i<datos.length;i++){
                    HTML = HTML + '<tr>';
                    HTML = HTML + '<td>'+datos[i].idproveedor+'</td>';
                    HTML = HTML + '<td>'+datos[i].razon_social+'</td>';
                    HTML = HTML + '<td>'+datos[i].representante+'</td>';
                    HTML = HTML + '<td>'+datos[i].ruc+'</td>';
                    HTML = HTML + '<td>'+datos[i].direccion+'</td>';
                    HTML = HTML + '<td>'+datos[i].telefono+'</td>';
                    HTML = HTML + '<td>'+datos[i].email+'</td>';
                    var editar='/sisjungla/proveedores/editar/'+datos[i].idproveedor; 
                    var eliminar='/sisjungla/proveedores/eliminar/'+datos[i].idproveedor;   
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
                    columns: [{field:"Codigo", width:6},
                        {field:"RazonSocial", width:10},
                        {field:"Representante", width:10},
                        {field:"RUC", width:10},
                        {field:"Direccion", width:10},
                        {field:"Telefono", width:10},
                        {field:"Email", width:10},
                        {field:"Acciones", width:8}]
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