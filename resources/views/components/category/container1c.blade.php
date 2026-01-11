@props(['category'])

<div class="flex justify-center m-8 gap-4 flex-wrap">
    @foreach ($category as $cat)
        <div class="bg-white w-[300px] rounded-[10px] overflow-hidden shadow transition-transform duration-300 ease-in-out
                       hover:scale-110">

            <div class="w-full h-[200px]">
                <img src="{{ asset('storage/' . $cat->groupimg) }}" alt="" class="w-full h-full object-cover">
            </div>

            <h1 class="px-4 py-4 font-bold text-center text-2xl">
                {{ $cat->groupname }}
            </h1>

        </div>
    @endforeach
</div>