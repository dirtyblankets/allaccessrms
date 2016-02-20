@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-fw fa-calendar"></i> Create Event</h2>
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::previous() }}><i class="fa fa-calendar"></i> Events</a>
        </li>
        <li class="active">
            Add New Event
        </li>
    </ol>
</section>
<!-- Content -->
@include('partials.message')
@include('partials.errors')
<form class='form form-horizontal' method="POST" action="/events/store">
    {!! csrf_field() !!}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-calendar"></i> Event Details</h4>
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Title</label>
                <input type="text" placeholder="Event Title Here" class="form-control" name="event[title]"
                       value="{{ old('event.title') }}" required="required"/>
            </div>
            <div class='form-group'>
                <label>Description</label>
                <textarea placeholder="Enter Description Here" class="form-control" name="event[description]">{{ Input::old('event.description') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class='form-group'>
                        <label>Start Date</label>
                        <div class="input-group input-append datepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            <input type="date" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/01/2015" class="form-control dateRangePicker"
                                   name="event[startdate]" value="{{ old('event.startdate') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Start Time </label>
                        <div class="input-group timepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                            <input type="time" size="" placeholder="Start Time" class="form-control" name="event[starttime]"
                                   value="{{ old('event.starttime') }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class='form-group'>
                        <label>End Date</label>
                        <div class="input-group input-append datepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                            <input type="date" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                                   name="event[enddate]" value="{{ old('event.enddate') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>End Time</label>
                        <div class="input-group timepicker">
                            <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                            <input type="time" size="" placeholder="End Time" class="form-control" name="event[endtime]"
                                   value="{{ old('event.endtime') }}"/>
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
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Registration Cost</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-fw fa-usd"></i></span>
                            <input type="number" size="4" pattern="^\d*(\.\d{2}$)?" min="0" max="9999" step="0.01" placeholder="0.00" class="form-control" name="event[cost]"
                                   value="{{ old('event.cost') }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Event Capacity</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-fw fa-users"></i></span>
                            <input type="number" pattern="^\d" min="0" max="9999" step="1" placeholder="0" class="form-control" name="event[capacity]"
                                   value="{{ old('event.capacity') }}"/>
                        </div>
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
                    <input type="text" placeholder="Venue Name" class="form-control" name="eventsite[name]" value="{{ old('eventsite.name') }}"/>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Address</label>
                            <input type="text" placeholder="1234 AllAccessRMS St." class="form-control" name="eventsite[address]" value="{{ old('eventsite.address') }}"/>                 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>City</label>
                            <input type="text" placeholder="City" class="form-control" name="eventsite[city]" value="{{ old('eventsite.city') }}"/>                 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>State</label>
                            <input type="text" placeholder="State" class="form-control" name="eventsite[state]" value="{{ old('eventsite.state') }}"/>                 
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Zipcode</label>
                            <input type="text" placeholder="Zipcode" class="form-control" name="eventsite[zipcode]" value="{{ old('eventsite.zipcode') }}"/>                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-sm btn-primary btn-toggle-readonly">Submit</button>
</div>

</div>
</form>
@stop
