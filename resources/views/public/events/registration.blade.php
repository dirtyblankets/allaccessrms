@extends('public.layouts.main')
@section('content')
@include('public.events.navbar')
<!-- Registration Section -->
<section id="registration" class="container content-section">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $event->title }} - Registration</h2>
            <hr class="divider">
        </div>
    </div>
    {!! Form::open(array('route' => array('event.register'), 'method' => 'POST'))!!}
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <button type='submit' class='btn btn-lg btn-info'>
                Submit Registration
                </button>                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                @include('partials.errors')            
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {!! Form::hidden('event_id', $event->id) !!}
            <div class="panel panel-default panel-registration">
            	<ul class="nav nav-tabs">
    				<li role="presentation" class="active">
                        <a href="#application">Application</a>
                    </li>
    				<li role="presentation" >
                        <a href="#healthreleaseform">Health and Release Form</a>
                    </li>
				</ul>
				<section id="application" class="tab-content active">
					@include('public.events.application_section')
				</section>
				<section id="healthreleaseform" class="tab-content hide">
					@include('public.events.health_release_section')
				</section>
			</div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@stop