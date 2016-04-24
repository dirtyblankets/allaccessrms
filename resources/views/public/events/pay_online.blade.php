@extends('public.layouts.main')
@section('content')
@include('public.events.navbar')

<!-- Registration Section -->
<section id="online_pay" class="container content-section">
	<div class="row">
        <div class="col-md-12">
            <h2>{{ $event->title }} - Registration</h2>
            <hr class="divider">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        	@include('partials.message')
            <div class="panel panel-default panel-information">
                <div class="panel-heading">
					<h4>Online Payment</h4>
                </div>
                <div class="panel-body">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-event-id="{{ session('registration_data.event_id') }}" data-target="#pay_online_modal"><i class="fa fa-fw fa-credit-card"></i> Pay Now</button> 
                </div>
            </div>
        </div>
    </div>
</section>
@stop