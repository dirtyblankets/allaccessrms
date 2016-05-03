@if(Auth::user()->is('owner|admin'))

{!! Form::open(array('route' => array('organization_info.update', Auth::user()->organization_id), 'method' => 'PATCH'))!!}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Organization Information</h4>        
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-building-o"></i></div>
                        <input type="text" placeholder="Organization Name" class="form-control" name="organizations[name]"
                                value="{{ old('organizations.name') }}" required="required"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <input type="text" placeholder="Address" class="form-control" name="organizationinfo[address]"
                            value="{{ old('organizationinfo.address') }}"/>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="text" placeholder="City" class="form-control" name="organizationinfo[city]"
                           value="{{ old('organizationinfo.city') }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    {!! Form::select('', $states, null, array(
                        'class'=>'form-control',
                        'value'=>"{{ old('organizationinfo.state') }}")) !!}
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="text" placeholder="Zipcode" class="form-control" name="organizationinfo[zipcode]"
                           value="{{ old('organizationinfo.zipcode') }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                        <input type="tel" placeholder="Telephone" class="form-control phone" name="organizationinfo[telephone]"
                               value="{{ old('organizationinfo.telephone') }}"/>
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
