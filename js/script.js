/**
 * @author Abdo-Hamoud <abdo.host@gmail.com>
 * https://github.com/Abdo-Hamoud/bootstrap-show-password
 * version: 1.0
 */

!function ($) {
//eyeOpenClass: 'fa-eye', 
//eyeCloseClass: 'fa-eye-slash',
    'use strict';

    $(function () {
        $('[data-toggle="password"]').each(function () {
            var input = $(this);
            var eye_btn = $(this).parent().find('.input-group-text');
            eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
            eye_btn.on('click', function () {
                if (eye_btn.hasClass('input-password-hide')) {
                    eye_btn.removeClass('input-password-hide').addClass('input-password-show');
                    eye_btn.find('.fa').removeClass('fa-eye').addClass('fa-eye-slash')
                    input.attr('type', 'text');
                } else {
                    eye_btn.removeClass('input-password-show').addClass('input-password-hide');
                    eye_btn.find('.fa').removeClass('fa-eye-slash').addClass('fa-eye')
                    input.attr('type', 'password');
                }
            });
        });
    });

}(window.jQuery);

function fetch(id, goal = 0) {
    gt = 'goal';
    if (!goal) {
        gt = 'task'
    }
console.log(gt);
    data_url = 'edit.php?fetch='+gt+'&id='+id;
    $.get(data_url, function(data){ //jQuery Ajax post
        if(data) { //if no more records
            data = JSON.parse(data);
            $('#gtid').val(data.id);
            $('#title').val(data.title);
            $('#due_date').val(data.deadline);
            $('#gt').val(gt);
            $('#heading').html('Edit '+gt);
        }		
    });
}