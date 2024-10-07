<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
</head>
<body>
<button class="eliminar btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertar">Insertar</button>
    <table class="table table-striped table-bordered text-center" id="tblUsers">
    <thead>
        <tr>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            //*
            $url = "http://localhost:8080/projec-1/webresources/uta.edu.ec.projec.personas";
            $json = file_get_contents($url);
            $datos = json_decode($json, true);
            $btnEdit = '<button class="actualizar btn btn-primary">Actualizar</button> ';
            $btnDelete = '<button class="eliminar btn btn-danger">Eliminar</button>';
            $html = "";
            foreach($datos as $dato){
                $html .= "<tr>".
                            "<td>".$dato['cedula']."</td>".
                            "<td>".$dato['nombre']."</td>".
                            "<td>".$dato['apellido']."</td>".
                            "<td>".$dato['edad']."</td>".
                            "<td>".$btnEdit.$btnDelete."</td>".
                        "</tr>";
            }
            echo $html;
            //*/
        ?>
    </tbody>
    </table>

    <div class="fade modal" tabindex="-1" id="insertar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Insertar</h5>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="ingresarP">
                        <input type="text" name="cedula" id="cedulaI" placeholder="Cédula">
                        <input type="text" name="nombre" id="nombreI" placeholder="Nombre">
                        <input type="text" name="apellido" id="apellidoI" placeholder="Apelllido">
                        <input type="text" name="edad" id="edadI" placeholder="Edad">            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Insertar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="fade modal" tabindex="-1" id="editar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar</h5>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editarP">
                        <input type="text" name="cedula" id="cedulaE" placeholder="Cédula">
                        <input type="text" name="nombre" id="nombreE" placeholder="Nombre">
                        <input type="text" name="apellido" id="apellidoE" placeholder="Apelllido">
                        <input type="text" name="edad" id="edadE" placeholder="Edad">            
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#ingresarP').submit(function(){
                $.ajax({
                    url: "http://localhost:8080/projec-1/webresources/uta.edu.ec.projec.personas",
                    type: "POST",
                    data: JSON.stringify({
                        "cedula":$("#cedulaI").val(),
                        "nombre":$("#nombreI").val(),
                        "apellido":$("#apellidoI").val(),
                        "edad":$("#edadI").val()
                    }),
                    contentType:"application/json",
                    success:function(){
                        alert("Insertado correctamente");
                        location.reload();
                    },
                    error:function(data){
                        alert(data);
                    }
                });
            });

            $('.eliminar').click(function(){
                fila = $(this).closest("tr");
                cedula = fila.find('td:eq(0)').text();
                $.ajax({
                    url: "http://localhost:8080/projec-1/webresources/uta.edu.ec.projec.personas/" + cedula,
                    type: "DELETE",
                    success:function(){
                        alert("Eliminado correctamente");
                        location.reload();
                    }
                })
            });

            $(".actualizar").click(function(){
                cedula = $(this).parents("tr").find("td")[0].innerHTML;
                nombre = $(this).parents("tr").find("td")[1].innerHTML;
                apellido = $(this).parents("tr").find("td")[2].innerHTML;
                edad = $(this).parents("tr").find("td")[3].innerHTML;
                $("#cedulaE").val(cedula);
                $("#nombreE").val(nombre);
                $("#apellidoE").val(apellido);
                $("#edadE").val(edad);
                $("#editar").modal("show");
            });

            $('#editarP').submit(function(){
                $.ajax({
                    url: "http://localhost:8080/projec-1/webresources/uta.edu.ec.projec.personas/" + $("#cedulaE").val(),
                    type: "PUT",
                    data: JSON.stringify({
                        "cedula":$("#cedulaE").val(),
                        "nombre":$("#nombreE").val(),
                        "apellido":$("#apellidoE").val(),
                        "edad":$("#edadE").val()
                    }),
                    contentType:"application/json",
                    success:function(){
                        alert("Actualizado correctamente");
                        location.reload();
                    },
                    error:function(data){
                        alert(data);
                    }
                });
            });
        });
    </script>
</body>
</html>