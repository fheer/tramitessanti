<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Nuevo Usuario
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>utente">Lista Usuario</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nuevo Usuario</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <?php echo form_open(base_url().'usuario/guardarDB',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="ci" class="col-sm-3 col-form-label">Funcionario</label>
          <div class="col-sm-4">
            <select class="js-example-basic-single w-100" name="idexpedido">
              <?php foreach ($persona as $row) { ?>
                <option value="<?php echo $row['idpersona']; ?>"><?php echo $row['nombreCompleto']; ?></option>
              <?php } ?> 
            </select>
            <span class="text-danger"><?php echo form_error('idexpedido');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="apellidoMaterno" class="col-sm-3 col-form-label">Permisos</label>
          <div class="col-sm-5">
            <div class="form-check form-check-primary">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" >
                Opciones
              </label>
            </div>
            <div class="form-check form-check-success">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" >
                Personas
              </label>
            </div>
            <div class="form-check form-check-info">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" >
                Tramites
              </label>
            </div>
            <div class="form-check form-check-danger">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" >
                Seguimiento Tramite
              </label>
            </div>
            <div class="form-check form-check-warning">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" >
                Usuarios
              </label>
            </div>
          </div>
        </div>   
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        
        <a href="<?php echo base_url().'utente'; ?>" class="btn btn-light">Cancelar</a>
      

        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->