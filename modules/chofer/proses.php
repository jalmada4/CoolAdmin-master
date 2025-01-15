<?php 

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else {
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            // Obtener datos del formulario
            $id_chofer = $_POST['id_chofer'];
            $chof_nombre = $_POST['chof_nombre'];
            $chof_apellido = $_POST['chof_apellido'];
            $chof_cedula = $_POST['chof_cedula'];
            $chof_telefono = $_POST['chof_telefono'];
            $licencia = $_POST['licencia'];
            $estado = $_POST['estado'];

            // Realizar la consulta de inserción
            $query = mysqli_query($mysqli, "INSERT INTO chofer (id_chofer, chof_nombre, chof_apellido, chof_cedula, chof_telefono, licencia, estado)
            VALUES ($id_chofer, '$chof_nombre', '$chof_apellido', '$chof_cedula', '$chof_telefono', '$licencia', '$estado')")
            or die('Error'.mysqli_error($mysqli));
            
            // Verificar si la consulta fue exitosa
            if($query){
                header("Location: ../../main.php?module=chofer&alert=1");
            } else {
                header("Location: ../../main.php?module=chofer&alert=4");
            }
        }
    }
    elseif($_GET['act']=='update'){
        if(isset($_POST['Guardar'])){
            if(isset($_POST['id_chofer'])){
                // Obtener datos del formulario
                $id_chofer = $_POST['id_chofer'];
                $chof_nombre = $_POST['chof_nombre'];
                $chof_apellido = $_POST['chof_apellido'];
                $chof_cedula = $_POST['chof_cedula'];
                $chof_telefono = $_POST['chof_telefono'];
                $licencia = $_POST['licencia'];
                $estado = $_POST['estado'];

                // Realizar la consulta de actualización
                $query = mysqli_query($mysqli, "UPDATE chofer SET chof_nombre = '$chof_nombre',
                                                                  chof_apellido = '$chof_apellido',
                                                                  chof_cedula = '$chof_cedula',
                                                                  chof_telefono = '$chof_telefono',
                                                                  licencia = '$licencia',
                                                                  estado = '$estado'
                                                                  WHERE id_chofer = $id_chofer")
                                                                  or die('Error'.mysqli_error($mysqli));

                // Verificar si la consulta fue exitosa
                if($query){
                    header("Location: ../../main.php?module=chofer&alert=2");
                } else {
                    header("Location: ../../main.php?module=chofer&alert=4");
                }                                                    
            }
        }
    }
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_chofer'])){
            $id_chofer = $_GET['id_chofer'];

            // Realizar la consulta de eliminación
            $query = mysqli_query($mysqli, "DELETE FROM chofer WHERE id_chofer = $id_chofer")
                                            or die('Error'.mysqli_error($mysqli));

            // Verificar si la consulta fue exitosa
            if($query){
                header("Location: ../../main.php?module=chofer&alert=3");
            } else {
                header("Location: ../../main.php?module=chofer&alert=4");
            }
        }
    }
}
?>
