<?php 
    require_once "../../config/database.php";
    
    if(isset($_GET['act']) && $_GET['act'] == 'imprimir'){
        if(isset($_GET['cod_apertura_cierre'])){
            $codigo = $_GET['cod_apertura_cierre'];

            // Cabecera del Apertura y Cierre
            $cabecera_apertura_cierre = mysqli_query($mysqli, "SELECT * FROM caja_apertura_cierre WHERE cod_apertura_cierre = '$codigo'")
                or die('Error: ' . mysqli_error($mysqli));
            
            if(mysqli_num_rows($cabecera_apertura_cierre) > 0) {
                while($data = mysqli_fetch_assoc($cabecera_apertura_cierre)){
                    $codigo = $data['cod_apertura_cierre'];
                    $id_user = $data['id_user'];  // Asegúrate de que 'id_user' exista en la tabla
                    $fecha_aper = $data['fecha_apertura'];
                    $hora_aper = $data['hora_apertura'];
                    $fecha_cierre = $data['fecha_cierre'];
                    $hora_cierre = $data['hora_cierre'];
                    $monto_inicial = $data['monto_apertura'];
                    $monto_total = $data['monto_cierre'];
                    $estado = $data['estado'];
                    $id_caja = $data['id_caja'];
                }
            } else {
                echo "No se encontraron datos para la caja de apertura/cierre con ID: $codigo";
                exit;  // Detener la ejecución si no se encuentran datos
            }
        } else {
            echo "El parámetro 'cod_apertura_cierre' no está presente en la URL.";
            exit;  // Detener la ejecución si no se pasa el parámetro necesario
        }
    } else {
        echo "Acción no válida.";
        exit;  // Detener la ejecución si la acción no es válida
    }
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Apertura y Cierre de Caja</title>
    </head>
    <body>
        <h1 style="width: 300px; color: cadetblue; text-align: center;">Apertura y Cierre de Caja</h1><hr>
        <div>
            <table width="100%" border="0.3"  align="center">
                <thead>
                    <tr class="tabla-title" style="text-align: start;">
                        <th style="padding: 0px 50px 20px 0px;"><small>ID Apertura/Cierre</small></th>
                        <th><small>Usuario</small></th>
                        <th><small>Fecha Apertura</small></th>
                        <th><small>Hora Apertura</small></th>
                        <th><small>Fecha Cierre</small></th>
                        <th><small>Hora Cierre</small></th>
                        <th><small>Monto Inicial</small></th>
                        <th><small>Monto Total</small></th>
                        <th><small>Estado</small></th>
                        <th><small>ID Caja</small></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 0px 50px 20px 0px;"><?php echo $codigo; ?></td>
                        <td align='center'><?php echo $id_user; ?></td>
                        <td align='center'><?php echo $fecha_aper; ?></td>
                        <td align='center'><?php echo $hora_aper; ?></td>
                        <td align='center'><?php echo $fecha_cierre; ?></td>
                        <td align='center'><?php echo $hora_cierre; ?></td>
                        <td align='center'><?php echo $monto_inicial; ?></td>
                        <td align='center'><?php echo $monto_total; ?></td>
                        <td align='center'><?php echo $estado; ?></td>
                        <td align='center'><?php echo $id_caja; ?></td>
                    </tr>
                </tbody>
            </table>         
        </div>
    </body>
</html>
