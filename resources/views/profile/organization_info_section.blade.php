@if(Auth::user()->is('owner|admin'))

{!! Form::open(array('route' => array('profile.organization_info.update', Auth::user()->organization_id), 'method' => 'PATCH'))!!}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Organization Information</h4>        
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Organization Name</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                        <input type="text" placeholder="Organization Name" class="form-control" name="name"
                                value="{{ $organization->name }}" required="required"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" placeholder="Address" class="form-control" name="address"
                            value="{{ $organization->info()->first()->address }}"/>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" placeholder="City" class="form-control" name="city"
                           value="{{ $organization->info()->first()->city }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <label>State</label>
                    {!! Form::select('state', 
                                        $states, 
                                        $organization->info()->first()->state, 
                                        array('class'=>'form-control')) !!}
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>Zipcode</label>
                    <input type="text" placeholder="Zipcode" class="form-control" name="zipcode"
                           value="{{ $organization->info()->first()->zipcode }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>Contact</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                        <input type="tel" placeholder="Telephone" class="form-control phone" name="telephone"
                               value="{{ $organization->info()->first()->telephone }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <button type="submit" name="submitBtn" class="btn btn-md btn-success" value="organization_update"><i class="fa fa-fw fa-check"></i> Save</button>
            </div>
        </div>
    </div>    
</div>
{!! Form::close() !!}
@endif
