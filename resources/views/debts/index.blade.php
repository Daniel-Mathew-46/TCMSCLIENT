@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Meter Debts</h2>
        </div>
        {{-- @can('customer-assigndebt')
          <div class="pull-right mb-4">
            <a class="btn btn-success" href="{{ route('customers.create') }}">Assign Debt</a>
          </div>
        @endcan --}}
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
   <th>Debt Description</th>
   <th>Original Amount</th>
   <th>Reduction Rate</th>
   <th>Remaining Amount</th>
 </tr>
 @foreach ($debts as $key => $debt)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $debt['description'] }}</td>
    <td>{{ $debt['debtAmount'] }}</td>
    <td>{{ $debt['reductionRate'] }}</td>
    <td>{{ $debt['remainingDebtAmount'] }}</td>
  </tr>
 @endforeach
</table>
</div>
@endsection