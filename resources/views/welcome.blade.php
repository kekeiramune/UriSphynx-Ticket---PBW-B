<x-guest-layout>
<<<<<<< HEAD
    <div x-data="{ notifOpen: false }" class="overflow-x-hidden">

        <!-- HERO SECTION -->
        <div class="w-full flex justify-center px-4">
            <div class="max-w-[1900px] w-full bg-secondary rounded-[40px] lg:rounded-[70px] shadow-lg p-6 lg:p-12">

                <x-navbar>
                    <!-- LEFT MENU -->
                    <a class="hidden md:block hover:text-white hover:bg-[#8faeba] px-4 py-1 rounded-full transition"
                        href="{{ route('home') }}">Home</a>
                    <a class="hidden md:block hover:text-white hover:bg-[#8faeba] px-4 py-1 rounded-full transition"
                        href="#">Seating</a>

                    <div x-data="{ open: false }" class="relative hidden md:block">
                        <button @click="open = !open" class="flex items-center gap-1">
                            Category <img src="{{ asset('linedown.svg') }}" alt="">
                        </button>

                        <div x-show="open" @click.away="open=false"
                            class="absolute mt-2 bg-white shadow rounded-lg p-3 w-40 z-50">
                            <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Boygroup</a>
                            <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Girlgroup</a>
                            <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Co-ed</a>
                        </div>
                    </div>

                    <!-- RIGHT -->
                    <x-slot:right>
                        <div class="flex items-center gap-4">

                            <!-- NOTIF -->
                            <button @click="window.dispatchEvent(new CustomEvent('notif-open'))">
                                <img src="{{ asset('notif.svg') }}" class="w-7 h-7">
                            </button>

                            <div x-data="{ open:false }" @notif-open.window="open=true" x-show="open"
                                class="fixed top-20 right-4 w-72 bg-white rounded-xl shadow-lg p-4 z-[999]">
                                <h2 class="font-semibold mb-3">Notifications</h2>
                                <div class="space-y-2 max-h-64 overflow-auto">
                                    <div class="bg-gray-100 p-2 rounded">New concert announced</div>
                                    <div class="bg-gray-100 p-2 rounded">Payment processing</div>
                                    <div class="bg-gray-100 p-2 rounded">Ticket confirmed</div>
                                </div>
                                <button @click="open=false" class="mt-3 w-full bg-secondary text-white py-2 rounded">
                                    Close
                                </button>
                            </div>

                            <!-- PROFILE -->
                            <div x-data="{ open:false }" class="relative">

                                @auth
                                    <button @click="open=!open" class="flex items-center gap-2">
                                        <img src="{{ asset('profile.svg') }}" class="w-8 h-8 rounded-full">
                                        <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                                    </button>

                                    <div x-show="open" @click.away="open=false"
                                        class="absolute right-0 mt-2 bg-white shadow rounded-lg w-40 p-2">
                                        @if(auth()->user()->role === 'admin')
                                            <a href="{{ route('admin.dashboardadmin') }}"
                                                class="block px-3 py-2 hover:bg-gray-100 rounded">
                                                Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard') }}"
                                                class="block px-3 py-2 hover:bg-gray-100 rounded">
                                                Dashboard
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="flex items-center gap-2">
                                        <img src="{{ asset('profile.svg') }}" class="w-8 h-8 rounded-full">
                                        <span class="hidden sm:block">Login</span>
                                    </a>
                                @endguest

                            </div>

                    </x-slot:right>

                    <!-- SEARCH -->
                    <x-slot:search>
                        <div class="w-full md:w-1/2 bg-white rounded-full px-6 py-2 flex items-center gap-3 shadow">
                            <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70">
                            <input
                                class="w-full bg-transparent border-0 outline-none focus:outline-none focus:ring-0 focus:border-transparent"
                                placeholder="Search">
                        </div>
                    </x-slot:search>
                </x-navbar>

                <!-- HERO CONTENT -->
                <div class="mt-16 flex flex-col lg:flex-row items-center gap-12">
                    <img src="{{ asset('h2h.jpeg') }}" class="w-full max-w-md lg:max-w-[600px] rounded-2xl">

                    <div class="text-center lg:text-left max-w-xl">
                        <h1 class="text-3xl lg:text-5xl font-bold text-basetext">
                            Transaksi aman,<br>nonton konser nyaman
                        </h1>

                        <p class="mt-6 text-basetext leading-relaxed">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </p>

                        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <button class="bg-white px-6 py-3 rounded-full shadow">Get Started</button>
                            <a href="{{ route('login') }}"
                                class="bg-customButton px-6 py-3 rounded-full text-white flex items-center gap-2">
                                Sign In Now <img src="{{ asset('arrow1.svg') }}" class="w-3">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- CONTENT -->
        <section class="text-center mt-24 px-6">
            <h1 class="text-4xl font-bold">UriSphynx Ticket</h1>
            <p class="mt-6 max-w-3xl mx-auto text-basetext">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
        </section>

        <x-landing.concertcard :concerts="$concerts" />

        <!-- SEATING -->
        <section class="mt-24 text-center">
            <h1 class="text-4xl font-bold mb-8">Seating Plan</h1>
            <img src="{{ asset('seating.jpg') }}" class="mx-auto w-full max-w-5xl h-auto">
        </section>

        <x-landing.steps />

        <x-footer />

    </div>
</x-guest-layout>
=======
    <div x-data="{ notifOpen: false }">
    <div class="w-full flex justify-center">
        <div class="max-w-[1900px] w-full h-[650px] p-10 rounded-[70px] bg-secondary shadow-lg relative">
            <x-navbar>
    <!-- LEFT MENU -->
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="{{ route('home') }}">Home</a>
    <a class="transition-all duration-200 hover:text-[#FFFF] hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold" href="#">Seating</a>
    <div x-data="{ open: false }" class="relative">
    <a href="{{ route('category') }}"><button @click="open = !open" class="flex items-center gap-1">
        Category <span><img src="{{ asset('linedown.svg') }}" alt=""></span>
    </button></a>

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
    <div class="text-center mt-20 text-4xl font-bold text-blacktext">
        <h1>UriSphynx Ticket</h1>
        <p class="mt-8 text-[20px] font-normal text-basetext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis harum quos sint cum eaque nobis molestiae nisi, assumenda magni consequuntur fuga quia asperiores excepturi id vitae, voluptatibus dolorum rem nostrum?</p>
    </div>
    <x-landing.concertcard>
        <button class="bg-secondary text-white font-semibold py-3 px-6 rounded-[30px] inline-flex items-center hover:bg-customHover"><a href="{{ route('concert.show', $concert->id_concert) }}">See More</a></button>
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
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
