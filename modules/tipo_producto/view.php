<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=tipo_producto">Tipo Producto</a></li>
    </ol>
    <h1>
    <i class="fa fa-folder icon-title"></i>Tipo Producto
    <a class="btn btn-primary btn-social pull-right" href="?module=form_tipo_producto&form=add" title="Agregar" data-toggle="tooltip">
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
                <h4> <i class='icon fa fa-check-circle'></i>Exitoso!</h4>
                Datos registrado correctamente
                </div>";
            }
            elseif($_GET['alert']==2){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4> <i class='icon fa fa-check-circle'></i>Exitoso!</h4>
                Datos modificado correctamente
                </div>";
            }
            elseif($_GET['alert']==3){
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4> <i class='icon fa fa-check-circle'></i>Exitoso!</h4>
                Datos eliminado correctamente
                </div>";
            }
            elseif($_GET['alert']==4){
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4> <i class='icon fa fa-check-circle'></i>Erro!</h4>
                No se pudo realizar la operación.
                </div>";
            }
            ?>
            <div class="box box-primary">
                <div class="box-body">
                    <section class="content-header">
                        <a class="btn btn-warning btn-social pull-right" href="modules/tipo_producto/print.php" target="_blank">
                            <i class="fa fa-print"></i>Imprimir
                        </a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Tipos de Productos</h2>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th class="col-sm-2">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $nr1 = mysqli_query($mysqli, "SELECT * FROM tipo_producto") 
                        or die('Error: ' . mysqli_error($mysqli));

                        while($data = mysqli_fetch_assoc($nr1)){
                            $id_departamento = $data['cod_tipo_prod'];
                            $dep_descripcion = $data['t_p_descrip'];
                            echo "<tr>
                                    <td class='center'>$id_departamento</td>
                                    <td class='center'>$dep_descripcion</td>
                                    <td class='center' width='80'>
                                        <div>
                                            <a data-toggle='tooltip' data-placement='top' title='Modificar datos del departamento' 
                                            style='margin-right:5px' class='btn btn-primary btn-sm' 
                                            href='?module=form_tipo_producto&form=edit&id=$id_departamento'>
                                                <i class='fas fa-pencil-square' style='color:#fff'></i> </a>";
                                        
                                ?>
                                <a data-toggle="tooltip" data-data-placement="top" title="Eliminar Datos" class="btn btn-danger btn-sm"
                                 href="modules/tipo_producto/proses.php?act=delete&cod_tipo_prod=<?php echo $data['cod_tipo_prod']; ?>" 
                                 onclick="return confirm('Estás seguro/a de eliminar: <?php echo $data['t_p_descrip'] ; ?> ?')">
                                <i class="fas fa-times"></i>
                            </a>
                            <?php 
                                echo 
                                "</div>
                                </td>
                                </tr>
                                "
                            ?>

                        <?php }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>