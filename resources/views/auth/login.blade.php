@extends('layouts.tailapp')

@section('content')
{{-- <div class="container"> --}}
    @if (!session('success') && !session('error'))
    <div class="flex flex-col items-center justify-center px-6 mt-10 mx-auto pt:mt-0 dark:bg-gray-900">
        <a href="{{"/"}}" class="flex items-center justify-center py-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <span>Token and Customer Management System</span>
        </a>
    @endif


     @if(session('success'))
        <div class="flex flex-col items-center justify-center px-6 mt-0 mx-auto pt:mt-0 dark:bg-gray-900">
            <a href="{{"/"}}" class="flex items-center justify-center py-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <span>Token and Customer Management System</span>
            </a>

<div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div class="ml-3 text-sm font-medium">
        {{ session('success') }}
    </div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
</div>
@endif

@if(session('error'))
<div class="flex flex-col items-center justify-center px-6 mt-0 mx-auto pt:mt-0 dark:bg-gray-900">
    <a href="{{"/"}}" class="flex items-center justify-center py-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <span>Token and Customer Management System</span>
    </a>

<div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div class="ml-3 text-sm font-medium">
        {{ session('error') }}
    </div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
      <span class="sr-only">Close</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
  </div>
@endif
        <!-- Card -->
        <div class="w-full max-w-xl p-6 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Sign in
            </h2>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900
                    @error('email')
                    border-red-500 text-red-900
                    @enderror
                     sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                     dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                     @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}</span></p>
                    @enderror

                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900
                    @error('password')
                    border-red-500 text-red-900
                    @enderror
                    sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{$message}}</span></p>
                    @enderror
                </div>
                <div class="flex items-start">
                    <a href="{{ route('password.request') }}" class="ml-auto text-sm text-blue-700 hover:underline dark:text-primary-500">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
            </form>
        </div>
    </div>
@endsection
