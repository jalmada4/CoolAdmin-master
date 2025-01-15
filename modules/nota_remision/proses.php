<?php 
session_start();
require_once "../../config/database.php";


$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
$_SESSION['id_user'] = $id_user; // Donde $id_user es el ID del usuario logueado

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}

else {
    // Insertar nueva nota de remisión
    if($_GET['act'] == 'insert'){
        if(isset($_POST['Guardar'])){
            // Obtener los datos del formulario
            $id_nota_remis = $_POST['id_nota_remis'];
            $cod_venta = $_POST['cod_venta'];
            $id_user = $_POST['id_user']; // El ID del usuario debería ser obtenido, posiblemente usando $_SESSION
            $id_movil = $_POST['id_movil'];
            $id_chofer = $_POST['id_chofer'];
            $fecha = $_POST['fecha'];
            $estado = $_POST['estado'];
            $hora = $_POST['hora'];
            $clientes = $_POST['id_cliente'];  // Asegúrate de pasar el ID del cliente
            $destino = $_POST['destino'];      // Asegúrate de pasar el destino

            $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

            if (!empty($id_user) && is_numeric($id_user)) {
                $query = $mysqli->prepare("INSERT INTO nota_remision (id_nota_remis, cod_venta, id_user, id_movil, id_chofer, fecha, estado, id_cliente, destino, hora) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $query->bind_param("isiiisssss", $id_nota_remis, $cod_venta, $id_user, $id_movil, $id_chofer, $fecha, $estado, $clientes, $destino, $hora);
            
                if ($query->execute()) {
                    header("Location: ../../main.php?module=nota_remision&alert=1");
                }  // Insertar detalle nota_remision
                $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto = tmp.id_producto");
                while ($row = mysqli_fetch_array($sql)) {
                    $codigo_producto = $row['cod_producto'];
                    $cantidad = $row['cantidad_tmp'];
    
                    $insert_detalle = mysqli_query($mysqli, "INSERT INTO det_nota_remision (cod_producto, id_nota_remis, cantidad)
                    VALUES ($codigo_producto, $id_nota_remis, $cantidad)")
                    or die('Error: ' . mysqli_error($mysqli));
                }
            }else {
                die("Error: No se pudo obtener un ID de usuario válido.");
            }
            
            // Verificar si la inserción fue exitosa
            if($query->execute()){
                header("Location: ../../main.php?module=nota_remision&alert=1");
            } 
        }
    }

    // Actualizar nota de remisión
    elseif($_GET['act'] == 'update'){
        if(isset($_POST['Guardar'])){
            // Obtener los datos del formulario
            if(isset($_POST['id_nota_remis'])){
                $id_nota_remis = $_POST['id_nota_remis'];
                $cod_venta = $_POST['cod_venta'];
                $id_user = $_POST['id_user'];
                $id_movil = $_POST['id_movil'];
                $id_chofer = $_POST['id_chofer'];
                $fecha = $_POST['fecha'];
                $estado = $_POST['estado'];
                $hora = $_POST['hora'];
                $clientes = $_POST['id_cliente'];  // Corregir $_post a $_POST
                $destino = $_POST['destino'];

                // Actualizar los datos en la base de datos
                $query = $mysqli->prepare("UPDATE nota_remision 
                    SET cod_venta = ?, id_user = ?, id_movil = ?, id_chofer = ?, fecha = ?, estado = ?, hora = ?, id_cliente = ?, destino = ? 
                    WHERE id_nota_remis = ?");
                $query->bind_param("isiiisssssi", $cod_venta, $id_user, $id_movil, $id_chofer, $fecha, $estado, $hora, $clientes, $destino, $id_nota_remis);

                // Verificar si la actualización fue exitosa
                if($query->execute()){
                    header("Location: ../../main.php?module=nota_remision&alert=2");
                } else {
                    header("Location: ../../main.php?module=nota_remision&alert=4");
                }
            }
        }
    }

    // Eliminar nota de remisión
    elseif($_GET['act'] == 'delete'){
        if(isset($_GET['id_nota_remis'])){
            $id_nota_remis = $_GET['id_nota_remis'];

            // Eliminar la nota de remisión en la base de datos
            $query = mysqli_query($mysqli, "DELETE FROM nota_remision WHERE id_nota_remis = $id_nota_remis") 
                or die('Error'.mysqli_error($mysqli));

            // Verificar si la eliminación fue exitosa
            if($query){
                header("Location: ../../main.php?module=nota_remision&alert=3");
            } else {
                header("Location: ../../main.php?module=nota_remision&alert=4");
            }
        }
    }
}
?>
