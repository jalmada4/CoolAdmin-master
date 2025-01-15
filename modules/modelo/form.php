<?php 
    if($_GET['form']=='add'){ ?>
      <section class="content-header">
        <h1>
          <i class="fa fa-edit icon-title">Agregar Modelo</i>
        </h1>
        <ol class="breadcrumb">
          <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
          <li><a href="?module=modelo"> Modelo</a></li>
          <li class="active">Más</li>
        </ol>
      </section>      

      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/modelo/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            //Método para generar código
                                $query_id = mysqli_query($mysqli, "SELECT MAX(id_modelo) as id FROM modelo")
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
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Marca</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="id_marca" required>
                                        <option value="">Seleccionar Marca</option>
                                        <?php
                                        // Obtener las marcas disponibles
                                        $query_marca = mysqli_query($mysqli, "SELECT * FROM marca") or die('Error'.mysqli_error($mysqli));
                                        while($marca = mysqli_fetch_assoc($query_marca)){
                                            echo "<option value='".$marca['id_marca']."'>".$marca['marca_descrip']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción del Modelo</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="mod_descrip" placeholder="Ingrese la descripción del modelo" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Año</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="anho" placeholder="Ingrese el año" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=modelo" class="btn btn-default btn-reset">Cancelar</a>
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
    elseif($_GET['form']=='edit'){ 
      if(isset($_GET['id'])){
          $query = mysqli_query($mysqli, "SELECT * FROM modelo WHERE id_modelo = '$_GET[id]'")
                                                    or die('Error'.mysqli_error($mysqli));
          $data = mysqli_fetch_assoc($query);                                          
      }?> 
    <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Modificar Modelo</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=modelo"> Modelo</a></li>
        <li class="active">Modificar</li>
      </ol>
    </section>  
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/modelo/proses.php?act=update" method="POST">
                        <div class="box-body">
                           
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $data['id_modelo']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Marca</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="id_marca" required>
                                        <option value="">Seleccionar Marca</option>
                                        <?php
                                        // Obtener las marcas disponibles
                                        $query_marca = mysqli_query($mysqli, "SELECT * FROM marca") or die('Error'.mysqli_error($mysqli));
                                        while($marca = mysqli_fetch_assoc($query_marca)){
                                            // Verificar si la marca es la misma que la del modelo
                                            $selected = ($marca['id_marca'] == $data['id_marca']) ? "selected" : "";
                                            echo "<option value='".$marca['id_marca']."' $selected>".$marca['marca_descrip']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción del Modelo</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="mod_descrip" value="<?php echo $data['mod_descrip']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Año</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="anho" value="<?php echo $data['anho']; ?>" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=modelo" class="btn btn-default btn-reset">Cancelar</a>
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