@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Tariff</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tariffs.index') }}"> Back</a>
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

@if (isset($tariff['id']))
{!! Form::model($tariff, ['method' => 'PATCH','route' => ['tariffs.update', $tariff['id']]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tariff Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Tariff Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tariff Code:</strong>
            {!! Form::text('code', null, array('placeholder' => 'Tariff Code','class' => 'form-control', 'value'=>$tariff['code'])) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Tariff PercentageAmount:</strong>
            {!! Form::text('percentageAmount', null, array('placeholder' => 'Tariff Percentage Amount','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Tariff Value:</strong>
            {!! Form::text('value', null, array('placeholder' => 'Tariff Value','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</div>
{!! Form::close() !!}
@else

@endif

@endsection
