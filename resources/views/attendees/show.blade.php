@extends('layouts.main')
@section('content')
<section class="content-header">
    <h2 class="page-header">                 
        <i class="fa fa-fw fa-user"></i>{{$attendee->firstname . ' ' . $attendee->lastname}} 
        <a href="{{ URL::route('attendees.edit', $attendee->id) }}" class='btn btn-md btn-info'><i class="fa fa-fw fa-pencil"></i> Edit</a>
        <button class='btn btn-md btn-warning btn-modal confirm' type='button' data-toggle="modal" data-target="#confirmResend" data-route="{{ URL::route('attendees.sendInvoice', $attendee->id) }}" data-title="Resend Invoice" data-message='Confirm resending of invoice to this attendee.'>
            <i class='fa fa-fw fa-envelope'></i> Resend Invoice
        </button> 
    </h2> 
    <ol class="breadcrumb">
        <li>
            <a href={{ URL::previous() }}><i class="fa fa-calendar"></i> Event</a>
        </li>
        <li class="active">
            Show Registered Attendee
        </li>
    </ol>
</section>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Registration Information</h4>
				 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-3">
						<div class="form-group">
							<label>First Name</label>
							{!! Form::text('firstname', $attendee->firstname, array(
								'class'	=>	'form-control readonly')) !!}
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label>Last Name</label>
							{!! Form::text('lastname', $attendee->lastname, array(
								'class'	=>	'form-control readonly')) !!}
						</div>
					</div>					
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Organization:</label>
								{!! Form::text('organization', $attendee->organization()->first()->name , array(
								'class'	=>	'form-control readonly')) !!}
						</div>	
					</div>					
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label>Registration Date:</label>
								{!! Form::date('registration_date', $attendee->registration_date, array(
								'class'	=>	'form-control readonly')) !!}
						</div>	
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Fees Paid:</label>
								{!! Form::date('fees_paid', $attendee->amount_paid, array(
								'class'	=>	'form-control readonly')) !!}
						</div>	
					</div>			
				</div>
			</div>
		</div>
	</div>
</div><!-- end row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Application Information</h4>
				 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group"
							<label>Birthdate: (yyyy-m-d)</label>
							{!! Form::text('birthdate', $attendee_application_form->birthdate, array(
								'class'	=>	'form-control readonly')) !!}
						</div>
					</div>	
					<div class="col-lg-2">
						<div class="form-group">
							<label>Grade:</label>
							{!! Form::text('grade', $attendee_application_form->student_grade, array(
								'class'	=>	'form-control readonly')) !!}
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Phone:</label>
                			{!! Form::text('phone', $attendee_application_form->student_phone, array('class'=>'form-control readonly')) !!}
						</div>
					</div>						
				</div><!--end row-->
				<hr class="divider">
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
							<label>Sweathshirt Size:</label>
                			{!! Form::select('sweatshirt_size', $sweatshirt_sizes, $attendee_application_form->sweatshirt_size, array('class'=>'form-control selectpicker readonly')) !!}
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Preferred Language:</label>
                			{!! Form::text('languages', $attendee_application_form->language, array('class'=>'form-control readonly')) !!}
						</div>
					</div>
				</div><!-- end row-->
				<hr class="divider">
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
						<label>Address:</label>
						{!! Form::text('address', $attendee_application_form->address, array('class'=>'form-control readonly')) !!}
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
						<label>City:</label>
						{!! Form::text('city', $attendee_application_form->city, array('class'=>'form-control readonly')) !!}
						</div>
					</div>
				</div><!-- end row-->
				<div class="row">
					<div class="col-lg-2">
						<div class="form-group">
						<label>State</label>
                			{!! Form::select('state', $states, $attendee_application_form->state, array('class'=>'form-control selectpicker readonly')) !!}
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
						<label>Zipcode</label>
                			{!! Form::text('zipcode', $attendee_application_form->zipcode, array('class'=>'form-control readonly')) !!}
						</div>
					</div>
				</div><!-- end row-->
			</div><!-- end panel-body-->
		</div>
	</div>
