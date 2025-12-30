<<<<<<< HEAD
@props(['concerts'])
<div 
    x-data="{ selectedSeat: null }"
    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"
>

@foreach($seatings as $seat)
    <div
        @click="selectedSeat = {{ $seat->id }}"
        :class="selectedSeat === {{ $seat->id }}
            ? 'border-2 border-blue-500 bg-blue-50'
            : 'border border-gray-300'"
        class="cursor-pointer rounded-2xl p-6 shadow transition"
    >
        <h3 class="text-xl font-bold">{{ $seat->seat_type }}</h3>
        <p class="mt-2 text-basetext">Price: Rp {{ number_format($seat->price) }}</p>
    </div>
@endforeach

    <!-- BUTTON -->
    <div class="col-span-full flex justify-center mt-10">
        <button
            @click="
                if(selectedSeat){
                    window.location.href = '/payment/' + selectedSeat
                } else {
                    alert('Pilih seat dulu')
                }
            "
            class="bg-blacktext text-white px-20 py-3 rounded-full hover:bg-gray-700"
        >
            Select Ticket
        </button>
    </div>

</div>
=======
@props(['seats'])
<div class="grid grid-cols-2 relative left-[80px] gap-4 max-w-[900px] mx-auto mt-8 mb-8">
     @foreach ($seats as $seat)
    <div class="w-[300px] h-[300px] bg-white border border-gray-300 hover:bg-gray-200 rounded-[24px] px-8 py-[120px] text-center">
        <button><h1 class="text-3xl mb-5 font-bold hover:bg-gray-200">{{ $seat->name_seating }}</h1></button>
        <p class="text-xl text-[#9795B5]">PRICE 1</p>
    </div>
     @endforeach
</div>
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
