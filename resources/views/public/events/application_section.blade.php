@include('partials.errors')
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
                    <input type="tel" placeholder="Telephone" class="form-control phone" name="studentapplication[student_phone]" value="{{ old('studentapplication.student_phone') }}"/>
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Address</label>
                    <input type="text" id="street_address" placeholder="1234 AllAccessRMS St." class="form-control" name="studentapplication[address]" value="{{ old('studentapplication.address') }}"/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>City</label>
                    <input type="text" id="locality" placeholder="City" class="form-control" name="studentapplication[city]" value="{{ old('studentapplication.city') }}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>State</label>
                {!! Form::select('studentapplication[state]', $states, null, array('id'=>'administrative_area_level_1', 'class'=>'form-control')) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Zipcode</label>
                    <input type="text" id='postal_code' placeholder="Zipcode" class="form-control" name="studentapplication[zipcode]" value="{{ old('studentapplication.zipcode') }}"/>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Grade</label>
                {!! Form::select('studentapplication[student_grade]', $grades, null, array('class'=>'form selectpicker')) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Preferred Language</label>
                {!! Form::select('studentapplication[language]', $languages, null, array('class'=>'form selectpicker')) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Sweatshirt Size</label>
                {!! Form::select('studentapplication[sweatshirt_size]', $sweatshirt_sizes, null, array('class'=>'form selectpicker')) !!}
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Do you have any medical difficulty? (If yes, please describe)</label>
                <textarea placeholder="Enter Description Here" class="form-control" name="studentapplication[medical_difficulty]">{{ old('studentapplication.medical_difficulty') }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Allergic to any Medication? (If yes, please describe)</label>
                <textarea placeholder="Enter Description Here" class="form-control" name="studentapplication[allergy_meds]">{{ old('studentapplication.allergy_meds') }}</textarea>
            </div>
        </div>        
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent Name</label>
                <input type="text" placeholder="" class="form-control" name="studentapplication[parent_name]" value="{{ old('studentapplication.parent_name') }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent Contact</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                    <input type="tel" placeholder="Telephone" class="form-control phone" name="studentapplication[parent_phone]" value="{{ old('studentapplication.parent_phone') }}"/>
                </div>
            </div>
        </div>      
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent Signature</label>
                <div id="parentSignaturePadWrapper">
                    <div class="signature-pad">
                        <canvas></canvas>
                        <input type="hidden" name="parent_signature" value="" />
                    </div>
                    <button type="button" class="button clear" data-action="clear" style="margin-top:5px; color:black;">Clear</button>
                    <button type="button" class="button save" data-action="save" style="margin-top:5px; color:black;">Save</button>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" name="submitBtn" class="btn btn-md btn-success" value="save"><i class="fa fa-fw fa-check"></i> Save</button>
</div>
