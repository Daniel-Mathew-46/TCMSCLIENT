@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Provider Category</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('provider_categories.index') }}"> Back</a>
        </div>
    </div>
</div>

@if (gettype($providerCategory) == 'array' && count($providerCategory) > 1)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Category Name:</strong>
                {{ $providerCategory['prov_categ_name'] }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Category Code:</strong>
                {{ $providerCategory['prov_categ_code'] }}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ 'No Data Found!'}}</strong>
            </div>
        </div>
    </div>
@endif

@endsection
