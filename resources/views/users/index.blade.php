@extends('layouts.app')

@section('content')
<div class="row">
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
      @endcan
      {{-- @can('provider-edit')
      @endcan --}}
    </td>
  </tr>
 @endforeach
</table>

@endsection