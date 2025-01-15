<?php 
    include "config/database.php";
    
    // Obtener los datos del usuario desde la base de datos
    $query = mysqli_query($mysqli, "SELECT id_user, name_user, foto, permisos_acceso FROM usuarios WHERE id_user='$_SESSION[id_user]'")
    or die('Error: '.mysqli_error($mysqli));

    $data = mysqli_fetch_assoc($query);
?>
<div class="account-wrap">
    <div class="account-item clearfix js-item-menu">
        <div class="image">
            <?php 
                // Verifica si el usuario tiene foto o usa una imagen por defecto
                if($data['foto'] == ""){ ?>
                    <img src="images/user/user-default.png" alt="<?php echo $data['name_user']; ?>" />
                <?php } else { ?>
                    <img src="images/user/<?php echo $data['foto']; ?>" alt="<?php echo $data['name_user']; ?>" />
                <?php } ?>
        </div>
        <div class="content">
            <a class="js-acc-btn" href="#"><?php echo $data['name_user']; ?></a>
        </div>
        <div class="account-dropdown js-dropdown">
            <div class="info clearfix">
                <div class="image">
                    <a href="#">
                        <?php 
                            // Muestra la foto del usuario en la vista de detalles
                            if($data['foto'] == ""){ ?>
                                <img src="images/user/user-default.png" alt="<?php echo $data['name_user']; ?>" />
                            <?php } else { ?>
                                <img src="images/user/<?php echo $data['foto']; ?>" alt="<?php echo $data['name_user']; ?>" />
                            <?php } ?>
                    </a>
                </div>
                <div class="content">
                    <h5 class="name">
                        <a href="#"><?php echo $data['name_user']; ?></a>
                    </h5>
                    <span class="email"><?php echo $data['permisos_acceso']; ?></span>
                </div>
            </div>
            <div class="account-dropdown__body">
                <div class="account-dropdown__item">
                    <a href="?module=perfil">
                        <i class="zmdi zmdi-account"></i>Perfil</a>
                </div>
            </div>
            <div class="account-dropdown__footer">
                <a href="logout.php" onclick="confirmLogout(event)">
                 <i class="zmdi zmdi-power"></i> Cerrar sesión
                </a>
            </div>
        </div>
    </div>
</div>
