<?php 
if($_GET['form']=='add'){ ?>
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title">Agregar Nota de Remisión</i>
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
      <li><a href="?module=nota_remision"> Nota de Remisión</a></li>
      <li class="active">Más</li>
    </ol>
  </section>      

  <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="modules/nota_remision/proses.php?act=insert" method="POST">
                    <div class="box-body">
                        <?php
                        // Generar código de nota de remisión
                        $query_id = mysqli_query($mysqli, "SELECT MAX(id_nota_remis) as id FROM nota_remision")
                                                    or die('Error'.mysqli_error($mysqli));

                        $count = mysqli_num_rows($query_id);  
                        if($count <> 0){
                            $data_id = mysqli_fetch_assoc($query_id);
                            $codigo = $data_id['id']+1;
                        } else{
                            $codigo=1;
                        }                       
                        ?>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ID Nota Remisión</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="id_nota_remis" value="<?php echo $codigo; ?>" readonly>
                            </div>
                        </div>

                        <!-- Campo Código Venta -->
                        <?php
                            // Realizar la consulta para obtener el último código de venta
                            $query_venta = mysqli_query($mysqli, "SELECT cod_venta FROM venta ORDER BY cod_venta DESC LIMIT 1");
                            $row_venta = mysqli_fetch_assoc($query_venta);

                            // Si existe un resultado, tomar el último cod_venta
                            $codigo = isset($row_venta['cod_venta']) ? $row_venta['cod_venta'] : '';
                            ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código Venta</label>
                                <div class="col-sm-5">
                                    <!-- En el formulario de agregar, usamos el último código de venta si existe -->
                                    <input type="text" class="form-control" name="cod_venta" value="<?php echo isset($codigo) ? $codigo : ''; ?>" readonly>
                                </div>
                            </div>


                        <!-- Otros campos (usuario, móvil, chofer, etc.) -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Usuario</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="id_user" value="<?php echo $data['name_user']; ?>" readonly>
                            </div>
                        </div>

                        <!-- Campo Cliente -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cliente</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="id_cliente" required>
                                    <option value="">Selecciona un cliente</option>
                                    <?php
                                    $query_clientes = mysqli_query($mysqli, "SELECT * FROM clientes") or die('Error'.mysqli_error($mysqli));
                                    while ($cliente = mysqli_fetch_assoc($query_clientes)) {
                                        echo "<option value='".$cliente['id_cliente']."'>".$cliente['cli_nombre']." ".$cliente['cli_apellido']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Último Nro. Factura</label>
                            <div class="col-sm-5">
                                <?php
                                // Consultar el último nro_factura de la tabla venta
                                $query_factura = mysqli_query($mysqli, "SELECT nro_factura FROM venta ORDER BY nro_factura DESC LIMIT 1") or die('Error'.mysqli_error($mysqli));
                                $factura = mysqli_fetch_assoc($query_factura);

                                // Mostrar el último nro_factura
                                $ultimo_nro_factura = $factura ? $factura['nro_factura'] : "No hay facturas";
                                ?>
                                <input type="text" class="form-control" name="ultimo_nro_factura" value="<?php echo $ultimo_nro_factura; ?>" readonly>
                            </div>
                        </div>

                        <!-- Último Producto Agregado -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Último Producto Vendido</label>
                            <div class="col-sm-5">
                                <?php
                                // Consultar el último producto vendido en la tabla 'venta_producto' (asociativa entre 'venta' y 'producto')
                                $query_producto = mysqli_query($mysqli, "
                                    SELECT 
                                        aper.cod_producto, 
                                        u.p_descrip, 
                                        aper.det_cantidad, 
                                        aper.det_precio_unit, 
                                        aper.cod_venta
                                    FROM 
                                        det_venta aper
                                    JOIN 
                                        producto u 
                                    ON 
                                        aper.cod_producto = u.cod_producto
                                    ORDER BY 
                                        aper.cod_venta DESC
                                    LIMIT 1;

                                ") or die('Error'.mysqli_error($mysqli));

                                $producto = mysqli_fetch_assoc($query_producto);

                                // Mostrar el último producto
                                $ultimo_producto = $producto ? $producto['p_descrip'] : "No hay productos vendidos";
                                ?>
                                <input type="text" class="form-control" name="ultimo_producto" value="<?php echo $ultimo_producto; ?>" readonly>
                            </div>
                        </div>


                        <!-- Destino -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Destino</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="destino" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Móvil</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="id_movil" required>
                                    <option value="">Selecciona un móvil</option>
                                    <?php
                                    $query_moviles = mysqli_query($mysqli, "SELECT * FROM movil") or die('Error'.mysqli_error($mysqli));
                                    while ($movil = mysqli_fetch_assoc($query_moviles)) {
                                        echo "<option value='".$movil['id_movil']."'>".$movil['nro_chapa']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Chofer -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Chofer</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="id_chofer" required>
                                    <option value="">Selecciona un chofer</option>
                                    <?php
                                    $query_choferes = mysqli_query($mysqli, "SELECT * FROM chofer") or die('Error'.mysqli_error($mysqli));
                                    while ($chofer = mysqli_fetch_assoc($query_choferes)) {
                                        echo "<option value='".$chofer['id_chofer']."'>".$chofer['chof_nombre']." ".$chofer['chof_apellido']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Fecha -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="fecha" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5">
                                <label class="col-sm-2 control-label">Estado</label>
                                <input type="text" class="form-control" name="estado" value="activo" readonly>
                            </div>  
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hora</label>
                            <div class="col-sm-5">
                                <input type="time" class="form-control" name="hora" required>
                            </div>
                        </div>

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
                                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                    <a href="?module=nota_remision" class="btn btn-default btn-reset">Cancelar</a>
                                </div>
                            </div>
                        </div>

                    </div>
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
                url:'./ajax/p_p_p_c.php',
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
          var precio_compra=$('#precio_compra_'+id).val();
          var cantidad=$('#cantidad_'+id).val();
           if(isNaN(cantidad)){
               alert('Esto no es un nro');
               document.getElementById('cantidad_'+id).focus();
               return false;
           }
           /*if(isNaN(precio_compra)){
               alert('Esto no es un nro');
               document.getElementById('precio_compra_'+id).focus();
               return false;
           }*/
           //fin de la validación
           var parametros={"id":id,"cantidad":cantidad};
           $.ajax({
               type: "POST",
               url: "./ajax/a_p_p_c.php",
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
                url: "./ajax/a_p_p_c.php",
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


<?php
if ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $query = mysqli_query($mysqli, "SELECT * FROM nota_remision WHERE id_nota_remis = '$_GET[id]'") or die('Error'.mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
    }
?>
<section class="content-header">
  <h1>
    <i class="fa fa-edit icon-title">Modificar Nota de Remisión</i>
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
    <li><a href="?module=nota_remision">Nota de Remisión</a></li>
    <li class="active">Modificar</li>
  </ol>
</section>  

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="modules/nota_remision/proses.php?act=update" method="POST">
                    <div class="box-body">
                        <!-- ID Nota Remisión -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ID Nota Remisión</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="id_nota_remis" value="<?php echo $data['id_nota_remis']; ?>" readonly>
                            </div>
                        </div>

                        <!-- Código Venta -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Código Venta</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="cod_venta" value="<?php echo isset($data['cod_venta']) ? $data['cod_venta'] : ''; ?>" required>
                            </div>
                        </div>

                        <!-- Cliente -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Cliente</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="id_cliente" required>
                                    <option value="">Selecciona un cliente</option>
                                    <?php
                                    $query_clientes = mysqli_query($mysqli, "SELECT * FROM clientes") or die('Error'.mysqli_error($mysqli));
                                    while ($cliente = mysqli_fetch_assoc($query_clientes)) {
                                        $selected = ($cliente['id_cliente'] == $data['id_cliente']) ? "selected" : "";
                                        echo "<option value='".$cliente['id_cliente']."' $selected>".$cliente['cli_nombre']." ".$cliente['cli_apellido']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Destino -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Destino</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="destino" value="<?php echo $data['destino']; ?>" required>
                            </div>
                        </div>

                        <!-- Resto de campos como móvil, chofer, etc. -->
                        <!-- Código igual que el formulario de agregar -->

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                    <a href="?module=nota_remision" class="btn btn-default btn-reset">Cancelar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php } ?>
