@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header">                 
        <i class="fa fa-fw fa-users"></i>Attendees
    </h2> 
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::previous() }}><i class="fa fa-calendar"></i> Events</a>
        </li>
        <li class="active">
            Attendees
        </li>
    </ol>
</section>
{!! Form::open(array('route' => array('attendees.search', $event->id), 'method' => 'GET', 'class'=>'form-horizontal'))!!}
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-fw fa-users"></i> 
                    Registered Attendees
                </h4>
                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
            </div>
            <div class="panel-body">
                <!--<div class="container-fluid">-->
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Registration Date</th>
                                <th>Organization</th>
                                <th>Fees Paid</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendees as $attendee)
                                <tr>
                                    <td>
                                        <a href="{{ URL::route('attendees.show', $attendee->id) }}">
                                            {{ $attendee->firstname . ' ' . $attendee->lastname }}
                                        </a>
                                    </td>
                                    <td>{{ $attendee->registration_date }}</td>
                                    <td>{{ $attendee->organization()->first()->name}}</td>
                                    @if ($attendee->is_fees_paid)
                                    <td>Yes</td>
                                    @else
                                    <td>No</td>
                                    @endif
                                </tr>
                            @endforeach
                            {!! $attendees->render() !!}
                            </tbody>
                        </table>
                    </div>
                <!--</div>-->
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                {!! Form::text('search_last_name', null, array(
                    'class'=>'form-control search', 
                    'placeholder'=>'Search by Last Name',
                    'value'=>"{{ old('search_last_name') }}")) !!}
                </div>
                <div class="form-group">
                {!! Form::text('search_first_name', null, array(
                    'class'=>'form-control search', 
                    'placeholder'=>'Search by First Name',
                    'value'=>"{{ old('search_first_name') }}")) !!}
                </div>
                <div class="form-group">
                    <label>Fee Status:</label>
                    {!! Form::select('search_payment_status', 
                                            array(''=>'','paid'=>'Fees paid','not_paid'=>'Fees not paid'), 
                                            old('search_payment_status'), 
                                            array(
                                            'class'=>'form-control search')) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary search-btn">Find</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop