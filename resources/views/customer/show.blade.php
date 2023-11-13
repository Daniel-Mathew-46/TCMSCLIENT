@extends('layouts.tailapp')

@section('content')
<div class="flex flex-col items-center justify-center px-6 mt-10 mx-auto pt:mt-0 dark:bg-gray-900">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <div class="bg-white rounded-lg shadow relative dark:bg-gray-800 dark:text-white mt-3">
            <div class="flex items-start justify-between p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold">
                    Customer Information
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-6 gap-6 mb-2">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="full_name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white">Customer Name</label>
                        <input type="text" name="full_name" id="full_name" value="{{$customer['full_name']}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="phone" class="text-sm font-medium text-gray-900 block mb-2 dark:text-white"> Customer Phone Number</label>
                        <input type="number" name="phone" id="phone" value="{{$customer['phone']}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" disabled>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="address" class="text-sm font-medium text-gray-900 block dark:text-white"> Customer Address</label>
                        <input type="address" name="address" id="address" value="{{ $customer['address'] }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" disabled>
                    </div>
                </div> 
            </div>
            @if(!empty($customer['meters']))
            <label class=" px-6 font-bold text-gray-900 dark:text-gray-300">Meters</label>
                @foreach($customer['meters'] as $meter)
                <div class="items-center px-6 border-gray-200 rounded-b py-3 ">
                    <span class="mr-2 font-semibold">Meter Number:</span>
                    <label class="font-medium text-blue-500">{{ $meter['meter_number']}}</label>
                    <a class=" underline ml-2 italic" href="{{ route('debts.show', $meter['id']) }}">View debts</a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
