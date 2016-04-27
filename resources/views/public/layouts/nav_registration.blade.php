<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top navbarscroll" role="navigation">
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
					<a class="" href='{{ URL::route('event.registration', $event->id) }}'>Registration</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>