@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Utility Provider</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('utility_providers.index') }}"> Back</a>
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

@if (isset($utilityProvider['id']))
{!! Form::model($utilityProvider, ['method' => 'PATCH','route' => ['utility_providers.update', $utilityProvider['id']]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Name:</strong>
                {!! Form::text('provider_name', null, array('placeholder' => 'Provider Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Provider Code:</strong>
                {!! Form::text('provider_code', null, array('placeholder' => 'Provider Code','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Provider Status</strong>
                {!! Form::select('provider_status', collect($providerStatus)->pluck('name', 'value'), null, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
            <div class="form-group">
                <strong>Provider Category:</strong>
                {!! Form::select('provider_categories_id', collect($providerCategories)->pluck('name', 'id'), null, array('class' => 'form-control')) !!}
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
