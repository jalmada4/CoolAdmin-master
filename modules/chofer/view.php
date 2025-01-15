<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=chofer">Choferes</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos de Chofer
        <a class="btn btn-primary btn-social pull-right" href="?module=form_chofer&form=add" title="Agregar" data-toggle="tooltip">
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
                        <a class="btn btn-warning btn-social pull-right" href="modules/chofer/print.php" target="_blank">
                        <i class="fa fa-print"></i>Imprimir
                        </a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Choferes</h2>
                        <thead>
                            <tr>
                                <th class="center">ID Chofer</th>
                                <th class="center">Nombre</th>
                                <th class="center">Apellido</th>
                                <th class="center">Cédula</th>
                                <th class="center">Teléfono</th>
                                <th class="center">Licencia</th>
                                <th class="center">Estado</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $nro=1;
                            // Modificación de la consulta para obtener los datos de chofer
                            $query = mysqli_query($mysqli, "SELECT * FROM chofer")
                                or die('Error'.mysqli_error($mysqli));
                            while($data = mysqli_fetch_assoc($query)){
                               $id_chofer = $data['id_chofer'];
                               $chof_nombre = $data['chof_nombre'];
                               $chof_apellido = $data['chof_apellido'];
                               $chof_cedula = $data['chof_cedula'];
                               $chof_telefono = $data['chof_telefono'];
                               $licencia = $data['licencia'];
                               $estado = $data['estado'];

                               echo "<tr>
                               <td class='center'>$id_chofer</td>
                               <td class='center'>$chof_nombre</td>
                               <td class='center'>$chof_apellido</td>
                               <td class='center'>$chof_cedula</td>
                               <td class='center'>$chof_telefono</td>
                               <td class='center'>$licencia</td>
                               <td class='center'>$estado</td>
                               <td class='center' width='80'>
                               <div>
                               <a data-toggle='tooltip' data-placement='top' title='Modificar datos del chofer' style='margin-right:5px' 
                               class='btn btn-primary btn-sm' href='?module=form_chofer&form=edit&id=$data[id_chofer]'>
                                    <i class='fas fa-pencil-square' style='color:#fff'></i> </a>";
                                ?>
                                <a data-toggle="tooltip" data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm" 
                                href="modules/chofer/proses.php?act=delete&id_chofer=<?php echo $data['id_chofer']; ?>"
                                onclick="return confirm('¿Estás seguro/a de eliminar <?php echo $data['chof_nombre']; ?>?')">
                                    <i class="fas fa-times"></i>
                                </a>
                                <?php 
                                echo "</div>
                                </td>
                                </tr>";
                            }                               
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
