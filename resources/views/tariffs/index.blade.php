@extends('layouts.tailapp')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
  <div class="mb-1 w-full">
      <div class="sm:flex">
          <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Tariffs Management</h1>
          </div>
          <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
            @can('tariff-create')
            <button type="button" data-modal-toggle="add-user-modal" class="w-1/2 text-gray-900 bg-teal-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add tariff
            </button>
            @endcan
          </div>
      </div>
  </div>
</div>

<div class="p-4 bg-white flex flex-col">
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
                            Tariff Name
                        </th>
                        <th scope="col" class="">
                            Tariff Code
                        </th>
                        <th scope="col" class="">
                            Tariff PercentageAmount
                        </th>
                        <th scope="col" class="">
                            Tariff Value
                        </th>
                        <th scope="col" class="">
                            Action
                        </th>
                      </tr>
                  </thead>
                  <tbody class="">
                    @foreach ($tariffs as $key => $tariff)
                      <tr class="">
                          <td class="">
                              <div class="">
                                {{ ++$i }}
                              </div>
                          </td>
                          <td>{{ $tariff['name'] }}</td>
                          <td>{{ $tariff['code'] }}</td>
                          <td>{{ $tariff['percentageAmount'] }}</td>
                          <td>{{ $tariff['value'] }}</td>
                          <td class="">
                            @can('tariff-show')
                            <button type="button" data-modal-toggle="show-tariff-modal{{$tariff['id']}}" class="justify-center text-white bg-teal-500 hover:bg-teal-800 focus:ring-4 focus:ring-teal-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center ">
                              <svg class="mr-2 h-5 w-5 " fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <g stroke="currentColor"  stroke-width="2">
                                      <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                      <path fill-rule="evenodd" d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" clip-rule="evenodd"/>
                                  </g>
                              </svg>
                              Show
                            </button>
                            @endcan
                            @can('tariff-edit')
                            <button type="button" data-modal-toggle="edit-tariff-modal{{$tariff['id']}}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                              <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                  <path  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                              </svg>
                              Edit
                            </button>
                            @endcan
                            @include('tariffs.modal.show')
                            @include('tariffs.modal.edit')
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>


<!-- Add User Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="add-user-modal">
  <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow relative">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-5 border-b rounded-t">
              <h3 class="text-xl font-semibold">
                  Add new user
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="add-user-modal">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 space-y-6">
              <form action="#">
                  <div class="grid grid-cols-6 gap-6">
                      <div class="col-span-6 sm:col-span-3">
                          <label for="first-name" class="text-sm font-medium text-gray-900 block mb-2">First Name</label>
                          <input type="text" name="first-name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Bonnie" required>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                          <label for="last-name" class="text-sm font-medium text-gray-900 block mb-2">Last Name</label>
                          <input type="text" name="last-name" id="last-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Green" required>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                          <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                          <input type="email" name="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="example@company.com" required>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                          <label for="phone-number" class="text-sm font-medium text-gray-900 block mb-2">Phone Number</label>
                          <input type="number" name="phone-number" id="phone-number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="e.g. +(12)3456 789" required>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                          <label for="department" class="text-sm font-medium text-gray-900 block mb-2">Department</label>
                          <input type="text" name="department" id="department" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Development" required>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                          <label for="company" class="text-sm font-medium text-gray-900 block mb-2">Company</label>
                          <input type="number" name="company" id="company" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="123456" required>
                      </div>
                  </div> 
              </div>
              <!-- Modal footer -->
              <div class="items-center p-6 border-t border-gray-200 rounded-b">
                  <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save</button>
              </div>
          </form>
      </div>
  </div>
</div>

{{-- <div class="row">
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
</table> --}}

@endsection