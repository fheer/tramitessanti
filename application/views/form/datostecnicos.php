<?php
$ci = &get_instance();
$ci->load->model("TipoTramite_model");
$tipotramite = $ci->TipoTramite_model->getTodosLosTramites();
?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
   <div class="page-header">
    <div class="pull-right">
    </div>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Datos Técnicos</li>
      </ol>
    </nav>
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
     <form method="post" action="<?php echo base_url();?>formulario/guardar">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label for="tipotramite" class="col-sm-3 col-form-label">Tramite</label>
            <div class="col-sm-5">
              <input type="hidden" name="idpersona" value="<?= $idpersona; ?>">
              <select class="js-example-basic-single w-100" id="tipotramite" name="tipotramite">
                <option value="Seleccione">Seleccione trámite</option>
                <?php foreach ($tipotramite as $row) { ?>
                  <option value="<?php echo $row['idtipotramite']; ?>"><?php echo $row['nombreRequisito']; ?></option>
                <?php } ?>
              </select>
              <span class="text-danger"><?php echo form_error('tipotramite');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="requisitos" class="col-sm-3 col-form-label">Requisitos Indispensables (Para el Trámite)</label>
            <div class="col-sm-5" id="requisitos">
            </div>
          </div>
          <div class="form-group row">
            <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
            <div class="col-sm-5">
              <input type="text" class="form-control form-control-sm" name="direccion" value="<?php echo $this->input->post('direccion'); ?>">
              <span class="text-danger"><?php echo form_error('direccion');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="zona" class="col-sm-3 col-form-label">Zona</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" name="zona" value="<?php echo $this->input->post('zona'); ?>">
              <span class="text-danger"><?php echo form_error('zona');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="manzano" class="col-sm-3 col-form-label">Número de manzano</label>
            <div class="col-sm-2">
              <input type="text" class="form-control form-control-sm" name="manzano" value="<?php echo $this->input->post('manzano'); ?>">
              <span class="text-danger"><?php echo form_error('manzano');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="predio" class="col-sm-3 col-form-label">Número de predio(lote)</label>
            <div class="col-sm-2">
              <input type="text" class="form-control form-control-sm" name="predio" value="<?php echo $this->input->post('predio'); ?>">
              <span class="text-danger"><?php echo form_error('predio');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="avaluo" class="col-sm-3 col-form-label">Avalúo Catastral</label>
            <div class="col-sm-2">
              <input type="text" class="form-control form-control-sm" name="avaluo" value="<?php echo $this->input->post('avaluo'); ?>">
              <span class="text-danger"><?php echo form_error('avaluo');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="codigo" class="col-sm-3 col-form-label">Código Catastral</label>
            <div class="col-sm-2">
              <input type="text" class="form-control form-control-sm" name="codigo" value="<?php echo $this->input->post('codigo'); ?>">
              <span class="text-danger"><?php echo form_error('codigo');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="distrito" class="col-sm-3 col-form-label">Distrito</label>
            <div class="col-sm-2">
              <input type="text" class="form-control form-control-sm" name="distrito" value="<?php echo $this->input->post('distrito'); ?>">
              <span class="text-danger"><?php echo form_error('distrito');?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="subdistrito" class="col-sm-3 col-form-label">Sub Distrito</label>
            <div class="col-sm-2">
              <input type="text" class="form-control form-control-sm" name="subdistrito" value="<?php echo $this->input->post('subdistrito'); ?>">
              <span class="text-danger"><?php echo form_error('subdistrito');?></span>
            </div>
          </div>
        </div><!-- card body -->
        

        <div class="card-footer">
          <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<!-- content-wrapper ends -->
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
  var fecha = new Date();
  document.getElementById('tipotramite').onchange = function() {
    /* Referencia al option seleccionado */
    var html = '';
    document.getElementById('requisitos').innerHTML = html;
    var mOption = this.options[this.selectedIndex];
    var mData = mOption.dataset;
      $.ajax({
        url: baseurl+"proceso/cargarrequisitos/" + this.value,
        method:"POST",
        success: function(data) {
          const parsedMessage = JSON.parse(data);
          for (var i = 0; i < parsedMessage.length; i++) {

            html += '<label class="form-check-label"><strong>'+ (i+1) + ' ' +parsedMessage[i].nombreRequisito +'</strong></label>';
            html += '<br><br>';
          }
          document.getElementById('requisitos').innerHTML = html;
        }
      });
    };
</script>
