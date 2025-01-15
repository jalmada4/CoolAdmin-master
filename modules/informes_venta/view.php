<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Informes de Ventas
        <a class="btn btn-primary btn-social pull-right" href="?module=informes_venta&form=add" title="Agregar" data-toggle="tooltip">
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Formulario de filtro por fecha -->
            <form method="GET" action="">
                <input type="hidden" name="module" value="informes_venta">
                <div class="row">
                    <div class="col-md-3">
                        <label for="start_date">Fecha inicio:</label>
                        <input type="date" class="form-control" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date">Fecha fin:</label>
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
            if(empty($_GET['alert'])){
                echo "";
            } elseif($_GET['alert']==1) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos registrados correctamente
                </div>";
            } elseif($_GET['alert']==2) {
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos anulados correctamente
                </div>";
            } elseif($_GET['alert']==3) {
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Error!</h4>
                No se puedo realizar la acción
                </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Ventas</h2>
                        <thead>
                        <tr>
                            <th class='center'>ID:</th>
                            <th class='center'>Cliente</th>
                            <th class='center'>Fecha</th>
                            <th class='center'>Total venta</th>
                            <th class='center'>Estado:</th>
                            <th class='center'>Hora:</th>
                            <th class='center'>Nro. Factura:</th>
                            <th class='center'>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        // Capturar las fechas del formulario
                        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                        // Construir la cláusula WHERE para el filtrado
                        $where_clause = "estado = 'activo'";
                        if (!empty($start_date) && !empty($end_date)) {
                            $where_clause .= " AND fecha BETWEEN '$start_date' AND '$end_date'";
                        }

                        // Consulta SQL para obtener los datos filtrados
                        $query = mysqli_query($mysqli, "SELECT * FROM v_ventas WHERE $where_clause") 
                            or die('Error: ' . mysqli_error($mysqli));

                        // Mostrar los datos
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                <td class='center'>{$data['cod_venta']}</td>
                                <td class='center'>{$data['id_cliente']}</td>
                                <td class='center'>{$data['fecha']}</td>
                                <td class='center'>{$data['total_venta']}</td>
                                <td class='center'>{$data['estado']}</td>
                                <td class='center'>{$data['hora']}</td>
                                <td class='center'>{$data['nro_factura']}</td>
                                <td class='center'>
                                    
                                    <a href='modules/ventas/print.php?act=imprimir&cod_venta={$data['cod_venta']}' 
                                        target='_blank'
                                        class='btn btn-warning btn-sm' 
                                        title='Imprimir factura de compra' 
                                        data-toggle='tooltip'>
                                        <i style='color: black;' class='fa fa-print'></i> 
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
