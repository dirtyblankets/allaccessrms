@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h2>
    </section>
<!-- Content -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-calendar fa-5x">
                            </i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                {{ $active_events }}
                            </div>
                            <label>Active Events</label>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">
                            View Details
                        </span>
                        <span class="pull-right">
                            <i class="fa fa-arrow-circle-right"></i>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x">
                            </i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
                                {{ $active_events }}
                            </div>
                            <label>Attendees</label>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">
                            View Details
                        </span>
                        <span class="pull-right">
                            <i class="fa fa-arrow-circle-right"></i>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@stop