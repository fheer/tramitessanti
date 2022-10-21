var map=L.map('mapid').
setView([-17.33833, -66.22095],
  16);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
  maxZoom: 19
}).addTo(map);

var popup = L.popup();

function onMapClick(e) {
  popup
    .setLatLng(e.latlng) 
    .setContent(e.latlng.lat.toString() + "," +  e.latlng.lng.toString()) 
    .openOn(map);  
    var lat = e.latlng.lat.toString();
    var lng = e.latlng.lng.toString();
    $('#lat').val(lat);
    $('#lng').val(lng);
    var marker = L.marker([lat, lng]).addTo(map);  
}

map.on('click', onMapClick);