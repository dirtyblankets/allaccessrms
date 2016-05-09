{!! Form::open(array('route' => array('events.attendee_search', $event->id), 'method' => 'GET'))!!}
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-fw fa-users"></i> 
                    Registered Attendees
                </h4>
                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
            </div>
            <div class="panel-body">
                <!--<div class="container-fluid">-->
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Registration Date</th>
                                <th>Organization</th>
                                <th>Fees Paid</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendees as $attendee)
                                <tr>
                                    <td>
                                        <a href="">
                                            {{ $attendee->firstname . ' ' . $attendee->lastname }}
                                        </a>
                                    </td>
                                    <td>{{ $attendee->registration_date }}</td>
                                    <td>{{ $attendee->organization()->first()->name}}</td>
                                    <td>{{ $attendee->amount_paid }}</td>
                                </tr>
                            @endforeach
                            {!! $attendees->render() !!}
                            </tbody>
                        </table>
                    </div>
                <!--</div>-->
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                {!! Form::text('search_last_name', null, array(
                    'class'=>'form-control search', 
                    'placeholder'=>'Search by Last Name',
                    'value'=>"{{ old('search_last_name') }}")) !!}
                </div>
                <div class="form-group">
                {!! Form::text('search_first_name', null, array(
                    'class'=>'form-control search', 
                    'placeholder'=>'Search by First Name',
                    'value'=>"{{ old('search_first_name') }}")) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary search-btn">Find</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}