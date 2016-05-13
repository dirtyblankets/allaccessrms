<!-- resources/views/organizations/edit.blade.php -->
@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header">
        <div class="button-container">
            <i class="fa fa-fw fa-building-o"></i> Edit
            <button class='btn btn-md btn-danger btn-modal confirm' type='button' data-toggle="modal" data-target="#confirmDelete" data-route="{{ URL::route('organizations.destroy', $organization->id) }}" data-title="Delete Organization" data-message='Are you sure you want to delete this organization ?'>
                <i class='fa fa-fw fa-times'></i> Delete
            </button>
        </div>
    </h2>    
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::to('organizations') }}><i class="fa fa-building-o"></i> Organizations</a>
        </li>
        <li class="active">
            Edit Partner Organization Info
        </li>
    </ol>
</section>
<!-- Content -->
@include('partials.message')
@include('partials.errors')
{!! Form::open(array('route' => array('organizations.update', $organization->id), 'method' => 'PATCH')) !!}
{!! csrf_field() !!}
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Name:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                <input type="text" placeholder="Organization Name" class="form-control" name="name"
                        value="{{ $organization->name }}" required="required"/>
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
                <input type="text" placeholder="Email" class="form-control" name="email"
                       value="{{ $info->email }}"/>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Phone:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                <input type="tel" placeholder="Telephone" class="form-control phone" name="telephone"
                       value="{{ $info->telephone }}"/>
            </div>
        </div>
    </div>
</div>
<hr class="divider">
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label>Address:</label>
            <input type="text" placeholder="Address" class="form-control" name="address"
                    value="{{ $info->address }}"/>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>City:</label>
            <input type="text" placeholder="City" class="form-control" name="city"
                   value="{{ $info->city }}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label>State:</label>
            {!! Form::select('state', $states, $info->state, array(
                'class'=>'form-control')) !!}
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label>Zipcode:</label>
            <input type="text" placeholder="Zipcode" class="form-control" name="zipcode"
                   value="{{ $info->zipcode }}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <button type="submit" class="btn btn-info"><i class="fa fa-fw fa-check"></i>Save</button>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop