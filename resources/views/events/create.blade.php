@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header"><i class="fa fa-fw fa-calendar"></i>+ Create Event</h2>
            <ol class="breadcrumb">
                <li>
                    <a href={{ URL::previous() }}><i class="fa fa-calendar"></i> Events</a>
                </li>
                <li class="active">
                    Add New Event
                </li>
        </div>
    </div>
    <!-- Content -->
    @include('partials.message')
    @include('partials.errors')
    <div class="panel-body">
        <form class='form form-horizontal' method="POST" action="/events/store">
            {!! csrf_field() !!}
            <div class="col-sm-12">
                <h4>Publish Event</h4>
                <div class="form-group">
                    <input type="text" placeholder="Event Title Here" class="form-control" name="event[title]"
                           value="{{ old('event.title') }}" required="required"/>
                </div>
                <div class='form-group'>
                    <textarea placeholder="Enter Description Here" class="form-control" name="event[description]"></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class='form-group'>
                            <label>Start Date</label>
                            <div class="input-group input-append datepicker">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                <input type="date" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/01/2015" class="form-control dateRangePicker"
                                       name="event[startdate]" value="{{ old('event.startdate')  }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class='form-group'>
                            <label>End Date</label>
                            <div class="input-group input-append datepicker">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                <input type="date" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                                       name="event[enddate]" value="{{ old('event.enddate')  }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Start Time</label>
                            <div class="input-group timepicker">
                                <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                                <input type="time" size="" placeholder="Start Time" class="form-control" name="event[starttime]"
                                       value="{{ old('event.starttime') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
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
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Registration Cost</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-usd"></i></span>
                                <input type="number" size="4" pattern="^\d*(\.\d{2}$)?" min="0" max="9999" step="0.01" placeholder="" class="form-control" name="event[cost]"
                                       value="{{ old('event.cost') }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Event Capacity</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-users"></i></span>
                                <input type="number" pattern="^\d" min="0" max="9999" step="1" placeholder="" class="form-control" name="event[capacity]"
                                       value="{{ old('event.capacity') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="'form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop
