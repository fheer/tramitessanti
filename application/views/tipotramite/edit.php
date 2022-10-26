<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>nombretramite/lista">Lista Tipo de Trámite</a></li>
          <li class="breadcrumb-item active" aria-current="page">Modificar Tipo de Trámite</li>
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
        <?php echo form_open(base_url().'tipotramite/modificar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>

        <div class="form-group row">
          <label for="idnormalegal" class="col-sm-2 col-form-label">Nro Norma Legal</label>
          <div class="col-sm-3">
            <select class="js-example-basic-single w-100" name="idnormalegal">
              <option value="<?php echo $normalegalID['idnormalegal']; ?>"><?php echo $normalegalID['normalegal']; ?></option>
              <?php foreach ($normalegal as $row) { ?>
                <option value="<?php echo $row['idnormalegal']; ?>"><?php echo $row['normalegal']; ?></option>
              <?php } ?> 
            </select>
            <span class="text-danger"><?php echo form_error('idnormalegal');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="nombre" class="col-sm-2 col-form-label">Trámite</label>
          <div class="col-sm-4">
            <input type="hidden" class="form-control" name="idtipotramite" value="<?php echo $tipotramite['idtipotramite']; ?>">
            <input type="text" class="form-control" name="slug" value="<?php echo $tipotramite['key']; ?>">
            <input type="text" class="form-control" name="nombre" value="<?php echo $tipotramite['nombre']; ?>">
            <span class="text-danger"><?php echo form_error('nombre');?></span>
          </div>
        </div>
        
        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="descripcion" value="<?php echo $tipotramite['descripcion']; ?>">
            <span class="text-danger"><?php echo form_error('descripcion');?></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="tiempoEstimado" class="col-sm-2 col-form-label">Tiempo Estimado</label>
          <div class="col-sm-1">
            <input type="text" class="form-control" name="tiempoEstimado" value="<?php echo $tipotramite['tiempoEstimado']; ?>">
            <span class="text-danger"><?php echo form_error('tiempoEstimado');?></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Asignar Requisitos</label>
          <div class="col-sm-9">
            <?php
              $arreglo= array();
              foreach ($requisitos as $rowRequisitos) {
                array_push($arreglo, $rowRequisitos['idrequisito']);
              }
            ?>
            <?php foreach ($requisito as $row) {
            if (in_array($row['idrequisito'], $arreglo)) {
            ?>
            <div class="form-check form-check-danger">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" name="requisitos[]" value="<?php echo $row['idrequisito'];?>" checked><?php echo $row['nombreRequisito'];?></label>
            </div> 
            <?php }else{ ?>
            <div class="form-check form-check-danger">
              <label class="form-check-label"><input type="checkbox" class="form-check-input" name="requisitos[]" value="<?php echo $row['idrequisito'];?>"><?php echo $row['nombreRequisito'];?></label>
            </div> 
            <?php } }?>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        <a href="<?php echo base_url().'tipotramite/lista'; ?>" class="btn btn-light">Cancelar</a>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->