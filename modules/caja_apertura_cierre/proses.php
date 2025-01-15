<?php
session_start(); // Asegúrate de iniciar la sesión
require_once "../../config/database.php"; // Archivo de conexión a la base de datos

// Verificar si la acción es 'insert' (para abrir la caja) o 'cerrar' (para cerrar la caja)
if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {
        // Capturar los datos del formulario
        $cod_apertura_cierre = $_POST['cod_apertura_cierre'];
        $fecha_apertura = $_POST['fecha_apertura'];
        $hora_apertura = $_POST['hora_apertura'];
        $id_user = $_POST['id_user'];
        $id_caja = $_POST['id_caja'];
        $monto_apertura = $_POST['monto_apertura'];
        $estado = $_POST['estado'];
        $monto_cierre = !empty($_POST['monto_cierre']) ? $_POST['monto_cierre'] : NULL; // Valor opcional

        // Validar que los datos obligatorios no estén vacíos
        if (!empty($cod_apertura_cierre) && !empty($fecha_apertura) && !empty($hora_apertura) && !empty($id_user) && !empty($id_caja) && !empty($monto_apertura) && !empty($estado)) {
            // Insertar datos en la tabla caja_apertura_cierre
            $query = mysqli_query($mysqli, "INSERT INTO caja_apertura_cierre (cod_apertura_cierre, fecha_apertura, hora_apertura, id_user, id_caja, monto_apertura, estado, monto_cierre) 
                                            VALUES ('$cod_apertura_cierre', '$fecha_apertura', '$hora_apertura', '$id_user', '$id_caja', '$monto_apertura', '$estado', '$monto_cierre')")
                                            or die('Error: ' . mysqli_error($mysqli));

            // Comprobar si la inserción fue exitosa
            if ($query) {
                // Redirigir con mensaje de éxito
                header("Location: ../../main.php?module=caja_apertura_cierre&alert=1");
            } else {
                // Redirigir con mensaje de error
                header("Location: ../../main.php?module=caja_apertura_cierre&alert=2");
            }
        } else {
            // Redirigir si faltan datos obligatorios
            header("Location: ../../main.php?module=caja_apertura_cierre&alert=3");
        }
    }
}if ($_GET['act'] == 'cerrar') {
    // Verificar si el código de caja está presente
    if (isset($_GET['id_caja'])) {
        $id_caja = $_GET['id_caja'];

        // Obtener la fecha actual del sistema
        $fecha_actual = date("Y-m-d");  // Formato de fecha: YYYY-MM-DD
        $hora_cierre = date("H:i:s");  // Formato de hora: HH:MM:SS

        // Obtener el total de ventas del día actual
        $queryVentasDia = mysqli_query($mysqli, "
            SELECT SUM(total_venta) AS total_ventas_dia 
            FROM venta 
            WHERE fecha = '$fecha_actual'
        ") or die('Error al obtener el total de las ventas del día: ' . mysqli_error($mysqli));

        $totalVentasDia = 0;
        if ($rowVentasDia = mysqli_fetch_assoc($queryVentasDia)) {
            $totalVentasDia = $rowVentasDia['total_ventas_dia'];
        }

        // Obtener el monto de apertura de la caja
        $queryMontoApertura = mysqli_query($mysqli, "
            SELECT monto_apertura 
            FROM caja_apertura_cierre 
            WHERE id_caja = '$id_caja' AND estado = 'Abierto'
        ") or die('Error al obtener el monto de apertura: ' . mysqli_error($mysqli));

        $montoApertura = 0;
        if ($rowMontoApertura = mysqli_fetch_assoc($queryMontoApertura)) {
            $montoApertura = $rowMontoApertura['monto_apertura'];
        }

        // Calcular el monto de cierre
        $montoCierre = $montoApertura + $totalVentasDia;

        // Actualizar el estado de la caja a 'Cerrado' y agregar la fecha, hora y monto de cierre
        $query = mysqli_query($mysqli, "
            UPDATE caja_apertura_cierre 
            SET estado = 'Cerrado', 
                fecha_cierre = '$fecha_actual', 
                hora_cierre = '$hora_cierre', 
                monto_cierre = '$montoCierre'
            WHERE id_caja = '$id_caja' AND estado = 'Abierto'
        ") or die('Error al actualizar el estado: ' . mysqli_error($mysqli));

        if ($query) {
            // Redirigir con mensaje de éxito
            header("Location: ../../main.php?module=caja_apertura_cierre&alert=2");
        } else {
            // Redirigir con mensaje de error
            header("Location: ../../main.php?module=caja_apertura_cierre&alert=3");
        }
    }
}



?>