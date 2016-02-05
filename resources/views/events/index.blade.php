@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header"><i class="fa fa-fw fa-calendar"></i> Events
                <a href="{{ URL::route('admin::events.create')  }}" class="btn btn-small btn-primary">+ New</a>
            </h2>
        </div>
    </div>
    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
@stop