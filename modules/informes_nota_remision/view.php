<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Informes Nota de Remisión
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos registrados correctamente
                </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos Modificados correctamente
                </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos Eliminados correctamente
                </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check-circle'></i> Error!</h4>
                No se pudo realizar la operación
                </div>";
            }
            ?>

            <!-- Formulario de filtro por fecha -->
            <form method="GET" action="">
                <input type="hidden" name="module" value="informes_nota_remision">
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" name="fecha_fin" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control">Filtrar</button>
                    </div>
                </div>
            </form>

            <div class="box box-primary">
                <div class="box-body">
                   
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">ID Nota Remisión</th>
                                <th class="center">fac. Venta</th>
                                <th class="center">Usuario</th>
                                <th class="center">Nro. de Chapa</th>
                                <th class="center">Nombre Chofer</th>
                                <th class="center">Apellido Chofer</th>
                                <th class="center">Fecha</th>
                                <th class="center">Estado</th>
                                <th class="center">Hora</th>
                                <th class="center">Nombre Cliente</th>
                                <th class="center">Apellido Cliente</th>
                                <th class="center">Destino</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            // Obtener fechas del formulario
                            $fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : '';
                            $fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : '';

                            // Construir la cláusula WHERE de manera dinámica
                            $where_clause = "";
                            if (!empty($fecha_inicio) && !empty($fecha_fin)) {
                                $where_clause = "WHERE nr.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
                            }

                            // Consulta con filtro de fechas opcional
                            $query = mysqli_query($mysqli, "
                                SELECT nr.id_nota_remis, v.nro_factura, nr.id_user, nr.id_movil, nr.id_chofer, nr.fecha, nr.estado, nr.hora,
                                    u.name_user, m.nro_chapa, c.chof_nombre, c.chof_apellido, 
                                    cli.cli_nombre, cli.cli_apellido, nr.destino
                                FROM nota_remision nr
                                LEFT JOIN venta v ON nr.cod_venta = v.cod_venta
                                LEFT JOIN usuarios u ON nr.id_user = u.id_user
                                LEFT JOIN movil m ON nr.id_movil = m.id_movil
                                LEFT JOIN chofer c ON nr.id_chofer = c.id_chofer
                                LEFT JOIN clientes cli ON nr.id_cliente = cli.id_cliente
                                $where_clause
                            ") or die('Error '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                    <td class='center'>{$data['id_nota_remis']}</td>
                                    <td class='center'>{$data['nro_factura']}</td>
                                    <td class='center'>{$data['name_user']}</td>
                                    <td class='center'>{$data['nro_chapa']}</td>
                                    <td class='center'>{$data['chof_nombre']}</td>
                                    <td class='center'>{$data['chof_apellido']}</td>
                                    <td class='center'>{$data['fecha']}</td>
                                    <td class='center'>{$data['estado']}</td>
                                    <td class='center'>{$data['hora']}</td>
                                    <td class='center'>{$data['cli_nombre']}</td>
                                    <td class='center'>{$data['cli_apellido']}</td>
                                    <td class='center'>{$data['destino']}</td>
                                    <td class='center'>
                                        <section class='content-header'>
                                            <a class='btn btn-warning btn-sm' href='modules/nota_remision/print.php?id_nota_remis={$data['id_nota_remis']}' target='_blank' title='Imprimir' data-toggle='tooltip'>
                                            <i class='fa fa-print'></i>
                                        </a>
                                            </section> 
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
