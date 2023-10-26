@extends('layouts.tailapp')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
  <div class="mb-1 w-full">
      <div class="sm:flex">
          <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">Provider Categories Management</h1>
          </div>
          <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
            @can('provcateg-create')
            <button type="button" data-modal-toggle="add-user-modal" class="w-1/2 text-gray-900 bg-teal-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                Add provider category
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
                          Prov.Category Name
                        </th>
                        <th scope="col" class="">
                          Prov.Category Code
                        </th>
                        <th scope="col" class="">
                          Action
                        </th>
                      </tr>
                  </thead>
                  <tbody class="">
                    @foreach ($provider_categories as $key => $provider_category)
                      <tr class="">
                          <td class="">
                              <div class="">
                                {{ ++$i }}
                              </div>
                          </td>
                          <td>{{ $provider_category['name'] }}</td>
                          <td>{{ $provider_category['code'] }}</td>
                          <td class="">
                            @can('provcateg-show')
                                <button type="button" data-modal-toggle="show-pc-modal{{$provider_category['id']}}" class="justify-center text-white bg-teal-500 hover:bg-teal-800 focus:ring-4 focus:ring-teal-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center ">
                                    <svg class="mr-2 h-5 w-5 " fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <g stroke="currentColor"  stroke-width="2">
                                            <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                            <path fill-rule="evenodd" d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z" clip-rule="evenodd"/>
                                        </g>
                                    </svg>
                                    Show
                                </button>
                            @endcan
                            <button type="button" data-modal-toggle="edit-pc-modal{{$provider_category['id']}}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                              <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                  <path  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                              </svg>
                              Edit
                            </button>
                            @include('provider_categories.modal.show')
                            @include('provider_categories.modal.edit')
                          </td>
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
    </td>
  </tr>
 @endforeach
</table> --}}

@endsection