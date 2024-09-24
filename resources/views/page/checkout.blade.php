@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen">
        <x-card class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Checkout Domain: {{ $domain->domain_name }}</h2>

            <form method="POST" action="{{ url('/checkout/' . $domain->domain_name) }}">
                @csrf

                <div class="mb-4">
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Select Duration (Years)</label>
                    <select name="duration" id="duration" class="block w-full px-4 py-2 rounded-md border border-gray-300">
                        <option value="1">1 Year</option>
                        <option value="2">2 Years</option>
                        <option value="3">3 Years</option>
                    </select>
                </div>

                @auth
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <p class="text-gray-800">{{ Auth::user()->name }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <p class="text-gray-800">{{ Auth::user()->email }}</p>
                    </div>
                @else
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name" class="block w-full px-4 py-2 rounded-md border border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" class="block w-full px-4 py-2 rounded-md border border-gray-300" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password" class="block w-full px-4 py-2 rounded-md border border-gray-300" required>
                    </div>

                    <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a></p>
                @endauth

                <div class="mt-6 mb-4">
                    <p id="totalPrice" class="text-lg font-bold text-gray-800">Total: Rp10.000,-</p>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                    Checkout
                </button>
            </form>
        </x-card>
    </div>

    <script>
        document.getElementById('duration').addEventListener('change', function () {
            const pricePerYear = 10000;
            const duration = this.value;
            const total = pricePerYear * duration;

            document.getElementById('totalPrice').innerText = `Total: Rp${total.toLocaleString('id-ID')},-`;
        });
    </script>
@endsection
