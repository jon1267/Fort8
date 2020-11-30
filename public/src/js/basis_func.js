$(document).ready(function(){

    $('#create3-save-button').on('click', function (e) {
        e.preventDefault();

        let data = {};
        data.title = $('#create3-title').val();
        data.description = $('#create3-description').val();
        data.display = $('#create3-display').val();
        data._token = $("input[name='_token']").val();

        $.ajax({
            type: 'post',
            url: '/admin/basis',
            data: data,
            error: function (data) {
                //console.log(data);
                clearValidations();
                if (data.responseJSON.errors) {
                    $.each(data.responseJSON.errors, function (index, value) {
                        $('#create3-' + index).addClass('is-invalid');
                        // это div, в к-ром содерж. input, в его конец аппендится этот спан с ошибками валидации
                        $('#' + index + '-div').append('<span class="invalid-feedback"><strong>' + value + '</strong></span>');
                    });
                }
            },
            success: function (data) {
                //console.log(data);
                $('#modal3-create').modal('hide');
                toastr.success("Данные успешно добавлены");
                // нарисовать изменения на фронтенде
            },
        });
    });

    $('#update3-save-button').on('click', function (e) {
        e.preventDefault();
        let data = {};
        data.id = $('#update3-id').val();
        data.title = $('#update3-title').val();
        data.description = $('#update3-description').val();
        data.display = $('#update3-display').val();
        data._token = $("input[name='_token']").val();
        data._method = $("input[name='_method']").val();

        $.ajax({
            type: 'post',
            url: `/admin/basis/${data.id}`,
            data: data,
            error: function (data) {
                console.log(data);
                clearValidations();
                if (data.responseJSON.errors) {
                    $.each(data.responseJSON.errors, function (index, value) {
                        $('#update3-' + index).addClass('is-invalid');
                        // это div, в к-ром содерж. input, в его конец аппендится этот спан с ошибками валидации
                        $('#' + index + '-update3-div').append('<span class="invalid-feedback"><strong>' + value + '</strong></span>');
                    });
                }
            },
            success: function (data) {
                //console.log(data);
                $('#modal3-update').modal('hide');
                toastr.success("Данные успешно изменены");
                // нарисовать изменения на фронтенде
            }
        });

    });


    $('input[type=text]').focus(function () {
        clearValidations();
    });

});

function clearValidations() {
    $('.invalid-feedback').remove();
    $('.is-invalid').removeClass('is-invalid')
}
