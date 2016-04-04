<!-- Events Section -->
<section id="events" class="container content-section">
    <div class="row">
        <div class="col-md-12">
            <h2>Events</h2>
            <hr class="divider">
        </div>
    </div>
    <div id="events" class="row list-group">
    @foreach(array_chunk($events->all(), 3) as $eventRow)
            @foreach($eventRow as $event)           
            <div class="item col-xs-4 col-lg-4">
                <div class="thumbnail">
                    <a href="{{ URL::route('event.show', $event->id) }}"><img class="group list-group-image" src="http://placehold.it/400x250/000/fff" alt="http://placehold.it/400x250/000/fff"/></a>
                    <div class="caption">
                        <h4 class="group inner grid-group-item-heading">
                            {{ $event->title }}                    
                        </h4>
                        <hr class="divider">
                        <p class="group inner grid-group-item-text">
                            {{ $event->eventDescriptionShort() }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
    @endforeach
    </div>
</section>