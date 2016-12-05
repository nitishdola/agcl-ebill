@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="col-md-8 col-md-offset-2">
        <h3>Step 2: Enter the OTP received</h3>
        <div style="margin-top: 40px;"></div>
        {!! Form::open(array('route' => 'user.otp.verify', 'id' => 'user.otp.verify', 'class' => 'form-horizontal row-border')) !!}
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">OTP Number*</label>

                <div class="col-md-5">
                    <input type="text" placeholder="Enter OTP received on your mobile"  class="form-control" name="otp" required="required">

                    @if ($errors->has('otp'))
                        <span class="help-block">
                            <strong>{{ $errors->first('otp') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <input type="hidden" id="enc_user_id" name="enc_user_id" value="{{ $enc_user_id }}" required="required">
            <input type="hidden" id="pkey" name="enc_user_id" value="{{ $pass }}" required="required">


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" id="register_btn" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Proceed
                    </button>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button id="resend" class="btn btn-success btn-sm">Resend OTP</button>
                </div>
            </div>
        {!!form::close()!!}

        
    </div>
</div>


@endsection


@section('pageScript')
<script>
$('#resend').click(function(e) {
    e.preventDefault();
    var url = '';
    var data = '';

    url += "{{ route('rest.resend.otp') }}";
    data += '&enc_user_id='+$('#enc_user_id').val();

    $.ajax({
        data : data,
        type : 'get',
        url  : url,

        error : function(resp) {
            alert('Oops ! Something went wrong ');
        },

        success : function(resp) {
           $('#resend').text('OTP Sent to your registered mobile number');
           $('#resend').prop('disabled', true); 
        }
    });
});
</script>
@stop
