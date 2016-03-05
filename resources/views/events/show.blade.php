@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header">
        <i class="fa fa-fw fa-calendar"></i>Preview Event <a href="{{ URL::route('owner::events.edit', $event->id)  }}" class="btn btn-sm btn-info">Edit</a>
    </h2>
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::to('events') }}><i class="fa fa-calendar"></i> Events</a>
        </li>
        <li class="active">
            Show Event
        </li>
    </ol>
</section>
<!-- Content -->
<div class="row">
    <div class="jumbotron text-center">
        <h1>{{ $event->title }}</h1>
        <p>{{ $event->description }}</p>
        <p><i class="fa fa-fw fa-calendar"></i><strong>{{ $event->start_date }}</strong> through <i class="fa fa-fw fa-calendar"></i><strong>{{ $event->end_date }}</strong></p>
        <p>Starts at: <strong>{{ $event->start_time }}</strong> and Ends at: <strong>{{ $event->end_time }}</strong></p>
    </div>
</div>
@stop