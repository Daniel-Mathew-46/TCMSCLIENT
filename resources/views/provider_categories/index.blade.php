@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Provider Categories Management</h2>
        </div>
        @can('provcateg-create')
          <div class="pull-right mb-4">
            <a class="btn btn-success" href="{{ route('provider_categories.create') }}"> Create New Provider Category</a>
          </div>
        @endcan
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
   <th>Prov.Category Name</th>
   <th>Prov.Category Code</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($provider_categories as $key => $provider_category)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $provider_category['name'] }}</td>
    <td>{{ $provider_category['code'] }}</td>
    <td>
      @can('provcateg-show')
        <a class="btn btn-info" href="{{ route('provider_categories.show', $provider_category['id']) }}">Show</a>
      @endcan
       {{-- <a class="btn btn-primary" href="{{ route('utility_providers.edit', $provider['id']) }}">Edit</a> --}}
    </td>
  </tr>
 @endforeach
</table>

@endsection