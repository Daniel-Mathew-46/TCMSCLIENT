@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tariffs Management</h2>
        </div>
        @can('tariff-create')
          <div class="pull-right mb-4">
            <a class="btn btn-success" href="{{ route('tariffs.create') }}"> Create New Tariff</a>
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
   <th>Tariff Name</th>
   <th>Tariff Code</th>
   <th>Tariff PercentageAmount</th>
   <th>Tariff Value</th>
   <th width="280px">Action</th>
 </tr>
 @if (!empty($tariffs))
  @foreach ($tariffs as $key => $tariff)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $tariff['name'] }}</td>
    <td>{{ $tariff['code'] }}</td>
    <td>{{ $tariff['percentageAmount'] }}</td>
    <td>{{ $tariff['value'] }}</td>
    <td>
      @can('tariff-show')
        <a class="btn btn-info" href="{{ route('tariffs.show', $tariff['id']) }}">Show</a>
      @endcan
      @can('tariff-edit')
        <a class="btn btn-primary" href="{{ route('tariffs.edit', $tariff['id']) }}">Edit</a>
      @endcan
    </td>
  </tr>
  @endforeach
 @else
     
 @endif
</table>

@endsection