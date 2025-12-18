@props(['seats'])
<div class="grid grid-cols-2 relative left-[80px] gap-4 max-w-[900px] mx-auto mt-8 mb-8">
     @foreach ($seats as $seat)
    <div class="w-[300px] h-[300px] bg-white border border-gray-300 rounded-[24px] px-8 py-[120px] text-center">
        <h1 class="text-3xl mb-5 font-bold">{{ $seat->name }}</h1>
        <p class="text-xl text-[#9795B5]">PRICE 1</p>
    </div>
     @endforeach
</div>