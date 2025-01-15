<?php 
require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT p.cod_producto, p.p_descrip, p.precio,
tp.cod_tipo_prod, tp.t_p_descrip, um.u_descrip
FROM producto p
JOIN tipo_producto tp ON p.cod_tipo_prod = tp.cod_tipo_prod
JOIN u_medida um ON p.id_u_medida = um.id_u_medida")
    or die('Error'.mysqli_error($mysqli));

$count = mysqli_num_rows($query);    
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Producto</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        <div align="center">
            <img src="../../images/comercial.png">
        </div>
        <div>
            Reporte de Producto
        </div>
        <div align="center">
            Cantidad: <?php echo $count; ?>
        </div>
        <hr>
        <div id="tabla">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead style="background:#e8ecee">
                    <tr class="table-title">
                        <th height="20" align="center" valign="middle"><small>Código</small></th>
                        <th height="30" align="center" valign="middle"><small>Tipo de Producto</small></th>  
                        <th height="30" align="center" valign="middle"><small>Producto</small></th>
                        <th height="30" align="center" valign="middle"><small>Unid. Medida</small></th>                                          
                        <th height="30" align="center" valign="middle"><small>Precio</small></th>                      
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($data = mysqli_fetch_assoc($query)){
                        $codigo = $data['cod_producto'];
                        $t_p_descrip = $data['t_p_descrip'];
                        $p_descrip = $data['p_descrip'];
                        $u_descrip = $data['u_descrip'];
                        $precio = $data['precio'];

                        echo "<tr>
                        <td width='100' align='center'>$codigo</td>
                        <td width='150' align='center'>$t_p_descrip</td>
                        <td width='150' align='center'>$p_descrip</td>
                        <td width='150' align='center'>$u_descrip</td>
                        <td width='150' align='center'>$precio</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>