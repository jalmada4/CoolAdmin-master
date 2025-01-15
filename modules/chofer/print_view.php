<?php 
require_once "../../config/database.php";

// Consulta para obtener los datos de los choferes
$query = mysqli_query($mysqli, "SELECT * FROM chofer")
    or die('Error'.mysqli_error($mysqli));

// Obtener el número de registros de choferes
$count = mysqli_num_rows($query);    
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Choferes</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
        <style>
            /* Estilos para hacer la tabla más pequeña */
            table {
                width: 90%; /* Ajustar el ancho de la tabla */
                margin: 20px auto; /* Centrar la tabla */
                border-collapse: collapse; /* Eliminar los espacios entre celdas */
            }
            th, td {
                padding: 5px 10px; /* Reducir el padding */
                text-align: left; /* Alinear el texto a la izquierda */
                font-size: 12px; /* Reducir el tamaño de la fuente */
            }
            th {
                background-color: #e8ecee; /* Fondo gris para los encabezados */
                font-weight: bold; /* Hacer los encabezados en negrita */
            }
            tr:nth-child(even) {
                background-color: #f2f2f2; /* Color de fondo alterno para las filas */
            }
            tr:hover {
                background-color: #ddd; /* Resaltar filas al pasar el mouse */
            }
            img {
                width: 400px; /* Tamaño fijo de la imagen */
            }
        </style>
    </head>
    <body>
        <div align="center">
            <img src="../../images/comercial.png">
        </div>
        <div>
            Reporte de Choferes
        </div>
        <div align="center">
            Cantidad: <?php echo $count; ?>
        </div>
        <hr>
        <div id="tabla">
        <table border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead>
                    <tr class="table-title">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Licencia</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Recorrer los resultados de la consulta y mostrarlos en la tabla
                    while ($data = mysqli_fetch_assoc($query)){
                        $id_chofer = $data['id_chofer'];
                        $chof_nombre = $data['chof_nombre'];
                        $chof_apellido = $data['chof_apellido'];
                        $chof_cedula = $data['chof_cedula'];
                        $chof_telefono = $data['chof_telefono'];
                        $licencia = $data['licencia'];
                        $estado = $data['estado'];

                        echo "<tr>
                        <td>$id_chofer</td>
                        <td>$chof_nombre</td>
                        <td>$chof_apellido</td>
                        <td>$chof_cedula</td>
                        <td>$chof_telefono</td>
                        <td>$licencia</td>
                        <td>$estado</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
