<?php 
    if($_GET['form']=='add'){ ?>
        <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Agregar Chofer</i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="?module=chofer"> Choferes</a></li>
            <li class="active">Más</li>
        </ol>
        </section>      

        <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/chofer/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            //Método para generar código
                                $query_id = mysqli_query($mysqli, "SELECT MAX(id_chofer) as id FROM chofer")
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
                                <label class="col-sm-2 control-label">ID Chofer</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="id_chofer" value="<?php echo $codigo; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_nombre" placeholder="Ingresa un nombre" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Apellido</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_apellido" placeholder="Ingresa un apellido" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Cédula</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_cedula" placeholder="Ingresa una cédula" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Teléfono</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_telefono" placeholder="Ingresa un teléfono" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Licencia</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="licencia" placeholder="Ingresa la licencia" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="estado" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=chofer" class="btn btn-default btn-reset">Cancelar</a>
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
          $query = mysqli_query($mysqli, "SELECT * FROM chofer WHERE id_chofer = '$_GET[id]'")
                                                    or die('Error'.mysqli_error($mysqli));
          $data = mysqli_fetch_assoc($query);                                          
      }?> 
    <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Modificar Chofer</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=chofer"> Choferes</a></li>
        <li class="active">Modificar</li>
      </ol>
    </section>  
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/chofer/proses.php?act=update" method="POST">
                        <div class="box-body">
                       
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID Chofer</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="id_chofer" value="<?php echo $data['id_chofer']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_nombre" value="<?php echo $data['chof_nombre']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Apellido</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_apellido" value="<?php echo $data['chof_apellido']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Cédula</label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="chof_cedula" pleaceholder="Ingresa un cedula" onkeypress="return goodchars(event,'1234567890-', this)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Teléfono</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="chof_telefono"  onkeypress="return goodchars(event,'1234567890-', this)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Licencia</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="licencia" value="<?php echo $data['licencia']; ?>" onkeypress="return goodchars(event,'1234567890-', this)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="estado" required>
                                        <option value="activo" <?php echo ($data['estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                                        <option value="inactivo" <?php echo ($data['estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=chofer" class="btn btn-default btn-reset">Cancelar</a>
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
