<!-- Modal Dialog -->
<div class="modal fade modal-openonerror" id="invite_modal" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Credit Card Payment</h4>
      </div>
      {!! Form::open(array('route' => array('event_registration.pay_online'), 'method' => 'POST'))!!}
      <input name="_data_attendee_id" type="hidden" value="">
      <div class="modal-body">
        @include('partials.errors')
        <label>
          <span>Card Number</span>
          <input type="text" data-stripe="number">
        </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-modal-save">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>