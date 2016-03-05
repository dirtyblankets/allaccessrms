//Bootstrap expects jQuery to be global and with the first line we are including jQuery and assigning it to the window. The second line is requiring Bootstrap JavaScript.
//The last section is just a jQuery on ready and logging out the bootstrap tooltip version.
//This is used to just confirm it’s loading as we expect.
window.$ = window.jQuery = require('jquery');
require('jquery-ui');
require('bootstrap-sass');
require('bootstrap.transition');
require('bootstrap.collapse');
require('moment');
require('eonasdan-bootstrap-datetimepicker');

$(document).ready(function () {
    $('#flash-overlay-modal').modal();

    $(function () {
        $(".datepicker").datetimepicker( {
            pickTime: false
        });
    });

    $(function () {
        $(".timepicker").datetimepicker( {
            format: 'LT',
            pickDate: false
        });
    });

    $(function () {
        var published = $("#event_published");
        if (published.val())
        {
            $(':input').attr('readonly','readonly');
            $('.btn-toggle-readonly').prop('disabled', true);
            $('.input-group-addon').off();
        }
        else
        {
            $(':input').removeAttr('readonly');
            $('.btn-toggle-readonly').prop('disabled', false);
        }
    });

    $(function(){
        $(".phone").mask("(999) 999-9999");
    });

    $('#confirmDelete').on('show.bs.modal', function (e) {
        var message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text(message);
        var title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text(title);

        var route = $(e.relatedTarget).attr('data-route');
        $('#deleteForm').attr('action', route);

    });
});

