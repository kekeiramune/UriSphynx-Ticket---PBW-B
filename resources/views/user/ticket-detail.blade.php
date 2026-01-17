<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 py-12">
    <div class="max-w-2xl mx-auto px-6">
        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dashboard
        </a>

        <!-- E-Ticket Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header with Concert Image -->
            <div class="relative h-48 bg-gradient-to-r from-purple-600 to-blue-600">
                @if($transaction->concert->image)
                    <img src="{{ asset('storage/' . $transaction->concert->image) }}" 
                         alt="{{ $transaction->concert->concert_name }}"
                         class="w-full h-full object-cover opacity-50">
                @endif
                <div class="absolute inset-0 flex items-center justify-center">
                    <h1 class="text-4xl font-bold text-white text-center px-4">E-TICKET</h1>
                </div>
            </div>

            <!-- Ticket Content -->
            <div class="p-8">
                <!-- Concert Name -->
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $transaction->concert->concert_name }}</h2>
                    <p class="text-gray-600">{{ $transaction->concert->category->groupname ?? 'Concert' }}</p>
                </div>

                <!-- Ticket Details Grid -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 text-sm mb-1">Date</p>
                        <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($transaction->concert->concert_date)->format('d F Y') }}</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 text-sm mb-1">Time</p>
                        <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($transaction->concert->concert_time)->format('H:i') }}</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 text-sm mb-1">Venue</p>
                        <p class="font-bold text-gray-800">{{ $transaction->concert->venue }}</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 text-sm mb-1">City</p>
                        <p class="font-bold text-gray-800">{{ $transaction->concert->city }}</p>
                    </div>
                </div>

                <!-- Seating & Holder Info -->
                <div class="border-t border-b border-gray-200 py-6 mb-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Seating Category</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $transaction->price->seating->name_seating ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm mb-1">Ticket Holder</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $transaction->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- QR Code Placeholder -->
                <div class="text-center mb-6">
                    <div class="inline-block p-6 bg-gray-100 rounded-lg">
                        <div class="w-48 h-48 bg-white border-4 border-gray-300 flex items-center justify-center">
                            <!-- QR Code would go here -->
                            <div class="text-center">
                                <svg class="w-32 h-32 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                <p class="text-gray-500 text-sm mt-2">Ticket ID: #{{ str_pad($transaction->id_transaction, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <p class="text-sm text-blue-800">
                        <strong>Important:</strong> Please show this e-ticket at the venue entrance. Screenshot or print this page for entry.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button onclick="window.print()" 
                            class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all font-semibold">
                        Print Ticket
                    </button>
                    <a href="{{ route('transaction.show', $transaction->id_transaction) }}" 
                       class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all text-center font-semibold">
                        View Transaction
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-6 text-gray-600 text-sm">
            <p>Purchased on {{ $transaction->created_at->format('d F Y, H:i') }}</p>
            <p class="mt-1">For assistance, please contact our support team</p>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .bg-white.rounded-3xl, .bg-white.rounded-3xl * {
            visibility: visible;
        }
        .bg-white.rounded-3xl {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        button, a {
            display: none !important;
        }
    }
</style>
</x-app-layout>

