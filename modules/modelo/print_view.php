<?php 
require_once "../../config/database.php";

// Consulta para obtener los datos de la tabla modelo
$query = mysqli_query($mysqli, "SELECT * FROM modelo")
    or die('Error'.mysqli_error($mysqli));

// Contar la cantidad de modelos
$count = mysqli_num_rows($query);    
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Modelos</title>
        <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    </head>
    <body>
        <div align="center">
            <img src="../../images/comercial.png">
        </div>
        <div>
            Reporte de Modelos
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
                        <th height="30" align="center" valign="middle"><small>Marca</small></th>
                        <th height="30" align="center" valign="middle"><small>Descripción</small></th>
                        <th height="30" align="center" valign="middle"><small>Año</small></th>                      
                    
                    </tr>
                </thead>
                <tbody>
                <?php
                    while ($data = mysqli_fetch_assoc($query)){
                        $codigo = $data['id_modelo'];
                        $id_marca = $data['id_marca'];
                        $mod_descrip = $data['mod_descrip'];
                        $anho = $data['anho'];

                        // Consulta para obtener la marca del modelo
                        $marca_query = mysqli_query($mysqli, "SELECT * FROM marca WHERE id_marca = $id_marca")
                            or die('Error'.mysqli_error($mysqli));
                        $marca_data = mysqli_fetch_assoc($marca_query);
                        $marca_nombre = $marca_data['marca_descrip'];

                        echo "<tr>
                        <td width='100' align='left'>$codigo</td>
                        <td width='150' align='left'>$marca_nombre</td>
                        <td width='150' align='left'>$mod_descrip</td>
                        <td width='150' align='left'>$anho</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
