@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Invoice</h2>
        <div class="mt-6 text-center">
            <p class="text-gray-600">Thank you for your purchase!</p>
            <p class="text-gray-600">Your domain has been successfully booked.</p>

            <!-- Download PDF Button -->
            <a href="{{ route('invoice.download', $transaction->id) }}" class="inline-block mt-4 bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
                Download PDF Invoice
            </a>
        </div>

        <div class="border-b pb-4 mb-4">
            <h3 class="text-xl font-semibold text-gray-700"></h3>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <p class="text-gray-600">Domain:</p>
                    <p class="text-lg font-bold text-gray-800">{{ $domain->domain_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Durasi:</p>
                    <p class="text-lg font-bold text-gray-800">{{ $transaction->duration }} Tahun</p>
                </div>
            </div>
        </div>

        <div class="border-b pb-4 mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Info Pembeli</h3>
            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <p class="text-gray-600">Nama:</p>
                    <p class="text-lg font-bold text-gray-800">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Email:</p>
                    <p class="text-lg font-bold text-gray-800">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="border-b pb-4 mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Total</h3>
            <p class="text-lg font-bold text-gray-800">Rp{{ number_format($transaction->total_price, 0, ',', '.') }},-</p>
        </div>

        <div class="mt-6 text-center">
            <p class="text-gray-600">Terima Kasih Sudah Membeli!</p>
            <p class="text-gray-600">Domain Kamu Berhasil Dibeli.</p>
        </div>
    </div>
@endsection
