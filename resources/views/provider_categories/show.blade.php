@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Utility Provider</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('utility_providers.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (gettype($utilityProvider) !== 'object')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Name:</strong>
                {{ $utilityProvider['provider_name'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Code:</strong>
                {{ $utilityProvider['provider_code'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Status:</strong>
                {{ $utilityProvider['provider_status']  }}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ $utilityProvider[0]}}</strong>
            </div>
        </div>
    </div>
@endif

@endsection
