$(document).ready(function () {

	init();

	$('#flash-overlay-modal').modal();

    if ($('#openModal').data('open-modal')) {        
        $('.modal-openonerror').modal('show'); 
    }
	DatePicker();
	TimePicker();
	PhoneMask();

	// Handle Events Create and Edit Page
	FormatEventsPage();

	ConfirmDelete();

});

function init() {
	$('#invite_section').hide();
}

function PhoneMask() {
	$(".phone").mask("(999) 999-9999");
}

function DatePicker() {
	$(".datepicker").datetimepicker( {
        pickTime: false
     });

}

function TimePicker() {
	$(".timepicker").datetimepicker( {
		format: 'LT',
        pickDate: false
	});
}

function HideShowOnRadioBtn(hideValue, showValue, targetSection) {

	 $('input[type=radio][name=optionsRadios]').change(function() {
        if (this.value == hideValue) {
        	$(targetSection).hide();   
        }
        else if (this.value == showValue) {
            $(targetSection).show();
        }
    });
}

function GridHandler() {

    for (var grid in AllAccessRMS.Grids) {
    }
}

function ConfirmDelete() {
	$('#confirmDelete').on('show.bs.modal', function (e) {
	var message = $(e.relatedTarget).attr('data-message');
	$(this).find('.modal-body p').text(message);
	var title = $(e.relatedTarget).attr('data-title');
	$(this).find('.modal-title').text(title);

	var route = $(e.relatedTarget).attr('data-route');
	$('#deleteForm').attr('action', route);
	});
}

function FormatEventsPage(){
	
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

	HideShowOnRadioBtn("publicEventRadio", "privateEventRadio", "#invite_section");

}