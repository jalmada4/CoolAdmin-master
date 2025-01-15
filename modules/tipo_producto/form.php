<?php 
if($_GET['form']=='add'){ ?>
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Agregar Tipo de Productos</i>
        </h1>
        <ol class="breadcrumb">
            <li> <a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li> <a href="?module=tipo_producto">Tipo Productos</a></li>
            <li class="active">Más</li>
        </ol>
    </section>

    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="modules/tipo_producto/proses.php?act=insert" method="POST">
                    <div class="box-body">
                        <?php 
                        //Método para generar código
                            $query_id = mysqli_query($mysqli, "SELECT MAX(cod_tipo_prod) as id FROM tipo_producto")
                            or die('error'.mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);
                            if($count<>0){
                                $data_id = mysqli_fetch_assoc($query_id);
                                $codigo = $data_id['id']+1;
                            } else {
                                $codigo = 1;
                            }
                        ?>

                        <!-- Código del Departamento -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >Código:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" readonly style="background-color: #f0f8ff; border: 2px solid grey; border-radius: 5px; font-size: 16px; color: black; padding: 10px;">
                            </div>
                        </div>

                        <!-- Descripción del Departamento -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" >Descripción:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="dep_descripcion" placeholder="Nombre del tipo de producto" required style="background-color: #f0f8ff; border: 2px solid grey; border-radius: 5px; font-size: 16px; color: black; padding: 10px;">
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                    <a href="?module=tipo_producto" class="btn btn-default btn-reset" style="background-color: grey;">Cancelar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Efectos Hover para Botones -->
<style>
    .btn-submit:hover {
        background-color: darkorange;
        transform: scale(1.1);
    }

    .btn-reset:hover {
        background-color: lightcoral;
        color: white;
        transform: scale(1.1);
    }
</style>

<?php }elseif($_GET['form']== 'edit'){
    if(isset($_GET['id'])){
        $query = mysqli_query(  $mysqli, "SELECT *FROM tipo_producto WHERE cod_tipo_prod = '$_GET[id]'")
        or die('rror'.mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
    } ?>
    <section class="content-header">
        <h1>
            <i  >
                Modificar Tipos de Productos
            </i>
        </h1>
        <ol class="breadcrumb">
            <li> <a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li> <a href="?module=deposito">Tipo de Productos</a></li>
            <li class="active">Modificar</li>
        </ol>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="modules/tipo_producto/proses.php?act=update" method="POST">
                    <div class="box-body">
                        

                        <!-- Código del Departamento -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="color: black; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); font-weight: bold;">Código:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_tipo_prod']?>" readonly style="background-color: #f0f8ff; border: 2px solid blue; border-radius: 5px; font-size: 16px; color: darkslateblue; padding: 10px;">
                            </div>
                        </div>

                        <!-- Descripción del Departamento -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" style="color: black; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); font-weight: bold;">Descripción:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="dep_descripcion" value="<?php echo $data['t_p_descrip']?>" required style="background-color: #f0f8ff; border: 2px solid blue; border-radius: 5px; font-size: 16px; color: darkslateblue; padding: 10px;">
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar" style="background-color: blue; border: none; font-size: 16px; padding: 10px 20px; text-transform: uppercase; transition: 0.3s ease-in-out;">
                                    <a href="?module=tipo_producto" class="btn btn-default btn-reset" style="font-size: 16px; padding: 10px 20px; background-color: lightgray; color: darkslateblue; border-radius: 5px; text-transform: uppercase; transition: 0.3s ease-in-out;">Cancelar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

    

<?php } 

?>