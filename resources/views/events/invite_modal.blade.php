<!-- Modal Dialog -->
<div class="modal fade modal-openonerror" id="invite_modal" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Guests</h4>
      </div>
      @if (Route::is('owner::events.create'))
      {!! Form::open(array('route' => array('owner::events.addgueststoview'), 'method' => 'POST'))!!}
      @endif
      <div class="modal-body">
        @if ($errors->has('guests_email'))
          <div class='bg-danger alert'>Invalid Email address exists!</div>
        @endif
        <label>Enter email address separated by comma.</label>
        <textarea class="form-control" name="guests_email">{{ Input::old('guests_email') }}</textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-modal-save">Save</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>