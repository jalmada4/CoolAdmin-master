<?php 
    if($_SESSION['permisos_acceso'] == 'Super Admin'){ ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-title"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p style="font-size:15px">
                        <i class="icon fa fa-user"></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?> </strong>
                        a la aplicación: <strong>SysPro</strong>
                    </p>
                </div> 
            </div>
        </div>

        <h2>Fomulario de movimiento</h2>
        <!--Fila principal de los bloques-->
        <div class="row">
          <!-- Bloque 1 Compras-->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c1">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-money"></i>               
                </div>
                <div class="text">
                    <h2><strong style="color: whitesmoke;">Compras</strong></h2>
                    <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                    <li><a href="?module=pedidos" style="color: black; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='darkturquoise';" onmouseout="this.style.color='black';">Pedidos</a></li>
                    <li><a href="?module=presupuesto" style="color: black; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='darkturquoise';" onmouseout="this.style.color='black';">Presupuesto</a></li>
                    <li><a href="?module=orden" style="color: black; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='darkturquoise';" onmouseout="this.style.color='black';">Orden</a></li>

                </ul>
                </div>
            </div>
            <a href="?module=compras" class="small-box-footer" title="Registrar Compras" data-toggle="tooltip"> 
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<!-- FIN Bloque 1 Compras-->


           <!-- Bloque 2 Ventas -->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c2">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div><br>
                <div class="text">
                    <h2><strong style="color: whitesmoke;">Ventas</strong></h2>
                    <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                    <li><a href="?module=caja_apertura_cierre" style="color: black; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='darkturquoise';" onmouseout="this.style.color='black';">Apertura/Cierre</a></li>
                    <li><a href="?module=nota_remision" style="color: black; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='darkturquoise';" onmouseout="this.style.color='black';">Nota de Remision</a></li>
                    <li><a href="?module=clientes" style="color: black; text-decoration: none; transition: color 0.3s ease;" onmouseover="this.style.color='darkturquoise';" onmouseout="this.style.color='black';">Clientes</a></li>

                    </ul>
                </div>
            </div>
            <a href="?module=ventas" class="small-box-footer" title="Registrar Ventas" data-toggle="tooltip">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<!-- FIN Bloque 2 Ventas -->

<!--Bloque 3 Stock-->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c3">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-calendar-note"></i> <!-- Icono agregado -->
                </div>
            </div>          
        </div>
            <h2><strong style="color: whitesmoke;">Stock</strong></h2>
            <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <li>Visualizar</li>
                <li> Stock </li>
                <li> de Productos</li>
            </ul>
        <a href="?module=stock" class="small-box-footer" title="Ver Stock de productos" data-toggle="tooltip">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>
            <!-- FIN Bloque 3 Stock-->

            
            
        </div>
    </section>
<?php  }
       elseif ($_SESSION['permisos_acceso'] == 'Compras') { ?>
           <section class="content-header">
        <h1>
            <i class="fa fa-home icon-title"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p style="font-size:15px">
                        <i class="icon fa fa-user"></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?> </strong>
                        a la aplicación: <strong>SysPro</strong>
                    </p>
                </div> 
            </div>
        </div>

        <h2>Fomulario de movimiento</h2>
        <!--Fila principal de los bloques-->
        <div class="row">
          <!-- Bloque 1 Compras-->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c1">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-money"></i>               
                </div>
                <div class="text">
                    <h2><strong style="color: whitesmoke;">Compras</strong></h2>
                    <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                        <li>Registrar</li>
                        <li>la Compra</li>
                        <li>de Productos</li>
                    </ul>
                </div>
            </div>
            <a href="?module=compras" class="small-box-footer" title="Registrar Compras" data-toggle="tooltip"> 
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<!-- FIN Bloque 1 Compras-->


<!--Bloque 3 Stock-->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c3">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-calendar-note"></i> <!-- Icono agregado -->
                </div>
            </div>          
        </div>
            <h2><strong style="color: whitesmoke;">Stock</strong></h2>
            <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <li>Visualizar</li>
                <li> Stock </li>
                <li> de Productos</li>
            </ul>
        <a href="?module=stock" class="small-box-footer" title="Ver Stock de productos" data-toggle="tooltip">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>
            <!-- FIN Bloque 3 Stock-->

            
        
        </div>
    </section>         
<?php }
elseif($_SESSION['permisos_acceso'] == 'Ventas'){ ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-title"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p style="font-size:15px">
                        <i class="icon fa fa-user"></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?> </strong>
                        a la aplicación: <strong>SysPro</strong>
                    </p>
                </div> 
            </div>
        </div>

        <h2>Fomulario de movimiento</h2>
        <!--Fila principal de los bloques-->
        <div class="row">

                      <!-- Bloque 2 Ventas -->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c2">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div><br>
                <div class="text">
                    <h2><strong style="color: whitesmoke;">Ventas</strong></h2>
                    <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                        <li>Registrar</li>
                        <li>Ventas</li>
                        <li>de Productos</li>
                    </ul>
                </div>
            </div>
            <a href="?module=ventas" class="small-box-footer" title="Registrar Ventas" data-toggle="tooltip">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<!-- FIN Bloque 2 Ventas -->
        
 <!--Bloque 3 Stock-->
<div class="col-sm-6 col-lg-3">
    <div class="overview-item overview-item--c3">
        <div class="overview__inner">
            <div class="overview-box clearfix">
                <div class="icon">
                    <i class="zmdi zmdi-calendar-note"></i> <!-- Icono agregado -->
                </div>
            </div>          
        </div>
            <h2><strong style="color: whitesmoke;">Stock</strong></h2>
            <ul style="color: black; font-family: Verdana, Geneva, Tahoma, sans-serif;">
                <li>Visualizar</li>
                <li> Stock </li>
                <li> de Productos</li>
            </ul>
        <a href="?module=stock" class="small-box-footer" title="Ver Stock de productos" data-toggle="tooltip">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>
<!-- FIN Bloque 3 Stock-->

           
            
        </div>
    </section>
<?php  }

?>