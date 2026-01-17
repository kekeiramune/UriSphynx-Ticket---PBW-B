@props(['activeTickets' => []])

<div class="relative mt-10 flex gap-[100px] mt-10 justify-center flex-wrap">
    @forelse($activeTickets ?? [] as $ticket)
    <div class="shadow-xl shadow-black/20 w-[300px] h-[450px] bg-white rounded-[24px] flex flex-col items-center justify-center p-4">
        @if($ticket->concert->image)
            <img src="{{ asset('storage/' . $ticket->concert->image) }}" 
                 alt="{{ $ticket->concert->concert_name }}"
                 class="w-32 h-32 object-cover rounded-lg mb-3">
        @else
            <div class="w-32 h-32 bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                <span class="text-gray-400 text-sm">No Image</span>
            </div>
        @endif
        
        <h1 class="font-bold text-[#2C2C2C] text-xl mt-2 text-center">{{ $ticket->concert->concert_name }}</h1>
        <p class="text-[#757575] text-sm">{{ \Carbon\Carbon::parse($ticket->concert->concert_date)->format('d M Y') }}</p>
        <p class="text-[#757575] text-sm">{{ $ticket->concert->city }}</p>
        <p class="text-[#444444] font-semibold mt-2">{{ $ticket->price->seating->name_seating ?? 'N/A' }}</p>
        <p class="text-[#757575] text-xs mb-3">Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</p>
        
        <a href="{{ route('ticket.show', $ticket->id_transaction) }}" 
           class="bg-white text-[#444444] hover:bg-gray-200 border px-12 py-3 rounded-[40px] border-[#444444] transition-all">
            See E-Ticket
        </a>
        
        <div class="mt-3">
            @if($ticket->concert->status_concert === 'Upcoming')
                <span class="bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm font-semibold">Upcoming</span>
            @elseif($ticket->concert->status_concert === 'Ongoing')
                <span class="bg-green-100 text-green-800 px-4 py-1 rounded-full text-sm font-semibold">Ongoing</span>
            @endif
        </div>
    </div>
    @empty
    <div class="w-full text-center py-12">
        <p class="text-gray-500 text-lg">No active tickets yet.</p>
        <p class="text-gray-400 text-sm mt-2">Book a concert to see your tickets here!</p>
        <a href="{{ route('home') }}" 
           class="inline-block mt-4 bg-[#8faeba] text-white px-6 py-3 rounded-full hover:bg-[#7a8fa0] transition-all">
            Browse Concerts
        </a>
    </div>
    @endforelse
</div>