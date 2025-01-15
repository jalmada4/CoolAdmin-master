<?php 
require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT * FROM caja")
    or die('Error'.mysqli_error($mysqli));

$count = mysqli_num_rows($query);    
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Caja</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        <div align="center">
            <img src="../../images/comercial.png">
        </div>
        <div>
            Reporte de Caja
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
                        <th height="20" align="center" valign="middle"><small>Código apertura/cierre</small></th>
                        <th height="30" align="center" valign="middle"><small>Descripción</small></th>                      
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($data = mysqli_fetch_assoc($query)){
                        $codigo = $data['id_caja'];
                        $id_aper_cierre = $data['id_aper_cierre'];
                        $caja_descrip = $data['caja_descrip'];

                        echo "<tr>
                        <td width='100' align='left'>$codigo</td>
                        <td width='100' align='left'>$id_aper_cierre</td>
                        <td width='150' align='left'>$caja_descrip</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>