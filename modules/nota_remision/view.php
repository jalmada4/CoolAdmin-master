

<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=nota_remision">Nota de Remisión</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Datos de Nota de Remisión
        <a class="btn btn-primary btn-social pull-right" href="?module=form_nota_remision&form=add" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
            if (isset($_GET['alert'])) {
                if ($_GET['alert'] == 1) {
                    echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> ¡Exitoso!</h4>
                        Datos registrados correctamente.
                    </div>";
                } elseif ($_GET['alert'] == 2) {
                    echo "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check-circle'></i> ¡Exitoso!</h4>
                        Datos modificados correctamente.
                    </div>";
                }
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Nota de Remisión</h2>
                        <thead>
                            <tr>
                                <th class="center">ID Nota Remisión</th>
                                <th class="center">Factura Venta</th>
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
                            ") or die('Error: '.mysqli_error($mysqli));

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
                                        <a class='btn btn-warning btn-sm' href='modules/nota_remision/print.php?id_nota_remis={$data['id_nota_remis']}' target='_blank' title='Imprimir' data-toggle='tooltip'>
                                            <i class='fa fa-print'></i>
                                        </a>
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
