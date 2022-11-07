<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>requisito/lista">Lista Requisitos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Requisito</li>
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
        <?php echo form_open(base_url().'requisito/editar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="nombreRequisito" class="col-sm-2 col-form-label">Nombre Requisito</label>
          <div class="col-sm-7">
            <input type="hidden" class="form-control" name="slug" value="<?php echo $requisito['key']; ?>">
            <input type="text" class="form-control" name="nombreRequisito" value="<?php echo $requisito['nombreRequisito']; ?>">
            <span class="text-danger"><?php echo form_error('nombreRequisito');?></span>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Descripción Requisito</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="descripcion" value="<?php echo $requisito['descripcion']; ?>">
            <span class="text-danger"><?php echo form_error('descripcion');?></span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          <a href="<?php echo base_url().'requisito/lista'; ?>" class="btn btn-light">Cancelar</a>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->