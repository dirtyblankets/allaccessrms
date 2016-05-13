@extends('public.layouts.main')
@section('content')
<section id="login" class="container content-section">
    <div class='col-md-6 col-md-offset-3'>
        <div class="panel-body">
            {!! Form::open(array('route' => array('new_user.login', $user->id), 'method' => 'PUT')) !!}
                {!! csrf_field() !!}
                {!! Form::hidden('user_id', $user->id) !!}
                <div class="col-md-12">
                    @include('partials.errors')
                    <h1><i class='fa fa-lock'></i> Login</h1>
                    <div class="panel panel-default panel-information">
                    <div class="panel-body">
                        <div class='form-group'>
                            <label>Email</label>
                            <input type="text" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}"/>
                        </div>

                        <div class='form-group'>
                            <label>Create Password</label>
                            <input type="password" placeholder="Password" class="form-control" name="password"/>
                        </div>

                        <div class='form-group'>
                            <label>Password Confirmation</label>
                            <input type="password" placeholder="Re-enter Password" class="form-control" name="password_confirmation"/>
                        </div>
                        <div class='form-group'>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@stop