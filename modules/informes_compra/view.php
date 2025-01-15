<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Informes de Compras
       
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Formulario de filtro por fecha -->
            <form method="GET" action="">
                <input type="hidden" name="module" value="informes_compra">
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
                Datos anulados correctamente!
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
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">Id</th>
                                <th class="center">Proveedor</th>
                                <th class="center">Deposito</th>
                                <th class="center">N° factura</th>
                                <th class="center">Fecha</th>
                                <th class="center">Hora</th>
                                <th class="center">Total</th>                                
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                            // Modificar la consulta para incluir el filtro de fechas
                            $where_clause = "`compra`.`estado` = 'activo'";
                            if (!empty($start_date) && !empty($end_date)) {
                                $where_clause .= " AND `compra`.`fecha` BETWEEN '$start_date' AND '$end_date'";
                            }

                            $query = mysqli_query($mysqli, "SELECT `proveedor`.`razon_social`, `deposito`.`descrip`, `compra`.`cod_compra`, `compra`.`nro_factura`, `compra`.`fecha`, `compra`.`hora`, `compra`.`total_compra`, `compra`.`estado`, `compra`.`id_orden`
                            FROM `proveedor`
                            INNER JOIN `compra` ON `proveedor`.`cod_proveedor` = `compra`.`cod_proveedor`
                            INNER JOIN `deposito` ON `compra`.`cod_deposito` = `deposito`.`cod_deposito`
                            WHERE $where_clause;")
                            or die('Error: '.mysqli_error($mysqli));

                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod = $data['cod_compra'];
                                $proveedor = $data['razon_social'];
                                $deposito = $data['descrip'];
                                $nro_factura = $data['nro_factura'];
                                $fecha = $data['fecha'];
                                $hora = $data['hora'];
                                $total_compra = $data['total_compra'];

                                echo "<tr>
                                <td class='center'>$cod</td>
                                <td class='center'>$proveedor</td>
                                <td class='center'>$deposito</td>
                                <td class='center'>$nro_factura</td>
                                <td class='center'>$fecha</td>
                                <td class='center'>$hora</td>
                                <td class='center'>$total_compra</td>                               
                                <td class='center' width='80'>
                                <div> "; ?>
                                    <a data-toggle="tooltip" data-placement="top" title="Imprimir factura de compra" class="btn btn-warning btn-sm"
                                href="modules/compras/print.php?act=imprimir&cod_compra=<?php echo $data['cod_compra']; ?>" target="_blank">
                                    <i style="color: black;" class="fa fa-print"></i>
                                </a>
                                </td>
                                </tr>
                                <?php }                               
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
