<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
    <link rel="stylesheet" type="text/css" href="../jquery/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../jquery/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../jquery/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../jquery/demo/demo.css">
    <script type="text/javascript" src="../jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Basic CRUD Application</h2>
    <p>Click the buttons on datagrid toolbar to do crud actions.</p>
    
    <table id="dg" title="My Users" class="easyui-datagrid" style="width:700px;height:250px"
            url="http://localhost/SOA/controllers/apiRest.php" method='GET'
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="cedula" width="50">Cedula</th>
                <th field="nombre" width="50">Nombre</th>
                <th field="apellido" width="50">Apellido</th>
                <th field="direccion" width="50">Direccion</th>
                <th field="telefono" width="50">Telefono</th>
            </tr>
        </thead>
    </table>

    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
        <input id="searchBox" class="easyui-textbox" style="width:200px" prompt="Buscar por cedula">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="searchUser()">Buscar</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Estudiante</h3>
            <div style="margin-bottom:10px">
                <input name="cedula" class="easyui-textbox" required="true" label="Cedula" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="apellido" class="easyui-textbox" required="true" label="Apellido:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="direccion" class="easyui-textbox" required="true" label="Direccion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="telefono" class="easyui-textbox" required="true" label="Telefono:" style="width:100%">
            </div>
        </form>
    </div>
    
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <script type="text/javascript">
        var url;
        function newUser(){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','New User');
            $('#fm').form('clear');
            url = 'http://localhost/SOA/controllers/apiRest.php';//inicializando la URL
        }
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
                $('#fm').form('load',row);
                url = 'http://localhost/SOA/controllers/apiRest.php?cedula='+row.cedula;
            }
        }
        function saveUser() {
            var method = url.includes('?cedula=') ? 'PUT' : 'POST'; // Determina si es PUT o POST
            var data = $('#fm').serializeArray(); // Recoge los datos del formulario

            var userData = {};
            $.each(data, function(i, field) {
                userData[field.name] = field.value;
            });

            // Configuración de la solicitud dependiendo del método
            var ajaxOptions = {
                url: url,
                type: method,
                success: function(result) {
                    try {
                        result = JSON.parse(result);
                        if (result.errorMsg) {
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                            $('#dlg').dialog('close'); // Cierra el diálogo
                            $('#dg').datagrid('reload'); // Recarga los datos del usuario
                        }
                    } catch (e) {
                        console.error("Respuesta inesperada del servidor:", result);
                        $.messager.show({
                            title: 'Error',
                            msg: 'Respuesta no válida del servidor'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al guardar usuario:', error);
                }
            };

            // Si es PUT, envía los datos como JSON
            if (method === 'PUT') {
                ajaxOptions.contentType = "application/json";
                ajaxOptions.data = JSON.stringify(userData);
            } else {
                // Si es POST, envía los datos como formulario
                ajaxOptions.data = userData;
            }

            // Realiza la solicitud Ajax
            $.ajax(ajaxOptions);
        }
        function destroyUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $.messager.confirm('Confirm', 'Are you sure you want to destroy this user?', function(r) {
                    if (r) {
                        $.ajax({
                            url: 'http://localhost/SOA/controllers/apiRest.php?' + $.param({
                                cedula: row.cedula
                            }),
                            type: 'DELETE',
                            dataType: 'json',
                            success: function() {
                                $('#dg').datagrid('reload'); // reload the user data
                            },
                            error: function(result) {
                                $.messager.show({ // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                                $('#dg').datagrid('reload'); // reload the user data
                            }
                        });
                    }
                });
            }
        }

        function searchUser() {
    var cedula = $('#searchBox').val(); // Obtener valor del campo de búsqueda

    // Construir la URL de búsqueda
    var url = cedula ? 'http://localhost/SOA/controllers/apiRest.php?cedula=' + cedula : 'http://localhost/SOA/controllers/apiRest.php';

    $('#dg').datagrid({
        url: url,
        method: 'GET',
        onLoadSuccess: function(data) {
            if (data.total === 0) {  // Verificar el total en la respuesta
                $.messager.alert('Aviso', 'Estudiante no encontrado', 'info');
            }
        },
        onLoadError: function() {
            $.messager.show({
                title: 'Error',
                msg: 'Error al cargar los datos de búsqueda.'
            });
        }
    });
}


    </script>
</body>
</html>