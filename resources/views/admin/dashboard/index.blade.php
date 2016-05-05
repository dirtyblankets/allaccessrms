@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-home"></i> Home</h2>
</section>
<div class="panel panel-default">
    <div class="panel-heading">
        @if (Auth::user()->organization()->first()->isChild())
        <h4><i class="fa fa-fw fa-calendar"></i> Current Participating Events</h4>
        @else
        <h4><i class="fa fa-fw fa-calendar"></i> Live Events</h4>
        @endif
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">
        <div id="events" class="container-fluid">
            @foreach($events as $event)           
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        @if (!Auth::user()->organization()->first()->isChild())
                        <a href="{{ URL::route('events.show', $event->id) }}"><img class="group list-group-image img-responsive" src="http://placehold.it/1024x350/000/fff" alt="http://placehold.it/1024x350/000/fff"/>
                        </a>
                        @else
                        <a href="{{ URL::route('attendees', $event->id) }}"><img class="group list-group-image img-responsive" src="http://placehold.it/1024x350/000/fff" alt="http://placehold.it/1024x350/000/fff"/>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                        <h4>
                            <strong>Title:</strong> {{ $event->title }}                    
                        </h4>
                        <hr class="divider">
                        <p class="group inner grid-group-item-text">
                            <strong>Description:</strong> {{ $event->description }}
                        </p>
                        <p class="group inner grid-group-item-text">
                            <strong>Location:</strong> {{ $event->eventsite()->first()->name }}
                        </p>
                </div>
                <div class="col-md-4">
                    <h4>
                        <strong>Summary</strong>
                    </h4>
                    <hr class="divider">
                    <i class="fa fa-fw fa-users fa-align-center"></i> 
                    Attendees Registered: {{ $event->attendees()->count() }}
                    <hr class="divider">
                    <p class="group inner grid-group-item-text">
                        <strong>Start Date & Time:</strong> {{ $event->start_date }} at {{ $event->start_time }}
                    </p>
                    <p class="group inner grid-group-item-text">
                        <strong>End Date & Time:</strong> {{ $event->end_date }} at {{ $event->end_time }}
                    </p>
                </div>
            </div>
            <hr class="divider">
            @endforeach
        </div>
    </div>
</div>
@stop