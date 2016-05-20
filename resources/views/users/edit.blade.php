@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                <i class="fa fa-fw fa-user"></i>Edit {{ $user->getFullName() }}
                <button class='btn btn-md btn-default btn-modal confirm' type='button' data-toggle="modal" data-target="#confirmResend" data-route="{{ URL::route('users.sendRegistrationConfirmation', $user->id) }}" data-title="Resend Registration Confirmation" data-message='Confirm resending of registration confirmation email.'>
                <i class='fa fa-fw fa-envelope'></i> Resend Registration Confirmation
            </h2>
        </button> 
        </div>
    </div>
{!! Form::model($user, array('method'=>'PUT', 'route'=>array('users.update', $user->id),
           'class'=>'form form-vertical')) !!}
{!! csrf_field() !!}
    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')
            <div class="row">
                <div class="col-lg-6">
                    <div class='form-group'>
                        <label>Email Address:</label>
                        <div class='input-group'>
                            <div class="input-group-addon"><span class="fa fa-envelope"></span></div>
                            <input type="email" placeholder="Email Address" class="form-control" name="email" value="{{ $user->email }}" />
                        </div>
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class='form-group'>
                        <label>First Name:</label>
                        <input type="text" placeholder="First Name" class="form-control" name="firstname" value="{{ $user->firstname }}" />
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-6">
                    <div class='form-group'>
                        <label>Last Name:</label>
                        <input type="text" placeholder="Last Name" class="form-control" name="lastname" value="{{ $user->lastname }}" />
                    </div> 
                </div>        
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Contact Number</label>
                        <div class="input-group">
                            <div class="input-group-addon"><span class="fa fa-phone"></span></div>
                            <input type="tel" placeholder="Telephone" class="form-control phone" name="telephone"
                                           value="{{ $user->telephone }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Active
                        {!! Form::checkbox('active', 
                                            null, 
                                            $user->active, 
                                            array('class' => 'checkbox')) !!}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <button type="submit" name="submitBtn" class="btn btn-md btn-success" value="save"><i class="fa fa-fw fa-check"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Content -->
{!! Form::close() !!}
@include('partials.confirm_resend')
@stop