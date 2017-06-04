$(document).ready(function() {
    $('#add_task_save').click(function () {
        var formValid = true;
        $('input, textarea').each(function () {
            var formGroup = $(this).parents('.form-group');
            var glyphicon = formGroup.find('.form-control-feedback');
            if (this.checkValidity()) {
                formGroup.addClass('has-success').removeClass('has-error');
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            } else {
                formGroup.addClass('has-error').removeClass('has-success');
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                formValid = false;
            }
        });
        if (formValid) {

            var images = document.getElementById('images').files;
            var formData = new FormData();
            $.each(images, function (k, v) {
                formData.append('img_' + k, v, v.name);
            });

            formData.append('username', $('#username').val());
            formData.append('email', $('#email').val());
            formData.append('text', $('#text').val());

            $.ajax('ajax/add_task', {
                method: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if (response.status) {
                        alert('Задача успешно добавлена');
                        $("#AddNewTaskModal").modal('hide');

                    } else {
                        alert('Произошли ошибки');
                    }
                },
                error: function(response) {
                    alert('Произошли ошибки');
                }
            });
        }
    });

    $('table#task_list th').click(function () {
        if ($(this).hasClass('sort')) {
            if ($(this).hasClass('sort-asc')) {
                $(this).removeClass('sort-asc');
                $(this).addClass('sort-desc');
            } else {
                $(this).removeClass('sort-desc');
                $(this).addClass('sort-asc');
            }
        } else {
            $(this).addClass('sort sort-asc');
        }

        $('table#task_list th').not(this).removeClass('sort');
        $('table#task_list th').not(this).removeClass('sort-asc');
        $('table#task_list th').not(this).removeClass('sort-desc');
    });
});