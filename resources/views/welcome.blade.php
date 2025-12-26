<x-guest-layout>
<div x-data="{ notifOpen: false }" class="overflow-x-hidden">

    <!-- HERO SECTION -->
    <div class="w-full flex justify-center px-4">
        <div class="max-w-[1900px] w-full bg-secondary rounded-[40px] lg:rounded-[70px] shadow-lg p-6 lg:p-12">

            <x-navbar>
                <!-- LEFT MENU -->
                <a class="hidden md:block hover:text-white hover:bg-[#8faeba] px-4 py-1 rounded-full transition" href="{{ route('home') }}">Home</a>
                <a class="hidden md:block hover:text-white hover:bg-[#8faeba] px-4 py-1 rounded-full transition" href="#">Seating</a>

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

                        <div x-data="{ open:false }"
                            @notif-open.window="open=true"
                            x-show="open"
                            class="fixed top-20 right-4 w-72 bg-white rounded-xl shadow-lg p-4 z-[999]">
                            <h2 class="font-semibold mb-3">Notifications</h2>
                            <div class="space-y-2 max-h-64 overflow-auto">
                                <div class="bg-gray-100 p-2 rounded">New concert announced</div>
                                <div class="bg-gray-100 p-2 rounded">Payment processing</div>
                                <div class="bg-gray-100 p-2 rounded">Ticket confirmed</div>
                            </div>
                            <button @click="open=false"
                                class="mt-3 w-full bg-secondary text-white py-2 rounded">
                                Close
                            </button>
                        </div>

                        <!-- PROFILE -->
                        <div x-data="{ open:false }" class="relative">
                            <button @click="open=!open" class="flex items-center gap-2">
                                <img src="{{ asset('profile.svg') }}" class="w-8 h-8 rounded-full">
                                <span class="hidden sm:block">{{ Auth::user()->name ?? '' }}</span>
                            </button>

                            <div x-show="open" @click.away="open=false"
                                class="absolute right-0 mt-2 bg-white shadow rounded-lg w-40 p-2">
                                <a href="{{ route('dashboard') }}" class="block px-3 py-2 hover:bg-gray-100 rounded">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="w-full text-left px-3 py-2 hover:bg-gray-100 rounded">Logout</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </x-slot:right>

                <!-- SEARCH -->
                <x-slot:search>
                    <div class="w-full md:w-1/2 bg-white rounded-full px-6 py-2 flex items-center gap-3 shadow">
                        <img src="{{ asset('search.svg') }}" class="w-5 h-5 opacity-70">
                        <input class="w-full bg-transparent outline-none" placeholder="Search">
                    </div>
                </x-slot:search>
            </x-navbar>

            <!-- HERO CONTENT -->
            <div class="mt-16 flex flex-col lg:flex-row items-center gap-12">
                <img src="{{ asset('h2h.jpeg') }}"
                    class="w-full max-w-md lg:max-w-[600px] rounded-2xl">

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
