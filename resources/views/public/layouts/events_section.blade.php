<!-- Events Section -->
<section id="events" class="container content-section">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Events</h2>
            <hr class="divider">
        </div>
    </div>
    <div class="row">
        @foreach(array_chunk($events->all(), 3) as $eventRow)
            <div class="row-fluid">
                @foreach($eventRow as $event)
                    <div class="col-md-2 col-md-offset-2 griditem" style="color: black; background-color: white;">
                        <div class="panel-body">
                            <h3>{{ $event->title }}</h3>
                            <a href="{{ URL::route('event.show', $event->id) }}">View</a>
                            <hr class="divider">

                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>