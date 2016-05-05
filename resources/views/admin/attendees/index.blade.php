@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-fw fa-calendar"></i> {{ $event->title }}</h2>
</section>
@include('attendees.index')
@stop