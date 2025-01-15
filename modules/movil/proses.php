<?php 
session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
} else {
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            // Recibiendo datos del formulario
            $id_movil = $_POST['id_movil'];
            $id_modelo = $_POST['id_modelo'];
            $nro_chapa = $_POST['nro_chapa'];
            $estado = $_POST['estado'];
            $color = $_POST['color'];

            // Insertando los datos en la tabla 'movil'
            $query = mysqli_query($mysqli, "INSERT INTO movil (id_movil, id_modelo, nro_chapa, estado, color)
            VALUES ($id_movil, $id_modelo, '$nro_chapa', '$estado', '$color')") or die('Error'.mysqli_error($mysqli));

            // Verificando si la inserción fue exitosa
            if($query){
                header("Location: ../../main.php?module=movil&alert=1");
            } else {
                header("Location: ../../main.php?module=movil&alert=4");
            }
        }
    }

    elseif($_GET['act']=='update'){
        if(isset($_POST['Guardar'])){
            if(isset($_POST['id_movil'])){
                // Recibiendo datos del formulario
                $id_movil = $_POST['id_movil'];
                $id_modelo = $_POST['id_modelo'];
                $nro_chapa = $_POST['nro_chapa'];
                $estado = $_POST['estado'];
                $color = $_POST['color'];

                // Actualizando los datos en la tabla 'movil'
                $query = mysqli_query($mysqli, "UPDATE movil SET 
                                                id_modelo = $id_modelo,
                                                nro_chapa = '$nro_chapa',
                                                estado = '$estado',
                                                color = '$color'
                                                WHERE id_movil = $id_movil
                                                ")
                                                or die('Error'.mysqli_error($mysqli));

                // Verificando si la actualización fue exitosa
                if($query){
                    header("Location: ../../main.php?module=movil&alert=2");
                } else {
                    header("Location: ../../main.php?module=movil&alert=4");
                }                                                    

            }
        }
    }

    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_movil'])){
            $id_movil = $_GET['id_movil'];

            // Eliminando el registro de la tabla 'movil'
            $query = mysqli_query($mysqli, "DELETE FROM movil
                                            WHERE id_movil = $id_movil")
                                            or die('Error'.mysqli_error($mysqli));

            // Verificando si la eliminación fue exitosa
            if($query){
                header("Location: ../../main.php?module=movil&alert=3");
            } else {
                header("Location: ../../main.php?module=movil&alert=4");
            }
        }
    }

}

?>
