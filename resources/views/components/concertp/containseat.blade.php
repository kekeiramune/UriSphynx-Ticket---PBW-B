@props(['concerts'])
<div class="grid grid-cols-2 gap-4 max-w-[900px] mx-auto mt-8 mb-8">
    @foreach ($concerts->prices as $price)
        <div class="w-[300px] h-[300px] bg-white border rounded-[24px] px-8 py-[100px] text-center">

            <h1 class="text-3xl mb-5 font-bold uppercase">
                {{ $price->seating->name_seating }}
            </h1>

            <p class="text-xl text-[#9795B5]">
                Rp {{ number_format($price->ticket_price, 0, ',', '.') }}
            </p>

        </div>
    @endforeach
</div>