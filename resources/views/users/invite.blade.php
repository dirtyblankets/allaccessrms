@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header"><i class="fa fa-fw fa-envelope"></i> Invite User</h2>
        </div>
    </div>
    <!-- Content -->
    <div class="col-md-12">
        <form class='form-horizontal' method="POST" action="">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-4">
                    <div class='form-group @if ($errors->has('email')) has-error @endif'>
                        <input type="email" placeholder="Email Address" class="form-control" name="email" />
                        @if ($errors->has('email')) <p class='help-block'>{{ $errors->first('email') }}</p>@endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class='form-group'>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop