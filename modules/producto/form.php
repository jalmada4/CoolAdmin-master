<?php 
if($_GET['form']=='add'){ ?>
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Agregar Producto</i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="?module=producto">Producto</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>      

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/producto/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            // Método para generar código
                            $query_id = mysqli_query($mysqli, "SELECT MAX(cod_producto) as id FROM producto")
                                or die('Error'.mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);  
                            if($count <> 0){
                                $data_id = mysqli_fetch_assoc($query_id);
                                $codigo = $data_id['id']+1;
                            } else{
                                $codigo = 1;
                            }                       
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                </div>
                            </div>
                            
                            <!-- Combo para seleccionar un tipo de producto-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo de Producto</label>
                                <div class="col-sm-5">
                                    <select name="tipo_producto" class="form-control">
                                        <option value=""></option>
                                        <?php 
                                            $query = mysqli_query($mysqli, "SELECT * FROM tipo_producto")
                                                or die('Error'.mysqli_error($mysqli));
                                            while($data = mysqli_fetch_assoc($query)){
                                                echo "<option value='".$data['cod_tipo_prod']."'";                                 
                                                echo ">";
                                                echo $data['t_p_descrip'];
                                                echo "</option>";
                                            }                    
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Combo para seleccionar unidad de medida-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unidad de Medida</label>
                                <div class="col-sm-5">
                                    <select name="unidad_medida" class="form-control" required>
                                        <option value=""></option>
                                        <?php 
                                            $query = mysqli_query($mysqli, "SELECT * FROM u_medida")
                                                or die('Error'.mysqli_error($mysqli));
                                            while($data = mysqli_fetch_assoc($query)){
                                                echo "<option value='".$data['id_u_medida']."'";                                 
                                                echo ">";
                                                echo $data['u_descrip'];
                                                echo "</option>";
                                            }                    
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="p_descrip" placeholder="Ingrese el Nombre del Producto" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Precio</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="precio" placeholder="Ingrese el Precio" onkeypress="return goodchars(event,'1234567890', this)" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=producto" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>  

<?php } elseif($_GET['form'] == 'edit') {
    if(isset($_GET['id'])){
        $query = mysqli_query($mysqli, "SELECT * FROM producto WHERE cod_producto = '$_GET[id]'")
        or die('Error'.mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Modificar Producto</i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="?module=producto">Producto</a></li>
            <li class="active">Modificar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/producto/proses.php?act=update" method="POST">
                        <div class="box-body">

                            <!-- Código del Producto (No editable) -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_producto']; ?>" readonly>
                                </div>
                            </div>

                            <!-- Combo para seleccionar un tipo de producto-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo de Producto</label>
                                <div class="col-sm-5">
                                    <select name="tipo_producto" class="form-control">
                                        <option value=""></option>
                                        <?php 
                                            $query = mysqli_query($mysqli, "SELECT * FROM tipo_producto")
                                                or die('Error'.mysqli_error($mysqli));
                                            while($data_tipo = mysqli_fetch_assoc($query)){
                                                echo "<option value='".$data_tipo['cod_tipo_prod']."'"; 
                                                if($data['cod_tipo_prod'] == $data_tipo['cod_tipo_prod']) echo " selected"; 
                                                echo ">";
                                                echo $data_tipo['t_p_descrip'];
                                                echo "</option>";
                                            }                    
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Combo para seleccionar unidad de medida-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unidad de Medida</label>
                                <div class="col-sm-5">
                                    <select name="unidad_medida" class="form-control" required>
                                        <option value=""></option>
                                        <?php 
                                            // Realizamos la consulta para obtener todas las unidades de medida
                                            $query = mysqli_query($mysqli, "SELECT * FROM u_medida")
                                                or die('Error'.mysqli_error($mysqli));
                                            
                                            // Recorremos todas las opciones de unidades de medida
                                            while($data_um = mysqli_fetch_assoc($query)){
                                                // Comprobamos si el valor de la unidad de medida del producto es igual al valor de la unidad de medida en el combo
                                                echo "<option value='".$data_um['id_u_medida']."'"; 
                                                
                                                // Aquí comparamos el valor actual de la unidad de medida seleccionada con el valor del producto que estamos editando
                                                if (isset($data['id_u_medida']) && $data['id_u_medida'] == $data_um['id_u_medida']) {
                                                    echo " selected"; 
                                                }
                                                
                                                echo ">";
                                                echo $data_um['u_descrip'];
                                                echo "</option>";
                                            }                    
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="p_descrip" value="<?php echo $data['p_descrip']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Precio</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="precio" value="<?php echo $data['precio']; ?>" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=producto" class="btn btn-default btn-reset">Cancelar</a>
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
