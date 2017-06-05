var dataArray = [];

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
                        location.reload();
                    } else {
                        alert('Произошли ошибки');
                    }
                },
                error: function() {
                    alert('Произошли ошибки');
                }
            });
        }
    });

    $('#add_task_preview').click(function(){
        $('td#preview_username').text($('input#username').val());
        $('td#preview_email').text($('input#email').val());
        $('td#preview_text').text($('textarea#text').val());

        var images = document.getElementById('images').files;

        $('#PreviewNewTaskModal').modal('show');
    });
    $('input#images').change(function() {
        $('#preview_images').html('');

        var files = $(this)[0].files;
        loadInView(files);
    });

    $('table#task_list th').click(function () {
        var direction = 'asc';
        if($(this).hasClass('sort-asc')) {
            direction = 'desc';
        }
        document.location.href =  '?order='+$(this).attr('data-name')+'&direction='+direction;
    });

    $('select.task-status').change(function(){
        $.ajax({
            method: 'post',
            url: 'ajax/update_task_status',
            data: {
                status: $(this).val(),
                id: $(this).attr('data-id')
            },
            success: function(response) {
                if (response.status) {
                    alert('Задача успешно обновлена');
                    location.reload();
                } else {
                    alert('Произошли ошибки');
                }
            },
            error: function() {
                alert('Произошли ошибки');
            }
        });
    });

    $('table#task_list img').click(function(){
        $('img#preview_image').attr('src', $(this).attr('src'));
        $('#PreviewImageModal').modal('show');
    });
});

function loadInView(files) {
    $.each(files, function(index, file) {
            var fileReader = new FileReader();
            fileReader.onload = (function(file) {

                return function(e) {
                    // Помещаем URI изображения в массив
                    dataArray.push({name : file.name, value : this.result});
                    addImage((dataArray.length-1));
                };

            })(files[index]);
            fileReader.readAsDataURL(file);
    });
    return false;
}

function addImage(ind) {
    // Если индекс отрицательный значит выводим весь массив изображений
    if (ind < 0 ) {
        start = 0; end = dataArray.length;
    } else {
        // иначе только определенное изображение
        start = ind; end = ind+1;
    }
    for (i = start; i < end; i++) {
        $('td#preview_images').append('<img src="'+dataArray[i].value+'" />&nbsp;');
    }
    return false;
}