@extends('layouts.login')
@section('content')
<div class='col-md-6 col-md-offset-3'>
    <!-- Content -->
    <h1><i class='fa fa-lock'></i>New User Registration</h1>
    <form class='bootstrap-form' method="POST" action="/new_user_registration/store">
        {!! csrf_field() !!}
        <div class='form-group @if ($errors->has('organization')) has-error @endif'>
            <label class='control-label'>Organization Name</label>
            <input type="text" placeholder="Organization" class="form-control" name="organization" />
            @if ($errors->has('organization')) <p class='help-block has-error'>{{ $errors->first('organization') }}</p>@endif
        </div>
        <div class='form-group @if ($errors->has('email')) has-error @endif'>
            <label class='control-label'>Email</label>
            <input type="text" placeholder="Email" class="form-control" name="email" />
            @if ($errors->has('email')) <p class='help-block'>{{ $errors->first('email') }}</p>@endif
        </div>
        <div class='form-group @if ($errors->has('email_confirmation')) has-error @endif'>
            <input type="text" placeholder="Re-enter Email" class="form-control" name="email_confirmation" />
            @if ($errors->has('email_confirmation')) <p class='help-block'>{{ $errors->first('email_confirmation') }}</p>@endif
        </div>
</div>
<div class='col-md-3 col-md-offset-3'>
        <div class='form-group @if ($errors->has('firstname')) has-error @endif'>
            <label class='control-label'>First Name</label>
            <input type="text" placeholder="First Name" class="form-control" name="firstname" />
            @if ($errors->has('firstname')) <p class='help-block'>{{ $errors->first('firstname') }}</p>@endif
        </div>
</div>
<div class='col-md-3'>
        <div class='form-group @if ($errors->has('lastname')) has-error @endif'>
            <label class='control-label'>Last Name</label>
            <input type="text" placeholder="Last Name" class="form-control" name="lastname" />
            @if ($errors->has('lastname')) <p class='help-block'>{{ $errors->first('lastname') }}</p>@endif
        </div>
</div>
<div class='col-md-6 col-md-offset-3'>
        <div class='form-group @if ($errors->has('password')) has-error @endif'>
            <label class='control-label'>Password</label>
            <input type="password" placeholder="Password" class="form-control" name="password"/>
            @if ($errors->has('password')) <p class='help-block'>{{ $errors->first('password') }}</p>@endif
        </div>
        <div class='form-group @if ($errors->has('password_confirmation')) has-error @endif'>
            <input type="password" placeholder="Re-enter Password" class="form-control" name="password_confirmation"/>
            @if ($errors->has('password_confirmation')) <p class='help-block'>{{ $errors->first('password_confirmation') }}</p>@endif
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop