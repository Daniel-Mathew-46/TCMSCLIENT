@extends('layouts.tailapp')

@section('content')
<div class="text-center">
  <div class="pt-6 px-4">
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      @isset($dashboardDataAdmin)
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">8</span>
            <h3 class="text-base font-normal text-gray-500 dark:text-white">Users</h3>
          </div>
        </div>
      </div>
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">{{$dashboardDataAdmin['utilityProvider']}}</span>
            <h3 class="text-base font-normal text-gray-500 dark:text-white">New Utility Providers</h3>
          </div>
        </div>
      </div>
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">500</span>
            <h3 class="text-base font-normal text-gray-500 dark:text-white">Tokens generated</h3>
          </div>
        </div>
      </div>
      @endisset

      @isset($dashboardDataUtilityProvider)
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">{{$dashboardDataUtilityProvider['customers']}}</span>
            <h3 class="text-base font-normal text-gray-500 dark:text-white">New Customers</h3>
          </div>
        </div>
      </div>
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">{{ $dashboardDataUtilityProvider['totalDebtAmount']}}</span>
            <h3 class="text-base font-normal text-gray-500 dark:text-white">Total debts</h3>
          </div>
        </div>
      </div>
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800 dark:text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900 dark:text-white">{{ $dashboardDataUtilityProvider['numberOfTokens']}}</span>
            <h3 class="text-base font-normal text-gray-500 dark:text-white">Tokens generated</h3>
          </div>
        </div>
      </div>
      @endisset
    </div>

    <div class=" grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4 my-4 ">
      <!-- Newest customers Card -->
      @isset($dashboardDataUtilityProvider)
      <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h3>
          <a href="{{ route('customers.index') }}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg inline-flex items-center p-2 dark:text-white">
            View all
          </a>
        </div>
        <div class="flow-root ">
          @if (!empty($dashboardDataUtilityProvider['customersList']))
            <ul role="list" class="divide-y divide-gray-200 ">
                @foreach ($dashboardDataUtilityProvider['customersList'] as $customer)
                <li class="py-3 sm:py-4">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                        {{$customer['full_name']}}
                      </p>
                    </div>
                    <div class="flex-1 min-w-0">
                      <p class="text-sm text-gray-500 truncate dark:text-gray-300">
                        {{$customer['phone']}}
                      </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-gray-300">
                      {{$customer['address']}}
                    </div>
                  </div>
                </li>
                @endforeach
            </ul>
          @endif
        </div>
      </div>
      @endisset

      @isset($dashboardDataAdmin)
      <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full dark:bg-gray-800">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Utility Providers</h3>
          <a href="{{ route('utility_providers.index') }}" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 hover:text-gray-800 rounded-lg inline-flex items-center p-2 dark:text-white">
            View all
          </a>
        </div>
        <div class="flow-root ">
          @if (!empty($dashboardDataAdmin['utilityProviderList']))
          <ul role="list" class="divide-y divide-gray-200 ">
              @foreach ($dashboardDataAdmin['utilityProviderList'] as $utilityProvider)
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                      {{$utilityProvider['provider_name']}}
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-500 truncate dark:text-gray-300">
                      {{$utilityProvider['provider_code']}}
                    </p>
                  </div>
                  <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-gray-300">
                    {{$utilityProvider['provider_status']}}
                  </div>
                </div>
              </li>
              @endforeach
          </ul>
          @endif
        </div>
      </div>
      @endisset

      {{-- Acqusition --}}
      <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800">
        <h3 class="text-xl leading-none font-bold text-gray-900 mb-10 dark:text-white">Trends</h3>
        <div class="block w-full overflow-x-auto">
          {!! $chart->container() !!}
          
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@endsection