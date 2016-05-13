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
{!! Form::open(array('route'=>array('organizations.store'), 'method'=>'POST' )) !!}
<div class="row">
    <div class="col-lg-6">
        <h4>Admin Information</h4>
        <div class='form-group'>
            <label>Email:</label>
            <div class="input-group">
                <div class="input-group-addon"><span class="fa fa-envelope"></span></div>
                <input type="email" placeholder="Email Address" class="form-control" name="user[email]"
                       value="{{ old('user.email') }}" required="required"/>
            </div>
        </div>
        <div class='form-group'>
            <label>First Name:</label>
            <input type="text" placeholder="First Name" class="form-control" name="user[firstname]"
                   value="{{ old('user.firstname') }}" required="required"/>
        </div>
        <div class='form-group'>
            <label>Last Name:</label>
            <input type="text" placeholder="Last Name" class="form-control" name="user[lastname]"
                   value="{{ old('user.lastname') }}" required="required"/>
        </div>
    </div>
</div>
<hr class="divider">
<div class="row">
    <div class="col-lg-6">
        <h4>Organization Information</h4>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                <input type="text" placeholder="Organization Name" class="form-control" name="organization[name]"
                        value="{{ old('organization.name') }}" required="required"/>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Email:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></div>
                <input type="text" placeholder="Email Address" class="form-control" name="organizationinfo[email]"
                       value="{{ old('organizationinfo.email') }}"/>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Telephone:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                <input type="tel" placeholder="Telephone" class="form-control phone" name="organizationinfo[telephone]"
                       value="{{ old('organizationinfo.telephone') }}"/>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <label>Address:</label>
        <div class="form-group">
            <input type="text" placeholder="Address" class="form-control" name="organizationinfo[address]"
                    value="{{ old('organizationinfo.address') }}"/>
        </div>
    </div>
    <div class="col-lg-2">
        <label>City:</label>
        <div class="form-group">
            <input type="text" placeholder="City" class="form-control" name="organizationinfo[city]"
                   value="{{ old('organizationinfo.city') }}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <label>State:</label>
        <div class="form-group">
            {!! Form::select('state', $states, null, array(
                'class'=>'form-control',
                'value'=>"{{ old('organizationinfo.state') }}")) !!}
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>Zipcode:</label>
            <input type="text" placeholder="Zipcode" class="form-control" name="organizationinfo[zipcode]"
                   value="{{ old('organizationinfo.zipcode') }}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class='form-group'>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop