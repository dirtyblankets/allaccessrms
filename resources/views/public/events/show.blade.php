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
                    <div class="panel-body"style="min-height: 290px; max-height: 290; overflow-y: scroll;">
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
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Registration</h2>
                <hr class="divider">
            </div>
        </div>
    </section>
@stop