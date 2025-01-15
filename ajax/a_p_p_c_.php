<?php 
session_start();
$session_id = session_id();
if(isset($_POST['id'])) { $id = $_POST['id']; }
if(isset($_POST['cantidad'])) { $cantidad = $_POST['cantidad']; }

require_once '../config/database.php';

include 'conexion.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos.

if (isset($_GET['load_last'])) {
    // Consulta para obtener el último producto agregado.
    $query = "SELECT dv.cod_producto, p.p_descrip, dv.det_cantidad, dv.det_precio_unit 
              FROM det_venta dv
              JOIN producto p ON dv.cod_producto = p.cod_producto
              ORDER BY dv.cod_venta DESC
              LIMIT 1";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Genera el HTML del último producto.
        echo "
        <div class='alert alert-info'>
            <p><strong>Producto:</strong> {$row['p_descrip']}</p>
            <p><strong>Cantidad:</strong> {$row['det_cantidad']}</p>
            <p><strong>Precio Unitario:</strong> {$row['det_precio_unit']}</p>
        </div>";
    } else {
        echo "<div class='alert alert-warning'>No hay productos registrados.</div>";
    }
    exit;
}


// Insertar datos en la tabla tmp
if(!empty($id) && !empty($cantidad)) {
    $insert_tmp = mysqli_query($mysqli, "INSERT INTO tmp (id_producto, cantidad_tmp, session_id) 
    VALUES('$id', '$cantidad', '$session_id')");
}

// Eliminar un producto de la tabla tmp
if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = mysqli_query($mysqli, "DELETE FROM tmp WHERE id_tmp='" . $id . "'");
}
?>
<table class="table table-bordered table-hover table-responsive">
    <thead class="table-warning">
        <tr>
            <th>Código</th>
            <th>Tipo de Producto</th>
            <th>Producto</th>
            <th class="text-end">Cantidad</th>
            <th style="width: 36px;">Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Consulta para obtener los productos y su tipo, vinculados por session_id
        $sql = mysqli_query($mysqli, "SELECT p.cod_producto, p.p_descrip, t.cod_tipo_prod, t.t_p_descrip, tmp.id_tmp, tmp.cantidad_tmp 
                                      FROM producto p 
                                      JOIN tmp ON p.cod_producto = tmp.id_producto 
                                      LEFT JOIN tipo_producto t ON p.cod_tipo_prod = t.cod_tipo_prod
                                      WHERE tmp.session_id = '$session_id'");

        // Verificar si la consulta fue exitosa
        if ($sql === false) {
            die('Error en la consulta SQL: ' . mysqli_error($mysqli));
        }

        // Procesar los resultados
        while($row = mysqli_fetch_array($sql)) {
            $id_tmp = $row['id_tmp'];
            $codigo_producto = $row['cod_producto'];
            $descrip_producto = $row['p_descrip'];
            $cantidad = $row['cantidad_tmp'];

            $codigo_tproducto = $row['cod_tipo_prod'];
            $tproducto_nombre = $row['t_p_descrip'];
        ?>
        <tr>
            <td><?php echo $codigo_producto; ?></td>
            <td><?php echo $tproducto_nombre; ?></td>
            <td><?php echo $descrip_producto; ?></td>
            <td class="text-end"><?php echo $cantidad; ?></td>
            <td class="text-end">
                <a href="#" onclick="eliminar('<?php echo $id_tmp; ?>')" class="btn btn-danger btn-sm">
                <i style="color: black;" class="fas fa-times-circle"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5">
                <input type="hidden" name="cantidad" value="<?php echo !empty($cantidad) ? $cantidad : 0; ?>">
            </td>
        </tr>
    </tbody>
</table>
