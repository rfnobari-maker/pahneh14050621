$(document).ready(function() {

    // رویداد تغییر استان
    $('#ostan').change(function() {
        var ostanId = $(this).val();

        // پاک کردن لیست‌های زیردست
        $('#shahrestan').html('<option value="">-- انتخاب شهرستان --</option>');
        $('#markaz').html('<option value="">-- انتخاب مرکز --</option>');
        $('#abadi').html('<option value="">-- انتخاب آبادی --</option>');
        $('#shahr').html('<option value="">-- انتخاب شهر --</option>');

        if (ostanId) {
            $.getJSON('/location/get_cities.php', { id_ostan: ostanId }, function(data) {
                $.each(data, function(i, item) {
                    $('#shahrestan').append('<option value="'+item.id_city+'">'+item.city+'</option>');
                });

                // بعد از پر شدن شهرستان‌ها، مقدار قبلی را (در صورت وجود) انتخاب کنید
                if (typeof initial_id_city !== 'undefined' && initial_id_city) {
                    $('#shahrestan').val(initial_id_city);
                    var temp_initial_id_city = initial_id_city;
                    initial_id_city = '';
                    $('#shahrestan').trigger('change', [temp_initial_id_city]);
                }
            }).fail(function(jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
            });
        }
    });

    // رویداد تغییر شهرستان
    $('#shahrestan').change(function() {
        var ostanId = $('#ostan').val();
        var cityId = $(this).val();

        // پاک کردن لیست‌های زیردست
        $('#markaz').html('<option value="">-- انتخاب مرکز --</option>');
        $('#abadi').html('<option value="">-- انتخاب آبادی --</option>');
        $('#shahr').html('<option value="">-- انتخاب شهر --</option>');

        if (cityId) {
            $.getJSON('/location/get_centers.php', { id_ostan: ostanId, id_city: cityId }, function(data) {
                $.each(data, function(i, item) {
                    $('#markaz').append('<option value="'+item.id_mar+'">'+item.mar+'</option>');
                });

                // بعد از پر شدن مراکز، مقدار قبلی را (در صورت وجود) انتخاب کنید
                if (typeof initial_id_mar !== 'undefined' && initial_id_mar) {
                    $('#markaz').val(initial_id_mar);
                    var temp_initial_id_mar = initial_id_mar;
                    initial_id_mar = '';
                    $('#markaz').trigger('change', [temp_initial_id_mar]);
                }
            }).fail(function(jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
            });
        }
    });

    // رویداد تغییر مرکز
    $('#markaz').change(function() {
        var ostanId = $('#ostan').val();
        var cityId = $('#shahrestan').val();
        var marId = $(this).val();

        // پاک کردن لیست‌های زیردست
        $('#abadi').html('<option value="">-- انتخاب آبادی --</option>');
        $('#shahr').html('<option value="">-- انتخاب شهر --</option>');

        if (marId) {
            // بارگذاری لیست آبادی‌ها
            $.getJSON('/location/get_abadi.php', { id_ostan: ostanId, id_city: cityId, id_mar: marId }, function(data) {
                $.each(data, function(i, item) {
                    $('#abadi').append('<option value="'+item.add_abadi+'">'+item.abadi+'</option>');
                });
                if (typeof initial_add_abadi !== 'undefined' && initial_add_abadi) {
                    $('#abadi').val(initial_add_abadi);
                    initial_add_abadi = '';
                }
            }).fail(function(jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
            });

            // بارگذاری لیست شهرها
            $.getJSON('/location/get_shahr.php', { id_ostan: ostanId, id_city: cityId, id_mar: marId }, function(data) {
                $.each(data, function(i, item) {
                    $('#shahr').append('<option value="'+item.add_city+'">'+item.shahr+'</option>');
                });
                if (typeof initial_add_city !== 'undefined' && initial_add_city) {
                    $('#shahr').val(initial_add_city);
                    initial_add_city = '';
                }
            }).fail(function(jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
            });
        }
    });

    // این بخش، مسئول فعال‌سازی زنجیره‌ای رویدادها در بارگذاری اولیه صفحه است.
    if (typeof initial_id_ostan !== 'undefined' && initial_id_ostan) {
        $('#ostan').val(initial_id_ostan);
        var temp_initial_id_ostan = initial_id_ostan;
        initial_id_ostan = '';
        $('#ostan').trigger('change', [temp_initial_id_ostan]);
    }
});