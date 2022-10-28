<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        <a href="<?php echo  base_url();?>proceso/nuevo" class="btn btn-outline-info"><span class="fa fa-plus-circle" aria-hidden="true"></span> Reportes</a>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Reporte Tramites</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">

      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-title">
                <br>
                <?php
                if ($opcion==1) {
              ?>
                <div align="center">
                  <h4>Trámites en Curso</h4>
                </div>

              <?php }else{ if ($opcion==2) {
              ?>
                <div align="center">
                  <h4>Trámites Aprobados</h4>
                </div>

              <?php }else{?>
                <div align="center">
                  <h4>Reporte Fases</h4>
                </div>
              <?php } }?>
              <div class="card-body">
              <?php
               if (!empty($mensaje)) {
                ?>
                <div class="alert alert-danger">
                 <?php echo $mensaje; ?>
               </div>
              <?php }?>
             <br>
              <?php
                if ($opcion==1) {
              ?>
                <form class="forms-sample" action="<?php echo base_url();?>imprimir/imprimir-en-curso" method="post" enctype="multipart/form-data">
              <?php }else{ if ($opcion==2) {?>
                <form class="forms-sample" action="<?php echo base_url();?>imprimir/imprimir-aprobados" method="post" enctype="multipart/form-data">
              <?php }else{?>
                <form class="forms-sample" action="<?php echo base_url();?>imprimir/imprimir-fases" method="post" enctype="multipart/form-data">
              <?php } }?>
              <div align="center"><label class="col-form-label">Seleccione rango de fechas</label></div>
              <div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputName1" name="idempleado" value="<?php echo $this->session->userdata('idempleado');?>">
              </div>
              <div class="row" align="center">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">De</label>
                    <div class="col-sm-9">
                      <input type="date" name="de" value="<?php echo date('d-m-Y'); ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Hasta</label>
                    <div class="col-sm-9">
                      <input type="date" name="hasta" value="<?php echo date('d-m-Y'); ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <?php if ($opcion==3) {
              ?>

              <div align="center">
                <label for="fase" class="col-sm-2 col-form-label">Expedido</label>
                <div class="col-sm-3" align="center">
                  <select class="js-example-basic-single w-100" name="fase">
                    <option value="1">Fase 1 - Asesor legal</option>
                    <option value="2">Fase 2 - Tecnico 1</option>
                    <option value="3">Fase 3 - Profesional 1</option>
                    <option value="4">Fase 4 - Sub Alcalde</option>
                  </select>
                  <span class="text-danger"><?php echo form_error('fase');?></span>
                </div>
              </div>
              <?php } ?>
              <br>
              <div align="center">
                <button type="submit" class="btn btn-primary mb-2">Aceptar</button>
              </div>
            </form>
              </div>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
