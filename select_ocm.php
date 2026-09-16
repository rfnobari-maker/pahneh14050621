<!DOCTYPE html>
<html>
<head>
<title>لیست استان، شهرستان و مرکز</title>
	<meta charset="UTF-8">
	<script src="./assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<p>
	  <label for="province">استان:</label>
	  <select id="province" name="province">
	    <option value="">لطفا استان را انتخاب کنید</option>
	    <?php
			// اتصال به دیتابیس
           include ('login/config.php');

			// دریافت لیست استان‌ها
			$stmt = $dbh->prepare('SELECT * FROM ostanname');
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
  <label for="city">شهرستان:</label>
	  <select id="city" name="city">
	    <option value="">لطفا شهرستان را انتخاب کنید</option>
      </select>
</p>
<p>
  
  <label for="center">مرکز:</label>
  <select id="center" name="center">
    <option value="">لطفا مرکز را انتخاب کنید</option>
    </select>
</p>
    <script>
		$(document).ready(function() {
			// وقتی یک استان انتخاب می‌شود
			$('#province').change(function() {
				var provinceId = $(this).val();

				// دریافت لیست شهرستان‌های این استان
				$.ajax({
					url: 'get_cities.php',
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
					url: 'get_centers.php',
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
