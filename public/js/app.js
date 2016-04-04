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

	HandleTabs();

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
        format: 'MM/DD/YYYY'
     });

}

function TimePicker() {
	$(".timepicker").datetimepicker( {
		format: 'LT'
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

    var inputValue = $('input[type=radio][name=' + radioName + ']:checked').val();
    if (inputValue == showValue) {
    	$(targetSection).show();	
    }
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

function SetEventIdInInviteModal() {
	$('#invite_modal').on('show.bs.modal', function (e) {

		var data_event_id = $(e.relatedTarget).attr('data-event-id');
		$('input[name=_data_event_id]').attr('value', data_event_id);

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
	SetEventIdInInviteModal();

}

function HandlePanelCollapse() {
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
	});
}

function HandleTabs() {

	$('ul.nav-tabs li a').click(function (e) {
		e.preventDefault();

		//get displaying tab content jQuery selector
		var active_tab_selector = $('.nav-tabs > li.active > a').attr('href');					
					
		//find actived navigation and remove 'active' css
		var active_nav = $('.nav-tabs > li.active');
		active_nav.removeClass('active');

					
		//add 'active' css into clicked navigation
		$(this).parents('li').addClass('active');
					
		//hide displaying tab content
		$(active_tab_selector).removeClass('active');
		$(active_tab_selector).addClass('hide');
					
		//show target tab content
		var target_tab_selector = $(this).attr('href');
		$(target_tab_selector).removeClass('hide');
		$(target_tab_selector).addClass('active');
	
	});
}