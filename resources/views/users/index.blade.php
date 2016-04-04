@extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header"><i class="fa fa-fw fa-users"></i> Users
            <a href='{{ URL::route('owner::users.create') }}' class="btn btn-md btn-primary" title="Add New User"><i class='fa fa-fw fa-plus'></i> Add</a>
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
                            Last Name
                            @if ($sortby=='lastname' && $order=='asc') 
                            {!!
                                HTML::decode(link_to_action(
                                    'Owner\UserController@index',
                                    '<i class="fa fa-fw fa-caret-down"></i>',
                                    [
                                        'sortby'=>'lastname',
                                        'order'=>'desc'
                                    ]))
                            !!}
                            @else
                            {!!
                                HTML::decode(link_to_action(
                                    'Owner\UserController@index',
                                    '<i class="fa fa-fw fa-caret-up"></i>',
                                    [
                                        'sortby'=>'lastname',
                                        'order'=>'asc'
                                    ]))
                            !!}
                            @endif
                        </th>
                        <th style="width:20%">
                            First Name
                            @if ($sortby=='firstname' && $order=='asc') 
                            {!!
                                HTML::decode(link_to_action(
                                    'Owner\UserController@index',
                                    '<i class="fa fa-fw fa-caret-down"></i>',
                                    [
                                        'sortby'=>'firstname',
                                        'order'=>'desc'
                                    ]))
                            !!}
                            @else
                            {!!
                                HTML::decode(link_to_action(
                                    'Owner\UserController@index',
                                    '<i class="fa fa-fw fa-caret-up"></i>',
                                    [
                                        'sortby'=>'firstname',
                                        'order'=>'asc'
                                    ]))
                            !!}
                            @endif
                        </th>
                        <th style="width:20%">
                            Email
                            @if ($sortby=='email' && $order=='asc') 
                            {!!
                                HTML::decode(link_to_action(
                                    'Owner\UserController@index',
                                    '<i class="fa fa-fw fa-caret-down"></i>',
                                    [
                                        'sortby'=>'email',
                                        'order'=>'desc'
                                    ]))
                            !!}
                            @else
                            {!!
                                HTML::decode(link_to_action(
                                    'Owner\UserController@index',
                                    '<i class="fa fa-fw fa-caret-up"></i>',
                                    [
                                        'sortby'=>'email',
                                        'order'=>'asc'
                                    ]))
                            !!}
                            @endif
                        </th>
                        <th style="width:15%">Organization</th>
                        <th>Role</th>
                        <th style="width:5%">Active</th>
                        <th style="width:5%">Edit</th>
                        <th style="width:5%">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getOrganizationName() }}</td>
                            <td>{{ $user->getUserRoles() }}</td>
                            <td>{{ $user->getActiveString() }}</td>
                            <td><a href="#"><img src={{asset('images/edit_user.gif')}} alt="Edit"></a></td>
                            <td><a href="#"><img src={{asset('images/delete.gif')}} alt="Delete"></a></td>
                        </tr>
                    @endforeach
                    {!! $users->render() !!}
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--End Content-->
@stop