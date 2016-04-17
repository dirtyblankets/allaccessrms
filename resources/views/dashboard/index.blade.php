@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-home"></i> Home</h2>
</section>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-calendar"></i> Live Events</h4>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">
        <div id="events" class="container-fluid">
            @foreach($events as $event)           
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="{{ URL::route('admin::events.show', $event->id) }}"><img class="group list-group-image img-responsive" src="http://placehold.it/1024x350/000/fff" alt="http://placehold.it/1024x350/000/fff"/>
                        </a>
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
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop