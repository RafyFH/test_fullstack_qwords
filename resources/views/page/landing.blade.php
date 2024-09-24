@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <x-card class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Cek Ketersediaan Domain</h2>

            @auth
                <div class="text-center mb-4">
                    <p class="text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}!</p>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full mt-4 bg-red-600 text-white font-bold py-2 px-4 rounded-md hover:bg-red-700 transition">Logout</button>
                    </form>
                </div>
            @else
                <div class="text-center mb-4">
                    <p class="text-sm text-gray-600">Anda belum login. </p>
                    <a href="{{ route('login') }}" class="inline-block mt-2 bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 transition">Login</a>
                </div>
            @endauth

            <form id="domainCheckForm" method="POST" onsubmit="event.preventDefault(); checkDomain();">
                @csrf

                <div class="mb-4">
                    <label for="domain" class="block text-sm font-medium text-gray-700 mb-2">Masukkan Nama Domain</label>
                    <input type="text" name="domain" id="domain" placeholder="example.com" class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" id="checkButton" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Cek</button>
                </div>
            </form>
            <div id="result" class="mt-6 hidden text-center">
                <p id="message" class="font-bold mb-4"></p>
                <a href="" id="orderButton" class="w-full bg-green-600 text-white font-bold py-2 px-4 rounded-md hover:bg-green-700 transition">Pesan Sekarang</a>
            </div>
        </x-card>
    </div>

    <script>
        function checkDomain() {
            const domain = document.getElementById('domain').value;
            const checkButton = document.getElementById('checkButton');
            const result = document.getElementById('result');
            const message = document.getElementById('message');
            const orderButton = document.getElementById('orderButton');

            checkButton.innerText = 'Memeriksa...';
            checkButton.disabled = true;

            // Fetch data from the Laravel endpoint
            fetch('/check-domain', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ domain: domain })
            })
                .then(response => response.json())
                .then(data => {
                    checkButton.innerText = 'Cek';
                    checkButton.disabled = false;

                    if (data.available) {
                        message.innerText = 'Selamat! Domain tersedia.';
                        orderButton.href = `/checkout/${domain}`; // Mengarahkan ke halaman checkout dengan domain yang dipilih
                        result.classList.remove('hidden');
                        orderButton.classList.remove('hidden');
                    } else {
                        message.innerText = data.message;
                        result.classList.remove('hidden');
                        orderButton.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    checkButton.innerText = 'Cek';
                    checkButton.disabled = false;
                    message.innerText = 'Terjadi kesalahan. Silakan coba lagi.';
                    result.classList.remove('hidden');
                    orderButton.classList.add('hidden');
                });
        }
    </script>
@endsection
