@props(['category'])

<div class="flex justify-center m-8 gap-4 flex-wrap">
    @foreach ($category as $cat)
        <a href="{{ $cat->latestConcert ? route('concert.show', $cat->latestConcert->id_concert) : '#' }}" 
           class="bg-white w-[300px] rounded-[10px] overflow-hidden shadow transition-transform duration-300 ease-in-out hover:scale-110 block
           {{ !$cat->latestConcert ? 'cursor-default' : '' }}">

            <div class="w-full h-[200px]">
                <img src="{{ asset('storage/' . $cat->groupimg) }}" alt="" class="w-full h-full object-cover">
            </div>

            <h1 class="px-4 py-4 font-bold text-center text-2xl text-blacktext">
                {{ $cat->groupname }}
            </h1>

        </a>
    @endforeach
</div>