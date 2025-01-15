<section class="content-header">
<ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li class="active"><a href="?module=producto">Producto</a></li>
</ol><br><hr>
<h1>
    <i class="fa fa-folder icon-title"></i>Datos de Productos
    <a class="btn btn-primary btn-social pull-right" href="?module=form_producto&form=add" title="Agregar" data-toggle="tooltip">
        <i class="fa fa-plus"></i>Agregar
    </a>
</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
            if(empty($_GET['alert'])){
                echo "";
            }
            elseif($_GET['alert']==1){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos registrados correctamente
                </div>";
            }
            elseif($_GET['alert']==2){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos Modificados correctamente
                </div>";
            }
            elseif($_GET['alert']==3){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos Eliminados correctamente
                </div>";
            }
            elseif($_GET['alert']==4){
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Error!</h4>
                No se pudo realizar la operación
                </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                <section class="content-header">
                    <a class="btn btn-warning btn-social pull-right" href="modules/producto/print.php" target="_blank">
                    <i class="fa fa-print"></i>Imprimir
                    </a>
                </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Productos</h2>
                        <thead>
                            <tr>
                                <th class="center">Código</th>
                                <th class="center">Tipo de Producto</th>
                                <th class="center">Producto</th>
                                <th class="center">U. Medida</th>
                                <th class="center">Precio</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $nro=1;
                            $query = mysqli_query($mysqli, "SELECT p.cod_producto, p.p_descrip, p.precio,
       tp.cod_tipo_prod, tp.t_p_descrip, um.u_descrip
FROM producto p
JOIN tipo_producto tp ON p.cod_tipo_prod = tp.cod_tipo_prod
JOIN u_medida um ON p.id_u_medida = um.id_u_medida")
                            or die('Error'.mysqli_error($mysqli));

                            while($data = mysqli_fetch_assoc($query)){
                               $codigo = $data['cod_producto'];
                               $t_p_descrip = $data['t_p_descrip'];
                               $p_descrip = $data['p_descrip'];
                               $u_descrip = $data['u_descrip'];
                               $precio = $data['precio'];

                               echo "<tr>
                               <td class='center'>$codigo</td>
                               <td class='center'>$t_p_descrip</td>
                               <td class='center'>$p_descrip</td>
                               <td class='center'>$u_descrip</td>
                               <td class='center'>$precio</td>
                               <td class='center' width='80'>
                               <div>
                               <a data-toggle='tooltip' data-placement='top' title='Modificar datos de Producto' style='margin-right:5px' 
                               class='btn btn-primary btn-sm' href='?module=form_producto&form=edit&id=$data[cod_producto]'>
                                    <i class='fas fa-pencil-square' style='color:#fff'></i> </a>";
                                ?>
                                <a data-toggle="tooltip" data-data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm" 
                                href="modules/producto/proses.php?act=delete&cod_producto=<?php echo $data['cod_producto']; ?>"
                                onclick="return confirm('¿Estás seguro/a de eliminar <?php echo $data['p_descrip']; ?>?')">
                                    <i class="fas fa-times"></i>
                                </a>
                                <?php 
                                echo "</div>
                                </td>
                                </tr>" ?>
                            <?php }                               
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>