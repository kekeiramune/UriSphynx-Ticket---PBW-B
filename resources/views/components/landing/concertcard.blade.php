@props(['concerts'])
<div class="relative flex flex-wrap gap-10 justify-center mt-10 mb-20 px-4">
    @foreach ($concerts as $concert)
    <div class="relative w-full max-w-[500px] h-[330px] rounded-[25px] overflow-hidden shadow-xl transition-all duration-300 hover:scale-105 group">
        
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $concert->image) }}" 
                 alt="{{ $concert->concert_name }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 p-8 flex flex-col justify-end h-full h-full text-white">
            <div class="transform transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-bold tracking-widest text-[#707FDD] uppercase bg-white/10 backdrop-blur-md px-3 py-1 rounded-full border border-white/20">
                        {{ $concert->category->type ?? 'Music' }}
                    </p>
                    <span class="text-xs font-medium px-2 py-1 rounded bg-black/50 text-gray-300">
                        {{ \Carbon\Carbon::parse($concert->concert_date)->format('M d, Y') }}
                    </span>
                </div>

                <h1 class="text-3xl font-extrabold mb-2 leading-tight drop-shadow-md">
                    {{ $concert->concert_name }}
                </h1>
                
                <p class="text-gray-300 mb-6 font-medium flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full {{ $concert->status_concert == 'Upcoming' ? 'bg-green-400' : 'bg-gray-400' }}"></span>
                    {{ $concert->status_concert }}
                </p>
                
                <a href="{{ route('concert.show', $concert->id_concert) }}" 
                   class="inline-block w-full text-center bg-[#707FDD] hover:bg-[#5f6bc9] text-white font-bold py-3 rounded-[20px] transition shadow-lg hover:shadow-[#707FDD]/50">
                    See Details
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>