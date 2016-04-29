@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header">
            <div class='button-container'>
                <i class="fa fa-fw fa-building-o"></i> Organizations
                @if (Auth::user()->can('create.organizations'))
                <a href='{{ URL::route('admin::organizations.create') }}' class="btn btn-md btn-primary" title="Add New Organization"><i class='fa fa-fw fa-plus'></i> Add</a>
                @endif
            </div>
        </h2>
    </section>
    <!-- Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                    <thead>
                    <tr>
                        <th style="width:20%">
                            Name
                            @if ($sortby=='name' && $order=='asc') 
                            {!!
                                HTML::decode(link_to_action(
                                    'Admin\OrganizationController@index',
                                    '<i class="fa fa-fw fa-caret-down"></i>',
                                    [
                                        'sortby'=>'name',
                                        'order'=>'desc'
                                    ]))
                            !!}
                            @else
                            {!!
                                HTML::decode(link_to_action(
                                    'Admin\OrganizationController@index',
                                    '<i class="fa fa-fw fa-caret-up"></i>',
                                    [
                                        'sortby'=>'name',
                                        'order'=>'asc'
                                    ]))
                            !!}
                            @endif
                        </th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zipcode</th>
                        <th>Contact
                        @if (Auth::user()->can('organizations.update'))
                        <th>Edit</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organizations as $organization)
                        <tr>
                            <td>{{ $organization->name }}</td>
                            @if(!is_null($organization->info))
                                <td>{{ $organization->info->address }}</td>
                                <td>{{ $organization->info->city }}</td>
                                <td>{{ $organization->info->state }}</td>
                                <td>{{ $organization->info->zipcode }}</td>
                                <td>{{ $organization->info->telephone }}</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                            @if (Auth::user()->can('users.update'))
                            <td><a href="#"><img src={{asset('images/edit_user.gif')}} alt="Edit"></a></td>
                            @endif
                        </tr>
                    @endforeach
                    {!! $organizations->render() !!}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop