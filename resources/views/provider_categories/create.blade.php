@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-2">
        <div class="pull-left">
            <h2>Create New Provider Category</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('provider_categories.index') }}"> Back</a>
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

{!! Form::open(array('route' => 'provider_categories.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Prov.Category Name:</strong>
            {!! Form::text('prov_categ_name', null, array('placeholder' => 'Prov.Category Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Prov.Category Code:</strong>
            {!! Form::text('prov_categ_code', null, array('placeholder' => 'Prov.Category Code','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection