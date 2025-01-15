<section class="content-header">
<ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
</ol><br><hr>
<h1>
    <i class="fa fa-folder icon-title"></i>Informes de Orden
   
</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- Formulario para Filtrar por Fecha -->
            <form method="GET" action="">
                <input type="hidden" name="module" value="informes_orden">
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
            if(empty($_GET['alert'])){
                echo "";
            } elseif($_GET['alert']==1) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos registrados correctamente
                </div>";
            } elseif($_GET['alert']==2) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos Modificados correctamente
                </div>";
            } elseif($_GET['alert']==3) {
                echo "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos Eliminados correctamente
                </div>";
            } elseif($_GET['alert']==4) {
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
                        <thead>
                            <tr>
                                <th class="center">Orden</th>
                                <th class="center">Presupuesto</th>
                                <th class="center">Usuario</th>
                                <th class="center">Fecha Emisión</th>
                                <th class="center">Estado</th>
                                <th class="center">Hora</th>
                                <th class="center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $where_clause = "estado IN ('activo', 'pendiente')";
                            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                            if (!empty($start_date) && !empty($end_date)) {
                                $where_clause .= " AND fecha_emision BETWEEN '$start_date' AND '$end_date'";
                            }

                            $query = mysqli_query($mysqli, "SELECT * FROM vista_orden WHERE $where_clause")
                            or die('Error: '.mysqli_error($mysqli));

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
