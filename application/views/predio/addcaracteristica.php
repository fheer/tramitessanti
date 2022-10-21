<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">

      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>predio/tramites-asignados">Formulario Datos Técnicos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Formulario</li>
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
        <?php echo form_open(base_url().'predio/guardar-caracteristica',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
                <p class="card-description">
                  Caracteristicas de la(s) Construcciones
                </p>
                <p class="card-description">
                  Año
                </p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Construcción</label>
                      <input type="hidden" class="form-control" name="codigocatastral" value="<?php echo $codigocatastral; ?>" >
                      <input type="hidden" class="form-control" name="codigotramite" value="<?php echo $codigotramite; ?>" >
                      <input type="hidden" class="form-control" name="idpersona" value="<?php echo $idpersona; ?>" >
                      <div class="col-sm-6">
                        <input type="text" name="construccion" value="<?php echo $this->input->post('construccion'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('construccion');?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Modificado</label>
                      <div class="col-sm-6">
                        <input type="text" name="modificado" value="<?php echo $this->input->post('modificado'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('modificado');?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Bloque</label>
                      <div class="col-sm-4">
                        <input type="text" name="bloque" value="<?php echo $this->input->post('bloque'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('bloque');?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Superficie construida</label>
                      <div class="col-sm-4">
                        <input type="text" name="superficieconstruida" value="<?php echo $this->input->post('superficieconstruida'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('superficieconstruida');?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Pisos</label>
                      <div class="col-sm-4">
                        <input type="text" name="pisos" value="<?php echo $this->input->post('pisos'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('pisos');?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tipología</label>
                      <div class="col-sm-6">
                        <input type="text" name="tipologia" value="<?php echo $this->input->post('tipologia'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('tipologia');?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Puntaje</label>
                      <div class="col-sm-6">
                        <input type="text" name="puntaje" value="<?php echo $this->input->post('puntaje'); ?>" class="form-control" />
                        <span class="text-danger"><?php echo form_error('puntaje');?></span>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
          </div>
            </div>
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          <a href="<?php echo base_url().'predio/tramites-asignados'; ?>" class="btn btn-light">Cancelar</a>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->