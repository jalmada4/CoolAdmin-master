 <!-- Menú lateral -->
 <aside class="menu-sidebar d-none d-lg-block" style="background-image: linear-gradient(rgba(0, 100, 0, 0.7), rgba(0, 100, 0, 0.7)), url('images/user/process.jpg'); background-size: cover; background-position: center;">
 >
    <div class="logo">
        <a href="?module=start">
            <img src="images/icon/logo-blue.png" alt="Cool Admin" />
        </a>
    </div>
    
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <!-- Menú inicio -->
                <?php 
                if ($_SESSION['permisos_acceso'] == 'Super Admin') {
                    $active_home = ($_GET["module"] == "start") ? "active" : "";
                ?>
                    
                    <li class="<?php echo $active_home; ?>">
                        <a href="?module=start" style="color: darkturquoise;">
                            <i class="fa fa-home" style="color: darkgoldenrod;"></i> Inicio
                        </a>
                    </li>

                <!-- Referenciales Generales -->
                    <li class="has-sub <?php echo ($_GET["module"] == "departamento" || $_GET["module"] == "ciudad") ? "active" : ""; ?>">
                        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
                            Referencial General<i class="fas fa-sort-desc pull-right"></i>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li><a href="?module=departamento" style="color: darkturquoise;"><i class="fas fa-circle-o"></i>Departamento</a></li>
                            <li><a href="?module=ciudad" style="color: darkturquoise;"><i class="fas fa-circle-o"></i>Ciudad</a></li>
                        </ul>
                    </li>

                <!-- Referenciales de Compras -->
                    <li class="has-sub <?php echo ($_GET["module"] == "deposito" || $_GET["module"] == "proveedor" || $_GET["module"] == "producto" || $_GET["module"] == "tipo_producto" || $_GET["module"] == "umedida") ? "active" : ""; ?>">
                        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
                            Referencial Compra<i class="fas fa-sort-desc pull-right"></i>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li><a href="?module=deposito" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Depósito</a></li>
                            <li><a href="?module=proveedor" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Proveedor</a></li>
                            <li><a href="?module=producto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Producto</a></li>
                            <li><a href="?module=tipo_producto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Tipo de Producto</a></li>
                            <li><a href="?module=umedida" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
                            <li><a href="?module=pedidos" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Pedidos</a></li>
                            <li><a href="?module=presupuesto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Presupuesto</a></li>
                            <li><a href="?module=orden" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Orden</a></li>


                        </ul>
                    </li>

                <!-- Referenciales de Ventas -->
                    <li class="has-sub <?php echo ($_GET["module"] == "clientes") ? "active" : ""; ?>">
                        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
                            Referencial Ventas<i class="fas fa-sort-desc pull-right"></i>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li><a href="?module=clientes" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Clientes</a></li>
                            <li><a href="?module=caja" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Caja</a></li>
                            <li><a href="?module=caja_apertura_cierre" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Apertura/Cierre</a></li>
                            <li><a href="?module=marca" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>marca</a></li>
                            <li><a href="?module=modelo" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>modelo</a></li>
                            <li><a href="?module=movil" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Movil</a></li>
                            <li><a href="?module=chofer" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Chofer</a></li>        
                            <li><a href="?module=nota_remision" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Nota remision</a></li>

                        </ul>
                    </li>

                    <li class="has-sub <?php echo ($_GET["module"] == "informes"); ?>">
                        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
                            Referencial informes<i class="fas fa-sort-desc pull-right"></i>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li><a href="?module=informes_compra" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Informes Compra</a></li>
                            <li><a href="?module=informes_venta" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Informes Venta</a></li>
                            <li><a href="?module=informes_pedido" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Informes Pedido</a></li>
                            <li><a href="?module=informes_presupuesto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Info. Presupuesto</a></li>
                            <li><a href="?module=informes_orden" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Informes Orden</a></li>
                            <li><a href="?module=informes_caja_apertura_cierre" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Info. Apertura Cierre</a></li>
                            <li><a href="?module=informes_nota_remision" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Info. Nota Remision</a></li>

                        </ul>
                    </li>


                <!-- Administrar Usuarios -->
                    <li class="<?php echo ($_GET['module'] == 'user' || $_GET['module'] == 'form_user') ? 'active' : ''; ?>">
                        <a href="?module=user" style="color: darkturquoise;">
                            <i class="fa fa-user"></i> Administrar usuarios
                        </a>
                    </li>

                <!-- Cambiar Contraseña -->
                    <li class="<?php echo ($_GET['module'] == 'password') ? 'active' : ''; ?>">
                        <a href="?module=password" style="color: darkturquoise;">
                            <i class="fa fa-user"></i> Cambiar contraseña
                        </a>
                    </li>
            </ul>
        </nav>
    </div>
       
<?php } 

