@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <input id="email"
                       type="email"
                       name="email"
                       :value="old('email')"
                       required
                       autofocus
                       autocomplete="username"
                       class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">

                <button class="w-full mt-4 bg-green-600 text-white font-bold py-2 px-4 rounded-md hover:bg-green-700 transition">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
@endsection
