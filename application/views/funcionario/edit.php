<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Editar Datos
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>funcionario">Lista Funcionarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Modificar Funcionario</li>
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
        <?php echo form_open(base_url().'funcionario/editarDB',array("class"=>"forms-sample","enctype"=>"multipart/form-data")); ?>
        <div class="form-group row">
          <label for="ci" class="col-sm-3 col-form-label">CI</label>
          <div class="col-sm-2">
            <input type="hidden" class="form-control" name="opcion" value="<?php echo $opcion;?>">
            <input type="hidden" class="form-control" name="tipoPersona" value="<?php echo $funcionario['tipoPersona']; ?>">
            <input type="hidden" class="form-control" name="idpersona" value="<?php echo $funcionario['idpersona']; ?>">
            <input type="text" class="form-control" name="ci" value="<?php echo $funcionario['ci']; ?>">
            <span class="text-danger"><?php echo form_error('ci');?></span>
          </div>
          <label for="idexpedido" class="col-sm-1 col-form-label">Expedido</label>
          <div class="col-sm-1">
            <select class="js-example-basic-single w-100" name="idexpedido">
              <option value="<?php echo $funcionario['idexpedido']; ?>"><?php echo $funcionario['idexpedido']; ?></option>
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
          <label for="idcargo" class="col-sm-3 col-form-label">Actividad</label>
          <div class="col-sm-3">
            <select class="js-example-basic-single w-100" name="idcargo">
              <option value="<?php echo $act['idcargo']; ?>"><?php echo $act['cargo']; ?></option>
              <?php foreach ($cargo as $row) { ?>
                <option value="<?php echo $row['idcargo']; ?>"><?php echo $row['cargo']; ?></option>
              <?php } ?> 
            </select>
            <span class="text-danger"><?php echo form_error('idcargo');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="nombres" class="col-sm-3 col-form-label">Nombre(s)</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="nombres" value="<?php echo $funcionario['nombres']; ?>">
            <span class="text-danger"><?php echo form_error('nombres');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="apellidoPaterno" class="col-sm-3 col-form-label">Apellido Paterno</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="apellidoPaterno" value="<?php echo $funcionario['apellidoPaterno']; ?>">
            <span class="text-danger"><?php echo form_error('apellidoPaterno');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="apellidoMaterno" class="col-sm-3 col-form-label">Apellido Materno</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="apellidoMaterno" value="<?php echo $funcionario['apellidoMaterno']; ?>">
            <span class="text-danger"><?php echo form_error('apellidoMaterno');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="genero" class="col-sm-3 col-form-label">Genero</label>
          <div class="col-sm-1">
            <select class="js-example-basic-single w-100" name="genero">
              <option value="<?php echo $funcionario['genero']; ?>"><?php echo $funcionario['genero']; ?></option>
              <option value="F">F</option>
              <option value="M">M</option>
            </select>
            <span class="text-danger"><?php echo form_error('genero');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="estadoCivil" class="col-sm-3 col-form-label">Estado civil</label>
          <div class="col-sm-2">
            <select class="js-example-basic-single w-100" name="estadoCivil">
              <option value="<?php echo $funcionario['estadoCivil']; ?>"><?php echo $funcionario['estadoCivil']; ?></option>
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
            <input type="date" name="fechaNacimiento" value="<?php echo $funcionario['fechaNacimiento']; ?>">
            <span class="text-danger"><?php echo form_error('fechaNacimiento');?></span>
          </div>

        </div>
        <div class="form-group row">
          <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="direccion" value="<?php echo $funcionario['direccion']; ?>" placeholder="Zona, calle , número">
            <span class="text-danger"><?php echo form_error('direccion');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="telefono" class="col-sm-3 col-form-label"># Telefono</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="telefono" value="<?php echo $funcionario['telefono']; ?>">
            <span class="text-danger"><?php echo form_error('telefono');?></span>
          </div>
        </div>
        <div class="form-group row">
          <label for="celular" class="col-sm-3 col-form-label"># Celular</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="celular" value="<?php echo $funcionario['celular']; ?>">
            <span class="text-danger"><?php echo form_error('celular');?></span>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
        <?php if ($opcion==1) {
          ?>
          <a href="<?php echo base_url().'funcionario'; ?>" class="btn btn-light">Cancelar</a>
        <?php }  
          ?>
          

        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
<!-- content-wrapper ends -->