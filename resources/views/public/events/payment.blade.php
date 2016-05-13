@extends('public.layouts.main')
@section('content')
@include('public.events.navbar')

<!-- Registration Section -->
<section id="online_pay" class="container content-section">
	<div class="row">
        <div class="col-lg-12">
            <h2>{{ $event->title }} - Registration</h2>
            <hr class="divider">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                @include('partials.errors')
                @include('partials.message')  
            </div>
        </div>
    </div>
    @if ($event->price != $attendee->amount_paid)
    {!! Form::open(array('route' => array('event.payment', $event, $attendee), 'method' => 'PATCH', 'data-parsley-validate', 'id'=>'payment-form'))!!}
        <div class="panel panel-default panel-information">
            <div class="panel-heading">
                <div class="row">
                     <div class="col-lg-8 col-lg-offset-2">
                        <h4>Online Payment for 
                            <u>{{ $event->organization()->first()->name }}</u>
                        </h4>                 
                    </div>                   
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <label>Event Price: ${{ $event->price }}</label>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class='form-group'>
                            <label>Please enter your email for verification</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" placeholder="email@email.com" class="form-control" name="email" value="{{ old('email') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-lg-8 col-lg-offset-2">
                        <div class='form-group'>
                            <label>Please confirm your email</label>
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" placeholder="confirm_email@email.com" class="form-control" name="email_confirmation" value="{{ old('email_confirmation') }}"/>
                            </div>
                        </div>
                    </div>     
                </div>
                <hr class="divider">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="form-group" id="cc-group">
                            {!! Form::label(null, 'Credit card number:') !!}
                            {!! Form::text(null, null, [
                                'class'         =>      'form-control',
                                'required'      =>      'required',
                                'data-stripe'   =>      'number',
                                'data-parsley-type' =>  'number',
                                'maxlength'         =>  '16',
                                'data-parsley-trigger'  =>  'change focusout',
                                'data-parsley-class-handler'    =>  '#cc-group'
                            ]) !!}    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-2">
                        <div class="form-group" id="ccv-group">
                            {!! Form::label(null, 'Card Validation Code(3 or 4 digit number):') !!}
                            {!! Form::text(null, null, [
                                'class' => 'form-control', 
                                'required' => 'required',
                                'data-stripe'   =>  'cvc',
                                'data-parsley-type' =>  'number',
                                'data-parsley-trigger'  =>  'change focusout',
                                'maxlength' =>  '4',
                                'data-parsley-class-handler'    =>  '#ccv-group'  
                            ]) !!}    
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-lg-offset-2">
                        <div class="form-group" id="exp-m-group">
                            {!! Form::label(null, 'Ex. Month') !!}
                            {!! Form::selectMonth(null, null, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-stripe'   =>  'exp-month'
                            ], '%m') !!}    
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group" id="exp-y-group">
                            {!! Form::label(null, 'Ex. Year') !!}
                            {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-stripe'   =>  'exp-year'
                            ]) !!}    
                        </div>
                    </div>
                </div>
                <hr class="divider">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary btn-lg" id="submitBtn"><i class="fa fa-fw fa-credit-card"></i> Submit Payment</button>
                        <span class="payment-errors" style="color: red;margin-top:10px;"></span>  
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    @else
    <div class="row">
        <div class="col-lg-12">
            <h2>Thank you for your payment!!!</h2>
        </div>
    </div>
    @endif
</section>
@stop