<script type="text/javascript">
  function confirm_modal()
  {
    alert('Hola');
    $("#errorLogin").modal("show");
      //jQuery('#modal-4').modal('show', {backdrop: 'static'});
      //document.getElementById('idpersonadatos').value = id;
  }
</script>
<?php
if ($this->session->userdata('logueado')==0) {

  //redirect(base_url().'Welcome/error/');

}
$ciU = &get_instance();
$ciU->load->model('Usuario_model');
$ciU->load->model('Persona_model');
$idfuncionario = $ciU->session->userdata('idpersona');
$idpersona = $ciU->session->userdata('idPersona');
$tramitesActivos = $ciU->Usuario_model->tramitesActivos($idfuncionario);
$countTramitesActivos = $ciU->Usuario_model->countTramitesActivos($idfuncionario);
$tramitesActivosSolicitante = $ciU->Usuario_model->tramitesActivosSolicitante($idpersona);
$countTramitesActivosSolicitante = $ciU->Usuario_model->countTramitesActivosSolicitante($idpersona);
//print_r($data);

$usuario = $ciU->Usuario_model->getUsuario($this->session->userdata('token'));
if (!empty($usuario)) {
$permisos = explode("#",$usuario['permisos']);
$espacios = count($permisos);

$OpcionesMd5 = md5("1");
$PersonasMd5 = md5("2");
$TramitesMd5 = md5("3");
$SeguimientoMd5 = md5("4");
$UsuariosMd5 = md5("5");
$FormMD = md5("6");
foreach ($permisos as $permisoMd5)
  {
    switch ($permisoMd5)
    {
      case $OpcionesMd5:
        $opciones = "Opciones";
        break;
      case $PersonasMd5:
        $personas = "Personas";
        break;
      case $TramitesMd5:
        $tramites = "Tramites";
        break;
      case $SeguimientoMd5:
        $seguimiento = "Seguimiento";
        break;
      case $UsuariosMd5:
        $usuarios = "Usuarios";
        break;
      case $FormMD:
        $form = "form";
        break;

    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/widgets.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:10:41 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Seguimiento Trámites</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-editable-select.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url();?>favicon.png" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
  <style type="text/css">
  #mapid {
    width: 100%;
    height: 600px;
  }
  #mapview {
    width: 100%;
    height: 300px;
  }

  #mapreport {
    width: 300px;
    height: 200px;
  }
