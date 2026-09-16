<!DOCTYPE html>
<html>
<head>
    <title>نمایش مکان با OpenStreetMap</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { 
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h3>نمایش مکان روی نقشه</h3>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([31.03059, 53.33199], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        L.marker([31.03059, 53.33199]).addTo(map)
            .bindPopup('مکان مشخص شده.')
            .openPopup();
    </script>
</body>
</html>
