@props(['concerts', 'prices'])

<x-guest-layout>
    <div x-data="{ notifOpen: false }">
        <!-- HERO -->
        <div class="w-full flex justify-center">
            <div class="max-w-[1900px] w-full h-[650px] p-10 rounded-[70px] bg-secondary shadow-lg relative">
                <x-navbar>
                    <!-- LEFT MENU -->
                    <a class="transition-all duration-200 hover:text-white hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold"
                        href="{{ route('home') }}">Home</a>

                    <a class="transition-all duration-200 hover:text-white hover:px-4 hover:rounded-[30px] hover:py-1 hover:bg-[#8faeba] hover:font-bold"
                        href="#">Seating</a>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-1">
                            Category <span><img src="{{ asset('linedown.svg') }}" alt=""></span>
                        </button>

                        <div x-show="open" x-transition @click.away="open = false"
                            class="absolute bg-white shadow-lg rounded-lg mt-2 p-3 w-40 z-50 origin-top">
                            <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Boygroup</a>
                            <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Girlgroup</a>
                            <a href="#" class="block px-3 py-2 hover:bg-gray-100 rounded">Co-ed group</a>
                        </div>
                    </div>

                    <x-slot:right>
                        <div class="flex justify-end gap-5 text-xl">
                            <button @click="window.dispatchEvent(new CustomEvent('notif-open'))">
                                <img class="w-8 h-8 relative" src="{{ asset('notif.svg') }}" alt="">
                            </button>

                            <!-- NOTIFICATION DROPDOWN -->
                            <div x-data="{ open: false }" @notif-open.window="open = true" x-show="open"
                                class="fixed top-20 right-10 w-80 bg-white shadow-xl rounded-2xl p-5 z-[999] border">
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

                                <button class="mt-4 w-full bg-secondary text-white py-2 rounded-lg"
                                    @click="open = false">
                                    Close
                                </button>
                            </div>

                            <!-- PROFILE DROPDOWN -->
                            <div x-data="{ openProfile: false }" class="relative ml-auto">
                                <button @click="openProfile = !openProfile" class="flex items-center gap-2">
                                    <img src="{{ asset('profile.svg') }}" class="w-9 h-9 rounded-full object-cover"
                                        alt="">
                                    <span>
                                        @if(Auth::check())
                                            {{ Auth::user()->name }}
                                        @endif
                                    </span>
                                </button>

                                <div x-show="openProfile" x-transition @click.away="openProfile = false"
                                    class="absolute right-0 bg-white shadow-lg rounded-lg mt-2 p-3 w-44 z-50 origin-top">
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-3 py-2 hover:bg-gray-100 rounded">Dashboard</a>
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

                    <x-slot:search>
                        <div class="w-1/2 bg-white rounded-full px-8 py-1 flex items-center gap-3 shadow">
                            <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70" alt="">
                            <input type="text" placeholder="Search"
                                class="w-full bg-transparent border-none outline-none focus:ring-0 font-dmsans text-blacktext" />
                        </div>
                    </x-slot:search>
                </x-navbar>

                <img class="absolute rounded-[29.273px] w-[592px] h-[380px] top-[120px] mt-[50px] left-10"
                    src="{{ asset('h2h.jpeg') }}" alt="">

                <div
                    class="absolute right-10 top-[180px] mt-[60px] text-basetext font-bold text-[48px] leading-[56px] flex flex-col gap-6">
                    <h1>Transaksi aman,</h1>
                    <span>nonton konser nyaman</span>
                </div>

                <div
                    class="absolute left-[700px] bottom-10 top-[350px] mt-[60px] w-[550px] text-basetext font-normal text-[18px] leading-[28px]">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>

                <div class="absolute bottom-10 right-[200px] flex gap-4">
                    <div class="mt-16 mb-3">
                        <button
                            class="bg-white hover:bg-customHover text-blacktext font-semibold py-3 px-6 rounded-[36.55px] shadow-md">
                            Get Started
                        </button>
                    </div>
                    <div class="mt-16 mb-3">
                        <a href="{{ route('login') }}"
                            class="bg-customButton hover:bg-customHover text-white font-semibold py-3 px-6 rounded-[36.55px] flex items-center gap-2 shadow-md">
                            Sign in Now
                            <img src="{{ asset('arrow1.svg') }}" class="w-[13.5px] h-[12.691px]" alt="icon">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- DETAIL CONCERT -->
        <div class="text-center mb-8 mt-[100px] text-4xl font-bold text-blacktext">
            <p class="text-xl font-normal mb-3 uppercase">
                {{ $concerts->category->type ?? 'Uncategorized' }}
            </p>
            <h1 class="mb-3">{{ $concerts->concert_name }}</h1>
            <p class="text-lg">{{ $concerts->venue }} - {{ $concerts->concert_date }}</p>
        </div>

        <div class="w-full flex justify-center">
            <img class="h-[450px] w-[900px] rounded-[20px]"
                src="https://kpop-center.com/wp-content/uploads/2024/09/aespa_main-2.png" alt="">
        </div>

        <!-- ✅ SEAT SELECT CLEAN -->
        <div x-data="{ selectedCp: null }" class="max-w-5xl mx-auto px-6 mt-16">

            <h2 class="text-center font-semibold mb-10">Select Ticket Category :</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                @forelse($prices as $p)
                    @php
                        $remaining = max(0, $p->quota - $p->sold);
                        $soldOut = $remaining <= 0;
                        $cpId = $p->getKey();
                    @endphp

                    <div @click="if(!{{ $soldOut ? 'true' : 'false' }}) selectedCp = {{ $cpId }}"
                        class="relative rounded-3xl border p-14 bg-white text-center cursor-pointer transition select-none"
                        :class="selectedCp === {{ $cpId }}
                        ? 'border-black ring-2 ring-black shadow-lg scale-[1.01]'
                        : 'border-gray-200 hover:border-gray-400 hover:shadow'">
                        @if($soldOut)
                            <span class="absolute top-4 right-4 text-xs px-3 py-1 rounded-full bg-red-100 text-red-600">
                                SOLD OUT
                            </span>
                        @endif

                        <div class="text-2xl font-bold">{{ $p->seating->name_seating }}</div>

                        <div class="mt-6 text-sm tracking-widest text-gray-400 uppercase">
                            Rp {{ number_format($p->ticket_price) }}
                        </div>

                        <div class="mt-3 text-xs text-gray-500">
                            Sisa: {{ $remaining }}
                        </div>

                        <!-- check indicator -->
                        <div class="absolute bottom-5 right-5 h-7 w-7 rounded-full border flex items-center justify-center"
                            :class="selectedCp === {{ $cpId }} ? 'bg-black border-black' : 'border-gray-300'">
                            <svg x-show="selectedCp === {{ $cpId }}" class="h-4 w-4 text-white" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8.1 8.1a1 1 0 01-1.414 0l-3.9-3.9a1 1 0 011.414-1.414l3.193 3.193 7.393-7.393a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        @if($soldOut)
                            <div class="absolute inset-0 rounded-3xl bg-white/60 cursor-not-allowed"></div>
                        @endif
                    </div>

                @empty
                    <p class="text-center text-gray-400 col-span-full">Tiket belum tersedia.</p>
                @endforelse
            </div>

            <!-- tombol bawah: masih bisa alert dulu -->
            <div class="flex justify-center items-center mt-12 mb-20">
                <button type="button" :disabled="!selectedCp" @click="alert('Selected Concert Price ID: ' + selectedCp)"
                    class="rounded-[36.55px] text-white py-3 w-full max-w-5xl transition"
                    :class="selectedCp ? 'bg-blacktext hover:bg-gray-700' : 'bg-gray-300 cursor-not-allowed'">
                    <a href="{{ route('payment.form', $concerts->id_concert) }}">Select Ticket</a>
                </button>
            </div>

        </div>

        <x-footer>
            <div class="flex flex-col md:flex-row items-center justify-center gap-12 p-12">
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
                @if (session('notif') === 'open')
                    setTimeout(() => {
                        window.dispatchEvent(new CustomEvent('notif-open'));
                    }, 10);
                @endif
            });
        </script>

    </div>
</x-guest-layout>