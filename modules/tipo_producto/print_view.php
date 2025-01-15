<?php 
require_once '../../config/database.php';

// Consulta para extraer los departamentos
$query = mysqli_query($mysqli, "SELECT * FROM tipo_producto") 
    or die('Error'.mysqli_error($mysqli));

// Contar la cantidad de resultados
$count = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Deposito</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
        /* Estilos CSS para agrandar la tabla */
        table {
            width: 90%; /* Aumenta el ancho de la tabla */
            border-collapse: collapse;
            margin: 20px auto; /* Centra la tabla en la página */
            font-size: 18px; /* Aumenta el tamaño de la fuente */
            padding: 20px 20px 20px 270px;
        }
        th, td {
            padding: 15px; /* Aumenta el espacio dentro de las celdas */
            border: 1px solid #000;
            text-align: center;
        }
        thead th {
            color: black;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #d1e7ff;
        }
    </style>
</head>
<body>
   

    <div>
        <h1 style="text-align: center;">Reporte de tipo producto</h1>
    </div>
    <div align="center">
        Cantidad: <?php echo $count; ?>
    </div>

    <hr>

    <!-- Tabla para mostrar los datos de los departamentos -->
    <table>
        <thead>
            <tr>
                <th><small>Código</small></th>
                <th><small>Descripción</small></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Mostrar los datos de cada departamento en la tabla
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $data['cod_tipo_prod'] . "</td>";
                echo "<td>" . $data['t_p_descrip'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
