<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>normav">Lista Norma Legal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Modificar Norma Legal</li>
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
        <?php echo form_open(base_url().'norma/editar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="nombreNorma Legal" class="col-sm-2 col-form-label">Nombre Norma Legal</label>
          <div class="col-sm-7">
            <input type="hidden" class="form-control" name="slug" value="<?php echo $normalegal['slug'];?>">
            <input type="text" class="form-control" name="normalegal" value="<?php echo $normalegal['normalegal'];?>">
            <span class="text-danger"><?php echo form_error('normalegal');?></span>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          <a href="<?php echo base_url().'norma'; ?>" class="btn btn-light">Cancelar</a>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->