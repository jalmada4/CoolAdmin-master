<?php 
require_once "../../config/database.php";

// Modificación de la consulta para obtener los datos de los móviles
$query = mysqli_query($mysqli, "SELECT m.id_movil, m.id_modelo, m.nro_chapa, m.estado, m.color, md.mod_descrip 
                                FROM movil m 
                                LEFT JOIN modelo md ON m.id_modelo = md.id_modelo")
    or die('Error'.mysqli_error($mysqli));

// Contando el número de registros
$count = mysqli_num_rows($query);    
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Móviles</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        <div align="center">
            <img src="../../images/comercial.png">
        </div>
        <div>
            Reporte de Móviles
        </div>
        <div align="center">
            Cantidad: <?php echo $count; ?>
        </div>
        <hr>
        <div id="tabla">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
                <thead style="background:#e8ecee">
                    <tr class="table-title">
                        <th height="20" align="center" valign="middle"><small>ID Móvil</small></th>
                        <th height="30" align="center" valign="middle"><small>Marca (Modelo)</small></th>
                        <th height="30" align="center" valign="middle"><small>Nro. Chapa</small></th>
                        <th height="30" align="center" valign="middle"><small>Estado</small></th>
                        <th height="30" align="center" valign="middle"><small>Color</small></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Mostrando los datos de los móviles en la tabla
                    while ($data = mysqli_fetch_assoc($query)){
                        $id_movil = $data['id_movil'];
                        $id_modelo = $data['id_modelo'];
                        $nro_chapa = $data['nro_chapa'];
                        $estado = $data['estado'];
                        $color = $data['color'];
                        $marca_descrip = $data['mod_descrip']; // Descripción de la marca

                        echo "<tr>
                        <td width='100' align='left'>$id_movil</td>
                        <td width='150' align='left'> $marca_descrip</td>
                        <td width='150' align='left'> $nro_chapa</td>
                        <td width='150' align='left'> $estado</td>
                        <td width='150' align='left'> $color</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
