<?php
$center_coords = array(37.85, 46.65); // مرکز نقشه برای روستای کردکندی بستان آباد
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محاسبه مساحت پلیگون با عکس هوایی</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
    <style>
        #map { height: 600px; }
        #area-info { margin-top: 10px; font-family: Arial, sans-serif; }
    </style>
</head>
<body>

<div id="map"></div>
<div id="area-info">مساحت: <span id="area">0</span> متر مربع</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/6.5.0/turf.min.js"></script>

<script>
// ایجاد نقشه
var map = L.map('map').setView([<?php echo $center_coords[0]; ?>, <?php echo $center_coords[1]; ?>], 15);

// لایه عکس هوایی (Esri)
var esriSat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; <a href="https://www.esri.com">Esri</a> World Imagery'
}).addTo(map);

// لایه نقشه OpenStreetMap (در صورت نیاز به تغییر)
var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
});

// افزودن کنترل تغییر لایه‌ها
var baseLayers = {
    "عکس هوایی": esriSat,
    "نقشه OSM": osmLayer
};
L.control.layers(baseLayers).addTo(map);

// گروه برای پلیگون‌های رسم‌شده
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

// ابزار رسم
var drawControl = new L.Control.Draw({
    edit: { featureGroup: drawnItems },
    draw: {
        polygon: true,
        rectangle: false,
        circle: false,
        marker: false,
        polyline: false
    }
});
map.addControl(drawControl);

// محاسبه مساحت
function calculateArea(layer) {
    var latlngs = layer.getLatLngs()[0]; // مختصات پلیگون
    var coordinates = latlngs.map(function(latlng) {
        return [latlng.lng, latlng.lat]; // تبدیل به قالب [lng, lat]
    });

    coordinates.push(coordinates[0]); // بستن حلقه پلیگون
    var polygon = turf.polygon([coordinates]);
    var area = turf.area(polygon); // محاسبه مساحت با Turf.js
    return area.toFixed(2); // مقدار نهایی مساحت
}

// رویداد برای رسم پلیگون جدید
map.on('draw:created', function (e) {
    var layer = e.layer;
    drawnItems.addLayer(layer);

    // محاسبه مساحت و نمایش
    var area = calculateArea(layer);
    document.getElementById('area').innerText = area;

    // رویداد برای ویرایش پلیگون
    layer.on('edit', function () {
        var updatedArea = calculateArea(layer);
        document.getElementById('area').innerText = updatedArea;
    });
});

// رویداد برای ویرایش پلیگون موجود
map.on('draw:edited', function (e) {
    e.layers.eachLayer(function(layer) {
        var area = calculateArea(layer);
        document.getElementById('area').innerText = area;
    });
});
</script>

</body>
</html>
