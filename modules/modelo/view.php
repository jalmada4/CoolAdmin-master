<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=modelo">Modelo</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos de Modelos
        <a class="btn btn-primary btn-social pull-right" href="?module=form_modelo&form=add" title="Agregar" data-toggle="tooltip">
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
                    <a class="btn btn-warning btn-social pull-right" href="modules/modelo/print.php" target="_blank">
                    <i class="fa fa-print"></i>Imprimir
                    </a>
                </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Modelos</h2>
                        <thead>
                            <tr>
                                <th class="center">Código</th>
                                <th class="center">Marca</th>
                                <th class="center">Descripción</th>
                                <th class="center">Año</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $nro=1;
                            $query = mysqli_query($mysqli, "SELECT m.id_modelo, m.id_marca, m.mod_descrip, m.anho, ma.marca_descrip 
                                                            FROM modelo m 
                                                            LEFT JOIN marca ma ON m.id_marca = ma.id_marca")
                                                            or die('Error'.mysqli_error($mysqli));
                            while($data = mysqli_fetch_assoc($query)){
                               $id_modelo = $data['id_modelo'];
                               $id_marca = $data['id_marca'];
                               $marca_descrip = $data['marca_descrip'];
                               $mod_descrip = $data['mod_descrip'];
                               $anho = $data['anho'];

                               echo "<tr>
                               <td class='center'>$id_modelo</td>
                               <td class='center'>$marca_descrip</td>
                               <td class='center'>$mod_descrip</td>
                               <td class='center'>$anho</td>
                               <td>
                               <div>
                               <a data-toggle='tooltip' data-placement='top' title='Modificar datos de Modelo' style='margin-right:5px' 
                               class='btn btn-primary btn-sm' href='?module=form_modelo&form=edit&id=$data[id_modelo]'>
                                    <i class='fas fa-pencil-square' style='color:#fff'></i> </a>";
                                ?>
                                <a data-toggle="tooltip" data-data-placement="top" title="Eliminar datos" class="btn btn-danger btn-sm" 
                                href="modules/modelo/proses.php?act=delete&id_modelo=<?php echo $data['id_modelo']; ?>"
                                onclick="return confirm('¿Estás seguro/a de eliminar <?php echo $data['mod_descrip']; ?>?')">
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
