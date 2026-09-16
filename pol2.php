<?php
$center_coords = array(37.85, 46.65); // مرکز نقشه برای روستای کردکندی بستان آباد
?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسم پلیگون و ذخیره در MySQL</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
    <style>
        #map { height: 600px; }
        #area-info { margin-top: 10px; font-family: Arial, sans-serif; }
        #save-button {
            margin-top: 10px;
            display: none;
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #save-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div id="map"></div>
<div id="area-info">مساحت: <span id="area">0</span> متر مربع</div>
<button id="save-button">ذخیره اطلاعات</button>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Turf.js/6.5.0/turf.min.js"></script>

<script>
var map = L.map('map').setView([<?php echo $center_coords[0]; ?>, <?php echo $center_coords[1]; ?>], 15);

// لایه عکس هوایی
var esriSat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; <a href="https://www.esri.com">Esri</a> World Imagery'
}).addTo(map);

// افزودن ابزار رسم
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
    edit: { featureGroup: drawnItems },
    draw: { polygon: true, rectangle: false, circle: false, marker: false, polyline: false }
});
map.addControl(drawControl);

var lastDrawnLayer; // ذخیره آخرین لایه رسم‌شده

// محاسبه مساحت
function calculateArea(layer) {
    var latlngs = layer.getLatLngs()[0];
    var coordinates = latlngs.map(function(latlng) { return [latlng.lng, latlng.lat]; });
    coordinates.push(coordinates[0]); // بستن پلیگون
    var polygon = turf.polygon([coordinates]);
    return turf.area(polygon).toFixed(2);
}

// رویداد رسم پلیگون
map.on('draw:created', function (e) {
    var layer = e.layer;
    drawnItems.addLayer(layer);

    var area = calculateArea(layer);
    document.getElementById('area').innerText = area;

    lastDrawnLayer = layer; // ذخیره پلیگون
    document.getElementById('save-button').style.display = 'block';
});

// دکمه ذخیره اطلاعات
document.getElementById('save-button').addEventListener('click', function () {
    if (!lastDrawnLayer) return alert('هیچ پلیگونی برای ذخیره وجود ندارد!');

    var latlngs = lastDrawnLayer.getLatLngs()[0];
    var coordinates = latlngs.map(function(latlng) { return [latlng.lng, latlng.lat]; });
    coordinates.push(coordinates[0]); // بستن پلیگون
    var area = calculateArea(lastDrawnLayer);

    // ارسال اطلاعات به سرور
    fetch('save_polygon.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ coordinates: coordinates, area: area })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('اطلاعات با موفقیت ذخیره شد.');
            document.getElementById('save-button').style.display = 'none';
        } else {
            alert('خطا در ذخیره اطلاعات: ' + data.error);
        }
    })
    .catch(() => alert('خطا در اتصال به سرور.'));
});
</script>

</body>
</html>
