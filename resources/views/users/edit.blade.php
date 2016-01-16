<!-- resources/views/users/edit.blade.php -->
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
                <div class="col-md-4">
                    <div class='form-group @if ($errors->has('firstname')) has-error @endif'>
                        <label>First Name</label>
                        {!! Form::text('firstname', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('firstname')) <p class='help-block'>{{ $errors->first('firstname') }}</p>@endif
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <div class='form-group @if ($errors->has('lastname')) has-error @endif'>
                        <label>Last Name</label>
                        {!! Form::text('lastname', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('lastname')) <p class='help-block'>{{ $errors->first('lastname') }}</p>@endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class='form-group @if ($errors->has('email')) has-error @endif'>
                        <label>Email</label>
                        {!! Form::email('email', null, ['class'=>'form-control']) !!}
                        @if ($errors->has('email')) <p class='help-block'>{{ $errors->first('email') }}</p>@endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <a href="{{ URL::previous() }}" class="btn btn-small btn-default">Cancel</a>
                        <button type="submit" class="btn btn-small btn-primary">Save</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div><!-- Content -->
@stop