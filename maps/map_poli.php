<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>رسم پلیگون با Leaflet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <button id="saveBtn" style="margin-top: 10px;">ذخیره پلیگون</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    
    <script>
        var map = L.map('map').setView([35.6892, 51.3890], 10); // مرکز نقشه

        // افزودن لایه نقشه
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // ایجاد لایه برای ذخیره اشکال رسم شده
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        // اضافه کردن کنترل‌های رسم به نقشه
        var drawControl = new L.Control.Draw({
            draw: {
                polygon: true,   // فعال کردن رسم پلیگون
                rectangle: true, // فعال کردن رسم مستطیل (اختیاری)
                circle: false,
                polyline: false,
                marker: false
            },
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);

        var currentPolygon = null; // متغیری برای نگه‌داری پلیگون جاری

        // رویداد رسم پلیگون
        map.on(L.Draw.Event.CREATED, function (event) {
            var layer = event.layer;
            drawnItems.addLayer(layer);
            currentPolygon = layer; // ذخیره پلیگون جاری
        });

        // ذخیره پلیگون
        document.getElementById("saveBtn").addEventListener("click", function() {
            if (currentPolygon) {
                var coordinates = currentPolygon.getLatLngs(); // دریافت مختصات پلیگون

                // ارسال داده‌ها به سرور با استفاده از AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "save_polygon.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("پلیگون با موفقیت ذخیره شد.");
                    }
                };
                xhr.send("polygon=" + encodeURIComponent(JSON.stringify(coordinates)));
            } else {
                alert("لطفاً پلیگونی رسم کنید.");
            }
        });
    </script>
</body>
</html>
