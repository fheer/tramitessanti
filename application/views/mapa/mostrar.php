<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Ver mapa
      </h3>
    </div>
    <div class="row grid-margin">
      <div class="col-12">
        <input type="hidden" id="latitud" value="<?php echo $latitud;?>">
        <input type="hidden" id="longitud" value="<?php echo $longitud;?>">
        <div id="mapid"></div>
      </div>
    </div>
</div>
<script type="text/javascript">
      
      var latitud = document.getElementById("latitud").value;
      var longitud = document.getElementById("longitud").value;
      //alert(latitud);
      
       var map = L.map('mapid').setView([latitud, longitud], 18);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      L.marker([latitud, longitud]).addTo(map).openPopup();
</script>
<!-- content-wrapper ends -->