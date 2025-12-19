<x-guest-layout>
    <x-guest-layout>
    <div x-data="{ notifOpen: false }">
    <div class="w-full flex justify-center">
        <div class="max-w-[1900px] w-full h-[650px] p-10 rounded-[70px] bg-secondary shadow-lg relative">
            <x-navbar>
    <!-- LEFT MENU -->
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="{{ route('home') }}">Home</a>
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


<x-slot:right>
<div class="flex justify-end gap-5 text-xl">
    <button 
    @click="window.dispatchEvent(new CustomEvent('notif-open'))"
    >
    <img class="w-8 h-8 relative" src="{{ asset('notif.svg') }}" alt="">
</button>

<!-- NOTIFICATION DROPDOWN -->
<div 
    x-data="{ open: false }"
    @notif-open.window="open = true"
    @notif-close.window="open = false"
    x-show="open"
    class="fixed top-20 right-10 w-80 bg-white shadow-xl rounded-2xl p-5 z-[999] border"
>
    <h2 class="font-semibold text-lg mb-3">Notifications</h2>

    <div class="space-y-3 max-h-72 overflow-auto">
        <div class="p-3 bg-gray-100 rounded-lg">
            <p>Your favorite group just announced a new concert!</p>
        </div>

        <div class="p-3 bg-gray-100 rounded-lg">
            <p>Your payment is being processed…</p>
        </div>

        <div class="p-3 bg-gray-100 rounded-lg">
            <p>Your ticket is confirmed!</p>
        </div>
    </div>

    <button
     
        class="mt-4 w-full bg-secondary text-white py-2 rounded-lg"
        @click="open = false"
    >
        Close
    </button>
</div>

    <!-- PROFILE DROPDOWN -->
<div x-data="{ openProfile: false }" class="relative ml-auto">
    <button @click="openProfile = !openProfile" class="flex items-center gap-2">
        <img
            src="{{ asset('profile.svg') }}"
            alt=""
            class="w-9 h-9 rounded-full object-cover top-full"
        />
        <span>
            @if(Auth::check())
            {{ Auth::user()->name }}
            @endif
        </span>
    </button>

    <div
        x-show="openProfile"
        x-transition
        @click.away="openProfile = false"
        class="absolute right-0 bg-white shadow-lg rounded-lg mt-2 p-3 w-44 z-50 origin-top"
    >
        <a href="#" class=""></a>
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 hover:bg-gray-100 rounded">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="block w-full text-left px-3 py-2 hover:bg-gray-100 rounded">
                Logout
            </button>
        </form>
    </div>
</div>
</div>
</x-slot:right>


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
    <div class="text-center mb-8 mt-[100px] text-4xl font-bold text-blacktext">
        <h1>Concert Name</h1>
    <p>Location - Date</p>
    </div>
    <img class="h-[450px] w-[900px] relative left-[190px] rounded-[20px]" src="https://kpop-center.com/wp-content/uploads/2024/09/aespa_main-2.png" alt="">
    <x-concertp.containseat :seats="$seats">
    </x-concertp.containseat>
    <div class="flex justify-center items-center mt-10 mb-20">
        <button class="bg-blacktext rounded-[36.55px] text-white px-[320px] hover:bg-gray-700 py-3">Select Ticket</button>
    </div>
    <x-footer>
        <div class="flex flex-col absolute right-[100px] md:flex-row items-center justify-center gap-12 p-12">
            <a href="{{ route('home') }}">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('fb.svg') }}" alt=""></a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('insta.svg') }}" alt=""></a>
            <a href="#" target="_blank"><img class="w-8 h-8" src="{{ asset('twit.svg') }}" alt=""></a>
        </div>
    </x-footer>

    <script>
    document.addEventListener('alpine:init', () => {
        @if(session('notif') === 'open')
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('notif-open'));
            }, 10); // beri waktu alpine hidup
        @endif
    });
</script>
</div>
</x-guest-layout>

</x-guest-layout>