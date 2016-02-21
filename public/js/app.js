
$(document).ready(function (){
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


  $('#confirmDelete').on('show.bs.modal', function (e) {
    var message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text(message);
    var title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text(title);

    var route = $(e.relatedTarget).attr('data-route');
    $('#deleteForm').attr('action', route);

  });

});