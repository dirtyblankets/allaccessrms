<!-- resources/views/organizations/create.blade.php -->
@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header"><i class="fa fa-fw fa-building-o"></i>+ Add New Organization</h2>
        <ol class="breadcrumb">
            <li>
                <a href={{ URL::previous() }}><i class="fa fa-building-o"></i> Organizations</a>
            </li>
            <li class="active">
                Add New Organization
            </li>
        </ol>
    </section>
    <!-- Content -->
    @include('partials.errors')
    <form class='form-horizontal' method="POST" action="/organizations/store">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                        <input type="text" placeholder="Organization Name" class="form-control" name="organizations[name]"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class='form-group'>
                    <div class="input-group">
                        <div class="input-group-addon">@</div>
                        <input type="email" placeholder="Email Address" class="form-control" name="users[email]" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class='form-group'>
                    <input type="text" placeholder="First Name" class="form-control" name="users[firstname]" />
                </div>
            </div>
            <div class="col-sm-3">
                <div class='form-group'>
                    <input type="text" placeholder="Last Name" class="form-control" name="users[lastname]" />
                </div>
            </div>
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@stop