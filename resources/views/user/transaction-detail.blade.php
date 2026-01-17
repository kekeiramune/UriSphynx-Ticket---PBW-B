<x-app-layout>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Back Button -->
        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dashboard
        </a>

        <!-- Transaction Detail Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Transaction Details</h1>
            
            <!-- Status Badge -->
            <div class="mb-6">
                @if($transaction->status === 'paid')
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">✓ Paid</span>
                @elseif($transaction->status === 'pending')
                    <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-semibold">⏳ Pending Verification</span>
                @else
                    <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-semibold">{{ ucfirst($transaction->status) }}</span>
                @endif
            </div>

            <!-- Concert Information -->
            <div class="border-b pb-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Concert Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Concert Name</p>
                        <p class="font-semibold text-gray-800">{{ $transaction->concert->concert_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Date</p>
                        <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($transaction->concert->concert_date)->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Venue</p>
                        <p class="font-semibold text-gray-800">{{ $transaction->concert->venue }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">City</p>
                        <p class="font-semibold text-gray-800">{{ $transaction->concert->city }}</p>
                    </div>
                </div>
            </div>

            <!-- Ticket Information -->
            <div class="border-b pb-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Ticket Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Seating Category</p>
                        <p class="font-semibold text-gray-800">{{ $transaction->price->seating->name_seating ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Ticket Holder Name</p>
                        <p class="font-semibold text-gray-800">{{ $transaction->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="border-b pb-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Payment Information</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Payment Method</p>
                        <p class="font-semibold text-gray-800">{{ ucfirst($transaction->payment_method) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Price</p>
                        <p class="font-semibold text-gray-800 text-2xl">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Transaction Date</p>
                        <p class="font-semibold text-gray-800">{{ $transaction->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Transaction ID</p>
                        <p class="font-semibold text-gray-800">#{{ str_pad($transaction->id_transaction, 6, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Proof -->
            @if($transaction->payment_proof)
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Payment Proof</h2>
                <img src="{{ asset('storage/payment_proofs/' . $transaction->payment_proof) }}" 
                     alt="Payment Proof" 
                     class="max-w-md rounded-lg shadow-md border">
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-8">
                @if($transaction->status === 'paid')
                <a href="{{ route('ticket.show', $transaction->id_transaction) }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all">
                    View E-Ticket
                </a>
                @endif
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-all">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