//acceso compras
elseif ($_SESSION['permisos_acceso'] == 'Compras') {
    $active_home = ($_GET["module"] == "start") ? "active" : "";
?>
    
    <li class="<?php echo $active_home; ?>">
        <a href="?module=start" style="color: darkturquoise;">
            <i class="fa fa-home" style="color: darkgoldenrod;"></i> Inicio
        </a>
    </li>

<!-- Referenciales Generales -->
    <li class="has-sub <?php echo ($_GET["module"] == "departamento" || $_GET["module"] == "ciudad") ? "active" : ""; ?>">
        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
            Referencial General<i class="fas fa-sort-desc pull-right"></i>
        </a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">
            <li><a href="?module=departamento" style="color: darkturquoise;"><i class="fas fa-circle-o"></i>Departamento</a></li>
            <li><a href="?module=ciudad" style="color: darkturquoise;"><i class="fas fa-circle-o"></i>Ciudad</a></li>
        </ul>
    </li>

<!-- Referenciales de Compras -->
    <li class="has-sub <?php echo ($_GET["module"] == "deposito" || $_GET["module"] == "proveedor" || $_GET["module"] == "producto" || $_GET["module"] == "tipo_producto" || $_GET["module"] == "umedida") ? "active" : ""; ?>">
        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
            Referencial Compra<i class="fas fa-sort-desc pull-right"></i>
        </a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">
            <li><a href="?module=deposito" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Depósito</a></li>
            <li><a href="?module=proveedor" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Proveedor</a></li>
            <li><a href="?module=producto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Producto</a></li>
            <li><a href="?module=tipo_producto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Tipo de Producto</a></li>
            <li><a href="?module=umedida" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
            <li><a href="?module=pedidos" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Pedidos</a></li>
            <li><a href="?module=presupuesto" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Presupuesto</a></li>
            <li><a href="?module=orden" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Orden</a></li>


        </ul>
    </li>

            

                <!-- Cambiar Contraseña -->
                <li class="<?php echo ($_GET['module'] == 'password') ? 'active' : ''; ?>">
                        <a href="?module=password" style="color: darkturquoise;">
                            <i class="fa fa-user"></i> Cambiar contraseña
                        </a>
                    </li>


    </ul>
<?php }

//acceso usuario ventas
elseif ($_SESSION['permisos_acceso'] == 'Ventas') {
    $active_home = ($_GET["module"] == "start") ? "active" : "";
?>
    
    <li class="<?php echo $active_home; ?>">
        <a href="?module=start" style="color: darkturquoise;">
            <i class="fa fa-home" style="color: darkgoldenrod;"></i> Inicio
        </a>
    </li>

<!-- Referenciales Generales -->
    <li class="has-sub <?php echo ($_GET["module"] == "departamento" || $_GET["module"] == "ciudad") ? "active" : ""; ?>">
        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
            Referencial General<i class="fas fa-sort-desc pull-right"></i>
        </a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">
            <li><a href="?module=departamento" style="color: darkturquoise;"><i class="fas fa-circle-o"></i>Departamento</a></li>
            <li><a href="?module=ciudad" style="color: darkturquoise;"><i class="fas fa-circle-o"></i>Ciudad</a></li>
        </ul>
    </li>

               

                 <!-- Referenciales de Ventas -->
                 <li class="has-sub <?php echo ($_GET["module"] == "clientes") ? "active" : ""; ?>">
                        <a class="js-arrow" href="javascript:void(0);" style="color: darkturquoise;">
                            Referencial Ventas<i class="fas fa-sort-desc pull-right"></i>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li><a href="?module=clientes" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Clientes</a></li>
                            <li><a href="?module=caja" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Caja</a></li>
                            <li><a href="?module=caja_apertura_cierre" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Apertura/Cierre</a></li>
                            <li><a href="?module=marca" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>marca</a></li>
                            <li><a href="?module=modelo" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>modelo</a></li>
                            <li><a href="?module=movil" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Movil</a></li>
                            <li><a href="?module=chofer" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Chofer</a></li>        
                            <li><a href="?module=nota_remision" style="color: darkturquoise;"><i class="fa fa-circle-o"></i>Nota remision</a></li>

                        </ul>
                    </li>

                
                     <!-- Cambiar Contraseña -->
                     <li class="<?php echo ($_GET['module'] == 'password') ? 'active' : ''; ?>">
                             <a href="?module=password" style="color: darkturquoise;">
                                 <i class="fa fa-user"></i> Cambiar contraseña
                             </a>
                         </li>

               

        <?php //} ?>

    </ul>

<?php
}
?>
</aside> 
                
            
      
    

