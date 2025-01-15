<?php 
    require_once "../../config/database.php";
    
    if($_GET['act'] == 'imprimir'){
        if(isset($_GET['id_orden'])){
            $codigo = $_GET['id_orden'];
            var_dump($codigo); // Esto te permitirá ver el valor de $codigo para verificar

            // Asegúrate de escapar el valor de $codigo para evitar problemas de inyección SQL
            $codigo = mysqli_real_escape_string($mysqli, $codigo);

            // Cabecera del Presupuesto
            $cabecera_presup = mysqli_query($mysqli, "SELECT * FROM vista_orden WHERE id_orden = '$codigo'")
                or die('Error: ' . mysqli_error($mysqli));
            
            while($data = mysqli_fetch_assoc($cabecera_presup)){
                $codigo = $data['id_orden'];
                $id_presup = $data['id_presup'];
                $usuario = $data['name_user'];      // Asegúrate de que 'usuario' exista en la vista
                $fecha_emision = $data['fecha_emision'];
                $estado = $data['estado'];
                $hora = $data['hora'];
            }

              //Detalle de compra
              $detalle_compra = mysqli_query($mysqli, "SELECT `tipo_producto`.`t_p_descrip`, `producto`.`p_descrip`, `u_medida`.`u_descrip`, `detalle_compra`.`precio`, `detalle_compra`.`cantidad`, `compra`.`cod_compra`
              FROM `tipo_producto`
              JOIN `producto` ON `tipo_producto`.`cod_tipo_prod` = `producto`.`cod_tipo_prod`
              JOIN `u_medida` ON `producto`.`id_u_medida` = `u_medida`.`id_u_medida`
              JOIN `detalle_compra` ON `producto`.`cod_producto` = `detalle_compra`.`cod_producto`
              JOIN `compra` ON `detalle_compra`.`cod_compra` = `compra`.`cod_compra`
              WHERE `compra`.`cod_compra` = $codigo")
              or die('Error'.mysqli_error($mysqli));
        }
    }
?> 

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Orden</title>
    </head>
    <body>
        <div align='center'>
        Orden<br>
            <label><strong>Orden: </strong> <?php echo $codigo; ?> </label><br>
            <label><strong>Presupuesto Nro.: </strong> <?php echo $id_presup; ?> </label><br>
            <label><strong>Usuario: </strong> <?php echo $usuario; ?> </label><br>
            <label><strong>Fecha: </strong> <?php echo $fecha_emision; ?> </label><br>
            <label><strong>Hora: </strong> <?php echo $hora; ?> </label><br>
        </div>
        <hr>
        <div>
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead style="background:#e8ecee">
                    <tr class="tabla-title">
                        <th height="20" align="center" valign="middle"><small>tipo de producto</small></th>
                        <th height="20" align="center" valign="middle"><small>Producto</small></th>
                        <th height="20" align="center" valign="middle"><small>U. Medida</small></th>
                        <th height="20" align="center" valign="middle"><small>Cantidad</small></th>
                        <th height="20" align="center" valign="middle"><small>Precio</small></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                            while ($data2 = mysqli_fetch_assoc($detalle_compra)) {
                                $t_p_descrip = $data2['t_p_descrip'];
                                $p_descrip = $data2['p_descrip'];
                                $u_descrip = $data2['u_descrip'];
                                $cantidad = $data2['cantidad'];
                                $precio = $data2['precio'];

                                echo "<tr>
                                        <td width='100' align='left'>$t_p_descrip</td>
                                        <td width='80' align='left'>$p_descrip</td>
                                        <td width='100' align='left'>$u_descrip</td>
                                        <td width='100' align='left'>$cantidad</td>
                                        <td width='100' align='left'>$precio</td>

                                     </tr>";
                            }
                        ?>
                </tbody>
            </table>         
        </div>
    </body>
</html>
