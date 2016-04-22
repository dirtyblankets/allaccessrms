@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-fw fa-calendar"></i> Events
        <a href="{{ URL::route('admin::events.create') }}" class="btn btn-md btn-primary"><i class='fa fa-fw fa-plus'></i> New</a>
    </h2>
</section>
<!-- Content -->
<div class="row">
    <div class="col-md-12">
        @if ($events->count() == 0)
        <h4>No Events Added... yet :)</h4>
        @else
        <div class="table-responsive">
            <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>
                            <a href="{{ URL::route('admin::events.manage', $event->id)}}">
                                @if ($event->title == "")
                                    NO TITLE
                                @else
                                    {{ $event->title }}
                                @endif
                            </a>
                            @if ($event->has_ended)
                            <span style="color: red; text-align: right">Ended!</span>
                            @endif
                        </td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>{{ $event->eventType() }}</td>
                        <td>{{ $event->eventStatus() }}</td>
                        @if (Auth::user()->is('admin'))
                        <td><a class="btn btn-sm btn-success" href="{{ URL::route('admin::events.show', $event->id)}}">Show</a></td>
                        @endif
                    </tr>
                @endforeach
                {!! $events->render() !!}
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@stop