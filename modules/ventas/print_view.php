<?php
require_once "../../config/database.php";

if (isset($_GET['act']) && $_GET['act'] == 'imprimir') {
    if (isset($_GET['cod_venta'])) {
        $codigo = $_GET['cod_venta'];

        // Consulta la cabecera de la venta
        $cabecera_venta = mysqli_query($mysqli, "SELECT * FROM v_ventas WHERE cod_venta = $codigo");
        if (!$cabecera_venta) {
            die('Error al consultar la cabecera: ' . mysqli_error($mysqli));
        }

        // Validar si existen datos
        if ($data = mysqli_fetch_assoc($cabecera_venta)) {
            $cli_nombre = $data['clientes'];
            $nro_factura = $data['nro_factura'];
            $fecha = $data['fecha'];
            $hora = $data['hora'];
            $total_venta = $data['total_venta'];

            // Formatear el número de factura
            $numero_factura = str_pad($nro_factura, 6, '0', STR_PAD_LEFT);
            $nro_factura_formateado = "$sucursal-$punto_expedicion-$numero_factura";
        } else {
            die("No se encontró la venta con código: $codigo");
        }

        // Consulta el detalle de la venta
        $detalle_venta = mysqli_query($mysqli, "SELECT * FROM v_detalle_venta WHERE cod_venta = $codigo");
        if (!$detalle_venta) {
            die('Error al consultar el detalle: ' . mysqli_error($mysqli));
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura de Venta</title>
    <style>
        table {
            
            border-collapse: collapse;
            width: 80%;
            margin: 5px auto;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: skyblue;
        }

        h1 {
            text-align: center;
            text-decoration: underline;
        }

        .total {
            font-weight: bold;
        }
        
    </style>
</head>

<body>
    <div align='center'>
        <h4 style="text-align: center;">Registro de Factura de Venta</h4>
        <label style="text-align: center;"><strong>Cliente:</strong> <?php echo $cli_nombre ?? ''; ?></label><br>
        <label style="text-align: center;"><strong>N° de Factura:</strong> <?php echo $nro_factura_formateado ?? ''; ?></label><br>
        <label style="text-align: center;"><strong>Fecha:</strong> <?php echo $fecha ?? ''; ?></label><br>
        <label style="text-align: center;"><strong>Hora:</strong> <?php echo $hora ?? ''; ?></label><br>
    </div>
    <hr>
    <div>
        <table align="center">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Deposito</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($detalle_venta)) {
                    while ($row = mysqli_fetch_assoc($detalle_venta)) {
                        echo "<tr>
                                <td>{$row['producto']}</td>
                                <td>{$row['deposito']}</td>
                                <td>" . number_format($row['precio_unitario'], 0, ',', '.') . "</td>
                                <td>{$row['cantidad']}</td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="total" style="text-align: right;">
        <p>El Total es: Gs. <?php echo isset($total_venta) ? number_format($total_venta, 0, ',', '.') : ''; ?></p>
    </div>
    <hr>
</body>

</html>