<?php
// Conexión a la base de datos
require_once "config/database.php";

?>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=presupuesto">Presupuesto</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos de Presupuestos
        <a class="btn btn-primary btn-social pull-right" href="?module=form_presupuesto&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
            // Manejo de alertas
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                        Datos registrados correctamente
                      </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                        Datos anulados correctamente
                      </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> Error!</h4>
                        No se pudo realizar la acción
                      </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <section class="content-header"></section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Presupuestos</h2>
                        <thead>
                            <tr>
                                <th class="center">ID Presupuesto</th>
                                <th class="center">ID Pedido</th>
                                <th class="center">Proveedor</th>
                                <th class="center">Usuario</th>
                                <th class="center">Total Estimado</th>
                                <th class="center">Fecha</th>
                                <th class="center">Hora</th>
                                <th class="center">Estado</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Consulta a la vista "vista_presupuesto"
                            $query = mysqli_query($mysqli, "SELECT * FROM vista_presupuesto WHERE estado='aprobado'")
                            or die('Error: ' . mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) {
                                $id_presup = $data['id_presup'];
                                $id_pedido = $data['id_pedido'];
                                $proveedor = $data['proveedor'];
                                $usuario = $data['usuario'];
                                $total_esti = $data['total_esti'];
                                $fecha_presup = $data['fecha_presup'];
                                $hora = $data['hora'];
                                $estado = $data['estado'];

                                echo "<tr>
                                    <td class='center'>$id_presup</td>
                                    <td class='center'>$id_pedido</td>
                                    <td class='center'>$proveedor</td>
                                    <td class='center'>$usuario</td>
                                    <td class='center'>$total_esti</td>
                                    <td class='center'>$fecha_presup</td>
                                    <td class='center'>$hora</td>
                                    <td class='center'>$estado</td>
                                    <td class='center' width='80'>
                                        <div> " ?>
                                            <a data-toggle="tooltip" data-placement="top" title="Anular Compra" class="btn btn-danger btn-sm"
                                            href="modules/presupuesto/proses.php?act=anular&id_presup=<?php echo $data['id_presup']; ?>"
                                            onclick="return confirm('Estás seguro/a de anular el presupuesto de  <?php echo $data['usuario']; ?>?');">
                                            <i style="color: black;" class="fas fa-times-circle"></i>
                                            </a>
                                            <a data-toggle='tooltip' data-placement='top' title='Imprimir Presupuesto' class='btn btn-warning btn-sm' 
                                                href='modules/presupuesto/print.php?act=imprimir&id_presup=<?php echo $data['id_presup']; ?>' target='_blank'> 
                                                <i style='color:#000' class='fa fa-print'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
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