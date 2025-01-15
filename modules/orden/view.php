<section class="content-header">
<ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li class="active"><a href="?module=orden">Ordenes</a></li>
</ol><br><hr>
<h1>
    <i class="fa fa-folder icon-title"></i>Datos de Orden
    <a class="btn btn-primary btn-social pull-right" href="?module=form_orden&form=add" title="Agregar" data-toggle="tooltip">
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
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Orden</h2>
                        <thead>
                            <tr>
                                <th class="center">Orden</th>
                                <th class="center">presupuesto</th>
                                <th class="center">usuario</th>
                                <th class="center">Fecha Emision</th>
                                <th class="center">Estado</th>
                                <th class="center">Hora</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $nro=1;
                            $query = mysqli_query($mysqli, "SELECT * FROM vista_orden WHERE estado IN ('activo', 'pendiente')")
                            or die('Error'.mysqli_error($mysqli));
                        

                            while($data = mysqli_fetch_assoc($query)){
                               $id_orden = $data['id_orden'];
                               $id_presup = $data['id_presup'];
                               $name_user = $data['name_user'];
                               $fecha_emision = $data['fecha_emision'];
                               $estado = $data['estado'];
                               $hora = $data['hora'];

                               echo "<tr>
                               <td class='center'>$id_orden</td>
                               <td class='center'>$id_presup</td>
                               <td class='center'>$name_user</td>
                               <td class='center'>$fecha_emision</td>
                               <td class='center'>$estado</td>
                               <td class='center'>$hora</td>
                               <td class='center' width='80'>
                               <div>  "; ?>

                                <a data-toggle="tooltip" data-placement="top" title="Anular orden" class="btn btn-danger btn-sm"
                                    href="modules/orden/proses.php?act=anular&id_orden=<?php echo $data['id_orden']; ?>"
                                    onclick="return confirm('Estás seguro/a de anular el orden   <?php echo $data['id_orden']; ?>?');">
                                    <i style="color: black;" class="fas fa-times-circle"></i>
                                </a>


                              
                                <a data-toggle="tooltip" data-placement="top" title="Imprimir orden" class="btn btn-warning btn-sm"
                                href="modules/orden/print.php?act=imprimir&id_orden=<?php echo $data['id_orden']; ?>" target="_blank">
                                    <i style="color: black;" class="fa fa-print"></i>
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