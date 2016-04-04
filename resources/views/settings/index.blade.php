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
    </ul>
</div>
{!! Form::open(array('route' => array('password_change'), 'method' => 'POST'))!!}
<section id="password_change" class="tab-content active">
    @include('settings.password_change_section')
</section>
{!! Form::close() !!}
@stop