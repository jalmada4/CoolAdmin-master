<?php 
session_start();

require_once '../../config/database.php';

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else{
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $cod_venta = $_POST['cod_venta'];
            $cod_deposito= $_POST['cod_deposito'];
            //Insertar detalle de venta
            $suma_total=0;
            $sql=mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
            while($row = mysqli_fetch_array($sql)){
                $codigo_producto= $row['cod_producto'];
                $codigo= $row['id_producto'];
                $cod_deposito= $_POST['cod_deposito'];
                $precio= $row['precio_tmp'];
                $cantidad= $row['cantidad_tmp'];
                $suma_total+=$precio*$cantidad;
                $insert_detalle = mysqli_query($mysqli, "INSERT INTO det_venta (cod_producto, cod_venta, cod_deposito,
                det_precio_unit, det_cantidad) VALUES ('$codigo_producto', '$cod_venta', '$cod_deposito', '$precio', '$cantidad')")
                or die('Error'.mysqli_error($mysqli));

                //Insertar stock
                $query = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto=$codigo_producto
                AND cod_deposito=$cod_deposito") 
                or die('Error'.mysqli_error($mysqli));
                if($count = mysqli_num_rows($query)==0){
                    //Insertar
                    $insertar_stock = mysqli_query($mysqli, "INSERT INTO stock (cod_deposito, cod_producto, cantidad)
                    VALUES ($cod_deposito, $codigo_producto, -$cantidad )")
                    or die('Error'.mysqli_error($mysqli));
                }else {
                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - $cantidad
                    WHERE cod_producto=$codigo_producto
                    AND cod_deposito=$cod_deposito ")
                    or die('Error'.mysqli_error($mysqli));
                }
            }
            //Insertar cabecera de venta
            //Definir variables
            $cod_venta = $_POST['cod_venta'];
            $cod_deposito = $_POST['cod_deposito'];
            $id_cliente = $_POST['id_cliente'];
            $fecha = $_POST['fecha'];
            $suma_total = $_POST['suma_total'];
            $hora=$_POST['hora'];
            $nro_factura = $_POST['nro_factura'];
            //insertar
            mysqli_query($mysqli, "INSERT INTO venta (cod_venta, id_cliente, fecha, estado, total_venta, hora, nro_factura) 
                    VALUES ('$cod_venta', '$id_cliente', '$fecha', 'activo', '$suma_total', '$hora', '$nro_factura')")
                    or die('Error'.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=ventas&alert=1");
            } else {
                header("Location: ../../main.php?module=ventas&alert=3");
            }
        }
    }

    elseif($_GET['act']=='anular'){
        if(isset($_GET['cod_venta'])){
            $cod_venta = $_GET['cod_venta'];
            //Anular cabecera de compra (cambiar estado a anulado)
            $query = mysqli_query($mysqli, "UPDATE venta SET estado='anulado' WHERE cod_venta=$cod_venta")
            or die('Error'.mysqli_error($mysqli));

            //Consultar detalle de compra con el código que llegó por get
            $sql = mysqli_query($mysqli, "SELECT * FROM det_venta WHERE cod_venta=$cod_venta");
            while($row = mysqli_fetch_array($sql)){
                $codigo_producto = $row['cod_producto'];
                $cod_deposito = $row['cod_deposito'];
                $cantidad = $row['det_cantidad'];

                $actualizar_stock = mysqli_query($mysqli, "UPDATE stock set cantidad = cantidad + $cantidad
                WHERE cod_producto=$codigo_producto
                AND cod_deposito=$cod_deposito")
                or die('Error'.mysqli_error($mysqli));
            }
            if($query){
                header("Location: ../../main.php?module=ventas&alert=2");
            } else {
                header("Location: ../../main.php?module=ventas&alert=3");
            }
        }
    }
}



try {
    // Validar si la caja está abierta
    $query = "SELECT estado, cod_apertura_cierre FROM caja_apertura_cierre ORDER BY cod_apertura_cierre DESC LIMIT 1";
    $result = mysqli_query($mysqli, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data['estado'] === 'abierto') {
        $cod_apertura_cierre = $data['cod_apertura_cierre'];

        // Datos de la venta
        $cod_venta = $_POST['cod_venta'];
        $id_cliente = $_POST['id_cliente'];
        $fecha = $_POST['fecha'];
        $suma_total = $_POST['suma_total'];
        $hora = $_POST['hora'];
        $nro_factura = $_POST['nro_factura'];

        // Insertar la venta
        $query_venta = "INSERT INTO venta (cod_venta, id_cliente, fecha, estado, total_venta, hora, nro_factura, cod_apertura_cierre)
                        VALUES ('$cod_venta', '$id_cliente', '$fecha', 'activo', '$suma_total', '$hora', '$nro_factura', '$cod_apertura_cierre')";
        if (mysqli_query($mysqli, $query_venta)) {
            // Actualizar el monto final de la caja
            $query_update_caja = "UPDATE caja_apertura_cierre 
                                  SET monto_final = monto_final + $suma_total 
                                  WHERE cod_apertura_cierre = '$cod_apertura_cierre'";
            mysqli_query($mysqli, $query_update_caja);

            header("Location: ../../main.php?module=ventas&alert=1");
        } else {
            throw new Exception("Error al registrar la venta.");
        }
    } else {
        // La caja está cerrada
        echo "<script>alert('Debe abrir la caja antes de realizar una venta.');</script>";
        header("Location: ../../main.php?module=ventas");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>