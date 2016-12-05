@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="col-md-7">
        <h2><span class="label label-primary">New User Registration</span></h2>
        <div style="margin-top: 40px;"></div>
        {!! Form::open(array('route' => 'user.registration', 'id' => 'user.registration', 'class' => 'form-horizontal row-border')) !!}
            <div class="form-group{{ $errors->has('consumer_1') ? ' has-error' : '' }} {{ $errors->has('consumer_2') ? ' has-error' : '' }} {{ $errors->has('consumer_3') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">Consumer Number*</label>

                <div class="col-md-2">
                    <input type="text" class="inputs form-control" name="consumer_1" maxlength="3" value="{{ old('consumer_1') }}" required="required">
                </div>

                <div class="col-md-2">
                <input type="text" class="inputs2 form-control" name="consumer_2"  maxlength="3" value="{{ old('consumer_2') }}" required="required">
                </div>

                <div class="col-md-5">
                <input type="text" class="inputs3 form-control" name="consumer_3"  maxlength="4" value="{{ old('consumer_3') }}" required="required">
                </div>

                @if ($errors->has('consumer_1') || $errors->has('consumer_2') || $errors->has('consumer_3'))
                    <span class="help-block">
                        <strong>{{ $errors->first('consumer_1') }} {{ $errors->first('consumer_2') }} {{ $errors->first('consumer_3') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">Email*</label>

                <div class="col-md-9">
                    <input type="email" placeholder="Enter your Email Id"  class="form-control" name="email" required="required">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">Mobile Number*</label>

                <div class="col-md-9">
                    <input type="number" placeholder="Enter your 10 digit mobile number"  class="form-control" name="mobile_number" required="required">

                    @if ($errors->has('mobile_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">Password*</label>

                <div class="col-md-9">
                    <input id="password" type="password" placeholder="Password"  class="form-control" name="password" required="required">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-3 control-label">Re-Enter Password*</label>

                <div class="col-md-9">
                    <input id="password_confirmation" type="password" placeholder="Confirm Password"  class="form-control" name="password_confirmation" required="required">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" id="register_btn" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Register
                    </button>
                </div>
            </div>
        {!!form::close()!!}
    </div>

    <div class="col-md-5">
        <h2><span class="label label-primary">Exisiting User Login</span></h2>
        <div style="margin-top: 40px;"></div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Consumer Number</label>

                <div class="col-md-8">
                    <input type="text" placeholder="Consumer Number" class="form-control" name="username" value="{{ old('username') }}">

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Password</label>

                <div class="col-md-8">
                    <input type="password" placeholder="Password"  class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>
                </div>
            </div>
        </form>
    </div>


</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h3 id="err_msg"></h3>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
</div>

@endsection

@section('pageScript')
<script>
    $(".inputs").keyup(function () {
        if (this.value.length == this.maxLength) {
          $('.inputs2').focus();
        }
    });

    $(".inputs2").keyup(function () {
        if (this.value.length == this.maxLength) {
          $('.inputs3').focus();
        }
    });

    $('#register_btn').click(function(e) {
        if($('#password_confirmation').val() != $('#password').val()) {
            e.preventDefault();
            $('#err_msg').text(' Password did not matched ');
            $('#myModal').modal();
        }
    });
</script>
@stop
