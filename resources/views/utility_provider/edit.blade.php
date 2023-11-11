@extends('layouts.tailapp')

@section('content')
<div class="flex flex-col items-center justify-center px-6 mt-10 mx-auto pt:mt-0 dark:bg-gray-900">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative dark:bg-gray-800 dark:text-white">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Edit utility provider
                </h3>
            </div>
            @if (count($errors) > 0)
            <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 ml-4 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </ul>
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endif
            @if (isset($utilityProvider['id']))
            <div class="p-6 space-y-6">
                {!! Form::model($utilityProvider, ['method' => 'PATCH','route' => ['utility_providers.update', $utilityProvider['id']]]) !!}
                    <div class="grid grid-cols-6 gap-6 mb-2">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="provider-name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Provider Name</label>
                            {!! Form::text('provider_name', null, array('placeholder' => 'Provider Name', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white')) !!}
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="provider-code" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Provider Code</label>
                            {!! Form::text('provider_code', null, array('placeholder' => 'Provider Code','disabled' => true, 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white')) !!}
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="provider_status" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Provider Status</label>
                            {!! Form::select('provider_status', collect($providerStatus)->pluck('name', 'value'), null, array('class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white')) !!}
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="provider_category" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Provider Category</label>
                            {!! Form::select('provider_categories_id', collect($providerCategories)->pluck('name', 'id'), null, array('class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white')) !!}
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Update</button>
                    </div>
                {!! Form::close() !!}
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
