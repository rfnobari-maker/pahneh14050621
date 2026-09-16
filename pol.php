<?php
// مختصات مرکز نقشه برای روستای کردکندی بستان آباد
$center_coords = array(37.956, 47.341);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسم پلیگون در کردکندی - بستان آباد</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 600px; }
    </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />

<script>
// ایجاد نقشه
var map = L.map('map').setView([<?php echo $center_coords[0]; ?>, <?php echo $center_coords[1]; ?>], 15);

// اضافه کردن لایه نقشه
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// اضافه کردن ابزار رسم به نقشه
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems
    },
    draw: {
        polygon: true,
        rectangle: false,
        circle: false,
        marker: false,
        polyline: false
    }
});
map.addControl(drawControl);

// تابع برای محاسبه مساحت
function showArea(layer) {
    var area = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]); // محاسبه مساحت پلیگون
    alert("مساحت پلیگون: " + area.toFixed(2) + " متر مربع"); // نمایش مساحت در پنجره alert
}

// هنگام ترسیم پلیگون، مختصات آن را چاپ می‌کنیم و مساحت را محاسبه می‌کنیم
map.on('draw:created', function (e) {
    var layer = e.layer;
    drawnItems.addLayer(layer);

    // استخراج مختصات پلیگون ترسیم شده
    var coordinates = layer.getLatLngs();
    console.log(coordinates);

    // محاسبه و نمایش مساحت
    showArea(layer);
});
</script>

</body>
</html>
