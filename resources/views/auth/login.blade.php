@extends('layouts.tailapp')

@section('content')
{{-- <div class="container"> --}}
    <div class="flex flex-col items-center justify-center px-6 mt-10 mx-auto pt:mt-0 dark:bg-gray-900">
        <a href="{{"/"}}" class="flex items-center justify-center py-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <span>Token and Customer Management System</span>  
        </a>
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
                    <a href="#" class="ml-auto text-sm text-blue-700 hover:underline dark:text-primary-500">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
                
            </form>
        </div>
    </div>
@endsection
