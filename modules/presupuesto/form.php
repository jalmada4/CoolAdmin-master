<?php
if ($_GET['form'] == 'add') { ?>
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Agregar Presupuesto de Compra</i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="?module=presupuesto"> Presupuesto de Compra</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!--Le agregue el ID por esto document.getElementById('miFormulario')-->
                    <form role="form" id="miFormulario" class="form-horizontal"
                        action="modules/presupuesto/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            //Método para generar código
                            $query_id = mysqli_query($mysqli, "SELECT MAX(id_presup) as id FROM presupuesto")
                                or die('Error' . mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);
                            if ($count <> 0) {
                                $data_id = mysqli_fetch_assoc($query_id);
                                $codigo = $data_id['id'] + 1;
                            } else {
                                $codigo = 1;
                            }
                            if ($count <> 0) {
                                $query = "TRUNCATE TABLE tmp";
                                $statement = $mysqli->prepare($query);
                                $statement->execute();
                            }
                            ?>

                           
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" style="margin-left: 30px;">>Cod. Presupuesto</label>
                                <div class="col-sm-1" style="margin-left: 20px;">
                                    <input type="text" class="form-control" name="id_presup" value="<?php echo $codigo; ?>"
                                        readonly>
                                </div>

                                
                                <div class="form-group row">
                                <label class="col-sm-1 control-label" style="margin-left: 30px; margin-bottom: 20px;" >Fecha</label>
                                <div class="col-sm-2" style="margin-left: 25px;">
                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="fecha_presup" 
                                           value="<?php echo date("Y-m-d"); ?>" readonly>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-1 control-label" style="margin-left: 33px;">Hora</label>
                                
                                    <div class="col-sm-2" style="margin-left: 26px;">
                                        <?php
                                        date_default_timezone_set('America/Asuncion');
                                        ?>
                                        <input type="text" class="form-control date-picker" data-date-format="H-mm-ss"
                                            name="hora" autocomplete="of" value="<?php echo date("H:i:s"); ?>" readonly>
                                    </div>
                                
                                </div>
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" style="margin-left: 30px;">Proveedor</label>
                                <div class="col-sm-3" style="margin-left: 25px;">
                                    <select class="form-control select2" name="cod_proveedor"
                                        data-placeholder="-- Seleccionar Proveedor --" autocomplete="off" required>
                                        <option value="">Seleccionar Proveedor</option>
                                        <?php
                                        $query_prov = mysqli_query($mysqli, "SELECT cod_proveedor, razon_social, ruc
                                            FROM proveedor
                                            ORDER BY cod_proveedor ASC") or die('Error' . mysqli_error($mysqli));
                                        while ($data_prov = mysqli_fetch_assoc($query_prov)) {
                                            echo "<option value=\"$data_prov[cod_proveedor]\">$data_prov[razon_social] | $data_prov[ruc]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" style="margin-left: 30px;">Pedido</label>
                                <div class="col-sm-3" style="margin-left: 25px;">
                                    <select class="form-control select2" name="id_pedido"
                                        data-placeholder="-- Seleccionar Pedido --" autocomplete="off" required>
                                        <option value="">Seleccionar Pedido</option>
                                        <?php 
                                        // Consulta para obtener los id_pedido de la tabla 'pedidos' que no estén en la tabla 'presupuesto'
                                        $query_pedido = mysqli_query($mysqli, 
                                            "SELECT p.id_pedido 
                                            FROM pedidos p 
                                            LEFT JOIN presupuesto ps ON p.id_pedido = ps.id_pedido 
                                            WHERE p.estado = 'activo' AND ps.id_pedido IS NULL
                                            ORDER BY p.id_pedido ASC")
                                            or die('Error: '.mysqli_error($mysqli));

                                        // Mostrar las opciones de pedido
                                        while ($data_pedido = mysqli_fetch_assoc($query_pedido)) {
                                            echo "<option value=\"{$data_pedido['id_pedido']}\">{$data_pedido['id_pedido']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
    

                         <!--   <div class="form-group row">
                                <label class="col-sm-1 col-form-label" style="margin-left: 30px;">Total Estimado</label>
                                <div class="col-sm-3" style="margin-left: 25px;">
                                    <input type="text" class="form-control" name="total_esti" value="<?php echo number_format($total_esti, 2, ',', '.'); ?>" readonly>
                                     <?php
                                        $total_esti = 0; // Inicializa con un valor predeterminado

                                        $query_total = mysqli_query($mysqli, "SELECT total_esti FROM presupuesto WHERE id_presup = '$codigo'")
                                            or die('Error: ' . mysqli_error($mysqli));

                                        if ($data_total = mysqli_fetch_assoc($query_total)) {
                                            $total_esti = $data_total['total_esti'];
                                        }
                                        ?>

                                </div>
                            </div>
                            



                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label" style="margin-left: 30px;">Estado</label>
                                <div class="col-sm-3" style="margin-left: 25px;">
                                    <select class="form-control select2" name="id_estado" data-placeholder="-- Seleccionar Estado --" autocomplete="off" required>
                                        <option value="">Seleccionar Estado</option>
                                        <option value="aprobado">Aprobado</option>
                                        <option value="anulado">Anulado</option>
                                    </select>
                                </div>
                            </div>


                          


                            <hr>
                            <!-- <div class=" form-group">
                                            <div class="col-sm-12">
                                                <label class="col-sm-2 control-label">Productos</label>
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#myModal">
                                                    <span class="glyphicon glyphicon-plus">Agregar Productos</span>
                                                </button>
                                            </div>
                                    </div> -->
                                    <div class="col-md-12">
                                <label class="form-label">Productos</label>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="bx bx-plus"></i> Agregar Productos
                                </button>
                            </div>

                            <div id="resultados" class="col-md-9"></div>



                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <!-- <input type="submit" class="btn btn-primary btn-submit" name="Guardar"
                                            value="Guardar1"> -->

                                        <!-- Agrega un botón para enviar los datos de la tabla junto con el resto del formulario -->
                                        <button type="submit" class="btn btn-primary btn-submit" onclick="enviarFormulario()"
                                            name="Guardar">Guardar</button>
                                        <a href="?module=presupuesto" class="btn btn-default btn-reset">Cancelar</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Input oculto para almacenar los datos de la tabla en formato JSON -->
                        <input type="hidden" name="datosTabla" id="datosTabla" value="">
                    </form>

                </div>
            </div>
        </div>

    </section>

<?php } ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

    <script>
        $(document).ready(function(){
          load(1);  
        });

        function load(page){
            var x = $("#x").val();
            var parametros={"action":"ajax","page":page,"x":x};
            $("#loader").fadeIn('slow');
            $.ajax({
                url:'./ajax/pedir_producto_presupuesto.php',
                data: parametros,
                beforeSend: function(objeto){
                    $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
                },
                success:function(data){
                    $(".outer_div").html(data).fadeIn('slow');
                    $('#loader').html('');
                }
            })

        }
    </script>
    <script>
        function agregar(id){
          var precio_venta=$('#precio_venta_'+id).val();
          var cantidad=$('#cantidad_'+id).val();
           if(isNaN(cantidad)){
               alert('Esto no es un nro');
               document.getElementById('cantidad_'+id).focus();
               return false;
           }
           if(isNaN(precio_venta)){
               alert('Ingrese un precio valido');
               document.getElementById('precio_venta_'+id).focus();
               return false;
           }
           //fin de la validación
           var parametros={"id":id,"precio_venta_":precio_venta,"cantidad":cantidad};
           $.ajax({
               type: "POST",
               url: "./ajax/agregar_producto_presupuesto.php",
               data: parametros,
               beforeSend: function(objeto){
                   $("#resultados").html("Mensaje: Cargando...");
               },
               success: function(datos){
                   $("#resultados").html(datos);
               }
           });
        }
        function eliminar(id){
            $.ajax({
                type: "GET",
                url: "./ajax/agregar_producto_presupuesto.php",
                data: "id="+id,
                beforeSend: function(objeto){
                   $("#resultados").html("Mensaje: Cargando...");
               },
               success: function(datos){
                   $("#resultados").html(datos);
               }
            });
        }

    </script>


<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-image: radial-gradient(circle, cadetblue,grey);">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Buscar Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form class="row g-3">
                    
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="searchProduct" placeholder="Buscar Productos" onkeyup="load(1)">
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="button" class="btn btn-primary" style="background-color: cadetblue;" onclick="load(1)">
                            <i></i> Buscar
                        </button>
                    </div>
                </form>
                <div id="loader" class="text-center mt-3" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
                <div class="outer_div mt-3"></div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>