
Stripe.setPublishableKey('pk_test_vAYF5GcyE747lt2FoXWKg2S5');

jQuery(function($) {
  $('#payment-form').submit(function(event) {

    var $form = $(this);

    /*
    $form.parsley().subscribe('parsley:form:validate', function(formInstance) {

      formInstance.submitEvent.preventDefault();

      return false;
    });
    */
    // Disable the submit button to prevent repeated clicks
    $form.find('#submitBtn').prop('disabled', true);

    Stripe.card.createToken($form, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });
});

var stripeResponseHandler = function(status, response) {
  var $form = $('#payment-form');
  if (response.error) {
    // Show the errors on the form
    $form.find('.payment-errors').text(response.error.message);
    $form.find('.payment-errors').addClass('alert alert-danger');
    $form.find('#submitBtn').prop('disabled', false);

  } else {
    // token contains id, last4, and card type
    var token = response.id;
    // Insert the token into the form so it gets submitted to the server
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    // and re-submit
    $form.get(0).submit();
  }
};

