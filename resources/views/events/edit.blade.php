@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header">                 
        <div class='button-container'>
                <i class="fa fa-fw fa-calendar"></i>Edit Event     
                <button class='btn btn-sm btn-danger btn-modal' type='button' data-toggle="modal" data-target="#confirmDelete" data-route="{{ URL::route('owner::events.destroy', $event->id) }}" data-title="Delete Event" data-message='Are you sure you want to delete this event ?'>
                    <i class='fa fa-fw fa-times'></i> Delete
                </button>
            @if($event->published)
            {!! Form::open(array('route' => array('owner::events.unpublish', $event->id), 'method' => 'PATCH')) !!}
                <button title='Take event offline' type='submit' id='btn-unpublish' class='btn btn-sm btn-warning'>Unpublish</button> 
            {!! Form::close() !!} 
            @endif
        </div>
    </h2> 
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::previous() }}><i class="fa fa-calendar"></i> {{ $event->title }}</a>
        </li>
        <li class="active">
            Edit
        </li>
    </ol>
</section>
 <!-- Content -->
@include('partials.message')
@include('partials.errors')
{!! Form::open(array('route' => array('owner::events.update', $event->id), 'method' => 'PUT'))!!}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-calendar"></i> Event Details</h4>
    </div>
    <div class="panel-body">
        <input id="event_published" type="hidden" value="{{ $event->published }}">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Title</label>
                <input type="text" placeholder="Event Title Here" class="form-control" name="event[title]"
                       value="{{ $event->title }}" required="required"/>
            </div>
            <div class='form-group'>
                <label>Description</label>
                <textarea placeholder="Enter Description Here" class="form-control" name="event[description]">{{ $event->description }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class='form-group'>
                        <label>Start Date</label>
                        <div class="input-group input-append datepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            <input type="date" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/01/2015" class="form-control dateRangePicker"
                                   name="event[startdate]" value="{{ $event->start_date }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Start Time </label>
                        <div class="input-group timepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                            <input type="time" size="" placeholder="Start Time" class="form-control" name="event[starttime]"
                                   value="{{ $event->start_time }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class='form-group'>
                        <label>End Date</label>
                        <div class="input-group input-append datepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            <input type="date" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                                   name="event[enddate]" value="{{ $event->end_date }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>End Time</label>
                        <div class="input-group timepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                            <input type="time" size="" placeholder="End Time" class="form-control" name="event[endtime]"
                                   value="{{ $event->end_time}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-ticket"></i> Ticket Information</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Registration Cost</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-usd"></i></span>
                        <input type="number" size="4" pattern="^\d*(\.\d{2}$)?" min="0" max="9999" step="0.01" placeholder="" class="form-control" name="event[cost]"
                               value="{{ $event->price }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Event Capacity</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-users"></i></span>
                        <input type="number" pattern="^\d" min="0" max="9999" step="1" placeholder="" class="form-control" name="event[capacity]"
                               value="{{ $event->capacity }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-map"></i> Event Location</h4>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="form-group">
                <label>Venue Name</label>
                    <input type="text" placeholder="Venue Name" class="form-control" name="eventsite[name]" value="{{ $eventsite->name }}"/>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                            <input type="text" placeholder="1234 AllAccessRMS St." class="form-control" name="eventsite[address]" value="{{ $eventsite->address }}"/>                 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>City</label>
                            <input type="text" placeholder="City" class="form-control" name="eventsite[city]" value="{{ $eventsite->city }}"/>                 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>State</label>
                            <input type="text" placeholder="State" class="form-control" name="eventsite[state]" value="{{ $eventsite->state }}"/>                 
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Zipcode</label>
                            <input type="text" placeholder="Zipcode" class="form-control" name="eventsite[zipcode]" value="{{ $eventsite->zipcode }}"/>                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-building"></i> Participating Organizations</h4>
    </div>
    <div class="panel-body">
        <div class="checkboxlist">
            <ul style="list-style-type: none">
                @foreach ($partners as $partner)
                    <li>
                        {!! Form::checkbox('partners', $partner->id, true) !!}
                        {{$partner->name}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary btn-toggle-readonly">Submit</button>
</div>
{!! Form::close() !!}
@stop