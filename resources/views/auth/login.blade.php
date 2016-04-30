@extends('public.layouts.main')
@section('content')
<section id="login" class="container content-section">
    <div class='col-md-6 col-md-offset-3'>
        <div class="panel-body">
            <form class='bootstrap-form' method="POST" action="/auth/login">
                {!! csrf_field() !!}
                <div class="col-md-12">
                    @include('partials.errors')
                    @include('partials.message')
                    <h1><i class='fa fa-lock'></i> Login</h1>
                    <div class='form-group'>
                        <label>Email</label>
                        <input type="text" placeholder="Email" class="form-control" name="email" />
                    </div>

                    <div class='form-group'>
                        <label>Password</label>
                        <input type="password" placeholder="Password" class="form-control" name="password"/>
                    </div>

                    <div class='form-group'>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@stop