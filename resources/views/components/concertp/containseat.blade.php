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
