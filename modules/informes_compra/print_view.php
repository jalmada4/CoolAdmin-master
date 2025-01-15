<?php
require_once "../../config/database.php"; // Asegúrate de que esta ruta sea correcta

// Recibir los parámetros de fecha
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

// Construir la cláusula WHERE para el filtro de fechas
$where_clause = "`compra`.`estado` = 'activo'";
if (!empty($start_date) && !empty($end_date)) {
    $where_clause .= " AND `compra`.`fecha` BETWEEN '$start_date' AND '$end_date'";
}

// Obtener los datos de la base de datos
$query = mysqli_query($mysqli, "SELECT 
    `proveedor`.`razon_social`, 
    `deposito`.`descrip`, 
    `compra`.`cod_compra`, 
    `compra`.`nro_factura`, 
    `compra`.`fecha`, 
    `compra`.`hora`, 
    `compra`.`total_compra`
FROM 
    `proveedor`
INNER JOIN 
    `compra` ON `proveedor`.`cod_proveedor` = `compra`.`cod_proveedor`
INNER JOIN 
    `deposito` ON `compra`.`cod_deposito` = `deposito`.`cod_deposito`
WHERE 
    $where_clause;")
or die('Error: '.mysqli_error($mysqli));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .title {
            text-align: center;
            margin-top: 20px;
        }
        .print-btn {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="title">Informe de Compras</h1>
    <?php if (!empty($start_date) && !empty($end_date)) { ?>
        <p class="title">Período: <?php echo date('d-m-Y', strtotime($start_date)); ?> a <?php echo date('d-m-Y', strtotime($end_date)); ?></p>
    <?php } ?>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Proveedor</th>
                <th>Depósito</th>
                <th>N° Factura</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>
                    <td>{$data['cod_compra']}</td>
                    <td>{$data['razon_social']}</td>
                    <td>{$data['descrip']}</td>
                    <td>{$data['nro_factura']}</td>
                    <td>" . date('d-m-Y', strtotime($data['fecha'])) . "</td>
                    <td>{$data['hora']}</td>
                    <td>{$data['total_compra']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="print-btn">
        <button onclick="window.print()">Imprimir</button>
    </div>
</body>
</html>
