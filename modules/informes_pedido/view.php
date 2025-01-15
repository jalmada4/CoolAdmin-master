<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    </ol><br><hr>
    <h1>
        <i class="fa fa-folder icon-title"></i>Informes de Pedidos
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Formulario para Filtrar por Fecha -->
            <form method="GET" action="">
                <input type="hidden" name="module" value="informes_pedido">
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
                            $where_clause = "estado='activo'";
                            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                            if (!empty($start_date) && !empty($end_date)) {
                                $where_clause .= " AND fecha BETWEEN '$start_date' AND '$end_date'";
                            }

                            $query = mysqli_query($mysqli, "SELECT * FROM vista_pedidos WHERE $where_clause")
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