</div><!-- end row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Health Release Information</h4>
				 <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
			</div>
			<div class="panel-body">
			    <div class="row">
			        <div class="col-lg-6">
			            <div class="form-group">
			                <label>Do you have any medical difficulty? (If yes, please describe)</label>
			                <textarea placeholder="N/A" class="form-control readonly" name="healthproblems">{{ $attendee_health_release_form->healthproblems }}</textarea>
			            </div>
			        </div>
			        <div class="col-lg-6">
			            <div class="form-group">
			                <label>Allergic to any Medication? (If yes, please describe)</label>
			                <textarea placeholder="N/A" class="form-control readonly" name="allergies">{{ $attendee_health_release_form->allergies }}</textarea>
			            </div>
			        </div>        
			    </div>
			    <div class="row">
			    	<div class="col-lg-2">
			            <div class='form-group'>
			                <label>Gender</label>
			                {!! Form::select('gender', 
			                				$genders, 
			                				$attendee_health_release_form->gender, 
											array('class'=>'form-control selectpicker readonly')) !!}
			            </div>
			        </div>
			        <div class="col-lg-2">
			            <label>Last Tetanus Shot</label>                    
			            <div class="form-group">
			                <div class="input-group input-append datepicker">
			                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
			                    {!! Form::text('lasttetanusshot',
			                    				$attendee_health_release_form->lasttetanusshot,
			                    				array('class'=>'form-control readonly')) !!}

			                </div>
			            </div>
			        </div>
			        <div class="col-lg-2">                 
			            <div class="form-group">
			                <label>Last Physical Exam</label>   
			                <div class="input-group input-append datepicker">
			                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
			                {!! Form::text('lastphysicalexam', 
			                				$attendee_health_release_form->lastphysicalexam, 
											array('class'=>'form-control readonly')) !!}
			                </div>
			            </div>
			        </div>
			    </div>
			    <hr class="divider">
			    <div class="row">
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Insurance Carrier</label>
			                {!! Form::text('insurancecarrier', 
			                				$attendee_health_release_form->insurancecarrier, 
			                				array('class'=>'form-control readonly')) !!}
			            </div>
			        </div>
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Insurance Policy Number</label>
			                {!! Form::text('insurancepolicynum', 
			                				$attendee_health_release_form->insurancepolicynum, 
			                				array('class'=>'form-control readonly')) !!}
			            </div>
			        </div>
			    </div>
			    <hr class="divider">
			    <div class="row">
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Emergency Contact Name</label>
			                {!! Form::text('emgcontactname', 
			                				$attendee_health_release_form->emg_contactname, 
			                				array('class'=>'form-control readonly')) !!}
			            </div>
			        </div>
			        <div class="col-lg-4">
			            <div class="form-group">
			                 <div class='form-group'>
			                    <label>Emergency Contact Relationship</label>
			                    {!! Form::text('emgcontactrel', 
			                    				$attendee_health_release_form->emg_contactrel, 
			                    				array('class'=>'form-control readonly')) !!}
			                </div>               
			            </div>
			        </div>
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Emergency Contact Number</label>
			                <div class="input-group">
			                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
			                    {!! Form::text('emgcontactnumber', 
			                    				$attendee_health_release_form->emg_contactnumber, 
			                    				array('class'=>'form-control readonly')) !!}			           
			                </div>             
			            </div>
			        </div>
			    </div>
			    <hr class="divider">
			    <div class="row">
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Parent/Guardian Name</label>
			                {!! Form::text('guardianfullname', 
			                    			$attendee_health_release_form->guardian_name, 
			                    			array('class'=>'form-control readonly')) !!}
			            </div>
			        </div>
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Parent/Guardian Relationship</label>
			                {!! Form::text('relationship', 
			                    			$attendee_health_release_form->guardian_relation, 
			                    			array('class'=>'form-control readonly')) !!}       
			            </div>
			        </div>
			        <div class="col-lg-4">
			            <div class="form-group">
			                <label>Parent Contact</label>
			                <div class="input-group">
			                    <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
			                    {!! Form::text('guardian_phone', 
			                    			$attendee_health_release_form->guardian_contact, 
			                    			array('class'=>'form-control readonly')) !!}
			                </div>
			            </div>
			        </div>      
			    </div>
			    <div class="row">
			        <div class="col-lg-6">
			            <div class="form-group">
			                <label>Parent Signature</label>
							<img src="{{ $attendee_health_release_form->guardian_sign }}" />
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div><!-- end row -->
@include('partials.confirm_resend')
@stop