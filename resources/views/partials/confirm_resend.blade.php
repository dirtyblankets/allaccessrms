<!-- Modal Dialog -->
<div class="modal fade confirm" id="confirmResend" role="dialog" aria-labelledby="confirmResendLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Resend Invoice</h4>
      </div>
      <div class="modal-body">
        <p>Confirm resending of invoice.</p>
      </div>
      <div class="modal-footer">
        <form id="confirmForm" action="" method="GET">
        {!! csrf_field() !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success" id="confirm">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>