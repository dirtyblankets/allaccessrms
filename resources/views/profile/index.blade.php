@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-fw fa-cog"></i> Settings
    </h2>
</section>
<!-- Content -->
@include('partials.message')
@include('partials.errors')
<div class="tab-wrapper">
    <ul class="nav nav-tabs">
        @if (Auth::user()->is('owner|admin'))
        <li role="presentation" class="active">
            <a href="#organization_info">Organization Info</a>
        </li>
        <li role="presentation">
            <a href="#password_change">Password</a>
        </li>
        @else
        <li role="presentation" class="active">
            <a href="#password_change">Password</a>
        </li>
        @endif
    </ul>
</div>
@if (Auth::user()->is('owner|admin'))
<section id="organization_info" class="tab-content active">
    @include('profile.organization_info_section')
</section>
<section id="password_change" class="tab-content hide">
    @include('profile.password_change_section')
</section>
@else
<section id="password_change" class="tab-content active">
    @include('profile.password_change_section')
</section>
@endif
@stop