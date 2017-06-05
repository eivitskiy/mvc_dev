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
        var input = $(this)[0];
        if ( input.files && input.files[0] ) {
            var files = input.files;
            $.each(files, function(k,v){
                if( v.type.match('image.*')) {
                    var reader = new FileReader();
                    //reader.onload = function(e) { $('#td#preview_images').attr('src', e.target.result); }
                    reader.onload = function(e) { $('td#preview_images').append('<img src="' + e.target.result + ' alt="">'); }
                    reader.readAsDataURL(v);
                    console.log('asdf');
                }
            })
        }
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
});