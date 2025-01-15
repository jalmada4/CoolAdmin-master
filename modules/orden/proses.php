<?php 
session_start();


require_once '../../config/database.php';

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {
            $id_orden = $_POST['id_orden'];
            $total = 0;

            // Recibir los datos de los productos
            // $data = json_decode($_POST['data'], true);

            $sql = mysqli_query($mysqli, "SELECT producto.cod_producto, tmp.cantidad_tmp, tmp.precio_tmp 
                                          FROM producto, tmp 
                                          WHERE producto.cod_producto = tmp.id_producto 
                                          AND tmp.session_id = '$session_id'");
    
            // Recorrer cada fila del resultado y realizar la inserción
            while ($row = mysqli_fetch_array($sql)) {
                $cod_producto = $row['cod_producto'];
                $cantidad = $row['cantidad_tmp'];
                $precio = $row['precio_tmp'];

            // Insertar detalles de la orden de compra
           // foreach ($data as $detalle) {
            //    $id_orden = $detalle['id_orden'];
            //    $cantidad = $detalle['cantidad'];
            //    $precio = $detalle['precio'];
                // Verificar que cantidad y precio sean mayores que cero
             //   if ($cantidad > 0 && $precio > 0) {
           //         $total += $precio * $cantidad;

                    $insert_detalle = mysqli_query($mysqli, "INSERT INTO det_orden (id_orden, cod_producto, cantidad, precio) VALUES ('$id_orden', '$cod_producto', '$cantidad', '$precio')")
                        or die('Error'.mysqli_error($mysqli));
                }
          //  }

            // Insertar cabecera de la orden de compra
            $id_orden = $_POST['id_orden'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $estado = $_POST ['estado'];
            $usuario = $_POST ['usuario'];
            $id_presup = $_POST ['id_presup'];




            $query = mysqli_query($mysqli, "INSERT INTO orden (id_orden, id_presup, id_user, fecha_emision, estado, hora) VALUES ('$id_orden', '$id_presup', '$usuario', '$fecha', '$estado', '$hora')")
                or die('Error'.mysqli_error($mysqli));
            
            $UPDATE_ESTADO = mysqli_query($mysqli, "UPDATE presupuesto SET estado='PROCESADO' WHERE id_presup = '$cod_orden'");

            if($query){
                header("Location: ../../main.php?module=orden&alert=1");
            } else {
                header("Location: ../../main.php?module=orden&alert=3");
            }
        }
    }

    /**
     * Anula una compra previamente realizada.
     * 
     * Verifica si se ha pasado un código de compra por GET.
     * Si existe, anula la cabecera de la compra en la BD cambiando su estado a "anulado".
     * Luego consulta los detalles de esa compra y actualiza el stock restando las cantidades de esos productos.
     * Finalmente redirige a la página de compras con un mensaje de éxito o error.
     */
    elseif ($_GET['act'] == 'anular') {
        if (isset($_GET['cod_compra'])) {
            $codigo = $_GET['cod_compra'];
            //Anular cabecera de compra (cambiar estado a anulado)
            $query = mysqli_query($mysqli, "UPDATE compra SET estado='anulado' WHERE cod_compra=$codigo")
                or die('Error' . mysqli_error($mysqli));

            //Consultar detalle de compra con el código que llegó por get
            $sql = mysqli_query($mysqli, "SELECT * FROM detalle_compra WHERE cod_compra=$codigo");
            while ($row = mysqli_fetch_array($sql)) {
                $codigo_producto = $row['cod_producto'];
                $codigo_deposito = $row['cod_deposito'];
                $cantidad = $row['cantidad'];

            }
            if ($query) {
                header("Location: ../../main.php?module=orden&alert=2");
            } else {
                header("Location: ../../main.php?module=orden&alert=3");
            }
        }
    }
    elseif ($_GET['act'] == 'rechazar') {
        if (isset($_GET['id_orden']) && isset($_GET['id_presup'])) {
            $cod_pedido = $_GET['id_orden'];
            $cod_presup = $_GET['id_presup'];
    
            $query = mysqli_query($mysqli, "UPDATE orden SET estado = 'ANULADO' WHERE id_orden = $cod_pedido")
                or die('Error' . mysqli_error($mysqli));

                $query2 = mysqli_query($mysqli, "UPDATE presupuesto SET estado = 'PENDIENTE' WHERE id_presup = $cod_presup")
                or die('Error' . mysqli_error($mysqli));
    
            if ($query) {
                header("Location: ../../main.php?module=orden&alert=2");
            } else {
                header("Location: ../../main.php?module=orden&alert=3");
            }
        }
    }
    elseif ($_GET['act'] == 'aprobar') {
        if (isset($_GET['id_orden'])) {
            $cod_pedido = $_GET['id_orden'];
    
            $query = mysqli_query($mysqli, "UPDATE orden SET estado = 'APROBADO' WHERE id_orden = $cod_pedido")
                or die('Error' . mysqli_error($mysqli));
    
            if ($query) {
                header("Location: ../../main.php?module=orden&alert=4");
            } else {
                header("Location: ../../main.php?module=orden&alert=3");
            }
        }
    }
}
?>