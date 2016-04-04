<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-calendar"></i> Event Details</h4>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title</label>
                    @if(empty($event->title))
                    <input type="text" placeholder="Event Title Here" class="form-control" name="event[title]" value="{{ old('event.title') }}"/>
                    @else
                    <input type="text" placeholder="Event Title Here" class="form-control" name="event[title]" value="{{ $event->title }}"/>
                    @endif
                </div>
                <div class='form-group'>
                    <label>Description</label>
                    @if (empty($event->description))
                    <textarea placeholder="Enter Description Here" class="form-control" name="event[description]">{{ old('event.description') }}</textarea>
                    @else
                    <textarea placeholder="Enter Description Here" class="form-control" name="event[description]">{{ $event->description }}</textarea>
                    @endif
                </div>
            </div>
        </div><!-- end of row -->
        <div class="row">
            <div class="col-md-3">
                <label>Starting</label>
                <div class='form-group'>
                    <div class="input-group input-append datepicker">
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                        @if (empty($event->startdate))
                        <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/01/2015" class="form-control dateRangePicker"
                               name="event[startdate]" value="{{ old(event.startdate) }}" />
                        @else
                        <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/01/2015" class="form-control dateRangePicker"
                               name="event[startdate]" value="{{ $event->startdate }}" />
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>&nbsp</label>
                    <div class="input-group input-append timepicker">
                        <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                        @if (empty($event->starttime))
                        <input type="text" size="" placeholder="Start Time" class="form-control" name="event[starttime]"
                               value="{{ old(event.starttime) }}"/>
                        @else
                        <input type="text" size="" placeholder="Start Time" class="form-control" name="event[starttime]"
                               value="{{ $event->starttime }}"/>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- end of row -->
        <div class="row">
            <div class="col-md-3">
                <label>Ending</label>                    
                <div class='form-group'>
                    <div class="input-group input-append datepicker">
                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                        <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                               name="event[enddate]" value="{{ $event->enddate }}" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>&nbsp</label>
                    <div class="input-group input-append timepicker">
                        <span class="input-group-addon"><i class="fa fa-fw fa-clock-o"></i></span>
                        <input type="text" size="" placeholder="End Time" class="form-control" name="event[endtime]"
                               value="{{ $event->endtime }}"/>
                    </div>
                </div>
            </div>
        </div><!-- end of row -->
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-ticket"></i> Ticket Information</h4>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
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
                                   value="{{ $event->price }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Event Capacity</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-fw fa-users"></i></span>
                            <input type="number" pattern="^\d" min="0" max="9999" step="1" placeholder="0" class="form-control" name="event[capacity]"
                                   value="{{ $event->capacity }}"/>
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
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">
        <div class="col-md-8">
            <div class="form-group">
                <label>Google Address Search</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-search"></i></span>
                    <input class="form-control" id="searchGoogleMapField" type="text" size="50" onFocus="geolocate()">
                </div>
            </div>
            <div class="form-group">
                <label>Venue Name</label>
                    <input type="text" id="establishment" placeholder="Venue Name" class="form-control" name="eventsite[name]" value="{{ $eventsite->name }}"/>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                            <input type="text" id="street_address" placeholder="1234 AllAccessRMS St." class="form-control" name="eventsite[address]" value="{{ $eventsite->address }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>City</label>
                            <input type="text" id="locality" placeholder="City" class="form-control" name="eventsite[city]" value="{{ $eventsite->city }}"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>State</label>
                        {!! Form::select('eventsite[state]', $states, null, array('id'=>'administrative_area_level_1', 'class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Zipcode</label>
                            <input type="text" id='postal_code' placeholder="Zipcode" class="form-control" name="eventsite[zipcode]" value="{{ $eventsite->zipcode }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-building"></i> Participating Organizations</h4>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            @foreach ($partners as $partner)
            <div class="checkbox">
                <label>
                    @if (in_array($partner->id, $selectedPartnersId))
                    {!! Form::checkbox('partners['.$partner->id.']', $partner->id, true, array('class'=>'cb')) !!}
                    @else
                    {!! Form::checkbox('partners['.$partner->id.']', $partner->id, false, array('class'=>'cb')) !!}
                    @endif 
                    {{ $partner->name }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><i class="fa fa-fw fa-cog"></i> Additional Settings</h4>
        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="radio">
                <label>
                    @if (!$event->private)
                    {!! Form::radio('event_privacy', 'public', true, array('class'=>'radio')) !!}
                    @else
                    {!! Form::radio('event_privacy', 'public', false, array('class'=>'radio')) !!}
                    @endif
                    Public: Registration available to the public.
                </label>
            </div>
            <div class="radio">
                <label>
                    @if ($event->private)
                    {!! Form::radio('event_privacy', 'private', true, array('class'=>'radio')) !!}
                    @else
                    {!! Form::radio('event_privacy', 'private', false, array('class'=>'radio')) !!}
                    @endif
                    Private: Registration available only to those on the invitation list.
                </label>
            </div>
            <div id="invite_section">
                <div class="panel inner-panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-event-id="{{ $event->id }}" data-target="#invite_modal"><i class="fa fa-fw fa-plus"></i> Add Guests</button> 
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <hr class="divider">
                                @if ($guests->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                                        <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($guests as $guest)                 
                                                <tr>
                                                    <td>{{ $guest->attendee_email }}</td>
                                                    <td>
                                                        <a href="{{ route('owner::eventguests.destroy', $guest->id) }}" data-method="delete" rel="nofollow" ><img src={{asset('images/delete.gif')}} alt="Delete"></a>
                                                    </td>
                                                </tr>             
                                            @endforeach
                                            {!! $guests->render() !!}
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@include('events.invite_modal')