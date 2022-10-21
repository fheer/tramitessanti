<?php 
  $permisos = explode("#",$usuario['permisos']);
  $espacios = count($permisos);

  $OpcionesMd5 = md5("1");
  $PersonasMd5 = md5("2");
  $TramitesMd5 = md5("3");
  $SeguimientoMd5 = md5("4");
  $UsuariosMd5 = md5("5");
  $opciones = '';
  $personas = '';
  $tramites = '';
  $seguimiento = '';
  $usuarios = '';
  foreach ($permisos as $permisoMd5)
  {
    switch ($permisoMd5)
    {
      case $OpcionesMd5:
      $opciones = "checked";
      break;
      case $PersonasMd5:
      $personas = "checked";
      break;
      case $TramitesMd5:
      $tramites = "checked";
      break;
      case $SeguimientoMd5:
      $seguimiento = "checked";
      break;
      case $UsuariosMd5:
      $usuarios = "checked";
      break;
    }
  }
?>

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
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>utente">Lista Usuarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <?php echo form_open(base_url().'usuario/editarDB',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="usuario" class="col-sm-3 col-form-label">Usuario</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="nombres" value="<?php echo $persona['nombreCompleto']; ?>" readonly >
            <input type="hidden" class="form-control" name="idpersona" value="<?php echo $persona['idpersona']; ?>" >
            <input type="hidden" class="form-control" name="idusuario" value="<?php echo $usuario['idusuario']; ?>">
            <input type="hidden" class="form-control" name="usuario" value="<?php echo $usuario['usuario']; ?>">
            <input type="hidden" class="form-control" name="foto" value="<?php echo $usuario['foto']; ?>">
            <input type="hidden" class="form-control" name="slug" value="<?php echo $usuario['slug']; ?>">

            <img src="<?php echo base_url().'fotos/usuarios/'.$usuario['foto']; ?>" height="99" width="50">
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
        <div class="form-group row">
          <label for="apellidoMaterno" class="col-sm-3 col-form-label">Permisos</label>
          <div class="col-sm-5">
            <div class="form-check form-check-primary">
              <label class="form-check-label">
                <input type="checkbox" name="permisos[]" value="1" class="form-check-input" <?php echo $opciones;?>>
                Opciones
              </label>
            </div>
            <div class="form-check form-check-success">
              <label class="form-check-label">
                <input type="checkbox" name="permisos[]" value="2" class="form-check-input" <?php echo $personas;?>>
                Personas
              </label>
            </div>
            <div class="form-check form-check-info">
              <label class="form-check-label">
                <input type="checkbox" name="permisos[]" value="3" class="form-check-input" <?php echo $tramites;?>>
                Tramites
              </label>
            </div>
            <div class="form-check form-check-danger">
              <label class="form-check-label">
                <input type="checkbox" name="permisos[]" value="4" class="form-check-input" <?php echo $seguimiento;?>>
                Seguimiento Tramite
              </label>
            </div>
            <div class="form-check form-check-warning">
              <label class="form-check-label">
                <input type="checkbox" name="permisos[]" value="5" class="form-check-input" <?php echo $usuarios;?>>
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