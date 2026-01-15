@props(['activeTickets' => []])

<div class="mt-6 flex gap-8 justify-center flex-wrap px-4 md:px-20">
    @forelse($activeTickets as $ticket)
        <div
            class="shadow-xl shadow-black/20 w-full md:w-[300px] h-auto p-6 md:p-0 md:h-[400px] bg-white rounded-[24px] flex flex-col items-center justify-center mb-6">
            @if($ticket->concert->category && $ticket->concert->category->groupimg)
                <img src="{{ asset('storage/' . $ticket->concert->category->groupimg) }}"
                    alt="{{ $ticket->concert->concert_name }}" class="w-24 h-24 rounded-full object-cover">
            @else
                <div
                    class="w-24 h-24 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center text-white text-2xl font-bold">
                    {{ substr($ticket->concert->concert_name, 0, 1) }}
                </div>
            @endif
            <h1 class="font-bold text-[#2C2C2C] text-xl mt-5">{{ $ticket->concert->concert_name }}</h1>
            <p class="text-[#757575]">{{ \Carbon\Carbon::parse($ticket->concert->concert_date)->format('d M Y') }}</p>
            <p class="text-[#757575] mb-3">{{ $ticket->concert->city }}</p>
            <button @click="$dispatch('open-ticket', {
                                    ticket_code: '{{ $ticket->ticket_code }}',
                                    concert_name: '{{ $ticket->concert->concert_name }}',
                                    concert_date: '{{ \Carbon\Carbon::parse($ticket->concert->concert_date)->format('d F Y') }}',
                                    venue: '{{ $ticket->concert->venue }}',
                                    city: '{{ $ticket->concert->city }}',
                                    seating_name: '{{ $ticket->concertPrice->seating->name_seating ?? '-' }}',
                                    user_name: '{{ Auth::user()->name }}',
                                    purchase_date: '{{ $ticket->created_at->format('d F Y') }}',
                                    qr_code_url: '{{ $ticket->qr_code_path ? asset('storage/' . $ticket->qr_code_path) : asset('placeholder-qr.png') }}',
                                    status: '{{ $ticket->status }}'
                                })"
                class="bg-white text-[#444444] hover:bg-gray-200 border px-12 py-3 rounded-[40px] border-[#444444] transition">
                See E-Ticket
            </button>
            <h1 class="font-semibold text-xl text-[#2C2C2C] mt-5">
                <span
                    class="px-3 py-1 rounded-full text-sm {{ $ticket->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                    {{ ucfirst($ticket->status) }}
                </span>
            </h1>
        </div>
    @empty
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Belum ada tiket aktif</p>
            <p class="text-gray-400 text-sm mt-2">Tiket akan muncul setelah pembayaran diapprove oleh admin</p>
        </div>
    @endforelse
</div>