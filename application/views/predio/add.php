<?php
$ci = &get_instance();
$ci->load->model("Tramite_model");
$tramite = $ci->Tramite_model->getTramiteByCodigo($codigotramite);
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
        <?php echo form_open(base_url().'predio/guardar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="nombreRequisito" class="col-sm-1 col-form-label">Solicitante</label>
          <div class="col-sm-4">
            <input type="hidden" class="form-control" name="codigocatastral" value="<?php echo $codigocatastral; ?>" >
            <input type="hidden" class="form-control" name="codigotramite" value="<?php echo $codigotramite; ?>" >
            <input type="hidden" class="form-control" name="idtramite" value="<?php echo $tramite['idtramite']; ?>" >
            <input type="hidden" class="form-control" name="idpersona" value="<?php echo $idpersona; ?>" >
            <input type="text" class="form-control" name="solicitante" value="<?php echo $solicitante['nombreCompleto']; ?>" readonly>
            <span class="text-danger"><?php echo form_error('solicitante');?></span>
          </div>
          <label for="codigocatastral" class="col-sm-1 col-form-label">Código Catastral</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="codigocatastral" value="<?php echo $codigocatastral; ?>" readonly>
            <span class="text-danger"><?php echo form_error('codigocatastral');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="nombreRequisito" class="col-sm-1 col-form-label">Matrícula</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="matricula" value="<?php echo $this->input->post('matricula'); ?>">
            <span class="text-danger"><?php echo form_error('matricula');?></span>
          </div>
          <label for="asiento" class="col-sm-1 col-form-label">Asiento</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="asiento" value="<?php echo $this->input->post('asiento'); ?>">
            <span class="text-danger"><?php echo form_error('asiento');?></span>
          </div>
          <label for="fechaddrr" class="col-sm-1 col-form-label">Fecha DD.RR.</label>
          <div class="col-sm-3">
            <div class="col-sm-8 input-group date datepicker">
              <input type="date" name="fechaddrr" value="<?php date_default_timezone_set("America/La_Paz"); echo date('Y-m-d');?>">
              <span class="text-danger"><?php echo form_error('fechaddrr');?></span>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="fechaimpresion" class="col-sm-1 col-form-label">Fecha</label>
          <div class="col-sm-3">
            <div class="col-sm-8 input-group date datepicker">
              <input type="date" name="fechaimpresion" value="<?php date_default_timezone_set("America/La_Paz"); echo date('Y-m-d');?>">
              <span class="text-danger"><?php echo form_error('fechaimpresion');?></span>
            </div>
          </div>
          <label for="codigoform" class="col-sm-1 col-form-label">Código</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="codigoform" value="<?php echo $this->input->post('codigoform'); ?>">
            <span class="text-danger"><?php echo form_error('codigoform');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="calle" class="col-sm-1 col-form-label">Calle</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="calle" value="<?php echo $this->input->post('calle'); ?>">
            <span class="text-danger"><?php echo form_error('calle');?></span>
          </div>
          <label for="edificio" class="col-sm-1 col-form-label">Edificio</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="edificio" value="<?php echo $this->input->post('edificio'); ?>">
            <span class="text-danger"><?php echo form_error('edificio');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="frente" class="col-sm-1 col-form-label">Frente</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="frente" value="<?php echo $this->input->post('frente'); ?>">
            <span class="text-danger"><?php echo form_error('frente');?></span>
          </div>
          <label for="fondo" class="col-sm-1 col-form-label">Fondo</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="fondo" value="<?php echo $this->input->post('fondo'); ?>">
            <span class="text-danger"><?php echo form_error('fondo');?></span>
          </div>
          <label for="superficie" class="col-sm-1 col-form-label">Superficie</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="superficie" value="<?php echo $this->input->post('superficie'); ?>">
            <span class="text-danger"><?php echo form_error('superficie');?></span>
          </div>
           <label for="ubicacion" class="col-sm-1 col-form-label">Ubicación</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="ubicacion" value="<?php echo $this->input->post('ubicacion'); ?>">
            <span class="text-danger"><?php echo form_error('ubicacion');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="zona" class="col-sm-1 col-form-label">Zona Homogénea</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="zona" value="<?php echo $this->input->post('zona'); ?>">
            <span class="text-danger"><?php echo form_error('zona');?></span>
          </div>
          <label for="materialvia" class="col-sm-1 col-form-label">Material vía</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="materialvia" value="<?php echo $this->input->post('materialvia'); ?>">
            <span class="text-danger"><?php echo form_error('materialvia');?></span>
          </div>
          <label for="inclinacion" class="col-sm-1 col-form-label">Inclinación</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="inclinacion" value="<?php echo $this->input->post('inclinacion'); ?>">
            <span class="text-danger"><?php echo form_error('inclinacion');?></span>
          </div>
           <label for="forma" class="col-sm-1 col-form-label">Forma</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="forma" value="<?php echo $this->input->post('forma'); ?>">
            <span class="text-danger"><?php echo form_error('forma');?></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="alcantarillado" class="col-sm-1 col-form-label">Alcantarillado</label>
          <div class="col-sm-2">
            <select class="js-example-basic-single w-100" name="alcantarillado">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <span class="text-danger"><?php echo form_error('alcantarillado');?></span>
          </div>
          <label for="electrica" class="col-sm-1 col-form-label">Energia eléctrica</label>
          <div class="col-sm-2">
            <select class="js-example-basic-single w-100" name="electrica">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <span class="text-danger"><?php echo form_error('electrica');?></span>
          </div>
          <label for="telefono" class="col-sm-1 col-form-label">Telefono</label>
          <div class="col-sm-2">
            <select class="js-example-basic-single w-100" name="telefono">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <span class="text-danger"><?php echo form_error('telefono');?></span>
          </div>
           <label for="aguapotable" class="col-sm-1 col-form-label">Agua Potable</label>
          <div class="col-sm-2">
            <select class="js-example-basic-single w-100" name="aguapotable">
              <option value="Si">Si</option>
              <option value="No">No</option>
            </select>
            <span class="text-danger"><?php echo form_error('aguapotable');?></span>
          </div>
        </div>

        <div class="form-group row">
          <label for="zona" class="col-sm-1 col-form-label">Croquis del predio</label>
          <div class="col-sm-5">
            <input type="file" name="croquis">
          </div>
           <label for="forma" class="col-sm-1 col-form-label">Croquis de ubicación</label>
          <div class="col-sm-5">
            <input type="file" name="croquisubicacion">
          </div>
        </div>
        <div class="form-group row">
          <label for="materialvia" class="col-sm-1 col-form-label">Fachada 1</label>
          <div class="col-sm-5">
            <input type="file" name="fachadauno">
          </div>
          <label for="inclinacion" class="col-sm-1 col-form-label">Fachada 2</label>
          <div class="col-sm-5">
            <input type="file" name="fachadados">
          </div>
        </div>
        <div class="form-group row">
          <label for="materialvia" class="col-sm-1 col-form-label">Interior</label>
          <div class="col-sm-5">
            <input type="file" name="interior">
          </div>
        </div>

        <div class="form-group row">
          <label for="descripcion" class="col-sm-2 col-form-label">Observaciones</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="exampleTextarea1" name="observaciones" rows="4"></textarea>
            <span class="text-danger"><?php echo form_error('observaciones');?></span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
          <a href="<?php echo base_url().'predio/tramites-asignados'; ?>" class="btn btn-light">Cancelar</a>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->