@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Customers Management</h2>
        </div>
        <div class="pull-right mb-4">
            <a class="btn btn-success" href="{{ route('customers.create') }}"> Create New Customer</a>
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
   <th>Customer Name</th>
   <th>Customer Mobile No: </th>
   {{-- <th>Utility Provider</th>
   <th>Meter Number</th> --}}
   <th>Address</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($customers as $key => $customer)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $customer['full_name'] }}</td>
    <td>{{ $customer['phone'] }}</td>
    <td>{{ $customer['address'] }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('customers.show', $customer['id']) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('debts.show', $customer['id']) }}">Assign Debt</a>
       <a class="btn btn-outline-secondary" href="{{ route('customer.payment', $customer['id']) }}">Bills</a>
    </td>
  </tr>
 @endforeach
</table>
</div>
@endsection