</style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href=""><img src="<?php echo base_url();?>fotos/emblema.jpg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href=""><img src="<?php echo base_url();?>fotos/emblema.jpg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    
                  </span>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-envelope mx-0"></i>
              <span class="count">
                <?php
                if (!empty($countTramitesActivos)) {
                  echo $countTramitesActivos;
                }elseif (!empty($countTramitesActivosSolicitante)){
                  echo $countTramitesActivosSolicitante;
                }else{
                  echo '0';
                }
                ?>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <span class="badge badge-info badge-pill float-right"><?php
                  if (!empty($countTramitesActivos)) {
                    echo 'Tienes '.$countTramitesActivos.' trámite(s) activo';
                  }elseif (!empty($countTramitesActivosSolicitante)){
                    echo 'Tienes '.$countTramitesActivosSolicitante.' trámite activo';
                  }else{
                    echo 'Tienes 0 asignados';
                  }
                  ?></span>
              </div>
              <?php
                $ci = &get_instance();
                $ci->load->model("Tramite_model");
                $ci->load->model("TipoTramite_model");
                foreach ($tramitesActivos  as $row) 
                { 
                    $dato = $ci->Tramite_model->getTramite($row['idtramite']);
                    $tipoTramite = $ci->TipoTramite_model->getTipoTramiteId($dato['idtipotramite']);
              ?>
              <?php  if (!empty($tramitesActivos)) {?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="<?php echo base_url().'asignado/view/'.$row['idtramite'] ?>">
                
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"><?php echo $dato['codigo'] ?>
                  </h6>
                  <p class="font-weight-light small-text">
                    <?php echo $tipoTramite['nombreRequisito'] ?>
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <?php } }?>
              <?php
                $ci = &get_instance();
                $ci->load->model("Tramite_model");
                $ci->load->model("TipoTramite_model");
                foreach ($tramitesActivosSolicitante  as $row) 
                { 
                    $dato = $ci->Tramite_model->getTramite($row['idtramite']);
                    $tipoTramite = $ci->TipoTramite_model->getTipoTramiteId($dato['idtipotramite']);
              ?>
              <?php  if (!empty($tramitesActivosSolicitante)) {?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="<?php echo base_url().'asignado/view/'.$row['idtramite'] ?>">
                
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"><?php echo $dato['codigo'] ?>
                  </h6>
                  <p class="font-weight-light small-text">
                    <?php echo $tipoTramite['nombreRequisito']; ?>
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <?php } }?>
              
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="<?php echo base_url().'fotos/usuarios/'.$this->session->userdata('foto'); ?>" alt="Perfil"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?php echo base_url().'utente/ver/'.$this->session->userdata('token');?>">
                <i class="fas fa-cog text-primary"></i>
                Perfil
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url();?>utente/salir" class="dropdown-item">
                <i class="fas fa-power-off text-primary"></i>
                Salir
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="fas fa-ellipsis-h"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial:../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="profile-image">
                <img src="<?php echo base_url().'fotos/usuarios/'.$this->session->userdata('foto'); ?>" alt="image"/>
              </div>
              <div class="profile-name">
                <p class="name">
                  <?php echo $this->session->userdata('nomUser'); ?>
                </p>
                <p class="name">
                  <?php echo $this->session->userdata('apUser'); ?>
                </p>
                <p class="designation">
                  <?php echo $this->session->userdata('idusuario');?>
                  ---------------------------
                </p>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>main">
              <i class="fa fa-home menu-icon"></i>
              <span class="menu-title">Inicio</span>
            </a>
          </li>
          
          <?php
          if (!empty($opciones)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
              <i class="fa fa-cogs menu-icon"></i>
              <span class="menu-title">Opciones</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="<?php echo base_url(); ?>norma">Norma legal</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>requisito/lista">Requisitos</a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>tipotramite/lista">Tipo de tramite</a>
                </li>
                </li>
              </ul>
            </div>
          </li>
          <?php
           } 
          ?>
          <?php
          if (!empty($personas)) {
          ?>
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
              <i class="fa fa-child menu-icon"></i>
              <span class="menu-title">Personas</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sidebar-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>funcionario">Funcionario</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>solicitante">Solicitante</a></li>
              </ul>
            </div>
          </li>
          <?php
           } 
          ?>
          <?php
          if (!empty($tramites)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="fas fa-clipboard-list menu-icon"></i>
              <span class="menu-title">Tramites</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                <a class="nav-link" href="<?php echo  base_url();?>proceso/lista/1">Tramites En Curso</a></li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo  base_url();?>proceso/lista/2">Tramites Aprobados</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo  base_url();?>formulario/lista">Solicitud de Trámites</a></li>
              </ul>
            </div>
          </li>
          <?php
           } 
          ?>
          <?php
          if (!empty($seguimiento)) {
          ?>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
              <i class="fas fa-file menu-icon"></i>
              <span class="menu-title">Seguimiento</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="general-pages">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>seguimiento/buscar">Buscar</a></li>
              </ul>
            </div>
          </li>

          <?php
           } 
          ?>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#e-commerce" aria-expanded="false" aria-controls="e-commerce">
              <i class="fas fa-shopping-cart menu-icon"></i>
              <span class="menu-title">Reportes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="e-commerce">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>imprimir/reporte-en-curso/3" target="_blank"> Fases </a></li>
              </ul>
            </div>
          </li>

          <!--
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
              <i class="fas fa-file menu-icon"></i>
              <span class="menu-title">Datos Técnicos</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>predio/tramites-asignados">Lista Tramites</a></li>
              </ul>
            </div>
          </li>
          -->
          <?php
          if (!empty($usuarios)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
              <i class="far fa-user menu-icon"></i>
              <span class="menu-title">Usuarios</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="maps">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>utente">Lista</a></li>
              </ul>
            </div>
          </li>
          <?php
           } 
          ?>
          <?php
          if (!empty($form)) {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>formulario" target="_blank">
              <i class="fas fa-minus-square menu-icon"></i>
              <span class="menu-title">Formulario</span>
            </a>
          </li>
          <?php
           }
          ?>
        </ul>
      </nav>
