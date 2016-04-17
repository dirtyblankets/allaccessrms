<div class="panel-body">
    <p>Which Organization do you belong to? {!! Form::select('attendee[organization_id]', $organizations, null, array('class'=>'form selectpicker')) !!}</p>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class='form-group'>
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="First Name" name="attendee[firstname]" value="{{ old('attendee.firstname') }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class='form-group'>
                <label>Last Name</label>
                <input type="text" class="form-control" placeholder="Last Name" name="attendee[lastname]" value="{{ old('attendee.lastname') }}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class='form-group'>
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="email" placeholder="email@email.com" class="form-control" name="attendee[email]" value="{{ old('attendee.email') }}"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Phone</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                    <input type="tel" placeholder="Telephone" class="form-control phone" name="attendee_application_form[phone]" value="{{ old('attendee_application_form.phone') }}"/>
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Grade</label>
                {!! Form::select('attendee_application_form[grade]', $grades, null, array('class'=>'form selectpicker')) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Preferred Language</label>
                {!! Form::select('attendee_application_form[language]', $languages, null, array('class'=>'form selectpicker')) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Sweatshirt Size</label>
                {!! Form::select('attendee_application_form[sweatshirt_size]', $sweatshirt_sizes, null, array('class'=>'form selectpicker')) !!}
            </div>
        </div>
    </div>
    <hr class="divider">
    <p>Home Address</p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Address</label>
                    <input type="text" id="street_address" placeholder="1234 AllAccessRMS St." class="form-control" name="attendee_application_form[address]" value="{{ old('attendee_application_form.address') }}"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>City</label>
                    <input type="text" id="locality" placeholder="City" class="form-control" name="attendee_application_form[city]" value="{{ old('attendee_application_form.city') }}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>State</label>
                {!! Form::select('attendee_application_form[state]', $states, null, array('id'=>'administrative_area_level_1', 'class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Zipcode</label>
                    <input type="text" id='postal_code' placeholder="Zipcode" class="form-control" name="attendee_application_form[zipcode]" value="{{ old('attendee_application_form.zipcode') }}"/>
            </div>
        </div>
    </div>
</div>
