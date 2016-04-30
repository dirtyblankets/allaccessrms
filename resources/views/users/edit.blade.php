@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header"><i class="fa fa-fw fa-user"></i>Edit {{ $user->getFullName() }}</h2>
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
            @include('partials.message')
            {!! Form::model($user, array('method'=>'PUT', 'route'=>array('users.update', $user->id),
           'class'=>'form form-horizontal')) !!}
            {!! csrf_field() !!}
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
            {!! Form::close() !!}
        </div>
    </div><!-- Content -->
@stop