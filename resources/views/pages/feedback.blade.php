@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="col-md-8">
        <h4 class="text-dark  header-title m-t-0">Feedback </h4>
        <hr>

        {!! Form::open(array('route' => 'post.feedback', 'id' => 'post.feedback', 'class' => 'form-horizontal row-border')) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Name*</label>

            <div class="col-md-9">
                <input type="text" placeholder="Enter your name"  class="form-control" name="name" required="required">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Email</label>

            <div class="col-md-9">
                <input type="email" placeholder="Enter your Email Id"  class="form-control" name="email">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
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

        <div class="form-group{{ $errors->has('consumer_number') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Consumer Number</label>

            <div class="col-md-9">
                <input type="text" placeholder="Consumer Number"  class="form-control" name="consumer_number">

                @if ($errors->has('consumer_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('consumer_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('bill_number') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Bill Number</label>

            <div class="col-md-9">
                <input type="text" placeholder="Bill Number"  class="form-control" name="bill_number">

                @if ($errors->has('bill_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bill_number') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
            <label class="col-md-3 control-label">Remarks*</label>

            <div class="col-md-9">
                <textarea class="form-control" placeholder="Remarks" name="remarks" required="required"></textarea>

                @if ($errors->has('remarks'))
                    <span class="help-block">
                        <strong>{{ $errors->first('remarks') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" id="register_btn" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i> Submit
                    </button>
                </div>
            </div>
        {!!form::close()!!}
    </div>
</div>
@stop