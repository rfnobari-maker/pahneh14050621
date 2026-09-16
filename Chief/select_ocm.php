<!DOCTYPE html>
<html>
<head>
<title>لیست استان، شهرستان و مرکز</title>
	<meta charset="UTF-8">
	<script src="../assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<p>
	    <?php
			// اتصال به دیتابیس
           include ('../login/config.php');
        ?>
	  <select id="province" dir="rtl"  name="id_ostan"  style="width:170px ; height:40px">
	    <option value="-1">لطفا استان را انتخاب کنید</option>
	    <?php

			// دریافت لیست استان‌ها
			$stmt = $dbh->prepare("SELECT * FROM ostanname ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')");
			$stmt->execute();
			$provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// نمایش لیست استان‌ها
			foreach ($provinces as $province) {
				echo '<option value="' . $province['id_ostan'] . '">' . $province['ostan'] . '</option>';
			}
		?>
      </select>
</p>
<p>
	  <select id="city" dir="rtl"  name="id_city" style="width:170px ; height:40px">
	    <option value="0">لطفا شهرستان را انتخاب کنید</option>
      </select>
</p>
<p>
  
  <select id="center" dir="rtl"  name="id_mar" style="width:170px ; height:40px">
    <option value="0">لطفا مرکز را انتخاب کنید</option>
    </select>
</p>
    <script>
		$(document).ready(function() {
			// وقتی یک استان انتخاب می‌شود
			$('#province').change(function() {
				var provinceId = $(this).val();

				// دریافت لیست شهرستان‌های این استان
				$.ajax({
					url: '../get_cities.php',
					type: 'POST',
					data: {province_id: provinceId},
					dataType: 'json',
					success: function(response) {
						// پاک کردن لیست شهرستان‌ها و مراکز
						$('#city').empty();
						$('#center').empty();

						// نمایش لیست شهرستان‌ها
						$('#city').append('<option value="">لطفا شهرستان را انتخاب کنید</option>');
						$.each(response.cities, function(index, city) {
							$('#city').append('<option value="' + city.id_city + '">' + city.city + '</option>');
						});
					},
					error: function() {
						alert('خطا در دریافت لیست شهرستان‌ها');
					}
				});
			});

			// وقتی یک شهرستان انتخاب می‌شود
			$('#city').change(function() {
				var cityId = $(this).val();
                var provinceId = $('#province').val();
				// دریافت لیست مراکز این شهرستان
				$.ajax({
					url: '../get_centers.php',
					type: 'POST',
					data: {province_id: provinceId,city_id: cityId},
					dataType: 'json',
					success: function(response) {
						// پاک کردن لیست مراکز
						$('#center').empty();

						// نمایش لیست مراکز
						$('#center').append('<option value="">لطفا مرکز را انتخاب کنید</option>');
						$.each(response.centers, function(index, center) {
							$('#center').append('<option value="' + center.id_mar + '">' + center.mar + '</option>');
						});
					},
					error: function() {
						alert('خطا در دریافت لیست مراکز');
					}
				});
			});
		});
	</script>
</body>
</html>
