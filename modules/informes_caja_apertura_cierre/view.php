<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
    <br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i> Informes Apertura y Cierre
      
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- Formulario para Filtrar por Fecha -->
            <form method="GET" action="">
                <input type="hidden" name="module" value="informes_caja_apertura_cierre">
                <div class="row">
                    <div class="col-md-3">
                        <label for="start_date">Fecha Inicio:</label>
                        <input type="date" class="form-control" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">Fecha Fin:</label>
                        <input type="date" class="form-control" name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
                    </div>
                </div>
            </form>
            <br>

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
                    <table id="dataTables" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">Id</th>
                                <th class="center">Fecha Apertura</th>
                                <th class="center">Hora Apertura</th>
                                <th class="center">Usuario</th>
                                <th class="center">Estado</th>
                                <th class="center">Monto Apertura</th>
                                <th class="center">Monto Cierre</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Construir la cláusula WHERE para filtrar por fecha
                            $where_clause = "estado='abierto' OR estado='cerrado'";
                            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                            if (!empty($start_date) && !empty($end_date)) {
                                $where_clause .= " AND fecha_apertura BETWEEN '$start_date' AND '$end_date'";
                            }

                            $query = mysqli_query($mysqli, "SELECT * FROM caja_apertura_cierre WHERE $where_clause")
                            or die('Error '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_apertura_cierre = $data['cod_apertura_cierre'];
                                $id_caja = $data['id_caja'];
                                $fecha_apertura = $data['fecha_apertura'];
                                $hora_apertura = $data['hora_apertura'];
                                $usuario = $data['id_user'];
                                $estado = $data['estado'];
                                $monto_apertura = $data['monto_apertura'];
                                $monto_cierre = $data['monto_cierre'];

                                echo "<tr>
                                    <td class='center'>$id_caja</td>
                                    <td class='center'>$fecha_apertura</td>
                                    <td class='center'>$hora_apertura</td>
                                    <td class='center'>$usuario</td>
                                    <td class='center'>$estado</td>
                                    <td class='center'>$monto_apertura</td>
                                    <td class='center'>$monto_cierre</td>
                                    <td class='center' width='150'>
                                        <div class='btn-group' role='group'>  

                                            <a data-toggle='tooltip' data-placement='top' title='Imprimir Presupuesto' class='btn btn-warning btn-sm' 
                                                href='modules/caja_apertura_cierre/print.php?act=imprimir&cod_apertura_cierre=$cod_apertura_cierre' target='_blank'> 
                                                <i style='color:#000' class='fa fa-print'></i>
                                            </a>
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
