@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Customer Information</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (gettype($customer) == 'array' && count($customer) > 1)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Customer Name:</strong>
                {{ $customer['full_name'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Customer Mobile No:</strong>
                {{ $customer['phone'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Customer Address:</strong>
                {{ $customer['address']  }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Meter Details:</strong>
                @if(!empty($customer['meters']))
                    @foreach($customer['meters'] as $meter)
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <span>Meter Number:</span>
                            {{ $meter['meter_number']}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <span>Meter Status:</span> 
                            {{ $meter['status']}}
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ $customer[0]}}</strong>
            </div>
        </div>
    </div>
@endif

@endsection


{{-- @if(!empty($customer['meters']))
                    @foreach($customer['meters'] as $meter)
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <span>Meter Number:</span>
                            {{ $meter['meter_number']}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <span>Meter Status:</span> 
                            {{ $meter['status']}}
                        </div>
                    </div>
                    @endforeach
                @endif --}}