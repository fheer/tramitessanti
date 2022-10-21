<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <div class="pull-right">
        <h3>Requisitos</h3>
      </div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Ver requisitos - Pdf</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <div class="row">
          <?php
          foreach ($docs as $row) {
            $ciInstance = &get_instance();
            $ciInstance->load->model("Requisito_model");
                    
            $requisto = $ciInstance->Requisito_model->getRequisitoId($row['idrequisito']);
          ?>
          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $requisto['nombreRequisito'];?></h5>
                  <p class="card-description" align="center">
                    <img src="<?php echo base_url().'fotos/documentos/'.$row['ruta'];?>" width="150" height="200">
                  </p>
                </div>
              </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
<!-- content-wrapper ends -->