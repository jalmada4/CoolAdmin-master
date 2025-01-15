<?php  
if ($_GET['form'] == 'add') { ?>
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Agregar Apertura/Cierre de Caja
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
      <li><a href="?module=caja_apertura_cierre">Caja</a></li>
      <li class="active">Agregar</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <form role="form" class="form-horizontal" action="modules/caja_apertura_cierre/proses.php?act=insert" method="POST">
            <div class="box-body">
              <?php
              // Generar código único para la apertura/cierre
              $query_id = mysqli_query($mysqli, "SELECT MAX(cod_apertura_cierre) as id FROM caja_apertura_cierre")
                          or die('Error: '.mysqli_error($mysqli));

              $count = mysqli_num_rows($query_id);  
              if ($count <> 0) {
                  $data_id = mysqli_fetch_assoc($query_id);
                  $codigo = $data_id['id'] + 1;
              } else {
                  $codigo = 1;
              }
              ?>
              <!-- Primera fila -->
              <div class="form-group">
                <div class="col-sm-6">
                  <label class="control-label">Código</label>
                  <input type="text" class="form-control" name="cod_apertura_cierre" value="<?php echo $codigo; ?>" readonly>
                </div>
                <div class="col-sm-6">
                  <label class="control-label">Fecha Apertura</label>
                  <input type="text" class="form-control" name="fecha_apertura" value="<?php echo date("Y-m-d"); ?>" readonly>
                </div>
              </div>
              <?php 
                        date_default_timezone_set('America/Asuncion'); // Ajusta la zona horaria
                        ?>
                        <div class="col-sm-6">
                            <label for="hora" class="form-label">Hora Apertura</label>
                            <input type="time" class="form-control" name="hora_apertura" id="hora" value="<?php echo date("H:i"); ?>" readonly>
                        </div>

              <!-- Segunda fila -->
              <div class="form-group">
                
                <div class="col-sm-6">
                  <label class="control-label">Usuario</label>
                  <?php 
                  if (isset($_SESSION['id_user']) && isset($_SESSION['name_user'])) {
                      $id_user = $_SESSION['id_user'];
                      $name_user = $_SESSION['name_user'];
                      echo "<input type=\"text\" class=\"form-control\" value=\"$name_user\" readonly>";
                      echo "<input type=\"hidden\" name=\"id_user\" value=\"$id_user\">";
                  } else {
                      echo "<p class=\"text-danger\">Error: Usuario no identificado.</p>";
                  }
                  ?>
                </div>
              </div>

              <!-- Tercera fila -->
              <div class="form-group">
                <div class="col-sm-6">
                  <label class="control-label">Caja</label>
                  <select class="form-control" name="id_caja" required>
                    <option value="">Seleccionar Caja</option>
                    <?php 
                    $query_caja = mysqli_query($mysqli, "SELECT id_caja, caja_descrip FROM caja ORDER BY id_caja ASC")
                                  or die('Error: '.mysqli_error($mysqli));
                    while ($data_caja = mysqli_fetch_assoc($query_caja)) {
                        echo "<option value=\"$data_caja[id_caja]\">$data_caja[caja_descrip]</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label class="control-label">Monto Apertura</label>
                  <input type="number" class="form-control" name="monto_apertura" placeholder="Ingrese monto de apertura" required>
                </div>
              </div>

              <!-- Cuarta fila -->
              <div class="form-group">
                <div class="col-sm-6">
                  <label class="control-label">Estado</label>
                  <input type="text" class="form-control" name="estado" value="Abierto" readonly>
                </div>
                
              </div>

              <!-- Botones -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                    <a href="?module=caja_apertura_cierre" class="btn btn-default btn-reset">Cancelar</a>
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