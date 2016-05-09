@extends('layouts.main')
@section('content')
@if($event->published)
    {!! Form::open(array('route' => array('events.unpublish', $event->id), 'method' => 'PATCH')) !!}
@else 
    {!! Form::open(array('route' => array('events.update', $event->id), 'method' => 'PUT', 'files' => true))!!}
@endif
<section class="content-header">
    <h2 class="page-header">                 
        <div class='button-container'>
            <i class="fa fa-fw fa-calendar"></i>Manage Event
            @if($event->published)
                <button title='Take event offline' name='unpublish' type='submit' id='btn-unpublish' class='btn btn-md btn-warning'><i class="fa fa-fw fa-warning"></i> Unpublish</button>
            @else 
                <button type="submit" name="submitBtn" class="btn btn-md btn-success btn-toggle-readonly" value="save"><i class="fa fa-fw fa-check"></i> Save</button>
                
                <button type="submit" name="submitBtn" class="btn btn-md btn-primary btn-toggle-readonly" value="publish"><i class="fa fa-fw fa-arrow-circle-up"></i> Publish</button>     
                
                <button class='btn btn-md btn-danger btn-modal' type='button' data-toggle="modal" data-target="#confirmDelete" data-route="{{ URL::route('events.destroy', $event->id) }}" data-title="Delete Event" data-message='Are you sure you want to delete this event ?'>
                <i class='fa fa-fw fa-times'></i> Delete</button>
            @endif
        </div>
    </h2> 
    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::route('events') }}"><i class="fa fa-calendar"></i> Events</a>
        </li>
        <li class="active">
            Manage Event
        </li>
    </ol>
</section>
 <!-- Content -->
@include('partials.message')
@include('partials.errors')
<div id="openModal" data-open-modal="{{ old('openModal') }}" ></div>
@if ($event->published)
    <div id="event_published"></div>
@endif
<div class="tab-wrapper">
    <ul class="nav nav-tabs">
        <li role="presentation" class="{{ Request::is('events/' . $event->id . '/manage') ? 'active' : null }}">
            <a href="#event_detail" aria-controls="event_detail" role="tab" data-toggle="tab">Event Information</a>
        </li>
        @if ($attendees->count() > 0)
            <li role="presentation" class="{{ Request::is('events/' . $event->id . '/attendee_search*') ? 'active' : null }}">
                <a href="#registrants" aria-controls="registrants" role="tab" data-toggle="tab">Registered Attendee(s)</a>
            </li>
        @endif
    </ul>
</div>
<div class"tab-content">
    <section id="event_detail" class="tab-pane {{ Request::is('events/' . $event->id . '/manage') ? 'active' : 'hide' }}" role="tabpanel">
        @include('events.event_detail_section')
    </section>
    <section id="registrants" class="tab-pane {{ Request::is('events/' . $event->id . '/attendee_search*') ? 'active' : 'hide' }}" role="tabpanel">
        @include('events.attendees_section')
    </section>
</div>
@stop