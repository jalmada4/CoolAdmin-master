<?php
require_once "../../config/database.php";

// Validar si se recibe el parámetro 'id_nota_remis'
if (isset($_GET['id_nota_remis']) && is_numeric($_GET['id_nota_remis'])) {
    $id_nota_remis = $_GET['id_nota_remis'];

    // Consulta para obtener los datos de la nota de remisión seleccionada
    $stmt = $mysqli->prepare("
        SELECT 
            nr.id_nota_remis, 
            nr.cod_venta, 
            v.nro_factura, 
            u.name_user, 
            m.nro_chapa, 
            c.chof_nombre, 
            c.chof_apellido, 
            nr.fecha, 
            nr.estado, 
            nr.hora,
            cli.cli_nombre, 
            cli.cli_apellido, 
            nr.destino
        FROM 
            nota_remision nr
        LEFT JOIN venta v ON nr.cod_venta = v.cod_venta
        LEFT JOIN usuarios u ON nr.id_user = u.id_user
        LEFT JOIN movil m ON nr.id_movil = m.id_movil
        LEFT JOIN chofer c ON nr.id_chofer = c.id_chofer
        LEFT JOIN clientes cli ON nr.id_cliente = cli.id_cliente
        WHERE nr.id_nota_remis = ?
    ");
    $stmt->bind_param("i", $id_nota_remis);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Error: No se encontró el registro con ID $id_nota_remis.");
    }

    // Consulta el detalle de la venta
    $stmtDetalle = $mysqli->prepare("
        SELECT 
            id_nota_remis, 
            p_descrip, 
            cantidad 
        FROM 
            v_det_nota_remision 
        WHERE 
            id_nota_remis = ?
    ");
    $stmtDetalle->bind_param("i", $id_nota_remis);
    $stmtDetalle->execute();
    $detalle_venta = $stmtDetalle->get_result();
} else {
    die("Error: Parámetro 'id_nota_remis' no proporcionado o no válido.");
}
?>

<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Nota de Remisión</title>
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #e8ecee;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            width: 400px;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div align="center">
        <img src="../../images/comercial.png" alt="Logo">
    </div>
    <div align="center">
        <h3>Reporte de Nota de Remisión</h3>
    </div>
    <hr>
    <table align="center">
        <thead>
            <tr>
                <th>ID Nota Remisión</th>
                <th>Código Venta</th>
                <th>Número de Factura</th>
                <th>Usuario</th>
                <th>Móvil</th>
                <th>Chofer</th>
                <th>Cliente</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center"><?php echo htmlspecialchars($data['id_nota_remis']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['cod_venta']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['nro_factura']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['name_user']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['nro_chapa']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['chof_nombre'] . " " . $data['chof_apellido']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['cli_nombre'] . " " . $data['cli_apellido']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['destino']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['fecha']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['estado']); ?></td>
                <td class="center"><?php echo htmlspecialchars($data['hora']); ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <div>
        <table align="center">
            <thead>
                <tr>
                    <th>ID:</th>
                    <th>Producto:</th>
                    <th>Cantidad:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($detalle_venta->num_rows > 0) {
                    while ($row = $detalle_venta->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id_nota_remis']) . "</td>
                                <td>" . htmlspecialchars($row['p_descrip']) . "</td>
                                <td>" . htmlspecialchars($row['cantidad']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron detalles para esta nota de remisión.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <br><br>
    <div>Recibió: <?php echo htmlspecialchars($data['cli_nombre'] . " " . $data['cli_apellido']); ?> </div>
    <br><br>
    <div>Firma:_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div>
</body>
</html>
