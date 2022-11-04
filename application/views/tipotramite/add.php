<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>tipotramite/lista">Lista Tipo de Trámite</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Tipo de Trámite</li>
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
        <?php echo form_open(base_url().'tipotramite/guardar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>

        <div class="form-group row">
          <label for="idnormalegal" class="col-sm-2 col-form-label">Nro Norma Legal</label>
          <div class="col-sm-3">
            <select class="js-example-basic-single w-100" name="idnormalegal">
              <?php foreach ($normalegal as $row) { ?>
                <option value="<?php echo $row['idnormaLegal']; ?>"><?php echo $row['normalegal']; ?></option>
              <?php } ?> 
            </select>
            <span class="text-danger"><?php echo form_error('idnormalegal');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="nombre" class="col-sm-2 col-form-label">Trámite</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="nombre" value="<?php echo $this->input->post('nombre'); ?>">
            <span class="text-danger"><?php echo form_error('nombre');?></span>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="descripcion" value="<?php echo $this->input->post('descripcion'); ?>">
            <span class="text-danger"><?php echo form_error('descripcion');?></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="tiempoEstimado" class="col-sm-2 col-form-label">Tiempo Estimado</label>
          <div class="col-sm-1">
            <input type="text" class="form-control" name="tiempoEstimado" value="<?php echo $this->input->post('tiempoEstimado'); ?>">
            <span class="text-danger"><?php echo form_error('tiempoEstimado');?></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Asignar Requisitos</label>
          <div class="col-sm-9">
            <?php foreach ($requisito as $row) { ?>
              <div class="form-check form-check-danger">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" name="requisitos[]" value="<?php echo $row['idrequisito'];?>"><?php echo $row['nombreRequisito'];?></label>
              </div> 
            <?php } ?>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          <a href="<?php echo base_url().'tipotramite/lista'; ?>" class="btn btn-light">Cancelar</a>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->