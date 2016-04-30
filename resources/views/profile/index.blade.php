@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-fw fa-cog"></i> Settings
    </h2>
</section>
<div class="tab-wrapper">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <a href="#password_change">Password</a>
        </li>
        <li role="presentation">
            <a href="#organization_info">Organization Info</a>
        </li>
    </ul>
</div>
{!! Form::open(array('route' => array('update'), 'method' => 'PATCH'))!!}
<section id="password_change" class="tab-content active">
    @include('settings.password_change_section')
</section>
<section id="organization_info" class="tab-content hide">
    @include('settings.organization_info_section')
</section>
{!! Form::close() !!}
@stop