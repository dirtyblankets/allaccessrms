@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header"><i class="fa fa-home"></i> Home</h2>
</section>

<div class="col-lg-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-fw fa-users"></i> 
                Registered Attendees
            </h4>
            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
        </div>
        <div class="panel-body">
            <div id="events" class="container-fluid">
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-lg-2">
                <button class="btn btn-primary">Find</button>
            </div>
        </div>
    </div>
</div>

@stop