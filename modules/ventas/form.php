<?php 
    if($_GET['form']=='add'){ ?>
      <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Agregar Ventas</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=ventas"> Ventas</a></li>
        <li class="active">Agregar</li>
      </ol>
      </section>      

      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/ventas/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            //Método para generar código
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_venta) as id FROM venta")
                                                        or die('Error'.mysqli_error($mysqli));

                                $count = mysqli_num_rows($query_id);  
                                if($count <> 0){
                                    $data_id = mysqli_fetch_assoc($query_id);
                                    $cod_venta = $data_id['id']+1;
                                } else{
                                    $cod_venta=1;
                                }                      
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="cod_venta" value="<?php echo $cod_venta; ?>" readonly>
                                </div>

                                <label class="col-sm-1 control-label">Fecha</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="fecha" autocomplete="of" 
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
                                    <label class="col-sm-2 control-label">Cliente</label>
                                    <div class="col-sm-3">
                                        <select class="chosen-select" name="id_cliente" data-placeholder=" Seleccionar  Cliente "
                                            autocomplete="off" required>
                                            <option value=""></option>
                                            <?php 
                                                $query_prov = mysqli_query($mysqli, "SELECT id_cliente, cli_nombre, cli_apellido
                                                FROM clientes
                                                ORDER BY id_cliente ASC") or die ('Error'.mysqli_error($mysqli));
                                                while ($data_prov = mysqli_fetch_assoc($query_prov)){
                                                    echo "<option value=\"$data_prov[id_cliente]\">$data_prov[cli_nombre] | $data_prov[cli_apellido]</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <!--factura -->
                                    <?php
                                        // Consulta para obtener el número más alto de la columna nro_factura
                                        $result = $mysqli->query("SELECT MAX(nro_factura) AS ultimo_numero FROM venta");

                                        if ($row = $result->fetch_assoc()) {
                                            $ultimo_numero = $row['ultimo_numero'];

                                            // Extraer el número actual e incrementar en 1
                                            if ($ultimo_numero) {
                                                // Eliminar los guiones y convertir a entero
                                                $numero_actual = (int)str_replace(['-', ' '], '', $ultimo_numero); // eliminar guiones y espacios si existen
                                                $nuevo_numero = $numero_actual + 1;

                                                // Formatear el nuevo número a 7 dígitos
                                                $nro_factura_generado = str_pad($nuevo_numero, 6, '0', STR_PAD_LEFT);
                                                $nro_factura_generado = '000-000-' . $nro_factura_generado; // Agregar los guiones en el formato adecuado
                                            } else {
                                                // Si no hay registros, empieza desde 000-000-000001
                                                $nro_factura_generado = '000-000-000001';
                                            }
                                        } else {
                                            die('Error al consultar el número de factura: ' . $mysqli->error);
                                        }
                                        ?>

                                        <div class="col-md-3">
                                            <label for="nro_factura" class="form-label">Nro. Factura</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                name="nro_factura" 
                                                id="nro_factura" 
                                                value="<?php echo isset($nro_factura_generado) ? $nro_factura_generado : ''; ?>" 
                                                readonly 
                                                onkeypress="return goodchars(event,'1234567890-', this)">
                                        </div>
                                </div>
                        </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Depósito</label>
                                <div class="col-sm-3">
                                    <select class="chosen-select" name="cod_deposito" data-placeholder="-- Seleccionar  Depósito --"
                                    autocomplete="off" required>
                                        <option value=""></option>
                                        <?php 
                                            $query_dep = mysqli_query($mysqli, "SELECT cod_deposito, descrip
                                            FROM deposito
                                            ORDER BY cod_deposito ASC") or die ('Error'.mysqli_error($mysqli));
                                            while ($data_dep = mysqli_fetch_assoc($query_dep)){
                                                echo "<option value=\"$data_dep[cod_deposito]\">$data_dep[cod_deposito] | $data_dep[descrip]</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                             <hr>               
                            <div class="form-group">
                                <div class="col-sm-12">
                                <label class="col-sm-2 control-label">Productos</label>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
                                    <span class="glyphicon glyphicon-plus">Agregar Productos</span>
                                    </button>
                                </div>
                            </div>
                            <div id="resultados" class="col-md-9"></div>
                                
                      

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=ventas" class="btn btn-default btn-reset">Cancelar</a>
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
                url:'./ajax/p_p_vent.php',
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
               url: "./ajax/a_p_vent.php",
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
                url: "./ajax/a_p_vent.php",
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

                                
    <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModallabel">Buscar Productos</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal">
                <div class="form-group">
                   <div class="col-sm-6">
                       <input type="text" class="form-control" id="x" placeholder="Buscar Productos" onkeyup="load(1)">
                   </div>
                   <button type="button" class="btn btn-default" onclick="load(1)"><span class="glyphicon glyphicon-search"></span>Buscar</button>
                </div>                            
              </form>
              <div id="loader" style="position: absolute; text-align: center; top: 55px; width:100%; display:none;"></div>
              <div class="outer_div"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>                                
         </div>
      </div>                                      
    </div>


    