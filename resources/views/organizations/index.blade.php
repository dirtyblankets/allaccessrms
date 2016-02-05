@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header"><i class="fa fa-fw fa-building-o"></i> Organizations
            <a href='{{ URL::route('admin::organizations.create') }}' class="btn btn-small btn-primary" title="Add New Organization">+ Add</a>
        </h2>
    </section>
    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                    <tr>
                        <th style="width:20%">Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zipcode</th>
                        <th>Contact</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organizations as $organization)
                        <tr>
                            <td>{{ $organization->name }}</td>
                            <td>{{ $organization->info->address }}</td>
                            <td>{{ $organization->info->city }}</td>
                            <td>{{ $organization->info->state }}</td>
                            <td>{{ $organization->info->zipcode }}</td>
                            <td>{{ $organization->info->telephone }}</td>
                            <td><a href="#"><img src={{asset('images/edit_user.gif')}} alt="Edit"></a></td>
                        </tr>
                    @endforeach
                    {!! $organizations->render() !!}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop