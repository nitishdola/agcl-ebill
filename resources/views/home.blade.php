@extends('layouts.user')

@section('content')
<div class="container">
    <div class="col-lg-6">
        <div class="col-sm-12 col-lg-10">
            <div class="widget-simple-chart text-left card-box">
                <p class="text-muted text-nowrap">Consumer Name</p>
                <h3 class="text-success counter">{{ $consumer_info->FIRST_NAME }} {{ $consumer_info->LAST_NAME }}</h3>

                <p class="text-muted text-nowrap">Consumer Number</p>
                <h3 class="text-success counter">{{ $consumer_info->CONSUMER_NO }}</h3>

                <p class="text-muted text-nowrap">Consumer Type</p>
                <h3 class="text-success counter">{{ $consumer_info->consumer_type['TYPE_OF_CUSTOMER'] }}</h3>
                <hr>
                <h4 class="text-dark  header-title m-t-0"> View Bills </h4>
                {!! Form::open(array('route' => 'user.view_bill', 'method' => 'get', 'id' => 'user.view_bill', 'class' => 'form-horizontal row-border')) !!}
            	<div class="form-group">
	                <div class="col-md-6">
	                    <select name="ym" class="form-control">
	                    	@for ($i=1; $i<=6; $i++)
	                    		<?php $ym = date('ym', strtotime("-$i month")); ?>
	                    		<option value="{{ $ym }}">{{ date('M Y', strtotime("-$i month")) }}</option>
	                    	@endfor
	                    </select>
	                </div>
	            </div>

	            <div class="form-group">
	                <div class="col-md-6">
	                    <button type="submit" id="register_btn" class="btn btn-primary">
	                        <i class="fa fa-btn fa-sign-in"></i> Search
	                    </button>
	                </div>
	            </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-6">
    	<div class="card-box">
            <h4 class="text-dark  header-title m-t-0">Latest Bills Paid </h4>
            <p class="text-muted m-b-25 font-13">
                Your latest paid bills
            </p>

            <div class="table-responsive">
                <div class="alert alert-warning">
				  <strong>Oops !</strong> No recent bills found .
				</div>
            </div>
	    </div>

	    <div class="card-box">
            <h4 class="text-dark  header-title m-t-0">View Bills </h4>
            <p class="text-muted m-b-25 font-13">
                View bills of last 3 months
            </p>

            @for ($i=1; $i<=3; $i++)
            <?php $ym = date('ym', strtotime("-$i month")); ?>
            <p class="text-muted m-b-25 font-13">
                <a href=" {{ route('user.view_bill', ['ym' => $ym])}}">{{ date('M Y', strtotime("-$i month")) }}</a>
            </p>
            @endfor
	    </div>
    </div>
</div>

@stop
