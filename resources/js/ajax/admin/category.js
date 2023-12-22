$(document).ready(function () {

    $('.name-category').on('click', '.cancel-update', function (event) {
        window.location.href = $(this).attr('data-href');
    });

    $('.name-category').on('click', '.comfirm-update', function (event) {
        $(this).closest('form').submit();
    });

    $('.destroy-category').on('click', function () {
        $('#deleteModal').modal('show');
        $('#deleteModal').find('input[name=id]').val($(this).attr('data-id'));
    });

    $('#deleteModal').on('shown.bs.modal', function() {
        $(this).find('input[name=id]').val();
    });
});
