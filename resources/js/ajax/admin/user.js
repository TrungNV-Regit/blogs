import '../config.js';

$(document).ready(function () {

    $('input[type="checkbox"]:not(#remember)').click(function (event) {
        event.preventDefault();
        let input = $(this);
        let enpoint = $(this).attr('change-status-route');
        $.ajax({
            url: enpoint,
            type: 'POST',
            success: function (response) {
                input.parent().siblings('.status').text(response);
                input.is(":checked") ? input.prop('checked', false) : input.prop('checked', true);
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    window.location.href = data.route.login;
                }
            }
        });
    });
});
