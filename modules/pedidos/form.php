<?php
$queryuser = mysqli_query($mysqli, "SELECT id_user, name_user, foto, permisos_acceso FROM usuarios 
WHERE id_user='$_SESSION[id_user]'")
or die("Error en la consulta del usuario: " . mysqli_error($mysqli));

$data = mysqli_fetch_assoc($queryuser);

$id_user = $data['id_user'];
$name_user = $data['name_user'];

if ($_GET['form'] == 'add') { ?>
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Pedido de Compras
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=pedidos">Pedido de Compras</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/pedidos/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            // Método para generar código único
                            $query_id = mysqli_query($mysqli, "SELECT MAX(id_pedido) as id FROM pedidos")
                                or die('Error al obtener el código: ' . mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);
                            if ($count != 0) {
                                $data_id = mysqli_fetch_assoc($query_id);
                                $codigo = $data_id['id'] + 1;
                            } else {
                                $codigo = 1;
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                </div>

                                <label class="col-sm-1 control-label">Fecha</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="fecha" 
                                           value="<?php echo date("Y-m-d"); ?>" readonly>
                                </div>

                                <label class="col-sm-1 col-form-label">Hora</label>
                                <div >
                                    <div class="col-sm-2">
                                        <?php
                                        date_default_timezone_set('America/Asuncion');
                                        ?>
                                        <input type="text" class="form-control date-picker" data-date-format="H-mm-ss"
                                            name="hora" autocomplete="of" value="<?php echo date("H:i:s"); ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Usuario</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="usuario" value="<?php echo $name_user; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Depósito</label>
                                <div class="col-sm-3">
                                    <select class="form-control chosen-select" name="codigo_deposito" data-placeholder="-- Seleccionar Depósito --" required>
                                        <option value=""></option>
                                        <?php 
                                        $query_dep = mysqli_query($mysqli, "SELECT cod_deposito, descrip FROM deposito ORDER BY cod_deposito ASC")
                                            or die('Error al obtener los depósitos: ' . mysqli_error($mysqli));
                                        while ($data_dep = mysqli_fetch_assoc($query_dep)) {
                                            echo "<option value=\"{$data_dep['cod_deposito']}\">{$data_dep['cod_deposito']} | {$data_dep['descrip']}</option>";
                                        }
                                        ?>
                                    </select>
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
                                        <a href="?module=pedidos" class="btn btn-default btn-reset">Cancelar</a>
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