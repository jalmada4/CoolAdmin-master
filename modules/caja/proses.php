<?php 

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else {
    // Acción para insertar
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            $descrip = $_POST['descrip'];
            $id_aper_cierre = $_POST['id_aper_cierre']; // Nuevo campo

            // Consulta para insertar en la tabla caja
            $query = mysqli_query($mysqli, "INSERT INTO caja (id_caja, caja_descrip, id_aper_cierre)
            VALUES ($codigo, '$descrip', $id_aper_cierre)") or die('Error'.mysqli_error($mysqli));
            
            // Comprobar si la inserción fue exitosa
            if($query){
                header("Location: ../../main.php?module=caja&alert=1"); // Redirigir con mensaje de éxito
            } else {
                header("Location: ../../main.php?module=caja&alert=4"); // Redirigir con mensaje de error
            }
        }
    }
    // Acción para actualizar
    elseif($_GET['act']=='update'){
        if(isset($_POST['Guardar'])){
            if(isset($_POST['codigo'])){
                $codigo = $_POST['codigo'];
                $descrip = $_POST['caja_descrip']; // Campo de descripción de la caja
                $id_aper_cierre = $_POST['id_aper_cierre']; // Nuevo campo

                // Consulta para actualizar la tabla caja
                $query = mysqli_query($mysqli, "UPDATE caja 
                                                SET caja_descrip = '$descrip', id_aper_cierre = $id_aper_cierre 
                                                WHERE id_caja = $codigo") 
                                                or die('Error'.mysqli_error($mysqli));

                // Comprobar si la actualización fue exitosa
                if($query){
                    header("Location: ../../main.php?module=caja&alert=2"); // Redirigir con mensaje de éxito
                } else {
                    header("Location: ../../main.php?module=caja&alert=4"); // Redirigir con mensaje de error
                }
            }
        }
    }
    // Acción para eliminar
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_caja'])){
            $codigo = $_GET['id_caja'];

            // Consulta para eliminar de la tabla caja
            $query = mysqli_query($mysqli, "DELETE FROM caja WHERE id_caja = $codigo") 
                    or die('Error'.mysqli_error($mysqli));

            // Comprobar si la eliminación fue exitosa
            if($query){
                header("Location: ../../main.php?module=caja&alert=3"); // Redirigir con mensaje de éxito
            } else {
                header("Location: ../../main.php?module=caja&alert=4"); // Redirigir con mensaje de error
            }
        }
    }
}
?>
