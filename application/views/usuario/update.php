<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Modificar Usuario
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>utente">Lista Usuarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <?php echo form_open(base_url().'usuario/editar',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="usuario" class="col-sm-3 col-form-label">Nombre</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="nombres" value="<?php echo $persona['nombreCompleto']; ?>" readonly >
            <input type="hidden" class="form-control" name="idpersona" value="<?php echo $persona['idpersona']; ?>" >
            <input type="hidden" class="form-control" name="idusuario" value="<?php echo $usuario['idpersona']; ?>">
            <input type="hidden" class="form-control" name="usuario" value="<?php echo $usuario['usuario']; ?>">
            <input type="hidden" class="form-control" name="foto" value="<?php echo $usuario['foto']; ?>">
            <input type="hidden" class="form-control" name="slug" value="<?php echo $usuario['key']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="usuario" class="col-sm-3 col-form-label">Usuario</label>
          <div class="col-sm-2">
            <input type="text" class="form-control" name="usuario" value="<?php echo $usuario['usuario']; ?>" readonly >
            <span class="text-danger"><?php echo form_error('usuario');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="clave" class="col-sm-3 col-form-label">Contraseña</label>
          <div class="col-sm-4">
            <input type="password" class="form-control" name="clave" value="">
            <span class="text-danger"><?php echo form_error('clave');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="foto" class="col-sm-3 col-form-label">Foto</label>
          <div class="col-sm-4">
            <input type="file" name="userfile" id="userfile" class="file-upload-default">
            <div class="input-group col-xs-8">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Subir</button>
              </span>
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