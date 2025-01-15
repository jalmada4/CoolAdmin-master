<?php
session_start();
$session_id = session_id();
require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Variables para insertar en la cabecera
    $codigo = $_POST['id_presup'] ?? null; // ID del presupuesto
    $cod_pedido = $_POST['id_pedido'] ?? null;
    $codigo_proveedor = $_POST['cod_proveedor'] ?? null;
    $fecha_presup = $_POST['fecha_presup'] ?? date('d-m-y');

    $usuario = $_SESSION['id_user'] ?? null; // Usuario de la sesión
    $total_esti = $_POST['suma_total'] ?? 0; // Total estimado
    $hora = date('H:i:s'); // Hora actual
    $estado = 1; // Estado inicial, puede ser ajustado según la lógica del negocio

    // Insertar en la tabla "presupuesto"
    $stmt = $mysqli->prepare("INSERT INTO presupuesto (id_presup, id_pedido, cod_proveedor, fecha_presup, id_user, total_esti, hora, estado) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die('Error al preparar la consulta para presupuesto: ' . $mysqli->error);
    }
    $stmt->bind_param("iissidsi", $codigo, $cod_pedido, $codigo_proveedor, $fecha_presup, $usuario, $total_esti, $hora, $estado);

    if (!$stmt->execute()) {
        die('Error al insertar la cabecera de presupuesto: ' . $stmt->error);
    }
    $stmt->close();

    // Obtener los datos de la tabla temporal
    $sql_tmp = $mysqli->query("SELECT * FROM tmp WHERE session_id = '$session_id'");
    if (!$sql_tmp) {
        die('Error al consultar la tabla temporal: ' . $mysqli->error);
    }

    // Insertar detalles en "det_presupuesto"
    while ($row = $sql_tmp->fetch_assoc()) {
        $codigo_producto = $row['id_producto'];
        $cantidad = $row['cantidad_tmp'];
        $precio = $row['precio_tmp'];

        // Verificar si los valores son válidos antes de insertar
        if ($cantidad > 0 && $precio > 0) {
            $stmt = $mysqli->prepare("INSERT INTO det_presupuesto (id_presup, cod_producto, cantidad, precio) 
                                      VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                die('Error al preparar la consulta para det_presupuesto: ' . $mysqli->error);
            }
            $stmt->bind_param("iiid", $codigo, $codigo_producto, $cantidad, $precio);

            if (!$stmt->execute()) {
                die('Error al insertar en det_presupuesto: ' . $stmt->error);
            }
            $stmt->close();
        }
    }

    // Limpiar la tabla temporal después de procesar los datos
    $mysqli->query("DELETE FROM tmp WHERE session_id = '$session_id'");

     // Redireccionar según el resultado de la operación
     if ($query) {
        header("Location: ../../main.php?module=presupuesto&alert=3");
    } else {
        header("Location: ../../main.php?module=presupuesto&alert=1");
    }
    
}
elseif ($_GET['act'] == 'anular') {
    if (isset($_GET['id_presup'])) {
        $codigo = $_GET['id_presup'];

        // Anular cabecera del pedido
        $query = mysqli_query($mysqli, "UPDATE presupuesto SET estado='anulado' WHERE id_presup=$codigo")
        or die('Error: ' . mysqli_error($mysqli));

        // Consultar detalle del pedido
        $sql = mysqli_query($mysqli, "SELECT * FROM det_presupuesto WHERE id_presup=$codigo");
        while ($row = mysqli_fetch_array($sql)) {
            $codigo_producto = $row['cod_producto'];
            $cantidad = $row['cantidad'];

           
        }

        // Redireccionar según el resultado de la operación
        if ($query) {
            header("Location: ../../main.php?module=presupuesto&alert=2");
        } else {
            header("Location: ../../main.php?module=presupuesto&alert=3");
        }
    }
}
?>
