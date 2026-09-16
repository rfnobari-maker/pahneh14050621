$(document).ready(function() {

    // وقتی استان تغییر کرد
    $('#ostan').change(function() {
        var ostanId = $(this).val();
        $('#shahrestan').html('<option value="">-- انتخاب شهرستان --</option>');
        $('#markaz').html('<option value="">-- انتخاب مرکز --</option>');

        if (ostanId) {
            $.getJSON('../../get_cities.php', { id_ostan: ostanId }, function(data) {
                $.each(data, function(i, item) {
                    $('#shahrestan').append('<option value="'+item.id_city+'">'+item.city+'</option>');
                });
            });
        }
    });

    // وقتی شهرستان تغییر کرد
    $('#shahrestan').change(function() {
        var ostanId = $('#ostan').val();
        var cityId = $(this).val();
        $('#markaz').html('<option value="">-- انتخاب مرکز --</option>');

        if (cityId) {
            $.getJSON('../../get_centers.php', { id_ostan: ostanId, id_city: cityId }, function(data) {
                $.each(data, function(i, item) {
                    $('#markaz').append('<option value="'+item.id_mar+'">'+item.mar+'</option>');
                });
            });
        }
    });

});
