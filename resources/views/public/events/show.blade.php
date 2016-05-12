@extends('public.layouts.main')
@section('content')
    @include('public.layouts.nav_registration')
    @include('public.layouts.header_registration')
    <!-- Events Section -->
    <section id="information" class="container content-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Event Information <a href='{{ URL::route('event.registration', $event->id) }}' class='btn btn-lg btn-info'>Register Here</a></h2>
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
                        <p>
                            @if($event->price > 0)
                                Registration Cost: <strong>${{ $event->price }}</strong>
                            @else
                                Free Event
                            @endif
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
                            Organizer
                        </h3>
                    </div>
                    <div class="panel-body" style="min-height: 290px; max-height: 290;">
                        <label>Organized By:</label>  {{ $event->organization()->first()->name }}
                        <br>
                        <label>Contact Number:</label>  {{ $organizationinfo->telephone_formatted }}
                        <br>
                        <label>Email:</label>  {{ $organizationinfo->email }}
                        <br>
                        <label>Address:</label>  {{ $organizationinfo->address }}  {{ $organizationinfo->city }}
                        {{ $organizationinfo->state }}, {{ $organizationinfo->zipcode }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop