@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Utility Providers Management</h2>
        </div>
        <div class="pull-right mb-4">
          @can('provider-create')
            <a class="btn btn-success" href="{{ route('utility_providers.create') }}"> Create New Utility Provider</a>
          @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered ">
 <tr>
   <th>No</th>
   <th>Provider Name</th>
   <th>Provider Code</th>
   <th>Provider Status</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($providers as $key => $provider)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $provider['provider_name'] }}</td>
    <td>{{ $provider['provider_code'] }}</td>
    <td>{{ $provider['provider_status'] }}</td>
    <td>
      @can('provider-show')
        <a class="btn btn-info" href="{{ route('utility_providers.show', $provider['provider_code']) }}">Show</a>
      @endcan
      @can('provider-edit')
        <a class="btn btn-primary" href="{{ route('utility_providers.edit', $provider['id']) }}">Edit</a>
      @endcan
    </td>
  </tr>
 @endforeach
</table>

@endsection

