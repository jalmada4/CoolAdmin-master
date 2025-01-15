<?php 
    // Formulario para Agregar Movil
    if($_GET['form']=='add'){ ?>
      <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Agregar Movil</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=movil"> Movil</a></li>
        <li class="active">Más</li>
      </ol>
      </section>      

      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/movil/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            // Método para generar código
                                $query_id = mysqli_query($mysqli, "SELECT MAX(id_movil) as id FROM movil")
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
                                <label class="col-sm-2 control-label">ID Movil</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="id_movil" value="<?php echo $codigo; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Marca</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="id_modelo" required>
                                        <option value="">Selecciona una Marca</option>
                                        <?php 
                                            $query_modelo = mysqli_query($mysqli, "SELECT * FROM modelo") or die('Error'.mysqli_error($mysqli));
                                            while($data_modelo = mysqli_fetch_assoc($query_modelo)){
                                                echo "<option value='".$data_modelo['id_modelo']."'>".$data_modelo['mod_descrip']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nro Chapa</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nro_chapa" placeholder="Ingresa el número de chapa" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="estado" placeholder="Ingresa el estado del movil" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="color" placeholder="Ingresa el color del movil" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=movil" class="btn btn-default btn-reset">Cancelar</a>
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
    // Formulario para Editar Movil
    elseif($_GET['form']=='edit'){
      if(isset($_GET['id'])){
          $query = mysqli_query($mysqli, "SELECT * FROM movil WHERE id_movil = '$_GET[id]'")
                                                    or die('Error'.mysqli_error($mysqli));
          $data = mysqli_fetch_assoc($query);                                          
      }?> 
    <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Modificar Movil</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=movil"> Movil</a></li>
        <li class="active">Modificar</li>
      </ol>
    </section>  
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/movil/proses.php?act=update" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID Movil</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="id_movil" value="<?php echo $data['id_movil']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Marca</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="id_modelo" required>
                                        <option value="">Selecciona una Marca</option>
                                        <?php 
                                            $query_modelo = mysqli_query($mysqli, "SELECT * FROM modelo") or die('Error'.mysqli_error($mysqli));
                                            while($data_modelo = mysqli_fetch_assoc($query_modelo)){
                                                // Se selecciona el modelo actual
                                                $selected = ($data['id_modelo'] == $data_modelo['id_modelo']) ? 'selected' : '';
                                                echo "<option value='".$data_modelo['id_modelo']."' $selected>".$data_modelo['nombre']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nro Chapa</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nro_chapa" value="<?php echo $data['nro_chapa']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="estado" value="<?php echo $data['estado']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="color" value="<?php echo $data['color']; ?>" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=movil" class="btn btn-default btn-reset">Cancelar</a>
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
