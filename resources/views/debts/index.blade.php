@extends('layouts.tailapp')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800">
  <div class="mb-1 w-full">
      <div class="sm:flex">
          <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">Meter Debts</h1>
          </div>
      </div>
  </div>
</div>
<div class="p-4 bg-white flex flex-col dark:bg-gray-700">
  <div class="overflow-x-auto">
      <div class="align-middle inline-block w-full">
          <div class="shadow overflow-hidden">
              <table id="userstable" class="">
                  <thead class="">
                      <tr>
                        <th scope="col" class="">
                            No
                        </th>
                        <th scope="col" class="">
                          Debt Description
                        </th>
                        <th scope="col" class="">
                          Original Amount
                        </th>
                        <th scope="col" class="">
                          Reduction Rate
                        </th>
                        <th scope="col" class="">
                          Remaining Amount
                        </th>
                      </tr>
                  </thead>
                  <tbody class="">
                    @foreach ($debts as $key => $debt)
                      <tr class="">
                          <td class="">
                              <div class="">
                                {{ ++$i }}
                              </div>
                          </td>
                          <td>{{ $debt['description'] }}</td>
                          <td>{{ $debt['debtAmount'] }}</td>
                          <td>{{ $debt['reductionRate'] }}</td>
                          <td>{{ $debt['remainingDebtAmount'] }}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

{{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Meter Debts</h2>
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
</div> --}}
@endsection