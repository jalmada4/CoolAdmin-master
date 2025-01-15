<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="?module=caja_apertura_cierre"><i class="fa fa-folder"></i> Caja: Apertura y Cierre</a></li>
    </ol>
    <br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i> Datos de Caja: Apertura y Cierre
        <a class="btn btn-primary btn-social pull-right" href="?module=form_caja_apertura_cierre&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i> Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
            // Mensajes de alerta
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong><i class='fas fa-check-circle'></i> ¡Éxito!</strong>
                        Caja abierta exitosamente.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong><i class='fas fa-check-circle'></i> ¡Éxito!</strong>
                        Caja cerrada exitosamente.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong><i class='fas fa-info-circle'></i> Error:</strong>
                        No se pudo abrir/cerrar la caja.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong><i class='fas fa-info-circle'></i> ¡Éxito!</strong>
                        Caja eliminada correctamente.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <h2>Lista de Aperturas y Cierres de Caja</h2>
                    <table id="dataTables" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">Id</th>
                                <th class="center">Fecha Apertura</th>
                                <th class="center">Hora Apertura</th>
                                <th class="center">Usuario</th>
                                <th class="center">Caja</th>
                                <th class="center">Estado</th>
                                <th class="center">Monto Apertura</th>
                                <th class="center">Monto Cierre</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $query = mysqli_query($mysqli, "SELECT * FROM v_caja_aper WHERE estado='abierto' OR estado='cerrado'")
                            or die('Error '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_apertura_cierre = $data['cod_apertura_cierre'];
                                $id_caja = $data['id_caja'];
                                $fecha_apertura = $data['fecha_apertura'];
                                $hora_apertura = $data['hora_apertura'];
                                $usuario = $data['name_user'];
                                $caja = $data['caja_descrip'];
                                $estado = $data['estado'];
                                $monto_apertura = $data['monto_apertura'];
                                $monto_cierre = $data['monto_cierre'];

                                echo "<tr>
                                    <td class='center'>$id_caja</td>
                                    <td class='center'>$fecha_apertura</td>
                                    <td class='center'>$hora_apertura</td>
                                    <td class='center'>$usuario</td>
                                    <td class='center'>$caja</td>
                                    <td class='center'>$estado</td>
                                    <td class='center'>$monto_apertura</td>
                                    <td class='center'>$monto_cierre</td>
                                    <td class='center' width='150'>
                                        <div class='btn-group' role='group'>
                                            <a data-toggle='tooltip' data-placement='top' title='Cerrar Caja' class='btn btn-danger btn-sm'
                                                href='modules/caja_apertura_cierre/proses.php?act=cerrar&id_caja=$id_caja'
                                                onclick=\"return confirm('¿Estás seguro/a de cerrar la caja $id_caja?');\">
                                                <i style='color: black;' class='fas fa-times-circle'></i>
                                            </a>  "?>

                                            <section class="content-header">
                                            <a data-toggle='tooltip' data-placement='top' title='Imprimir Presupuesto' class='btn btn-warning btn-sm' 
                                                href='modules/caja_apertura_cierre/print.php?act=imprimir&cod_apertura_cierre=<?php echo $data['cod_apertura_cierre']; ?>' target='_blank'> 
                                                <i style='color:#000' class='fa fa-print'></i>
                                            </a>
                                            </section> 
                             
                                            <?php "
                                        </div>
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