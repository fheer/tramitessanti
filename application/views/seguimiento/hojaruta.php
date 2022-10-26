<script type="text/javascript">
  function confirm_modal(id,activo)
  {
      var url = '<?php echo base_url() . "proceso/cambiar/" ;?>';
      $("#url-delete").attr('href', url+id+'/'+activo);
      jQuery('#modal-4').modal('show', {backdrop: 'static'});

  }
</script> 
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>main">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista Tramites</li>
        </ol>
      </nav>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <div class="row">      
          <div class="col-12">
            <div class="table-responsive">
              <table id="order-listing" class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>N° de Tramite</th>
                    <th>Funcionario - Fase</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Informe</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($tramite)) {
                  ?>
                  <?php $i = 1; 
                  $ciInstance = &get_instance();
                  $ciInstance->load->model("Persona_model");
                  $ciInstance->load->model("Cargo_model");
                  $ciInstance->load->model("Actividad_model");

                  foreach ($tramite  as $row) 
                  {
                    
                    $idsolicitante = $row['idpersona'];
                    $idfuncionario = $row['idfuncionario'];
                    
                    $funcionario = $ciInstance->Persona_model->getPersonaByIdfuncionario($idfuncionario);
                    //print_r($funcionario);
                    if ($funcionario['tipoPersona'] == 2) {
                      $cargo = $ciInstance->Cargo_model->getCargo($funcionario['idcargo']);
                    }else{
                      $cargo = $ciInstance->Actividad_model->sacaActividad($funcionario['idactividad']);
                    }
                    ///*
                      $solicitante = $ciInstance->Persona_model->getPersonaId($idsolicitante);
                    //*/
                      //echo $idfuncionario;
                  ?>
                    <tr>
                      <td align="center"><?php echo $i; ?></td>
                      <td><?php echo $row['codigo'];?></td>
                      <td><?php
                      if ($funcionario['tipoPersona']==2) {
                         $pos = strpos($cargo['cargo'], 'Ascesor legal');
                         if ($pos !== false) {
                          echo $funcionario['nombreCompleto']. ' - ' . $cargo['cargo']. ' FASE 1';
                         }
                         $pos = strpos($cargo['cargo'], 'Tecnico 1');
                         if ($pos !== false) {
                          echo $funcionario['nombreCompleto']. ' - ' . $cargo['cargo']. ' FASE 2';
                         }
                         $pos = strpos($cargo['cargo'], 'Profesional 1');
                         if ($pos !== false) {
                          echo $funcionario['nombreCompleto']. ' - ' . $cargo['cargo']. ' FASE 3';
                         }
                         $pos = strpos($cargo['cargo'], 'Sub Alcalde');
                         if ($pos !== false) {
                          echo $funcionario['nombreCompleto']. ' - ' . $cargo['cargo']. ' FASE 4';
                         }
                      }
                      ?>                      
                      </td>
                      <td><?php echo $row['fechaInicio']; ?></td>
                      <td><?php echo $row['fechaFin']; ?></td>
                      <td>
                        <?php
                        if (empty($row['pdf'])) {
                        ?>
                        <a href=""> <img src="<?php echo base_url();?>fotos/pdf.png"> </a>
                        <?php }else{ ?>
                        <a href="<?php echo base_url().'proceso/pdf/'. $row['pdf']; ?>" target="_blank"> <img src="<?php echo base_url();?>fotos/pdf.png"> </a>
                      <?php } ?>
                      </td>
                </tr>                       
                <?php $i++; } ?>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<!-- Modal -->
