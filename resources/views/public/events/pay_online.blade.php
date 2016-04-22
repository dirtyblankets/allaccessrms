@extends('public.layouts.main')
@section('content')

<!-- Registration Section -->
<section id="online_pay" class="container content-section">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default panel-information">
                <div class="panel-heading">
					<h4>Payment</h4>
                </div>
                <div class="panel-body">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-event-id="{{ session('registration_data.event_id') }}" data-target="#pay_online_modal"><i class="fa fa-fw fa-credit-card"></i> Pay Now</button> 
                </div>
            </div>
        </div>
    </div>
</section>
@stop