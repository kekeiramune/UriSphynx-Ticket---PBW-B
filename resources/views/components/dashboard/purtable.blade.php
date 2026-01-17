@props(['transactions' => []])

<!-- DEBUG INFO -->
<div class="bg-yellow-100 border border-yellow-400 p-4 mb-4 rounded">
    <p class="font-bold">🔍 DEBUG INFO:</p>
    <p>Logged in as: <strong>{{ Auth::user()->name }}</strong> (ID: {{ Auth::user()->id }})</p>
    <p>Transaction Count: <strong>{{ count($transactions) }}</strong></p>
    <p>Total transactions in DB: <strong>{{ App\Models\Transaction::count() }}</strong></p>
    @if(count($transactions) > 0)
        <p class="text-green-600">✓ First transaction: {{ $transactions[0]->concert->concert_name ?? 'N/A' }}</p>
    @else
        <p class="text-red-600">✗ No transactions found for user ID {{ Auth::user()->id }}</p>
        <p class="text-sm text-gray-600 mt-2">Tip: Pastikan Anda login dengan user yang sama yang melakukan transaksi</p>
    @endif
</div>

<div class="mt-10 max-w-6xl mb-10 mx-auto px-6">
    <table class="w-full border-collapse rounded-[24px] overflow-hidden">
  <thead>
    <tr class="bg-gray-100">
      <th class="border px-4 py-2 text-left">Concert Name</th>
      <th class="border px-4 py-2 text-left">Date</th>
      <th class="border px-4 py-2 text-left">Seating</th>
      <th class="border px-4 py-2 text-left">Price</th>
      <th class="border px-4 py-2 text-left">Status</th>
      <th class="border px-4 py-2 text-left">Action</th>
    </tr>
  </thead>

  <tbody>
    @forelse($transactions ?? [] as $transaction)
    <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
      <td class="border px-4 py-2">{{ $transaction->concert->concert_name ?? 'N/A' }}</td>
      <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($transaction->concert->concert_date)->format('d-m-Y') }}</td>
      <td class="border px-4 py-2">{{ $transaction->price->seating->name_seating ?? 'N/A' }}</td>
      <td class="border px-4 py-2">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
      <td class="border px-4 py-2">
        @if($transaction->status === 'paid')
          <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Paid</span>
        @elseif($transaction->status === 'pending')
          <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
        @else
          <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">{{ ucfirst($transaction->status) }}</span>
        @endif
      </td>
      <td class="border px-4 py-2">
        <a href="{{ route('transaction.show', $transaction->id_transaction) }}" 
           class="text-blue-600 hover:text-blue-800 underline">
          View Details
        </a>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
        No transaction history yet. Start booking your favorite concerts!
      </td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>