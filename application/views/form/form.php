<script type="text/javascript">
  function confirm_modal(id)
  {
      jQuery('#modal-4').modal('show', {backdrop: 'static'});
      document.getElementById('idpersonadatos').value = id;
  }
</script>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Formulario de Solicitud
      </h3>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
                  <?php
            if (!empty($mensaje)) {
            ?>
            <div class="alert alert-danger">
             <?php echo $mensaje; ?>
           </div>
           <?php } ?>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Datos Personales</h4>
              <?php echo form_open(base_url().'formulario/save',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
               <div class="form-group row">
                <label for="ci" class="col-sm-3 col-form-label">C.I.</label>
                <div class="col-sm-2">
                  <input type="hidden" class="form-control form-control-sm" id="opcion" name="opcion" value="<?php echo $opcion;?>">
                  <input type="hidden" class="form-control form-control-sm" name="tipoPersona" value="1">
                  <input type="text" class="form-control form-control-sm" id="ci" name="ci" value="<?php echo $this->input->post('ci');?>">
                  
                  <span class="text-danger"><?php echo form_error('ci');?></span>
                </div>
                <script type="text/javascript">
                    var baseurl = "<?php echo base_url(); ?>";
                      document.getElementById('ci').onblur = function() {
                        /* Referencia al option seleccionado */
                        var html = '';
                        $.ajax({
                          url: baseurl+"validar/" + this.value,
                          method:"POST",
                          success: function(data) {
                            if (data>0) {
                              confirm_modal(data);
                            }
                          }
                        });
                      };
                </script>
                <label for="idexpedido" class="col-sm-1 col-form-label">Expedido</label>
                <div class="col-sm-2">
                  <select class="js-example-basic-single w-100 form-control-sm" name="idexpedido">
                    <option value="BN.">BN.</option>
                    <option value="CB.">CB.</option>
                    <option value="CH.">CH.</option>
                    <option value="LP.">LP.</option>
                    <option value="OR.">OR.</option>
                    <option value="PA.">PA.</option>
                    <option value="PT.">PT.</option>
                    <option value="TJ.">TJ.</option>
                    <option value="SC.">SC.</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('idexpedido');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="idactividad" class="col-sm-3 col-form-label">Actividad</label>
                <div class="col-sm-3">
                  <select class="js-example-basic-single w-100" name="idactividad">
                    <?php foreach ($actividad as $row) { ?>
                    <option value="<?php echo $row['idactividad']; ?>"><?php echo $row['actividad']; ?></option>
                    <?php } ?> 
                  </select>
                  <span class="text-danger"><?php echo form_error('idactividad');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="nombres" class="col-sm-3 col-form-label">Nombre(s)</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control form-control-sm" name="nombres" value="<?php echo $this->input->post('nombres'); ?>">
                  <span class="text-danger"><?php echo form_error('nombres');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="apellidoPaterno" class="col-sm-3 col-form-label">Apellido Paterno</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control form-control-sm" name="apellidoPaterno" value="<?php echo $this->input->post('apellidoPaterno'); ?>">
                  <span class="text-danger"><?php echo form_error('apellidoPaterno');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="apellidoMaterno" class="col-sm-3 col-form-label">Apellido Materno</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control form-control-sm" name="apellidoMaterno" value="<?php echo $this->input->post('apellidoMaterno'); ?>">
                  <span class="text-danger"><?php echo form_error('apellidoMaterno');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="genero" class="col-sm-3 col-form-label">Genero</label>
                <div class="col-sm-1">
                  <select class="js-example-basic-single w-100" name="genero">
                    <option value="F">F</option>
                    <option value="M">M</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('genero');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="estadoCivil" class="col-sm-3 col-form-label">Estado civil</label>
                <div class="col-sm-3">
                  <select class="js-example-basic-single w-100" name="estadoCivil">
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Soltero(a)">Soltero(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viudo(a)">Viudo(a)</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('estadoCivil');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="fechaNacimiento" class="col-sm-3 col-form-label">Fecha de Nacimiento</label>

                <div class="col-sm-6 input-group date datepicker">
                  <input type="date" name="fechaNacimiento" value="">
                  <span class="text-danger"><?php echo form_error('fechaNacimiento');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control form-control-sm" name="direccion" value="<?php echo $this->input->post('direccion'); ?>" placeholder="Zona, calle , número">
                  <span class="text-danger"><?php echo form_error('direccion');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="telefono" class="col-sm-3 col-form-label"># Telefono</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control form-control-sm" name="telefono" value="<?php echo $this->input->post('telefono'); ?>">
                  <span class="text-danger"><?php echo form_error('telefono');?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="celular" class="col-sm-3 col-form-label"># Celular</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control form-control-sm" name="celular" value="<?php echo $this->input->post('celular'); ?>">
                  <span class="text-danger"><?php echo form_error('celular');?></span>
                </div>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Guardar</button>
              <a href="<?php echo base_url().'main'; ?>" class="btn btn-light">Cancelar</a>

              <?php echo form_close(); ?>

            </div>
          </div>
      </div>
    </div>
</div>
<!-- content-wrapper ends -->
<!-- Modal -->
<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos Técnicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url();?>formulario/datos">
      <div class="modal-body">
        <input type="hidden" name="idpersonadatos" id="idpersonadatos">
        ¡Ud ya esta registrado(a)!<br>
        <span class="text-success">Tiene que llenar los datos técnicos.</span>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-check">&nbsp;</i>Aceptar</button>
      </div>
      </form>
    </div>
  </div>
</div>