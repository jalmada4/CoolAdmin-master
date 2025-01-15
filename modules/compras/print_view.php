<?php 
     require_once "../../config/database.php";
     if ($_GET['act'] == 'imprimir') {
        if (isset($_GET['cod_compra'])) {
            $codigo = $_GET['cod_compra'];
            // Cabecera de compra con el nombre del usuario
            $cabecera_compra = mysqli_query($mysqli, "
                SELECT 
                    `compra`.*, 
                    `proveedor`.`razon_social`, 
                    `deposito`.`descrip`, 
                    `detalle_compra`.*, 
                    `usuarios`.`name_user`  -- Se agrega el nombre del usuario
                FROM `compra`  
                JOIN `proveedor` ON `compra`.`cod_proveedor` = `proveedor`.`cod_proveedor`
                JOIN `deposito` ON `compra`.`cod_deposito` = `deposito`.`cod_deposito`
                JOIN `detalle_compra` ON `compra`.`cod_compra` = `detalle_compra`.`cod_compra`
                JOIN `usuarios` ON `compra`.`id_user` = `usuarios`.`id_user`  -- Unión con la tabla usuario
                WHERE `compra`.`cod_compra` = $codigo
            ") or die('Error: ' . mysqli_error($mysqli));
    
            while ($data = mysqli_fetch_assoc($cabecera_compra)) {
                $codigo = $data['cod_compra'];
                $proveedor = $data['razon_social'];
                $deposito = $data['descrip'];
                $nro_factura = $data['nro_factura'];
                $fecha = $data['fecha'];
                $hora = $data['hora'];
                $total_compra = $data['total_compra'];
                $usuario = $data['name_user'];  // Ahora se obtiene el nombre del usuario
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
        <title>Factura de Compra</title>
    </head>
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

    <body>
        <div align='center'>
            Registro de factura de Compra <br>
            <label ><strong>Proveedor:</strong> <?php echo $proveedor; ?></label><br>
            <label ><strong>Depósito:</strong> <?php echo $deposito; ?></label><br>
            <label ><strong>N° factura de compra:</strong> <?php echo $nro_factura; ?></label><br>
            <label ><strong>Fecha:</strong> <?php echo $fecha; ?></label><br>
            <label ><strong>Hora:</strong> <?php echo $hora; ?></label><br>
            <label ><strong>Usuario:</strong> <?php echo $usuario; ?></label>
        </div>
        <hr>
            <div>
                <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                    <thead style="background: #e8ecee;">
                        <tr class="tabla-title">
                            <th height="20" align="center" valign="middle"><small>Tipo de Produto</small></th>
                            <th height="20" align="center" valign="middle"><small>Produto</small></th>
                            <th height="20" align="center" valign="middle"><small>Unidad de medida</small></th>
                            <th height="20" align="center" valign="middle"><small>Precio</small></th>
                            <th height="20" align="center" valign="middle"><small>Cantidad</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while ($data2 = mysqli_fetch_assoc($detalle_compra)) {
                                $t_p_descrip = $data2['t_p_descrip'];
                                $p_descrip = $data2['p_descrip'];
                                $u_descrip = $data2['u_descrip'];
                                $precio = $data2['precio'];
                                $cantidad = $data2['cantidad'];

                                echo "<tr>
                                        <td width='100' align='left'>$t_p_descrip</td>
                                        <td width='80' align='left'>$p_descrip</td>
                                        <td width='100' align='left'>$u_descrip</td>
                                        <td width='100' align='left'>$precio</td>
                                        <td width='100' align='left'>$cantidad</td>
                                     </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div align='right'>
               <label><strong>El total de la compra es: Gs.<?php echo number_format($total_compra); ?></strong></label> 
            </div>
            <hr>
    </body>
</html>