$(document).ready(function () {

	init();

	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});

	$('#flash-overlay-modal').modal();

    if ($('#openModal').data('open-modal')) {        
        $('.modal-openonerror').modal('show'); 
    }
	DatePicker();
	TimePicker();
	PhoneMask();

	// Handle Events Create and Edit Page
	FormatEventsPage();

	HandlePanelCollapse();

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

function HideShowOnRadioBtn(radioName, hideValue, showValue, targetSection) {

	$('input[type=radio][name=' + radioName + ']').change(function() {
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
	if (published.length)
	{
		$(':input').attr('readonly','readonly');
		$(':input.cb').attr("disabled", true);
		$(':input.radio').attr("disabled", true);
		$('.btn-toggle-readonly').prop('disabled', true);
		$('.input-group-addon').off();
	}
	else
	{
		$(':input').removeAttr('readonly');
		$('.btn-toggle-readonly').prop('disabled', false);	
		$(':input.cb').removeAttr('disabled');
		$(':input.radio').removeAttr('disabled');			
	}

	HideShowOnRadioBtn("event_privacy" ,"public", "private", "#invite_section");

}

function HandlePanelCollapse()
{
	$(document).on('click', '.panel-heading span.clickable', function(e){
	    var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	})
}