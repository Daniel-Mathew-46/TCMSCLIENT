@extends('layouts.app')

@section('content')
<div class="col-xs-6 col-sm-6 col-md-6 justify-content-center ">
    <div class="card py-6">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Assign Customer Debt</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

{!! Form::open(['method' => 'POST','route' => ['debts.store']]) !!}
<div class="row">
    <div class="">
        <div class="form-group">
            <strong>Meter Number:</strong>
            {!! Form::select('meters_id', collect($meters)->pluck('meter_number', 'id'), null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Debt Description:</strong>
            {!! Form::text('description', null, array('placeholder' => 'Debt Description','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Debt Amount:</strong>
            {!! Form::text('amount', null, array('placeholder' => 'Debt Amount','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Reduction Rate(%):</strong>
            {!! Form::text('reductionRate', null, array('placeholder' => 'Reduction Rate','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Assign</button>
    </div>
</div>
{!! Form::close() !!}
</div>
</div>

@endsection
