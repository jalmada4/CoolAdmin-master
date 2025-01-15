<section class="content-header">
<ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li class="active"><a href="?module=pedidos">Pedidos</a></li>
</ol><br><hr>
<h1>
    <i class="fa fa-folder icon-title"></i>Datos de Pedidos
    <a class="btn btn-primary btn-social pull-right" href="?module=form_pedidos&form=add" title="Agregar" data-toggle="tooltip">
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
                        <h2>Lista de Pedidos</h2>
                        <thead>
                            <tr>
                                <th class="center">Código</th>
                                <th class="center">Usuario</th>
                                <th class="center">Fecha</th>
                                <th class="center">Estado</th>
                                <th class="center">Hora</th>
                                <th class="center">Deposito</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $nro=1;
                            $query = mysqli_query($mysqli, "SELECT * FROM vista_pedidos WHERE estado='activo'")
                            or die('Error'.mysqli_error($mysqli));

                            while($data = mysqli_fetch_assoc($query)){
                               $codigo = $data['id_pedido'];
                               $name_user = $data['name_user'];
                               $fecha = $data['fecha'];
                               $estado = $data['estado'];
                               $hora = $data['hora'];
                               $descrip = $data['descrip'];

                               echo "<tr>
                               <td class='center'>$codigo</td>
                               <td class='center'>$name_user</td>
                               <td class='center'>$fecha</td>
                               <td class='center'>$estado</td>
                               <td class='center'>$hora</td>
                               <td class='center'>$descrip</td>

                               <td class='center' width='80'>
                               <div>  "; ?>

                                <a data-toggle="tooltip" data-placement="top" title="Anular Compra" class="btn btn-danger btn-sm"
                                    href="modules/pedidos/proses.php?act=anular&id_pedido=<?php echo $data['id_pedido']; ?>"
                                    onclick="return confirm('Estás seguro/a de anular el pedido   <?php echo $data['id_pedido']; ?>?');">
                                    <i style="color: black;" class="fas fa-times-circle"></i>
                                </a>


                              
                                <a data-toggle="tooltip" data-placement="top" title="Imprimir pedido" class="btn btn-warning btn-sm"
                                href="modules/pedidos/print.php?act=imprimir&id_pedido=<?php echo $data['id_pedido']; ?>" target="_blank">
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