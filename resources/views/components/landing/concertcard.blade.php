@props(['concerts'])
<div class="relative flex gap-10 justify-center mt-10 mb-10">
    @foreach ($concerts as $concert)
    <div class="relative top-10 left-[30px] w-[500.691px] h-[330.781px] text-center bg-white rounded-[20px] p-8 transition-all duration-300 
            hover:scale-110">
        <img src="" alt="">
        <p class="uppercase">{{ $concert->category->type ?? 'Uncategorized' }}</p>
        <h1 class="text-3xl font-bold mt-4 mb-4">{{ $concert->concert_name }}</h1>
        <p class="mb-5">{{ $concert->status_concert }}</p>
        <button class="bg-secondary text-white font-semibold py-3 px-6 rounded-[30px] inline-flex items-center hover:bg-customHover"><a href="{{ route('concert.show', $concert->id_concert) }}">See More</a></button>
    </div>
    <div class="relative top-10 left-[30px] w-[200.691px] h-[330.781px] bg-white rounded-[20px] text-center transition-all duration-300 ease-out
            hover:scale-105 hover:shadow-xl">
        <h1 class="relative top-[200px] text-1xl font-bold mt-4 mb-4">Concert Name 2</h1>
    </div>
    <div class="relative top-10 left-[30px] w-[200.691px] h-[330.781px] bg-white rounded-[20px] text-center transition-all duration-300 ease-out
            hover:scale-105 hover:shadow-xl">
        <h1 class="relative top-[200px] text-1xl font-bold mt-4 mb-4">Concert Name 3</h1>
    </div>
    @endforeach
</div>