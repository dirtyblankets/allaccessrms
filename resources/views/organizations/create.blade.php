<!-- resources/views/organizations/create.blade.php -->
@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-fw fa-building-o"></i>+ Add New Organization</h2>
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::to('organizations') }}><i class="fa fa-building-o"></i> Organizations</a>
        </li>
        <li class="active">
            Add New Organization
        </li>
    </ol>
</section>
<!-- Content -->
@include('partials.message')
@include('partials.errors')
<div class="panel-body">
    <form class='form form-horizontal' method="POST" action="/organizations/store">
        {!! csrf_field() !!}
        <div class="col-sm-6">
            <h4>Organization Information</h4>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                    <input type="text" placeholder="Organization Name" class="form-control" name="organizations[name]"
                            value="{{ old('organizations.name') }}" required="required"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <input type="text" placeholder="Address" class="form-control" name="organizationinfo[address]"
                                value="{{ old('organizationinfo.address') }}"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" placeholder="City" class="form-control" name="organizationinfo[city]"
                               value="{{ old('organizationinfo.city') }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" placeholder="State" class="form-control" name="organizationinfo[state]"
                               value="{{ old('organizationinfo.state') }}"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="text" placeholder="Zipcode" class="form-control" name="organizationinfo[zipcode]"
                               value="{{ old('organizationinfo.zipcode') }}"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                            <input type="tel" placeholder="Telephone" class="form-control" name="organizationinfo[telephone]"
                                   value="{{ old('organizationinfo.telephone') }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>Admin Information</h4>
            <div class='form-group'>
                <div class="input-group">
                    <div class="input-group-addon">@</div>
                    <input type="email" placeholder="Email Address" class="form-control" name="users[email]"
                           value="{{ old('users.email') }}" required="required"/>
                </div>
            </div>
            <div class='form-group'>
                <input type="text" placeholder="First Name" class="form-control" name="users[firstname]"
                       value="{{ old('users.firstname') }}" required="required"/>
            </div>
            <div class='form-group'>
                <input type="text" placeholder="Last Name" class="form-control" name="users[lastname]"
                       value="{{ old('users.lastname') }}" required="required"/>
            </div>
            <div class='form-group'>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@stop