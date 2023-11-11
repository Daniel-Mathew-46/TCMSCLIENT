@extends('layouts.tailapp')

@section('content')
<div class="flex flex-col items-center justify-center px-6 mt-10 mx-auto pt:mt-0 dark:bg-gray-900">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative dark:bg-gray-800 dark:text-white">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Role Information
                </h3>
            </div>
            <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6 mb-2">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="full_name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Role Name</label>
                            {!! Form::text('name', $role->name, array('placeholder' => 'Name', 'disabled' => true, 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white')) !!}
                        </div>
                    </div>
                    <strong for="full_name" class="text-lg font-medium text-gray-900 block dark:text-white ">Permissions</strong>
                    <div class="grid grid-cols-4 gap-3 ">
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <label class="font-medium text-gray-900 dark:text-gray-300">{{ $v->name }},</label>
                            @endforeach
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div> --}}
@endsection