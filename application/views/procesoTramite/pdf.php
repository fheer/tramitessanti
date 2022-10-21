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
        <?php //$nombre .= '.pdf'; ?>
        <?php $nombre; ?>
        <embed src="<?php echo base_url()."fotos/documentos/".$nombre;?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />

      </div>
    </div>

  </div>
<!-- content-wrapper ends -->