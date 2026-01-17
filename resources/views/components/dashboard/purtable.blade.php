@props(['purchaseHistory' => []])

<div class="mt-6 mb-10 px-4 md:px-20 w-full">
  <div class="overflow-x-auto rounded-[24px] shadow-lg">
    <table class="w-full border-collapse bg-white min-w-[800px]">
      <thead>
        <tr class="bg-gray-100">
          <th class="border px-4 py-2 text-left">Concert Name</th>
          <th class="border px-4 py-2 text-left">Date</th>
          <th class="border px-4 py-2 text-left">Seating</th>
          <th class="border px-4 py-2 text-left">Quantity</th>
          <th class="border px-4 py-2 text-left">Total Amount</th>
          <th class="border px-4 py-2 text-left">Payment Status</th>
        </tr>
      </thead>

      <tbody>
        @forelse($purchaseHistory as $transaction)
          <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
            <td class="border px-4 py-2">{{ $transaction->concert->concert_name }}</td>
            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($transaction->concert->concert_date)->format('d-m-Y') }}
            </td>
            <td class="border px-4 py-2">{{ $transaction->concertPrice->seating->name_seating ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $transaction->quantity }}</td>
            <td class="border px-4 py-2">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            <td class="border px-4 py-2">
              @if($transaction->status === 'Pending')
                @if($transaction->admin_notes)
                  <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">Revision Needed</span>
                @else
                  <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                @endif
              @elseif($transaction->status === 'Paid')
                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Paid</span>
              @else
                <span
                  class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">{{ $transaction->status }}</span>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
              Belum ada riwayat pembelian
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>