<section class="content-header">
<ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li class="active"><a href="?module=ventas">Ventas</a></li>
</ol><br><hr>
<h1>
    <i class="fa fa-folder icon-title"></i>Datos de Ventas
    <a class="btn btn-primary btn-social pull-right" href="?module=form_ventas&form=add" title="Agregar" data-toggle="tooltip">
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
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Exitoso!</h4>
                Datos anulados correctamente
                </div>";
            }

            elseif($_GET['alert']==3){
                echo "<div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Error!</h4>
                No se puedo realizar la acción
                </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                <section class="content-header">
                 
                </section>
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
                        // Consulta SQL para obtener los datos de ciudad y departamento
                        $query = mysqli_query($mysqli, "SELECT *FROM v_ventas WHERE estado='activo'") 
                                                        or die('Error: ' . mysqli_error($mysqli));

                        // Iterar sobre cada registro para mostrar en la tabla
                        while ($data = mysqli_fetch_assoc($query)) {
                            echo "<tr>
                                    <td class='center'>{$data['cod_venta']}</td>
                                    <td class='center'>{$data['id_cliente']}</td>
                                    <td class='center'>{$data['fecha']}</td>
                                    <td class='center'>{$data['total_venta']}</td>
                                    <td class='center'>{$data['estado']}</td>
                                    <td class='center'>{$data['hora']}</td>
                                    <td class='center'>{$data['nro_factura']}</td>"; ?>
                                    
                                    <td class='center'>
                                        <!-- Botón Editar -->
                                        <a href="modules/ventas/proses.php?act=anular&cod_venta=<?php echo $data['cod_venta']; ?>" 
                                            class="btn btn-danger btn-sm" 
                                            title="Anular" 
                                            data-toggle="tooltip"
                                            onclick="return confirm('¿Estás seguro/a de anular la factura <?php echo $data['nro_factura']; ?>?');">
                                            <i style="color: black;" class="fas fa-times-circle"></i> 
                                        </a>


                                        <!-- Botón Eliminar -->
                                        <a href="modules/ventas/print.php?act=imprimir&cod_venta=<?php echo $data['cod_venta']; ?>" 
                                            target="_blank"
                                            class="btn btn-warning btn-sm" 
                                            title="Imprimir factura de compra" 
                                            data-toggle="tooltip">
                                                <i style="color: black;" class="fa fa-print"></i> 
                                        </a>

                                    </td>
                                    
                                
                            <?php  
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>