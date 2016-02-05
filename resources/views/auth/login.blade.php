@extends('layouts.login')
@section('content')
 <div class='col-md-6 col-md-offset-3'>
    @include('errors.errors')
    <!-- Content -->
     <div class="panel-body" style="background-color: aliceblue;">
         <form class='bootstrap-form' method="POST" action="/auth/login">
             {!! csrf_field() !!}
             <div class="col-sm-12">
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
             <!--<p color="red">Not registered? <a href="{{ URL::route('new_user_registration') }}">Register here.</a></p>-->
         </form>
     </div>
</div>
@stop