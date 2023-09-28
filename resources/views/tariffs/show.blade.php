@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Tariff</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tariffs.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (gettype($tariff) !== 'object')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tariff Name:</strong>
                {{ $tariff['name'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tariff Code:</strong>
                {{ $tariff['code'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tariff Percentage Amount:</strong>
                {{ $tariff['percentageAmount']  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tariff Value:</strong>
                {{ $tariff['value']  }}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ $tariff[0]}}</strong>
            </div>
        </div>
    </div>
@endif

@endsection
