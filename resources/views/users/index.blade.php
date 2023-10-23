@extends('layouts.tailapp')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
  <div class="mb-1 w-full">
      <div class="sm:flex">
          {{-- <div class="hidden sm:flex items-center sm:divide-x sm:divide-gray-100 mb-3 sm:mb-0">
              <form class="lg:pr-3" action="#" method="GET">
              <label for="users-search" class="sr-only">Search</label>
              <div class="mt-1 relative lg:w-64 xl:w-96">
                  <input type="text" name="email" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Search for users">
              </div>
              </form>
          </div> --}}
          <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">All users</h1>
        </div>
          <div class="flex items-center space-x-2 sm:space-x-3 ml-auto">
              <button type="button" data-modal-toggle="add-user-modal" class="w-1/2 text-gray-900 bg-teal-500 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium inline-flex items-center justify-center rounded-lg text-sm px-3 py-2 text-center sm:w-auto">
                  <svg class="-ml-1 mr-2 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                  Add user
              </button>
          </div>
      </div>
  </div>
</div>

<div class="p-4 bg-white flex flex-col">
  <div class="overflow-x-auto">
      <div class="align-middle inline-block w-full">
          <div class="shadow overflow-hidden">
              <table class="table-fixed w-full divide-y divide-gray-200">
                  <thead class="bg-gray-100">
                      <tr>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                            No
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                            Name
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                            Email
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                            Phone Number
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase">
                            Roles
                        </th>
                        <th scope="col" class="p-4">
                          Action
                        </th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $key => $user)
                      <tr class="hover:bg-gray-100">
                          <td class="p-4 w-4">
                              <div class="flex items-center">
                                {{ ++$i }}
                              </div>
                          </td>
                          <td class="p-4 flex items-center whitespace-nowrap space-x-6 mr-12 lg:mr-0">{{ $user['full_name']}}</td>
                          <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">{{ $user['email'] }}</td>
                          <td class="p-4 whitespace-nowrap text-base font-medium text-gray-900">0{{ $user['phone_number'] }}</td>
                          <td class="p-4 whitespace-nowrap text-base font-normal text-gray-900">
                              <div class="flex items-center">
                                @if(!empty($user['roles']))
                                  @foreach($user['roles'] as $v)
                                    <label class=" text-black">{{ $v }}</label>
                                  @endforeach
                                @endif
                              </div>
                          </td>
                          <td class="p-4 whitespace-nowrap space-x-2">
                              <button type="button" data-modal-toggle="delete-user-modal" class="text-white bg-teal-500 hover:bg-teal-800 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                  <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                  Show user
                              </button>
                              <button type="button" data-modal-toggle="user-modal" class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-3 py-2 text-center">
                                  <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                  Edit user
                              </button>
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
                  <button class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Add user</button>
              </div>
          </form>
      </div>
  </div>
</div>

{{-- Edit User Modal --}}
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="user-modal">
  <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow relative">
          <!-- Modal header -->
          <div class="flex items-start justify-between p-5 border-b rounded-t">
              <h3 class="text-xl font-semibold">
                  Edit user
              </h3>
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="user-modal">
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
                      <div class="col-span-6 sm:col-span-3">
                          <label for="current-password" class="text-sm font-medium text-gray-900 block mb-2">Current Password</label>
                          <input type="password" name="current-password" id="current-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="••••••••" required>
                      </div>
                      <div class="col-span-6 sm:col-span-3">
                          <label for="new-password" class="text-sm font-medium text-gray-900 block mb-2">New Password</label>
                          <input type="password" name="new-password" id="new-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="••••••••" required>
                      </div>
                  </div> 
              </div>
              <!-- Modal footer -->
              <div class="items-center p-6 border-t border-gray-200 rounded-b">
                  <button class="text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Save all</button>
              </div>
          </form>
      </div>
  </div>
</div>

<!-- Delete User Modal -->
<div class="hidden overflow-x-hidden overflow-y-auto fixed top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center h-modal sm:h-full" id="delete-user-modal">
  <div class="relative w-full max-w-md px-4 h-full md:h-auto">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow relative">
          <!-- Modal header -->
          <div class="flex justify-end p-2">
              <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="delete-user-modal">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
              </button>
          </div>
          <!-- Modal body -->
          <div class="p-6 pt-0 text-center">
              <svg class="w-20 h-20 text-red-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
              <h3 class="text-xl font-normal text-gray-500 mt-5 mb-6">Are you sure you want to delete this user?</h3>
              <a href="#" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2">
                  Yes, I'm sure
              </a>
              <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-cyan-200 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center" data-modal-toggle="delete-user-modal">
                  No, cancel
              </a>
          </div>
      </div>
  </div>
</div>
{{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right mb-3">
          @can('user-create')
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
          @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Phone Number</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user['full_name']}}</td>
    <td>{{ $user['email'] }}</td>
    <td>{{ $user['phone_number'] }}</td>
    <td>
      @if(!empty($user['roles']))
        @foreach($user['roles'] as $v)
           <label class=" text-black">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
      @can('user-show')
       <a class="btn btn-info" href="{{ route('users.show', $user['id']) }}">Show</a>
      @endcan
      @can('user-edit')
       <a class="btn btn-primary" href="{{ route('users.edit',$user['id']) }}">Edit</a>
      @endcan --}}
      {{-- @can('provider-edit')
      @endcan --}}
    {{-- </td>
  </tr>
 @endforeach
</table> --}}

@endsection