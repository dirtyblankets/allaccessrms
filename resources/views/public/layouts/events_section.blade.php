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
                    <a href="{{ URL::route('event.show', $event->id) }}">
                        @if(empty($event->thumbnail_url))
                        <img class="group list-group-image" src={{ asset('images/public/alt_image.jpg') }} />
                        @else
                        <img class="group list-group-image" src={{ asset($event->thumbnail_url) }} />
                        @endif
                    </a>
                    <div class="caption">
                        <p class="group inner grid-group-item-heading" style="text-align: center;">
                            {{ $event->title }}                    
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
    @endforeach
    </div>
</section>