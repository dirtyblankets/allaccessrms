<!-- resources/views/users/create.blade.php -->
@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header"><i class="fa fa-fw fa-user"></i>+ Add New User</h2>
        <ol class="breadcrumb">
            <li>
                <a href={{ URL::previous()  }}><i class="fa fa-users"></i> Users</a>
            </li>
            <li class="active">
                Add New User
            </li>
        </ol>
    </section>
    <!-- Content -->
    <form class='form-horizontal' method="POST" action="/users/store">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                        <input type="text" placeholder="Organization Name" class="form-control" name="organization"/>
                        @if ($errors->has('organization')) <p class='help-block'>{{ $errors->first('organization') }}</p>@endif
                     </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class='form-group @if ($errors->has('email')) has-error @endif'>
                    <div class="input-group @if ($errors->has('email')) has-error @endif">
                        <div class="input-group-addon">@</div>
                        <input type="email" placeholder="Email Address" class="form-control" name="email" />
                        @if ($errors->has('email')) <p class='help-block'>{{ $errors->first('email') }}</p>@endif
                    </div>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class='form-group @if ($errors->has('firstname')) has-error @endif'>
                    <input type="text" placeholder="First Name" class="form-control" name="firstname" />
                    @if ($errors->has('firstname')) <p class='help-block'>{{ $errors->first('firstname') }}</p>@endif
                </div>
            </div>
            <div class="col-sm-3">
                <div class='form-group @if ($errors->has('lastname')) has-error @endif'>
                    <input type="text" placeholder="Last Name" class="form-control" name="lastname" />
                    @if ($errors->has('lastname')) <p class='help-block'>{{ $errors->first('lastname') }}</p>@endif
                </div> 
            </div>
        </div> 
        <div class='form-group'>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@stop