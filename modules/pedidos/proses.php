<?php
session_start();

require_once '../../config/database.php';

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {
            // Definir variables para la cabecera del pedido
            $codigo = $_POST['codigo'];
            $codigo_deposito = $_POST['codigo_deposito'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $estado = 'activo';
            $usuario = $_SESSION['id_user'];

            // Insertar cabecera del pedido
            $query = mysqli_query($mysqli, "INSERT INTO pedidos(id_pedido, cod_deposito, fecha, hora, estado, id_user)
            VALUES ($codigo, $codigo_deposito, '$fecha', '$hora', '$estado', $usuario)")
            or die('Error: ' . mysqli_error($mysqli));

            // Insertar detalle del pedido
            $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto = tmp.id_producto");
            while ($row = mysqli_fetch_array($sql)) {
                $codigo_producto = $row['cod_producto'];
                $cantidad = $row['cantidad_tmp'];

                $insert_detalle = mysqli_query($mysqli, "INSERT INTO det_pedido (cod_producto, id_pedido, cantidad)
                VALUES ($codigo_producto, $codigo, $cantidad)")
                or die('Error: ' . mysqli_error($mysqli));
            }

            // Redireccionar según el resultado de la operación
            if ($query) {
                header("Location: ../../main.php?module=pedidos&alert=1");
            } else {
                header("Location: ../../main.php?module=pedidos&alert=3");
            }
        }
    } elseif ($_GET['act'] == 'anular') {
        if (isset($_GET['id_pedido'])) {
            $codigo = $_GET['id_pedido'];

            // Anular cabecera del pedido
            $query = mysqli_query($mysqli, "UPDATE pedidos SET estado='anulado' WHERE id_pedido=$codigo")
            or die('Error: ' . mysqli_error($mysqli));

            // Consultar detalle del pedido
            $sql = mysqli_query($mysqli, "SELECT * FROM det_pedido WHERE id_pedido=$codigo");
            while ($row = mysqli_fetch_array($sql)) {
                $codigo_producto = $row['cod_producto'];
                $cantidad = $row['cantidad'];

                // Actualizar stock
                $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $cantidad
                WHERE cod_producto=$codigo_producto")
                or die('Error: ' . mysqli_error($mysqli));
            }

            // Redireccionar según el resultado de la operación
            if ($query) {
                header("Location: ../../main.php?module=pedidos&alert=2");
            } else {
                header("Location: ../../main.php?module=pedidos&alert=3");
            }
        }
    }
}
?>