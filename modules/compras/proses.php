<?php 
session_start();

require_once '../../config/database.php';

if (empty($_SESSION['username']) || empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {
            $codigo = mysqli_real_escape_string($mysqli, $_POST['codigo']);
            $codigo_deposito = mysqli_real_escape_string($mysqli, $_POST['codigo_deposito']);
            
            // Insertar detalle de compra
            $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto = tmp.id_producto");
            while ($row = mysqli_fetch_array($sql)) {
                $codigo_producto = $row['id_producto'];
                $precio = $row['precio_tmp'];
                $cantidad = $row['cantidad_tmp'];

                $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_compra (cod_producto, cod_compra, cod_deposito, precio, cantidad) 
                VALUES ($codigo_producto, $codigo, $codigo_deposito, $precio, $cantidad)") or die('Error' . mysqli_error($mysqli));

                // Insertar stock
                $query = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto = $codigo_producto AND cod_deposito = $codigo_deposito") or die('Error' . mysqli_error($mysqli));

                $count = mysqli_num_rows($query);
                if ($count == 0) {
                    $insertar_stock = mysqli_query($mysqli, "INSERT INTO stock (cod_deposito, cod_producto, cantidad)
                    VALUES ($codigo_deposito, $codigo_producto, $cantidad)") or die('Error' . mysqli_error($mysqli));
                } else {
                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad + $cantidad
                    WHERE cod_producto = $codigo_producto AND cod_deposito = $codigo_deposito") or die('Error' . mysqli_error($mysqli));
                }
            }

            // Insertar cabecera de compra
            $codigo_proveedor = mysqli_real_escape_string($mysqli, $_POST['codigo_proveedor']);
            $fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);
            $hora = mysqli_real_escape_string($mysqli, $_POST['hora']);
            $nro_factura = mysqli_real_escape_string($mysqli, $_POST['nro_factura']);
            $suma_total = mysqli_real_escape_string($mysqli, $_POST['suma_total']);
            $estado = 'activo';
            $usuario = $_SESSION['id_user'];

            // Insertar compra
            $query = mysqli_query($mysqli, "INSERT INTO compra (cod_compra, cod_proveedor, cod_deposito, nro_factura, fecha, hora, estado, total_compra, id_user) 
            VALUES ($codigo, $codigo_proveedor, $codigo_deposito, '$nro_factura', '$fecha', '$hora', '$estado', $suma_total, $usuario)") 
            or die('Error' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=compras&alert=1");
            } else {
                header("Location: ../../main.php?module=compras&alert=3");
            }
        }
    }

    elseif ($_GET['act']=='anular') {
        if (isset($_GET['cod_compra'])) {
            $codigo = $_GET['cod_compra'];
            //Anulaar cabecera de compra (cambiar estado a anulado)
            $query = mysqli_query($mysqli, "UPDATE compra SET estado='anulado' WHERE cod_compra=$codigo")
            or die('Error'.mysqli_error($mysqli));

            //consultar detalle de compra con el codigo que llego por GET
            $sql = mysqli_query($mysqli, "SELECT * FROM detalle_compra WHERE cod_compra=$codigo");
            while($row = mysqli_fetch_array($sql)){
                $codigo_producto = $row['cod_producto'];
                $codigo_deposito = $row['cod_deposito'];
                $cantidad = $row['cantidad'];

                $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $cantidad
                WHERE cod_producto=$codigo_producto
                AND cod_deposito=$codigo_deposito")
                or die('Error'.mysqli_error($mysqli));
            }
            if ($query) {
                header("Location: ../../main.php?module=compras&alert=2");
            } else {
                header("Location: ../../main.php?module=compras&alert=3");
            }
        }
    }
}
?>
