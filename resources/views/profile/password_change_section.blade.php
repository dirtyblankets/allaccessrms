{!! Form::open(array('route' => array('password.update', Auth::user()->id), 'method' => 'PATCH'))!!}
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Password Change</h4>        
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>
                    <label>Current Password</label>                    
                    <div class='form-group'>
                        {!! Form::password('current_password', array('class'=>'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>
                    <label>New Password</label>                    
                    <div class='form-group'>
                        {!! Form::password('new_password', array('class'=>'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class='form-group'>
                    <label>New Password Confirmation</label>                    
                    <div class='form-group'>
                        {!! Form::password('new_password_confirmation', array('class'=>'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="submit" name="submitBtn" class="btn btn-md btn-success" value="password_change"><i class="fa fa-fw fa-check"></i> Save</button>
            </div>
        </div>
    </div>    
</div>
{!! Form::close() !!}