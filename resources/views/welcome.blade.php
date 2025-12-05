<x-guest-layout>
    <div class="w-full flex justify-center">
        <div class="max-w-[1900px] w-full h-[650px] p-10 rounded-[70px] bg-secondary shadow-lg relative">
            <x-navbar>
    <!-- LEFT MENU -->
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="#">Home</a>
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="#">Seating</a>
    <div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center gap-1">
        Category <span><img src="{{ asset('linedown.svg') }}" alt=""></span>
    </button>

    <div
        x-show="open"
        x-transition
        @click.away="open = false"
        class="absolute bg-white shadow-lg rounded-lg mt-2 p-3 w-40 z-50 origin-top"
    >
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Boygroup</a>
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Girlgroup</a>
        <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Co-ed group</a>
    </div>
</div>


    <!-- SEARCH BAR -->
    <x-slot:search>
    <div class="w-1/2 bg-white rounded-full px-8 py-1 flex items-center gap-3 shadow">
        <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70" alt="">
        <input
        type="text"
        placeholder="Search"
        class="w-full bg-transparent border-none outline-none focus:outline-none focus:ring-0 focus:border-none font-dmsans text-blacktext"
    />
</div>
</x-slot:search>
</x-navbar>
            <img class="absolute rounded-[29.273px] w-[592px] h-[380px] top-[120px] mt-[50px] left-10" src="{{ asset('h2h.jpeg') }}" alt="">
            <div class="absolute right-10 top-[180px] mt-[60px] text-basetext font-bold text-[48px] leading-[56px] flex flex-col gap-6">
                <h1>Transaksi aman,</h1>
            <span>nonton konser nyaman</span>
            </div>
            <div class="absolute left-[700px] bottom-10 top-[350px] mt-[60px] w-[550px] text-basetext font-normal text-[18px] leading-[28px]">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit labore placeat minima nemo eaque animi, delectus molestias saepe in porro aliquam voluptatibus sint, alias ratione quasi pariatur? Ad, optio eum?</p>
            </div>
            <div class="absolute bottom-10 right-[200px] flex gap-4">
    <!-- tombol putih -->
     <div class="mt-16 mb-3">
        <button class="bg-white hover:bg-customHover text-blacktext font-semibold py-3 px-6 rounded-[36.55px] shadow-md">
        Get Started
    </button>
     </div>

    <!-- tombol biru -->
     <div class="mt-16 mb-3">
         <button class="bg-customButton hover:bg-customHover text-white font-semibold py-3 px-6 rounded-[36.55px] flex items-center gap-2 shadow-md">
        <a href="{{ route('login') }}">Sign in Now</a>
        <img src="{{ asset('arrow1.svg') }}" class="w-[13.5px] h-[12.691px]" alt="icon">
    </button>
     </div>
</div>
        </div>
    </div>
    <div class="text-center mt-20 text-4xl font-bold text-blacktext">
        <h1>UriSphynx Ticket</h1>
        <p class="mt-8 text-[20px] font-normal text-basetext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis harum quos sint cum eaque nobis molestiae nisi, assumenda magni consequuntur fuga quia asperiores excepturi id vitae, voluptatibus dolorum rem nostrum?</p>
    </div>
    <x-landing.concertcard>
        <button class="bg-secondary text-white font-semibold py-3 px-6 rounded-[30px] inline-flex items-center hover:bg-customHover">See More</button>
        </x-landing.concertcard>
    <div class="text-center mt-[150px] text-4xl font-bold text-blacktext">
        <h1>Seating Plan</h1>
    </div>
    <div class="w-full flex justify-center mt-10 mb-10">
        <img src="{{ asset('seating.jpg') }}" alt="">
    </div>
    <div class="text-center text-4xl font-bold text-blacktext">
        <h1>How to Purchase a Ticket?</h1>
    </div>
    <x-landing.steps>
    </x-landing.steps>
    </div>
    <x-footer>
        <div class="flex flex-col absolute right-[100px] md:flex-row items-center justify-center gap-12 p-12">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('fb.svg') }}" alt=""></a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('insta.svg') }}" alt=""></a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('twit.svg') }}" alt=""></a>
        </div>
    </x-footer>
</x-guest-layout>
