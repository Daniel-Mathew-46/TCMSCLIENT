@extends('layouts.customer')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tariffs Management</h2>
        </div>
        <div class="pull-right mb-4">
            <a class="btn btn-success" href="{{ route('tariffs.create') }}"> Create New Tariff</a>
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
   <th>Tariff Name</th>
   <th>Tariff Code</th>
   <th>Tariff PercentageAmount</th>
   <th>Tariff Value</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($tariffs as $key => $tariff)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $tariff['name'] }}</td>
    <td>{{ $tariff['code'] }}</td>
    <td>{{ $tariff['percentageAmount'] }}</td>
    <td>{{ $tariff['value'] }}</td>
    <td>
      <a class="btn btn-info" href="{{ route('tariffs.show', $tariff['id']) }}">Show</a>
    </td>
  </tr>
 @endforeach
</table>

@endsection