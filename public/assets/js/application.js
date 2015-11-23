$(document).ready(function () {
    $("#variation-container").hide();

    $('#variation').bind('change', function () {
        if ($(this).is(':checked')) {
            $("#variation-container").show();
            $("#price").hide();

            $('#add').click(function () {
                $('#input-holder').append('<div class="form-group"><input class="form-control" placeholder="Name (e.g. Beef)" name="variation_name[]" type="text"><input class="form-control" placeholder="Price" name="variation_price[]" type="text"></div>');
            });

            $('#remove').click(function () {
                $('#variation-container .form-group').last().remove();
            });
        } else {
            $("#variation-container").hide();
            $("#price").show();
        }
    });
});