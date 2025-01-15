<?php
include '../../config/database.php'; // Conexión a la base de datos

// Acción de inserción
if (isset($_GET['act']) && $_GET['act'] == 'insert') {
    // Recibimos los datos del formulario
    $codigo = $_POST['codigo'];
    $tipo_producto = $_POST['tipo_producto'];
    $unidad_medida = $_POST['unidad_medida'];  // ID de la unidad de medida
    $p_descrip = $_POST['p_descrip'];
    $precio = $_POST['precio'];

    // Validación: asegurarse de que el campo unidad_medida no esté vacío
    if (empty($unidad_medida)) {
        echo "Error: Debes seleccionar una unidad de medida.";
        exit;
    }

    // Consulta para insertar el producto en la base de datos
    $query_insert = "INSERT INTO producto (cod_producto, cod_tipo_prod, id_u_medida, p_descrip, precio) 
                     VALUES ('$codigo', '$tipo_producto', '$unidad_medida', '$p_descrip', '$precio')";

    $result = mysqli_query($mysqli, $query_insert);

    if ($result) {
        // Si la inserción es exitosa, redirigimos a la página de productos con un mensaje de éxito
        header("Location: ../../main.php?module=producto&alert=1");
exit;
    } else {
        // Si ocurre un error en la consulta, lo mostramos
        echo "Error: " . mysqli_error($mysqli);
    }
}

// Acción de actualización
elseif (isset($_GET['act']) && $_GET['act'] == 'update') {
    if (isset($_POST['Guardar'])) {
        if (isset($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $tipo_producto = $_POST['tipo_producto'];
            $unidad_medida = $_POST['unidad_medida']; // Asegúrate de que el valor esté recibiéndose
            $p_descrip = $_POST['p_descrip'];
            $precio = $_POST['precio'];
            
            // Asegurarse de que los valores son correctos antes de hacer la consulta
            $query = "UPDATE producto 
                      SET p_descrip = '$p_descrip',
                          precio = '$precio',
                          cod_tipo_prod = '$tipo_producto',
                          id_u_medida = '$unidad_medida' 
                      WHERE cod_producto = '$codigo'";

            $query_result = mysqli_query($mysqli, $query);

            if ($query_result) {
                // Redirigir con mensaje de éxito
                header("Location: ../../main.php?module=producto&alert=2");
                exit;
            } else {
                // En caso de error en la consulta
                header("Location: ../../main.php?module=producto&alert=4");
                exit;
            }                                                    
        }
    }
}



// Acción de eliminación
elseif (isset($_GET['act']) && $_GET['act'] == 'delete') {
    if (isset($_GET['cod_producto'])) {
        $codigo = $_GET['cod_producto'];

        // Eliminar el producto de la base de datos
        $query_delete = "DELETE FROM producto WHERE cod_producto = '$codigo'";

        $delete_result = mysqli_query($mysqli, $query_delete);

        if ($delete_result) {
            // Redirigir con mensaje de éxito
            header("Location: ../../main.php?module=producto&alert=3");
            exit;
        } else {
            // En caso de error en la consulta
            header("Location: ../../main.php?module=producto&alert=4");
            exit;
        }
    }
}
?>
