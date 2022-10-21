var latitud = document.getElementById("lat").value;
var longitud = document.getElementById("lng").value;
 
var map = L.map('mapid').setView([latitud, longitud], 18);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker = L.marker([latitud, longitud]).addTo(map); 
     
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