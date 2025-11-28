<x-guest-layout>
    <div class="w-full flex justify-center mt-0">
        <div class="max-w-[1900px] w-full h-[600px] p-10 rounded-[70px] bg-secondary shadow-lg relative">
            <img class="absolute rounded-[29.273px] w-[592px] h-[380px] top-[120px] left-10" src="{{ asset('h2h.jpeg') }}" alt="">
            <div class="absolute right-10 top-[180px] text-basetext font-bold text-[48px] leading-[56px] flex flex-col gap-6">
                <h1>Transaksi aman,</h1>
            <span>nonton konser nyaman</span>
            </div>
            <div class="absolute left-[700px] bottom-10 top-[350px] w-[550px] text-basetext font-normal text-[18px] leading-[28px]">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit labore placeat minima nemo eaque animi, delectus molestias saepe in porro aliquam voluptatibus sint, alias ratione quasi pariatur? Ad, optio eum?</p>
            </div>
            <div class="absolute bottom-10 right-[200px] flex gap-4">
    <!-- tombol putih -->
    <button class="bg-white hover:bg-customHover text-blacktext font-semibold py-3 px-6 rounded-[36.55px] shadow-md">
        Get Started
    </button>

    <!-- tombol biru -->
    <button class="bg-customButton hover:bg-customHover text-white font-semibold py-3 px-6 rounded-[36.55px] flex items-center gap-2 shadow-md">
        Sign in Now
        <img src="{{ asset('arrow1.svg') }}" class="w-[13.5px] h-[12.691px]" alt="icon">
    </button>
</div>
        </div>
    </div>
    <div class="text-center mt-20 text-4xl font-bold text-blacktext">
        <h1>UriSphynx Ticket</h1>
        <p class="mt-8 text-[20px] font-normal text-basetext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis harum quos sint cum eaque nobis molestiae nisi, assumenda magni consequuntur fuga quia asperiores excepturi id vitae, voluptatibus dolorum rem nostrum?</p>
    </div>
    <x-landing.concertcard>
        </x-landing.concertcard>
    <div class="text-center mt-[150px] text-4xl font-bold text-blacktext">
        <h1>Seating Plan</h1>
    </div>
    <div class="text-center mt-[150px] text-4xl font-bold text-blacktext">
        <h1>How to Purchase a Ticket?</h1>
    </div>
    <x-landing.steps>
    </x-landing.steps>
</x-guest-layout>
