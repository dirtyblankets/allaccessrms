 @extends('layouts.main')
@section('content')
    <section class="content-header">
        <h2 class="page-header"><i class="fa fa-fw fa-user"></i>+ Add New User</h2>
        <ol class="breadcrumb">
            <li>
                <a href={{ URL::previous() }}><i class="fa fa-users"></i> Users</a>
            </li>
            <li class="active">
                Add New User
            </li>
        </ol>
    </section>
    <!-- Content -->
    <form class='form-horizontal' method="POST" action="/users/store">
        @include('partials.errors')
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-lg-6">
                <div class='form-group'>
                    <label>Email Address:</label>
                    <div class='input-group'>
                        <div class="input-group-addon"><span class="fa fa-envelope"></span></div>
                        <input type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}" />
                    </div>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class='form-group'>
                    <label>First Name:</label>
                    <input type="text" placeholder="First Name" class="form-control" name="firstname" value="{{ old('firstname') }}" />
                </div>
            </div>

        </div> 
        <div class="row">
            <div class="col-lg-6">
                <div class='form-group'>
                    <label>Last Name:</label>
                    <input type="text" placeholder="Last Name" class="form-control" name="lastname" value="{{ old('lastname') }}" />
                </div> 
            </div>        
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Contact Number</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="fa fa-phone"></span></div>
                        <input type="tel" placeholder="Telephone" class="form-control phone" name="telephone"
                                       value="{{ old('telephone') }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class='form-group'>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@stop