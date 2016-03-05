@extends('public.layouts.main')
@section('content')
    @include('public.layouts.header_registration')
    @include('public.layouts.nav_registration')
    <!-- Events Section -->
    <section id="information" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Event Information</h2>
                <hr class="divider">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default panel-information">
                    <div class="panel-heading">
                        <h3>
                            When and Where
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            <i class="fa fa-fw fa-calendar"></i><strong>{{ $event->start_date }}</strong> through <i class="fa fa-fw fa-calendar"></i><strong>{{ $event->end_date }}</strong>
                        </p>
                        <p>Starts at: <strong>{{ $event->start_time }}</strong> and Ends at: <strong>{{ $event->end_time }}</strong></p>
                        <p>
                            Location Site: <strong>{{ $eventsite->name }}</strong><br>
                            Address: {{ $eventsite->address }}, {{ $eventsite->city }} {{ $eventsite->state }} {{ $eventsite->zipcode }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <iframe
                        width="380"
                        height="350"
                        frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBdwK_EdllaBLjD-ZpkPvSd5_exs3zlzi4&q={{ $eventsite->name }},{{ $eventsite->city }}+{{ $eventsite->state }}" allowfullscreen>
                </iframe>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default panel-information">
                    <div class="panel-heading">
                        <h3>
                            Contact Information
                        </h3>
                    </div>
                    <div class="panel-body" style="min-height: 290px; max-height: 290; overflow-y: scroll;">
                        <p>
                            Host Contact Number: <strong>{{ $organizationinfo->telephone }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Registration Section -->
    <section id="registration" class="container content-section">
        <div class="row">
            <div class="col-lg-12">
                <h2>Registration</h2>
                <hr class="divider">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {!! Form::open(array('route' => array('event.registration'), 'method' => 'POST'))!!}
                {!! Form::hidden('event_id', $event->id) !!}
                <div class="panel panel-default panel-registration">
                    <div class="panel-heading">
                        <h3>Attendee Information</h3>
                    </div>
                    @include('partials.errors')
                    <div class="panel-body">
                        <p>Which Organization do you belong to? {!! Form::select('attendee[organization_id]', $organizations, null, array('class'=>'form selectpicker')) !!}</p>
                        <hr class="divider">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class='form-group'>
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="attendee[firstname]" value="{{ old('attendee.firstname') }}"/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class='form-group'>
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="attendee[lastname]" value="{{ old('attendee.lastname') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class='form-group'>
                                    <label>Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" placeholder="email@email.com" class="form-control" name="attendee[email]" value="{{ old('attendee.email') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                                        <input type="tel" placeholder="Telephone" class="form-control phone" name="attendee[phone]" value="{{ old('attendee.phone') }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success btn-toggle-readonly">Register</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@stop