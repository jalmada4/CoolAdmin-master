<?php 

session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else {
    // Agregar nuevo modelo (insert)
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            $id_marca = $_POST['id_marca'];
            $mod_descrip = $_POST['mod_descrip'];
            $anho = $_POST['anho'];

            // Inserción en la tabla modelo
            $query = mysqli_query($mysqli, "INSERT INTO modelo (id_modelo, id_marca, mod_descrip, anho)
            VALUES ($codigo, $id_marca, '$mod_descrip', '$anho')") or die('Error'.mysqli_error($mysqli));
            
            if($query){
                header("Location: ../../main.php?module=modelo&alert=1");
            } else {
                header("Location: ../../main.php?module=modelo&alert=4");
            }

        }
    }
    // Actualizar datos del modelo (update)
    elseif($_GET['act']=='update'){
        if(isset($_POST['Guardar'])){
            if(isset($_POST['codigo'])){
                $codigo = $_POST['codigo'];
                $id_marca = $_POST['id_marca'];
                $mod_descrip = $_POST['mod_descrip'];
                $anho = $_POST['anho'];

                // Actualización de los datos del modelo
                $query = mysqli_query($mysqli, "UPDATE modelo SET id_marca = $id_marca,
                                                                 mod_descrip = '$mod_descrip',
                                                                 anho = '$anho'
                                                                 WHERE id_modelo = $codigo
                                                                 ")
                                                                 or die('Error'.mysqli_error($mysqli));

                if($query){
                    header("Location: ../../main.php?module=modelo&alert=2");
                } else {
                    header("Location: ../../main.php?module=modelo&alert=4");
                }                                                    
            }
        }

    }
    // Eliminar un modelo (delete)
    elseif($_GET['act']=='delete'){
        if(isset($_GET['id_modelo'])){
            $codigo = $_GET['id_modelo'];

            // Eliminación del modelo
            $query = mysqli_query($mysqli, "DELETE FROM modelo
                                            WHERE id_modelo = $codigo")
                                            or die('Error'.mysqli_error($mysqli));
            if($query){
                header("Location: ../../main.php?module=modelo&alert=3");
            } else {
                header("Location: ../../main.php?module=modelo&alert=4");
            }
        }
    }

}

?>
