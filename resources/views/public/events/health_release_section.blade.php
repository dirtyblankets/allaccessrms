@include('partials.errors')
<div class="panel-body">
    <div class="row">
        <div class="col-md-2">
            <div class='form-group'>
                <label>Birthdate</label>                    
                <div class="input-group input-append datepicker">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                           name="studenthealthforms[birthdate]" value="{{ old('studenthealthforms.birthdate') }}" />
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class='form-group'>
                <label>Gender</label>
                {!! Form::select('studenthealthforms[gender]', $genders, null, array('class'=>'form-control selectpicker', 'value'=>"{{ old('studenthealthforms.gender') }}")) !!}
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent/Guardian Name</label>
                {!! Form::text('studenthealthforms[guardianfullname]', null, array('class'=>'form-control', 'value'=>"{{ old('studenthealthforms.guardianfullname') }}")) !!}                            
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Parent/Guardian Relationship</label>
                {!! Form::text('studenthealthforms[relationship]', null, array('class'=>'form-control', 'value'=>"{{ old('studenthealthforms.relationship') }}")) !!}        
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Emergency Contact Name</label>
                {!! Form::text('studenthealthforms[emgcontactname]', null, array('class'=>'form-control', 'value'=>"{{ old('studenthealthforms.emgcontactname') }}")) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                 <div class='form-group'>
                    <label>Emergency Contact Relationship</label>
                    {!! Form::text('studenthealthforms[emgcontactrel]', null, array('class'=>'form-control', 'value'=>"{{ old('studenthealthforms.emgcontactrel') }}", 'placeholder'=>'Mother, Father, Guardian, etc...')) !!}
                </div>               
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Emergency Contact Number</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                    <input type="tel" placeholder="Telephone" class="form-control phone" name="studenthealthforms[emgcontactnumber]" value="{{ old('studenthealthforms.emgcontactnumber') }}"/>
                </div>             
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Health Problems</label>
                <textarea placeholder="Any Health Problems? (please detail)" class="form-control" name="studenthealthforms[healthproblems]">{{ old('studenthealthforms.healthproblems') }}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Allergies</label>
                <textarea placeholder="Any Allergies? (please detail)" class="form-control" name="studenthealthforms[allergies]">{{ old('studenthealthforms.allergies') }}</textarea>
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
                           name="studenthealthforms[lasttetanusshot]" value="{{ old('studenthealthforms.lasttetanusshot') }}" />
                </div>
            </div>
        </div>
        <div class="col-md-2">                 
            <div class="form-group">
                <label>Last Physical Exam</label>   
                <div class="input-group input-append datepicker">
                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                    <input type="text" size="11" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="01/30/2015" class="form-control dateRangePicker"
                           name="studenthealthforms[lastphysicalexam]" value="{{ old('studenthealthforms.lastphysicalexam') }}" />
                </div>
            </div>
        </div>
    </div>
    <hr class="divider">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Insurance Carrier</label>
                {!! Form::text('studenthealthforms[insurancecarrier]', null, array('class'=>'form-control', 'value'=>"{{ old('studenthealthforms.insurancecarrier') }}")) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Insurance Policy Number</label>
                {!! Form::text('studenthealthforms[insurancepolicynum]', null, array('class'=>'form-control', 'value'=>"{{ old('studenthealthforms.insurancepolicynum') }}")) !!}
            </div>
        </div>
    </div>
</div>
