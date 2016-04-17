<!-- Intro Header -->
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row" style="margin-top: 80px;">
                <div class="col-md-12">
                    <h1 class="brand-heading">{{ $event->title  }}</h1>
                    <p class="intro-text">{{ $event->description }}</p>
                    <p>Hosted By: <strong>{{ $hostOrg->name }}</strong></p>
                    <a href="#information" class="btn btn-circle page-scroll pulse">
                        <i class="fa fa-angle-double-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>