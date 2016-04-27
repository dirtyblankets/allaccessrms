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
    {!! Form::open(array('route' => array('event.process_payment'), 'method' => 'POST'))!!}
    	@include('partials.message')
        <div class="row">
          <div class="col-md-12">
              <span class="payment-errors" style="color: red;margin-top:10px;"></span>
          </div>
        </div>
        <div class="panel panel-default panel-information">
            <div class="panel-heading">
                <div class="row">
                     <div class="col-md-8 col-md-offset-2">
                        <h4>Online Payment for <u>{{ $event->organization()->first()->name }}</u></h4>                   
                    </div>                   
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class='form-group'>
                            <label>Please enter your email for verification</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" placeholder="email@email.com" class="form-control" name="attendee[email]" value="{{ old('attendee.email') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-8 col-md-offset-2">
                        <div class='form-group'>
                            <label>Please confirm your email</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" placeholder="confirm_email@email.com" class="form-control" name="attendee[email_confirmation]" value="{{ old('attendee.email_confirmation') }}"/>
                            </div>
                        </div>
                    </div>     
                </div>
                <hr class="divider">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group">
                            {!! Form::label(null, 'Credit card number:') !!}
                            {!! Form::text(null, null, [
                                'class' => 'form-control',
                                'required' => 'required'
                            ]) !!}    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group">
                            {!! Form::label(null, 'Card Validation Code(3 or 4 digit number):') !!}
                            {!! Form::number(null, null, [
                                'class' => 'form-control', 
                                'min'=>"0", 
                                'max'=>"9999", 
                                'pattern'=>"^\d",
                                'required' => 'required'  
                            ]) !!}    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-2">
                        <div class="form-group">
                            {!! Form::label(null, 'Ex. Month') !!}
                            {!! Form::selectMonth(null, null, [
                                'class' => 'form-control',
                                'required' => 'required'
                            ], '%m') !!}    
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label(null, 'Ex. Year') !!}
                            {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                                'class' => 'form-control',
                                'required' => 'required'
                            ]) !!}    
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        <button type="submit" class="btn btn-primary btn-lg" data-target="#"><i class="fa fa-fw fa-credit-card"></i> Submit Payment</button>   
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
</section>
@stop