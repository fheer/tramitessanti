<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>solicitante">Lista Solicitantes</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Solicitante</li>
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
        <?php echo form_open(base_url().'solicitante/guardarDB',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="ci" class="col-sm-3 col-form-label">CI</label>
          <div class="col-sm-2">
            <input type="hidden" class="form-control" name="opcion" value="<?php echo $opcion;?>">
            <input type="hidden" class="form-control" name="tipoPersona" value="1">
            <input type="text" class="form-control" name="ci" value="<?php echo $this->input->post('ci'); ?>">
            <span class="text-danger"><?php echo form_error('ci');?></span>
          </div>
          <label for="idexpedido" class="col-sm-1 col-form-label">Expedido</label>
          <div class="col-sm-1">
            <select class="js-example-basic-single w-100" name="idexpedido">
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
            <input type="text" class="form-control" name="nombres" value="<?php echo $this->input->post('nombres'); ?>">
            <span class="text-danger"><?php echo form_error('nombres');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="apellidoPaterno" class="col-sm-3 col-form-label">Apellido Paterno</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="apellidoPaterno" value="<?php echo $this->input->post('apellidoPaterno'); ?>">
            <span class="text-danger"><?php echo form_error('apellidoPaterno');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="apellidoMaterno" class="col-sm-3 col-form-label">Apellido Materno</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="apellidoMaterno" value="<?php echo $this->input->post('apellidoMaterno'); ?>">
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
          <label for="direccion" class="col-sm-3 col-form-label">Direcci??n</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="direccion" value="<?php echo $this->input->post('direccion'); ?>" placeholder="Zona, calle , n??mero">
            <span class="text-danger"><?php echo form_error('direccion');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="telefono" class="col-sm-3 col-form-label"># Telefono</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="telefono" value="<?php echo $this->input->post('telefono'); ?>">
            <span class="text-danger"><?php echo form_error('telefono');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="celular" class="col-sm-3 col-form-label"># Celular</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="celular" value="<?php echo $this->input->post('celular'); ?>">
            <span class="text-danger"><?php echo form_error('celular');?></span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        <?php if ($opcion==1) {
          ?>
          <a href="<?php echo base_url().'solicitante'; ?>" class="btn btn-light">Cancelar</a>
        <?php }else{  
          ?>
          <a href="<?php echo base_url().'procesotramite/insert'; ?>" class="btn btn-light">Cancelar</a>
          <?php  
        } ?>

        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->