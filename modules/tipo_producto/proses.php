<?php 
session_start();
require_once "../../config/database.php";

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    // Método para insertar un nuevo departamento
    if($_GET['act'] == 'insert'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            $dep_descripcion = $_POST['dep_descripcion'];

            $query = mysqli_query($mysqli, "INSERT INTO tipo_producto (cod_tipo_prod, t_p_descrip)
            VALUES ($codigo, '$dep_descripcion')") or die('Error '.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=tipo_producto&alert=1");
            } else {
                header("Location: ../../main.php?module=tipo_producto&alert=4"); 
            }
        }
    }

    // Método para eliminar un departamento
    if($_GET['act'] == 'delete'){
        if(isset($_GET['cod_tipo_prod'])){
            $codigo = $_GET['cod_tipo_prod'];

            $query = mysqli_query($mysqli, "DELETE FROM tipo_producto WHERE cod_tipo_prod = $codigo")
            or die('Error '.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=tipo_producto&alert=3");
            } else {
                header("Location: ../../main.php?module=tipo_producto&alert=4");
            }
        }
    }

    // Método para modificar un departamento
    if($_GET['act'] == 'update'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            $dep_descripcion = $_POST['dep_descripcion'];

            $query = mysqli_query($mysqli, "UPDATE tipo_producto SET t_p_descrip = '$dep_descripcion' 
            WHERE cod_tipo_prod = $codigo") or die('Error '.mysqli_error($mysqli));

            if($query){
                header("Location: ../../main.php?module=tipo_producto&alert=2");
            } else {
                header("Location: ../../main.php?module=tipo_producto&alert=4");
            }
        }
    }
}
?>
