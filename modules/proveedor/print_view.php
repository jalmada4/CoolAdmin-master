<?php 
require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT * FROM proveedor")
    or die('Error'.mysqli_error($mysqli));

$count = mysqli_num_rows($query);    
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Proveedor</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        <div align="center">
            <img src="../../images/comercial.png">
        </div>
        <div>
            Reporte de proveedor
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
                        <th height="30" align="center" valign="middle"><small>Razon social</small></th>
                        <th height="30" align="center" valign="middle"><small>RUC</small></th>
                        <th height="30" align="center" valign="middle"><small>Dirección</small></th> 
                        <th height="30" align="center" valign="middle"><small>Telefono</small></th>                      
                     
                      
                      
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($data = mysqli_fetch_assoc($query)){
                        $codigo = $data['cod_proveedor'];
                        $razon_social = $data['razon_social'];
                        $ruc = $data['ruc'];
                        $direccion = $data['direccion'];
                        $telefono = $data['telefono'];

                        echo "<tr>
                        <td width='100' align='left'>$codigo</td>
                        <td width='150' align='left'> $razon_social</td>
                        <td width='150' align='left'> $ruc</td>
                        <td width='150' align='left'> $direccion</td>
                        <td width='150' align='left'> $telefono</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>