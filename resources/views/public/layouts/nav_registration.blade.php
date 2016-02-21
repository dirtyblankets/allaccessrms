	<!-- Navigation -->
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand page-scroll" href="{{ URL::to('/') }}">
					<i class="fa fa-play-circle"></i> <span class="light">All Access</span> RMS
				</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
				<ul class="nav navbar-nav">
					<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
					<li class="hidden">
						<a href="#page-top"></a>
					</li>
                    <li>
                        <a class="page-scroll" href="#page-top">Description</a>
                    </li>
					<li>
						<a class="page-scroll" href="#information">Information</a>
					</li>
					<li>
						<a class="page-scroll" href="#registration">Registration</a>
					</li>
                    <!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> Login<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu login" style="width: 200px;">
                            <form class='bootstrap-form' method="POST" action="/auth/login">
                                {!! csrf_field() !!}
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input type="text" placeholder="Email" class="form-control" name="email" />
                                </div>
                                <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <input type="password" placeholder="Password" class="form-control" name="password"/>
                                </div>
                                @if($errors->has())
                                    <span class="help-block" style="color: red">Invalid Login</span>
                                @endif
                                <li class="divider"></li>
                                <div class='form-group'>
                                    <button type="submit" class="btn btn-xs btn-primary">Login</button>
                                </div>
                            </form>
                        </ul>
                    </li>
                    -->
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>