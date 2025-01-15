<?php 
    require_once "../../config/database.php";
    
    if($_GET['act'] == 'imprimir'){
        if(isset($_GET['id_presup'])){
            $codigo = $_GET['id_presup'];
            var_dump($codigo); // Esto te permitirá ver el valor de $codigo para verificar

            // Asegúrate de escapar el valor de $codigo para evitar problemas de inyección SQL
            $codigo = mysqli_real_escape_string($mysqli, $codigo);

            // Cabecera del Presupuesto
            $cabecera_presup = mysqli_query($mysqli, "SELECT * FROM vista_presupuesto WHERE id_presup = '$codigo'")
                or die('Error: ' . mysqli_error($mysqli));
            
            while($data = mysqli_fetch_assoc($cabecera_presup)){
                $codigo = $data['id_presup'];
                $id_pedido = $data['id_pedido'];
                $proveedor = $data['proveedor'];  // Asegúrate de que 'proveedor' exista en la vista
                $usuario = $data['usuario'];      // Asegúrate de que 'usuario' exista en la vista
                $total_esti = $data['total_esti'];
                $fecha_presup = $data['fecha_presup'];
                $hora = $data['hora'];
                $estado = $data['estado'];
            }
                
            // Detalle del presupuesto
            $detalle_pedido_compra = mysqli_query($mysqli, "SELECT * FROM v_detalle_presupuesto WHERE id_presup = '$codigo'")
                or die('Error: ' . mysqli_error($mysqli));
        }
    }
?> 

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Presupuesto</title>
    </head>
    <body>
        <div align='center'>
            Presupuesto<br>
            <label><strong>Presupuesto Nro.: </strong> <?php echo $codigo; ?> </label><br>
            <label><strong>Pedido: </strong> <?php echo $id_pedido; ?> </label><br>
            <label><strong>Proveedor: </strong> <?php echo $proveedor; ?> </label><br>
            <label><strong>Usuario: </strong> <?php echo $usuario; ?> </label><br>
            <label><strong>Fecha: </strong> <?php echo $fecha_presup; ?> </label><br>
            <label><strong>Hora: </strong> <?php echo $hora; ?> </label><br>
        </div>
        <hr>
        <div>
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead style="background:#e8ecee">
                    <tr class="tabla-title">
                        <th height="20" align="center" valign="middle"><small>id presupuesto</small></th>
                        <th height="20" align="center" valign="middle"><small>Producto</small></th>
                        <th height="20" align="center" valign="middle"><small>Cantidad</small></th>
                        <th height="20" align="center" valign="middle"><small>Precio</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($data2 = mysqli_fetch_assoc($detalle_pedido_compra)){
                            $codigo = $data2['id_presup'];  // Asegúrate de que esta columna exista en v_detalle_presupuesto
                            $p_descrip = $data2['p_descrip'];      // Asegúrate de que esta columna exista en v_detalle_presupuesto
                            $cantidad = $data2['cantidad'];        // Asegúrate de que esta columna exista en v_detalle_presupuesto
                            $precio = $data2['precio'];            // Asegúrate de que esta columna exista en v_detalle_presupuesto
                            
                            echo "<tr>
                                    <td width='100' align='center'>$codigo</td>
                                    <td width='100' align='center'>$p_descrip</td>
                                    <td width='100' align='center'>$cantidad</td>
                                    <td width='100' align='center'>$precio</td>
                                  </tr>";
                        }                         
                    ?>
                </tbody>
            </table>         
        </div>
    </body>
</html>
