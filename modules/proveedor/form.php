<?php 
    if($_GET['form']=='add'){ ?>
      <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Agregar Proveedor</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=proveedor"> Proveedor</a></li>
        <li class="active">Más</li>
      </ol>
      </section>      

      <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/proveedor/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php
                            //Método para generar código
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_proveedor) as id FROM proveedor")
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
                                <label class="col-sm-2 control-label">Razon social</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="razon_social"  pleaceholder="Ingresa un Razon social" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ruc</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ruc" pleaceholder="Ingresa un ruc" onkeypress="return goodchars(event,'1234567890-', this)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Direccion</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="direccion" pleaceholder="Ingresa un Direccion" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telefono</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="telefono" pleaceholder="Ingresa un telefono" onkeypress="return goodchars(event,'1234567890+-', this)" required>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=proveedor" class="btn btn-default btn-reset">Cancelar</a>
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
          $query = mysqli_query($mysqli, "SELECT * FROM proveedor WHERE cod_proveedor = '$_GET[id]'")
                                                    or die('Error'.mysqli_error($mysqli));
          $data = mysqli_fetch_assoc($query);                                          
      }?> 
    <section class="content-header">
      <h1>
        <i class="fa fa-edit icon-title">Modificar Proveedor</i>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li><a href="?module=proveedor"> Proveedor</a></li>
        <li class="active">Modificar</li>
      </ol>
    </section>  
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/proveedor/proses.php?act=update" method="POST">
                        <div class="box-body">
                       
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $data['cod_proveedor']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Razon social</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="razon_social"  value="<?php echo $data['razon_social']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ruc</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ruc" value="<?php echo $data['ruc']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Direccion</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="direccion" value="<?php echo $data['direccion']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telefono</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="telefono" value="<?php echo $data['telefono']; ?>" required>
                                </div>
                            </div>

                            
                            

                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=proveedor" class="btn btn-default btn-reset">Cancelar</a>
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