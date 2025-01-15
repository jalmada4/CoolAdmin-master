<?php 

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else {
    // Acción de insertar
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            $marca_descrip = $_POST['marca_descrip'];

            // Insertar los datos de la nueva marca
            $query = mysqli_query($mysqli, "INSERT INTO marca (id_marca, marca_descrip)
            VALUES ($codigo, '$marca_descrip')") or die('Error'.mysqli_error($mysqli));
            
            if($query){
                // Redirigir a la página principal con un mensaje de éxito
                header("Location: ../../main.php?module=marca&alert=1");
            } else {
                // Redirigir a la página principal con un mensaje de error
                header("Location: ../../main.php?module=marca&alert=4");
            }
        }
    }
    // Acción de actualizar
    elseif($_GET['act']=='update'){
        if(isset($_POST['Guardar'])){
            if(isset($_POST['codigo'])){
                $codigo = $_POST['codigo'];
                $marca_descrip = $_POST['marca_descrip'];
                
                // Actualizar los datos de la marca
                $query = mysqli_query($mysqli, "UPDATE marca SET marca_descrip = '$marca_descrip'
                                                                    WHERE id_marca = $codigo")
                                                                    or die('Error'.mysqli_error($mysqli));

                if($query){
                    // Redirigir a la página principal con un mensaje de éxito
                    header("Location: ../../main.php?module=marca&alert=2");
                } else {
                    // Redirigir a la página principal con un mensaje de error
                    header("Location: ../../main.php?module=marca&alert=4");
                }                                                    
            }
        }
    }
    // Acción de eliminar
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_marca'])){
            $codigo = $_GET['id_marca'];

            // Eliminar la marca de la base de datos
            $query = mysqli_query($mysqli, "DELETE FROM marca
                                            WHERE id_marca = $codigo")
                                            or die('Error'.mysqli_error($mysqli));
            if($query){
                // Redirigir a la página principal con un mensaje de éxito
                header("Location: ../../main.php?module=marca&alert=3");
            } else {
                // Redirigir a la página principal con un mensaje de error
                header("Location: ../../main.php?module=marca&alert=4");
            }
        }
    }

}

?>
