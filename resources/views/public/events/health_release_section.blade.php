<div class="panel-body">
    <div class="row">
        <div class="col-md-2">
            <div class='form-group'>
                <label>Birthdate</label>                    
                <div class="input-group input-append datepicker">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                           name="attendee_health_release_form[birthdate]" value="{{ old('attendee_health_release_form.birthdate') }}" />
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class='form-group'>
                <label>Gender</label>
                {!! Form::select('attendee_health_release_form[gender]', $genders, null, array('class'=>'form-control selectpicker', 'value'=>"{{ old('attendee_health_release_form.gender') }}")) !!}
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Do you have any medical difficulty? (If yes, please describe)</label>
                <textarea placeholder="Enter Description Here" class="form-control" name="attendee_health_release_form[healthproblems]">{{ old('attendee_health_release_form.healthproblems') }}</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Allergic to any Medication? (If yes, please describe)</label>
                <textarea placeholder="Enter Description Here" class="form-control" name="attendee_health_release_form[allergies]">{{ old('attendee_health_release_form.allergies') }}</textarea>
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-2">
            <label>Last Tetanus Shot</label>                    
            <div class="form-group">
                <div class="input-group input-append datepicker">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                           name="attendee_health_release_form[lasttetanusshot]" value="{{ old('attendee_health_release_form.lasttetanusshot') }}" />
                </div>
            </div>
        </div>
        <div class="col-md-2">                 
            <div class="form-group">
                <label>Last Physical Exam</label>   
                <div class="input-group input-append datepicker">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                           name="attendee_health_release_form[lastphysicalexam]" value="{{ old('attendee_health_release_form.lastphysicalexam') }}" />
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Insurance Carrier</label>
                {!! Form::text('attendee_health_release_form[insurancecarrier]', null, array('class'=>'form-control', 'value'=>"{{ old('attendee_health_release_form.insurancecarrier') }}")) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Insurance Policy Number</label>
                {!! Form::text('attendee_health_release_form[insurancepolicynum]', null, array('class'=>'form-control', 'value'=>"{{ old('attendee_health_release_form.insurancepolicynum') }}")) !!}
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Emergency Contact Name</label>
                {!! Form::text('attendee_health_release_form[emgcontactname]', null, array('class'=>'form-control', 'value'=>"{{ old('attendee_health_release_form.emgcontactname') }}")) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                 <div class='form-group'>
                    <label>Emergency Contact Relationship</label>
                    {!! Form::text('attendee_health_release_form[emgcontactrel]', null, array('class'=>'form-control', 'value'=>"{{ old('attendee_health_release_form.emgcontactrel') }}", 'placeholder'=>'Mother, Father, Guardian, etc...')) !!}
                </div>               
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Emergency Contact Number</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                    <input type="tel" placeholder="Telephone" class="form-control phone" name="attendee_health_release_form[emgcontactnumber]" value="{{ old('attendee_health_release_form.emgcontactnumber') }}"/>
                </div>             
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent/Guardian Name</label>
                {!! Form::text('attendee_health_release_form[guardianfullname]', null, array('class'=>'form-control', 'value'=>"{{ old('attendee_health_release_form.guardianfullname') }}")) !!}                            
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent/Guardian Relationship</label>
                {!! Form::text('attendee_health_release_form[relationship]', null, array('class'=>'form-control', 'value'=>"{{ old('attendee_health_release_form.relationship') }}", 'placeholder'=>'Mother, Father, Guardian, etc...')) !!}        
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent Contact</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                    <input type="tel" placeholder="Telephone" class="form-control phone" name="attendee_health_release_form[guardian_phone]" value="{{ old('attendee_health_release_form.guardian_phone') }}"/>
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
                        <input type="hidden" name="parent_signature" value="{{ old('parent_signature') }}" />
                    </div>
                    <button type="button" class="button clear" data-action="clear" style="margin-top:5px; color:black;">Clear</button>
                    <button type="button" class="button save" data-action="save" style="margin-top:5px; color:black;">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
